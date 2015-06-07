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
<section class="clearfix search-results">
    <div class="container relative no-padding">


        <!--== Breadcrumbs ==-->
        <ul class="breadcrumbs">
            <li><a href="">Home</a></li>
            <li>Search</li>
        </ul>

        <!--== Page Control ==-->
        <?php $this->widget('Search'); ?>
    </div>
    <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataSearch,
            'itemView' => '_user', // refers to the partial view named '_post'
            'afterAjaxUpdate'=>'preloader',
            'summaryText' => false,
            'pager'=> "LinkPager",
            'cssFile' => false
        ));
    ?>
</section>
</html>