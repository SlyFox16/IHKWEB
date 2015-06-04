<?php
class Nav extends  CWidget
{
    public $_footer_menu;

    public function run()
    {
        $categories = ArticleCategory::model()->findAll('id IN (2, 3, 4)');
        if($this->_footer_menu)
            $this->render("footerManu", array('categories' => $categories));
        else
            $this->render("nav", array('categories' => $categories));
    }
}