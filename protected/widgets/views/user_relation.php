<label>
    <span><?php echo Yii::t("base", "Related User"); ?></span>
    <ul class="input-add">
        <li>
            <?php $this->widget(
                'booster.widgets.TbSelect2',
                [
                    'name' => 'ProductSelect',
                    'asDropDownList' => false,
                    'options' => [
                        'minimumInputLength' => 2,
                        'placeholder' => 'Select user',
                        'width' => '100%',
                        'allowClear' => true,
                        'ajax' => [
                            'url' => Yii::app()->controller->createUrl('/site/suggest'),
                            'dataType' => 'json',
                            'data' => 'js:function(term, page) { return {term: term }; }',
                            'results' => 'js:function(data) { return {results: data}; }',
                        ],
                        'formatResult' => 'js:productFormatResult',
                        'formatSelection' => 'js:productFormatSelection',
                    ],
                    'htmlOptions' => [
                        'id' => 'user-select',
                        'class' => 'form-control'
                    ],
                ]
            );?>
        </li>
        <li>
            <a id="add-user-to-user" href="" class="fa fa-plus"></a>
        </li>
    </ul>
</label>
<ul class="attached">
    <?php $connected = $user->connectedUsers;
    if($connected) { ?>
        <?php foreach($connected as $conUser) { ?>
            <li class="relateduser">
                <?php echo $conUser->fullName; ?>
                <a href="javascript:void(0)" title="<?php echo Yii::t("base", "Remove"); ?>" class="delete fa fa-times" data-id="<?php echo $conUser->id; ?>">
                </a>
            </li>
        <?php } ?>
    <?php } ?>
</ul>


<?php Yii::app()->clientScript->registerScript('add-user-to-user', "
    $('#add-user-to-user').click(function (e) {
        e.preventDefault();
        var userId = $('#user-select').select2('val');
        if (userId) {
            $.ajax({
                url: '".Yii::app()->controller->createUrl('/user/userRow')."',
                type: 'get',
                data: {
                'user_receiver': userId
                },
                success: function (data) {
                $('.attached').append(data);
            }
            });
        }
    });

    $('.attached').on('click', '.delete', function () {
        var self = $(this);
        $.ajax({
            type:'POST',
            data:{id:self.data('id')},
            url: '".Yii::app()->controller->createUrl('/user/deleteRelation')."',
            success:function (msg) {
                self.closest('li').fadeOut();
            }
        });
    });
", CClientScript::POS_END); ?>

<script type="text/javascript">
    function productFormatSelection(product) {
        return product.label;
    }

    function productFormatResult(user) {
        var markup = "<table class='result'><tr>";
        markup += "<td class='info'><div class='title'>" + user.label + "</div>";
        markup += "</td></tr></table>";
        return markup;
    }
</script>