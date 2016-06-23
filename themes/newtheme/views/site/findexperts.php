<!--===============================-->
<!--== Experts ====================-->
<!--===============================-->


<!-- Search Header -->
<section class="secondary-header">
    <div class="row">
        <div class="small-12 columns">
            <h2><?php echo Yii::t("base", "Find certified [b]Crowd Experts[/b]> now.", array('[b]' => '<b>', '[/b]' => '</b>')); ?></h2>
        </div>
    </div>
</section>

<div class="row">
    <!-- Breadcrumbs -->
    <div class="small-12 medium-4 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Search')
            ),
        )); ?>
    </div>

    <!--== Page Control ==-->
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
    <!-- Control -->
</div>

<section class="separated separated--edge">
    <?php $this->widget('ListView', array(
        'id'=>'rating-log-grid',
        'dataProvider' => $model->findMember(),
        'itemView' => '//search/_user', // refers to the partial view named '_post'
        'summaryText' => false,
        'loadingCssClass' => false,
        'pager'=> "LinkPager",
        'template'=>'{items} {pager}',
        'cssFile' => false,
        'emptyText' => '<div class="col-sm-12 text-center no-results">
                <h1>Sorry</h1>
                <p>Nothing found. <a class="angle" href="/">Go back</a></p>
            </div>',
        'htmlOptions' => array(
            'class' => false
        )
    )); ?>
</section>