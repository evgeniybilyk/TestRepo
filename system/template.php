<?php
class Template extends Smarty {

    protected  $TemplateVars = array ();

    //конструктор
    function __construct(){
        parent::__construct();
    }

    //буфферизация переменной
    function insert($param,$val){
        $this->TemplateVars[$param]=$val;
    }

    // на экран......
    function toScreen($file){

        $this->setTemplateDir(TEMPLATE_DIR);
        $this->setCompileDir(TEMPLATE_COMPILE_DIR);
        $this->setCacheDir(TEMPLATE_CASHE_DIR);

        //из буфера в шаблон
        foreach($this->TemplateVars as $key=>$val){
            $this->assign($key,$val);
        }

        $this->display($file);
    }

}