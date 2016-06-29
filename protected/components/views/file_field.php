<?php
    $attributeClean = preg_replace('~^\[[0-9]+\]~', '', $attribute);
    $id = CHtml::activeId($model, $attribute).rand(1,10000).uniqid();
?>

<div data-provides="fileinput" class="fileinput fileinput-new input-group">
    <input id="<?php echo $id; ?>" type="file" data-show-cancel="false" data-show-upload="false" data-show-caption="true" name="<?php echo CHtml::activeName($model, $attribute) ?>" data-allowed-file-extensions='[<?php echo $htmlOptions['extensions']; ?>]'>
    <?php echo CHtml::activeHiddenField($model, $attribute."_remove", array('value'=>0)); ?>
    <?php
        if(isset($htmlOptions['hintText']))
            echo CHtml::tag('p', array('class' => 'help-block'), $htmlOptions['hintText']);
    ?>
</div>

<?php
$swf = false;
$initial = null;

Yii::app()->clientScript->registerScript('remove_kartik_file_'.$id,'
    $("#'. $id.'").on("fileclear", function(event) {
	    $("#'. CHtml::activeId($model, $attribute).'_remove").val(1);
	});
	$("#'. $id.'").on("fileloaded", function(event) {
	    $("#'. CHtml::activeId($model, $attribute).'_remove").val(0);
	});
', CClientScript::POS_READY);

$allowedImages = array('gif', 'png', 'jpg', 'jpeg');

if (!empty($model->$attributeClean)) {
    $path_info = pathinfo($model->$attributeClean);
    if(!empty($model->$attributeClean) && in_array($path_info['extension'], $allowedImages)) {
        $initial = CHtml::image('/'.$model->$attributeClean, 'image', array('width' => 510));
    } elseif(!empty($model->$attributeClean) && $path_info['extension'] != 'swf') {
        $initial = CHtml::image($model->$attributeClean, 'image', array('class' => 'file-preview-image'));
    } elseif(!empty($model->$attributeClean) && $path_info['extension'] == 'swf') {$swf = true; ob_start(); ?>
        <div class='file-preview-frame'>
            <object
                classid="clsid:D697CDE7E-AE6D-11cf-96B8-458453540000"
                codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0"
                id="animation name">

                <param name="movie" value="<?php echo Yii::app()->request->baseUrl .'/'. $model->$attributeClean; ?>">
                <param name="quality" value="high">
                <param name="bgcolor" value="#FFFFFF">

                <embed
                    name="animationname"
                    src="<?php echo Yii::app()->request->baseUrl .'/'. $model->$attributeClean; ?>"
                    width="100%"
                    quality="high"
                    bgcolor="#FFFFFF"
                    type="application/x-shockwave-flash"
                    pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
                </embed>
            </object>
        </div>
        <?php $initial = ob_get_clean(); }
}
?>

<?php if($swf == true && !empty($initial)) {
    $initialPreview = "\"<div class='file-preview-text'><h2><i class='glyphicon glyphicon-file'></i></h2>Filename.xlsx</div>\"";
} elseif($path_info['extension'] == 'pdf') {
    $initialPreview = "\"<div class='file-preview-text'><h2><i class='glyphicon glyphicon-file'></i></h2>File.pdf</div>\"";
} else {
    $initialPreview = '[\''.addslashes(trim($initial)).'\']';
} ?>


<?php Yii::app()->clientScript->registerScript('popoverActivate'.$id,"
        $(document).on('ready', function(){\$('#".$id."').fileinput({
            initialPreview: ".$initialPreview.",
            overwriteInitial: true
        });
    });
", CClientScript::POS_END);?>