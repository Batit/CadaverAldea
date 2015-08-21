<?php

/*
 * define los atributos que debe tener cada plantilla
 *
 */

abstract class TemplateModel {

    protected $html;
    protected $module;
    protected $template;
    public $dir = "site_media/views/";
    protected $matriz = array();

    /*     * *****************************************************************************************
     *                                                                                          *
     *                                                                                          *     
     *                   abstract methods that define the diferents parts in a template                                                                        *
     *                                                                                          *
     *                                                                                          *
     *                                                                                          *
     *                                                                                          *
     * ****************************************************************************************** */

    abstract protected function setHeader();

    abstract protected function setNav();

    abstract protected function setContent();

    abstract protected function setFooter();


    /*     * *****************************************************************************************
     *                                                                                          *
     *                                                                                          *
     *                           methods for tu return template                                                                        *
     *                                                                                          *
     *                                                                                          *
     *                                                                                          *
     *                                                                                          *
     * ****************************************************************************************** */

    function __construct($module, $template) {
        $this->module = $module;
        if (strrpos($template, "html")) {
            $this->template = "/" . $template;
        }
    }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function getTemplate() {
        $dir = $this->dir . $this->module . $this->template;
        $this->html = file_get_contents($dir);
        foreach ($this->matriz as $clave => $valor) {
            if (empty($valor) || $valor == "" || is_null($valor)) {
                $this->html = str_replace('{' . $clave . '}', "", $this->html);
            } else {
                $this->html = str_replace('{' . $clave . '}', $valor, $this->html);
                
                         
            }
        }
        $this->html = str_replace($search, $replace, $this->html);
        return $this->html;
    }

}

?>