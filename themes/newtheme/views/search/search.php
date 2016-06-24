<!--===============================-->
<!--== Experts ====================-->
<!--===============================-->


<!-- Search Header -->
<section class="secondary-header">
    <div class="row">
        <div class="small-12 columns">
            <h2><?php echo Yii::t("base", "Search results for");?> <b><?php echo $searchPhrase; ?></b> :</h2>
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

    <?php $this->widget('SearchWidget'); ?>
</div>

<section class="separated separated--edge">
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataSearch,
        'itemView' => '_user', // refers to the partial view named '_post'
        'summaryText' => false,
        'pager'=> "LinkPager",
        'emptyText' => '<div class="col-sm-12 text-center">
				<h1>404</h1>
				<p>The page your are looking for was not found. <a class="angle" href="/">Go back</a></p>
			</div>',
        'cssFile' => false
    )); ?>
</section>