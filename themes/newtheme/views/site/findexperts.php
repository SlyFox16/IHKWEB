<!-- Search Header -->
<section class="secondary-header">
    <div class="row">
        <div class="small-12 columns">
            <h2><?php $this->widget('GetSearchHeader', array('model' => $model)); ?></h2>
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
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="medium-4 large-3 columns">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div>
        <div class="medium-8 large-9 columns">
            <?php $this->widget('ListView', array(
                'id'=>'rating-log-grid',
                'dataProvider' => $model->findMember(),
                'itemView' => '//search/_user', // refers to the partial view named '_post'
                'summaryText' => false,
                'itemsTagName' => 'ul',
                'itemsCssClass' => 'experts experts--ranking',
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
        </div>
    </div>
</section>