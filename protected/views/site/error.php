<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
    'Error',
);
?>

<section class="separated">
	<div class="container relative">
        <!--== Breadcrumbs ==-->
        <?php
        $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Error')
            ),
        ));
        ?>
		<div class="row">
			<div class="col-sm-12 text-center">
				<h1><?php echo $code; ?></h1>

				<p><?php echo CHtml::encode($message); ?> <a href="<?php echo Yii::app()->homeUrl;?>" class="angle">Go back</a></p>
			</div>
		</div>
	</div>
</section>