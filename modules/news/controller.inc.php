<?php
class News_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function Add()
    {
        echo 'Add!!!';
    }
    public function Edit($params)
    {
        echo 'Edit!!!';
    }
    public function GetList()
    {
        $tpl = new Template('templates/news/getlist.tpl');
        $tpl->AddParam('list', $this->Model->GetNews());
        return array(
            'Title' => 'News List',
            'Header' => 'News List',
            'Content' => $tpl->Fetch()
        );
    }
    public function Index()
    {
       return array(
           'Title' => 'Main page',
           'Header' => 'HEADER',
           'Content' => 'Some text'
       );
    }
}