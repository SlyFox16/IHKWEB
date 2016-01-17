<!--===============================-->
<!--== Find Experts ===============-->
<!--===============================-->
<section class="search-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2>Search results for <b><?php echo $searchPhrase; ?></b> :</h2>
            </div>
        </div>
    </div>
</section>

<!--===============================-->
<!--== Experts ====================-->
<!--===============================-->
<section class="clearfix search-results separated">
    <div class="container relative no-padding">


        <!--== Breadcrumbs ==-->
        <?php
        $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Search')
            ),
        ));
        ?>

        <!--== Page Control ==-->
        <?php $this->widget('SearchWidget'); ?>
    </div>
    <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataSearch,
            'itemView' => '_user', // refers to the partial view named '_post'
            'summaryText' => false,
            'pager'=> "LinkPager",
            'cssFile' => false
        ));
    ?>
</section>
</html>