<div class="heading clearfix">
    <h3 class="pull-left">Images</h3>
</div>
<div class="control-group ">
    <label class="control-label">&nbsp;</label>
    <div class="controls">
        <div class="wmk_grid">
            <?php $images = $model->$relation; ?>
            <?php if (count($images) > 0) { ?>
                <ul>
                    <?php foreach ($images as $image) { ?>
                        <li class="thumbnail">
                            <a href="<?php echo Yii::app()->iwi->load($image->$attribute)->cache(); ?>" rel="gallery" class="cboxElement">
                                <img src="<?php echo Yii::app()->iwi->load($image->$attribute)->adaptive(200, 150)->cache(); ?>" alt="">
                            </a>
                            <?php if(get_class($image) == 'MasterClassImage') { ?>
                                <p style="float:left;">
                                    <input type="radio" name="<?php echo get_class($image);?>[preview]"value="<?php echo $image->id;?>"<?php if($image->preview) echo " checked='checked'"?>> cover
                                </p>
                            <?php } ?>
                            <p>
                                <a href="javascript:void(0)" title="Remove" class="delete" id="<?php echo $image->id; ?>"><i class="icon-trash"></i></a>
                            </p>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">?</button>
                There is no images. Click <strong>Select files</strong> to upload images.
            </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>