<?php

class Template
{
    protected $FileName;
    protected $ParamsArray;
    public function __construct($fileName)
    {
        $this->FileName = $fileName;
        $this->ParamsArray = array();
    }
    public function AddParam($name, $value)
    {
        $this->ParamsArray[$name] = $value;
    }
    public function AddParams($rows)
    {
        if (!empty($rows))
        foreach ($rows as $key => $value)
        {
            $this->AddParam($key, $value);
        }
    }
    public function Fetch()
    {
        ob_start();
        extract($this->ParamsArray);
        include($this->FileName);
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
    public function Display()
    {
        $html = $this->Fetch();
        echo $html;
        return $html;
    }
}