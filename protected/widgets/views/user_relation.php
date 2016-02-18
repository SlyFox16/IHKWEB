<li>
    <ul class="input-list related-list">
        <?php $connected = $user->connectedUsers;
        if($connected) { ?>
            <?php foreach($connected as $conUser) { ?>
                <li class="relateduser">
                    <div>
                        <?php echo $conUser->fullName; ?>
                        <a href="javascript:void(0)" title="Remove" class="delete fa fa-times" data-id="<?php echo $conUser->id; ?>">
                        </a>
                    </div>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
    <div class="field-content">
        <div>
            Related User
        </div>
        <div>
            <ul class="add-input">
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
                    <a class="fa fa-plus" id="add-user-to-user"></a>
                </li>
            </ul>
        </div>
    </div>
</li>



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
                    $('.related-list').append(data);
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

    $(".related-list").on("click", '.delete', function () {
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