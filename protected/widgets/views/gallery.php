<div class="heading clearfix">
    <h3 class="pull-left">Pdf files</h3>
</div>
<div class="control-group "><label class="control-label">&nbsp;</label>
    <div class="controls">
        <div class="wmk_grid">
            <?php if (count($model->pdf) > 0) { ?>
                <div class="row">
                    <?php foreach ($model->pdf as $image) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 element thumb-image">
                            <div class="thumbnail-box">
                                <div class="thumb-content">
                                    <div class="center-vertical">
                                        <div class="center-content">
                                            <i class="icon-helper icon-center animated fadeIn font-white glyph-icon icon-linecons-search"></i>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" title="Remove" class="delete" id="<?php echo $image->id; ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                                <div class="thumb-overlay bg-black"></div>
                                <?php
                                    $fpath = explode("/", $image->path);
                                    $fileName = end($fpath);
                                    echo CHtml::link($image->title, array('/user/download', 'fileName' => $fileName));
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    There is no files. <?php if(!$noUpload) { ?>Click <strong>Select files</strong> to upload pdf. <?php } ?>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<script>
    $(".thumb-content").on("click", '.delete', function () {
        var $this = $(this);
        $.ajax({
            type:"POST",
            data:{id:$this.attr("id")},
            url:"<?php echo Yii::app()->createUrl(lcfirst(get_class($model)) . "/imagedel"); ?>",
            success:function (msg) {
                $this.closest(".element").fadeOut();
            }
        });
    });
</script>