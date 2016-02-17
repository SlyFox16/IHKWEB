
<ul class="input-list">
    <?php if (count($model->pdf) > 0) { ?>
        <?php foreach ($model->pdf as $image) { ?>
            <li class="thumb-content">
                <div>
                    <?php
                        $fpath = explode("/", $image->path);
                        $fileName = end($fpath);
                        echo CHtml::link($image->title, array('/user/download', 'fileName' => $fileName));
                    ?>
                    <a href="javascript:void(0)" title="Remove" class="delete fa fa-times" id="<?php echo $image->id; ?>"></a>
                </div>
            </li>
        <?php } ?>
    <?php } ?>
</ul>

<script>
    $(".thumb-content").on("click", '.delete', function () {
        var $this = $(this);
        $.ajax({
            type:"POST",
            data:{id:$this.attr("id")},
            url:"<?php echo Yii::app()->createUrl(lcfirst(get_class($model)) . "/imagedel"); ?>",
            success:function (msg) {
                $this.closest("li").fadeOut();
            }
        });
    });
</script>