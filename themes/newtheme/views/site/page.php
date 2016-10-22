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
        <div class="small-12 columns">
            <h1><?php echo $model->title; ?></h1>
            <?php if ($model->id == 1) {
                $this->renderPartial('custumPage/impressum');
            } elseif($model->id == 2) {
                $this->renderPartial('custumPage/agb');
            } else {
                echo $model->content;
            } ?>
        </div>
    </div>
</section>
