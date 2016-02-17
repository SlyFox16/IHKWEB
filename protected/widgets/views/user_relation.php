<li>
    <ul class="relateduser">
        <?php $connected = $user->connectedUsers;
        if($connected) { ?>
            <?php foreach($connected as $conUser) { ?>
                <li>
                    <?php echo $conUser->fullName; ?>
                    <a href="javascript:void(0)" title="Remove" class="delete" data-id="<?php echo $conUser->id; ?>">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</li>

<div class="row" style="margin-top:20px">
    <div class="col-sm-10">
        <div class="form-group">
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
        </div>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-primary btn btn-default btn-block" href="#" id="add-user-to-user">
            <?= Yii::t('base','Add'); ?>
        </a>
    </div>
</div>

<script type="text/javascript">
    $('#add-user-to-user').click(function (e) {
        e.preventDefault();
        var userId = $("#user-select").select2("val");
        if (userId) {
            $.ajax({
                url: '<?= Yii::app()->controller->createUrl('/user/userRow')?>',
                type: 'get',
                data: {
                    'user_receiver': userId
                },
                success: function (data) {
                    $('.relateduser').append('<li>'+data+'</li>');
                }
            });
        }
    });

    function productFormatSelection(product) {
        return product.label;
    }

    function productFormatResult(user) {
        var markup = "<table class='result'><tr>";
        markup += "<td class='info'><div class='title'>" + user.label + "</div>";
        markup += "</td></tr></table>";
        return markup;
    }

    $(".relateduser").on("click", '.delete', function () {
        var $this = $(this);
        $.ajax({
            type:"POST",
            data:{id:$this.data("id")},
            url: '<?= Yii::app()->controller->createUrl('/user/deleteRelation')?>',
            success:function (msg) {
                $this.closest("li").fadeOut();
            }
        });
    });
</script>