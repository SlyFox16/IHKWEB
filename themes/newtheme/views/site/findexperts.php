<!-- Search Header -->
<section class="secondary-header">
    <div class="row">
        <div class="small-12 columns">
            <h2>Find certified <b>Crowd Experts</b> now.</h2>
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
    <!-- Control -->
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="small-12 columns">
            <ul class="experts">
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
            </ul>
        </div>
    </div>
</section>