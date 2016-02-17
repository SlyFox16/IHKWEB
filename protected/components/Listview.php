<?php
Yii::import('zii.widgets.CListView');
class ListView extends CListView
{
    public function renderItems()
    {
        //echo CHtml::openTag($this->itemsTagName,array('class'=>$this->itemsCssClass))."\n";
        $data=$this->dataProvider->getData();
        if(($n=count($data))>0)
        {
            $owner=$this->getOwner();
            $viewFile=$owner->getViewFile($this->itemView);
            $j=0;
            foreach($data as $i=>$item)
            {
                $data=$this->viewData;
                $data['index']=$i;
                $data['data']=$item;
                $data['widget']=$this;
                $owner->renderFile($viewFile,$data);
                if($j++ < $n-1)
                    echo $this->separator;
            }
        }
        else
            $this->renderEmptyText();
        //echo CHtml::closeTag($this->itemsTagName);
    }
}