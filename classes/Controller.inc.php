<?php
class Controller
{
    protected $Model;
    public function __construct()
    {
        $model = "News_Model";
        $this->Model = new $model();
    }
}