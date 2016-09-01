<?php
    $attributeClean = preg_replace('~^\[[0-9]+\]~', '', $attribute);
    $id = CHtml::activeId($model, $attribute).rand(1,10000).uniqid();
?>

    <input id="<?php echo $id; ?>" type="file" multiple class="file-loading" name="<?php echo CHtml::activeName($model, $attribute) ?>">

<?php
$images = $model->$relation;
$initial = array();
$initialConfig = array();
if($images) {
    foreach($images as $image) {
        $fileParts = pathinfo('/'.$image->path);
        if(in_array($fileParts['extension'], array('aac', 'ogg', 'mp3', 'vav')))
            $initial[] = '<div class=\'file-preview-text\'><i class=\'fa fa-file-audio-o text-warning\'></i></div>';
        else
            $initial[] = CHtml::image('/'.$image->path, $image->caption, array('style' => 'height:160px'));

        $initialConfig[] = array('caption' => $image->caption, 'width' => "120px", 'url' => Yii::app()->createUrl('/'.$module.'/imagedel', array('id' => $image->id)), 'key' => $image->id);
    }
}
$initial = json_encode($initial);
$initialConfig = json_encode($initialConfig);
?>

<?php Yii::app()->clientScript->registerScript('popoverActivate',"
    $('#".$id."').fileinput({
        uploadUrl: '".Yii::app()->createUrl('/'.$module.'/upload')."', // server upload action
        uploadAsync: true,
        maxFileCount: 20,
        overwriteInitial: false,
        initialPreview: ".$initial.",
        initialPreviewConfig: ".$initialConfig.",
        uploadExtraData: function(previewId, index) {
            return {id: '".$model->id."'};
        }
    });
"); ?>