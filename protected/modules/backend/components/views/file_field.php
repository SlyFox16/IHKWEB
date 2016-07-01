<?php
/**
 * Created by Idol IT.
 * Date: 10/3/12
 * Time: 11:15 AM
 */

?>

<?php if (!empty($model->$attribute)) { ?>
    <?php if (@getimagesize(Yii::app()->basePath . '/../' . $model->$attribute)) { ?>
        <div class="span5 fileupload-new thumbnail">
            <?php
                $path_info = pathinfo($model->$attribute);
                if(!empty($model->$attribute) && $path_info['extension'] == 'gif') {
                    $img = CHtml::image('/'.$model->$attribute, 'image', array('width' => 510));
                    echo $img;
                } elseif(!empty($model->$attribute) && $path_info['extension'] != 'swf') {
                    if ($size != null)
                        echo CHtml::image(Yii::app()->iwi->load($model->$attribute)->resize(intval($size[0]), intval($size[1]))->cache());
                    else
                        echo CHtml::image(Yii::app()->iwi->load($model->$attribute)->cache());
                } elseif(!empty($model->$attribute) && $path_info['extension'] == 'swf') { ?>
                    <object
                        classid="clsid:D697CDE7E-AE6D-11cf-96B8-458453540000"
                        codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0"
                        id="animation name">

                        <param name="movie" value="<?php echo Yii::app()->request->baseUrl .'/'. $model->$attribute; ?>">
                        <param name="quality" value="high">
                        <param name="bgcolor" value="#FFFFFF">

                        <embed
                            name="animationname"
                            src="<?php echo Yii::app()->request->baseUrl .'/'. $model->$attribute; ?>"
                            width="100%"
                            quality="high"
                            bgcolor="#FFFFFF"
                            type="application/x-shockwave-flash"
                            pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
                        </embed>
                    </object>
               <?php }
            ?>
        </div>
    <?php } else { ?>
        <p><?php echo CHtml::link($model->$attribute, "/".$model->$attribute, array("target" => "_blank"))?></p>
    <?php } ?>
    <div class="clearfix"></div>
    <label class="checkbox ff-thumb-label" for="<?php echo CHtml::activeId($model, $attribute); ?>_remove">
        <input name="<?php echo CHtml::activeName($model, $attribute . "_remove"); ?>"
               id="<?php echo CHtml::activeId($model, $attribute); ?>_remove" value="1" type="checkbox">
        Remove?</label>

<?php } ?>
<div class="fileupload fileupload-new" data-provides="fileupload">
    <div class="input-append">
        <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span
                class="fileupload-preview"></span></div>
        <span class="btn btn-file"><span class="fileupload-new">Select file</span><span
                class="fileupload-exists">Change</span><input type="file"
                                                              name="<?php echo CHtml::activeName($model, $attribute) ?>"></span>
        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
    </div>

</div>

<script>
    $().ready(function () {
        $('.fileupload').fileupload({uploadtype: "file", name: "<?php echo CHtml::activeName($model, $attribute) ?>"})
    });
</script>