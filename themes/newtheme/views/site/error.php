<!--===============================-->
<!--== Cabinet ====================-->
<!--===============================-->

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Error')
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="small-12 columns text-center">
            <h1><?php echo $code; ?></h1>
            <p><?php echo CHtml::encode($message); ?> <a href="<?php echo Yii::app()->homeUrl;?>" class="angle"><?php echo Yii::t("base", "Go back");?></a></p>
        </div>
    </div>
</section>
