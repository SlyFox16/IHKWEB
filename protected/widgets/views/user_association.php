<label>
    <span><?php echo Yii::t("base", "User association"); ?></span>
    <ul class="input-add">
        <li>
            <?php $this->widget(
                'booster.widgets.TbSelect2',
                [
                    'name' => 'ProductAssociation',
                    'asDropDownList' => true,
                    'data' => AssociationMembership::model()->assocList,
                    'options' => [
                        /*'minimumInputLength' => 2,*/
                        'placeholder' => Yii::t("base", 'Select association'),
                        'width' => '100%',
                        'allowClear' => true,
                        /*'ajax' => [
                            'url' => Yii::app()->controller->createUrl('/site/associationSuggest'),
                            'dataType' => 'json',
                            'data' => 'js:function(term, page) { return {term: term }; }',
                            'results' => 'js:function(data) { return {results: data}; }',
                        ],
                        'formatResult' => 'js:productFormatResult2',
                        'formatSelection' => 'js:productFormatSelection2',*/
                    ],
                    'htmlOptions' => [
                        'id' => 'user-association',
                        'class' => 'form-control'
                    ],
                ]
            );?>
        </li>
        <li>
            <a id="add-assoc-to-user" href="" class="fa fa-plus"></a>
        </li>
    </ul>
</label>
<ul class="attached attachedassoc">
    <?php $connected = $user->connectedAssoc;
    if($connected) { ?>
        <?php foreach($connected as $conUser) { ?>
            <li>
                <?php echo $conUser->name; ?>
                <a href="javascript:void(0)" title="<?php echo Yii::t("base", "Remove"); ?>" class="delete fa fa-times" data-id="<?php echo $conUser->id; ?>">
                </a>
            </li>
        <?php } ?>
    <?php } ?>
</ul>


<?php Yii::app()->clientScript->registerScript('add-assoc-to-user23', "
    $('#add-assoc-to-user').click(function (e) {
        e.preventDefault();
        var userId = $('#user-association').select2('val');
        if (userId) {
            $.ajax({
                url: '".Yii::app()->controller->createUrl('/user/userAssoc')."',
                type: 'get',
                data: {
                'user_assoc': userId
                },
                success: function (data) {
                $('.attachedassoc').append(data);
            }
            });
        }
    });

    $('.attachedassoc').on('click', '.delete', function () {
        var self = $(this);
        $.ajax({
            type:'POST',
            data:{id:self.data('id')},
            url: '".Yii::app()->controller->createUrl('/user/deleteAssoc')."',
            success:function (msg) {
                self.closest('li').fadeOut();
            }
        });
    });
", CClientScript::POS_END); ?>

<script type="text/javascript">
    function productFormatSelection2(product) {
        return product.label;
    }

    function productFormatResult2(user) {
        var markup = user.label;
        return markup;
    }
</script>