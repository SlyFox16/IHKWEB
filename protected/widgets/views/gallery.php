<ul class="attached">
    <?php if (count($model->pdf) > 0) { ?>
        <?php foreach ($model->pdf as $image) { ?>
            <li class="thumb-content">
                <?php
                    $fpath = explode("/", $image->path);
                    $fileName = end($fpath);
                    echo CHtml::link($image->title, array('/user/download', 'fileName' => $fileName));
                ?>
                <a href="javascript:void(0)" title="Remove" class="delete fa fa-times" id="<?php echo $image->id; ?>"></a>
            </li>
        <?php } ?>
    <?php } ?>
</ul>

<script>
    <?php Yii::app()->clientScript->registerScript('popoverActivate',"
        $('.thumb-content').on('click', '.delete', function () {
            var self = $(this);
            $.ajax({
                type:'POST',
                data:{id: self.attr('id')},
                url:'".Yii::app()->createUrl(lcfirst(get_class($model)) . '/imagedel')."',
                success:function (msg) {
                    self.closest('li').fadeOut();
                }
            });
        });
", CClientScript::POS_END);?>
</script>