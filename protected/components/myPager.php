<?php
Yii::import('web.widgets.CListView');
class myPager extends CLinkPager{

    public function run()
	{
        $this->htmlOptions=array('class'=>'pagination page_margin_top');
		$this->registerClientScript();
		$buttons=$this->createPageButtons();
		if(empty($buttons))
			return;
        //echo $this->header;
		echo CHtml::tag('ul',$this->htmlOptions,implode("\n",$buttons));
		//echo $this->footer;

	}
        
    protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
        if($selected)
              return '<li class="selected">'.CHtml::tag('a',array('href'=>''),$label).'</li>';
        
		if($hidden)
              return;
                
		return '<li>'.CHtml::link($label,$this->createPageUrl($page)).'</li>';
	}

    protected function createPageButtons()
    {
        if(($pageCount=$this->getPageCount())<=1)
            return array();

        list($beginPage,$endPage)=$this->getPageRange();
        $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons=array();

        // internal pages
        for($i=$beginPage;$i<=$endPage;++$i)
            $buttons[]=$this->createPageButton($i+1,$i,$this->internalPageCssClass,false,$i==$currentPage);

        return $buttons;
    }

}
?>