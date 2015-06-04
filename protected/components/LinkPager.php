<?php
class LinkPager extends CLinkPager
{
    public $header = '<ul class="pagination clearfix page_margin_top_section">';

    public $footer = '</ul>';
    public $previousPageCssClass = 'left';
    public $prevPageLabel = '';
    public $nextPageLabel = '';
    public $nextPageCssClass = 'right';
    public $selectedPageCssClass = 'selected';
    public $internalPageCssClass = '';

    public function run()
    {
        $this->registerClientScript();
        $buttons=$this->createPageButtons();
        if(empty($buttons))
            return;
        echo $this->header;
        echo implode("\n",$buttons);
        /*echo CHtml::tag('div class="right"',$this->htmlOptions,implode("\n",$buttons));*/
        echo $this->footer;
    }


    public $firstPageCssClass= '';
    protected function createPageButton($label,$page,$class,$hidden,$selected)
    {
        if($hidden || $selected)
            $class.=' '.($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);

        $link = CHtml::link($label,$this->createPageUrl($page),array('class' => $class));
        return Chtml::tag('li', array('class' => $class), $link);
    }

    protected function createPageButtons()
    {
        if(($pageCount=$this->getPageCount())<=1)
            return array();

        list($beginPage,$endPage)=$this->getPageRange();
        $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons=array();


        // prev page
        if(($page=$currentPage-1)<0)
            $page=0;
        $buttons[]=$this->createPageButton($this->prevPageLabel,$page,$this->previousPageCssClass,$currentPage<=0,false);

        // internal pages
        for($i=$beginPage;$i<=$endPage;++$i)
            $buttons[]=$this->createPageButton($i+1,$i,$this->internalPageCssClass,false,$i==$currentPage);

        // next page
        if(($page=$currentPage+1)>=$pageCount-1)
            $page=$pageCount-1;
        $buttons[]=$this->createPageButton($this->nextPageLabel,$page,$this->nextPageCssClass,$currentPage>=$pageCount-1,false);

        return $buttons;
    }
}