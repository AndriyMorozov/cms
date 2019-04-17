<?php
class News_Model /*extends Model*/
{
    public function __construct()
    {
    }
    public function GetNews()
    {
        return FrontController::$Database->Select('news');
    }
    public function Delete($id)
    {
        FrontController::$Database->Delete('news', 'id', $id);
    }
}