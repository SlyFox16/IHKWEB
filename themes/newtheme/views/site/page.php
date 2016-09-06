<!--===============================-->
<!--== Cabinet ====================-->
<!--===============================-->

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", $model->title)
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="small-12 columns text-center">
            <h1><?php echo $model->title; ?></h1>
            <?php if ($model->id == 1) { ?>
                <!--//your code-->
            <?php } else { ?>
                <p><?php echo $model->content; ?></p>
            <?php } ?>
        </div>
    </div>
</section>
