<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
    'Error',
);
?>

<div role="main" id="main">
    <div id="contentarea" class="row">
        <h1 class="site-error">Error <?php echo $code; ?></h1>

        <div class="error">
            <?php echo CHtml::encode($message); ?>
        </div>
    </div>
</div>