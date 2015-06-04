<div class="page">
    <div class="page_header clearfix page_margin_top">
        <div class="page_header_left">
            <h1 class="page_title"><?php echo $searchPhrase; ?></h1>
        </div>
        <div class="page_header_right">
            <?php
                $this->widget('Breadcrumbs', array(
                    'links' => array(
                        Yii::t("base", 'Поиск')
                    ),
                ));
            ?>
        </div>
    </div>
    <div class="page_layout clearfix">
        <div class="divider_block clearfix">
            <hr class="divider first">
            <hr class="divider subheader_arrow">
            <hr class="divider last">
        </div>
        <div class="row">
            <div class="column column_2_3">
                <div class="row">
                    <ul class="blog big">
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $dataSearch,
                            'itemView' => '/article/_post', // refers to the partial view named '_post'
                            'afterAjaxUpdate'=>'preloader',
                            'pager'=> "LinkPager",
                            'cssFile' => false
                        ));
                        ?>
                    </ul>
                </div>
            </div>
            <?php $this->widget('Sidebar'); ?>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript->registerScript('popoverActivate',"
        var preloader = function()
        {
            $('.post>a>img, .grid_view .post>a>img, .post.single .post_image img, .slider .slide img, .pr_preload').each(function(){
            $(this).before('<span class=\'pr_preloader\'></span>');
            $(this).attr('src',$(this).attr('src') + '?i='+getRandom(1,100000));
            $(this).one('load', function(){
            $(this).prev('.pr_preloader').remove();
            $(this).fadeTo('slow', 1, function(){
            $(this).css('opacity', '');
            });
            $(this).css('display', 'block');
            if($(this).parent().parent().parent().hasClass('blog rating'))
            $('.blog.rating .value_bar_container').each(function(){
            $(this).height($(this).parent().outerHeight()-$(this).parent().find('img').height());
            });
            }).each(function(){
            if(this.complete)
            $(this).load();
            });
            });
        };
    ", CClientScript::POS_END);
?>