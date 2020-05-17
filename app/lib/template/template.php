<?php


namespace PHPMVC\LIB\Template;


class Template
{
    use TemplateHelper;

    private $_templateparts;
    private $_action_view;
    private $_data;
    private $_registry;

    public function __get($key)
    {
            return $this->_registry->$key;
    }

    public function  __construct(array $parts)
    {
        $this->_templateparts =$parts;
    }

    public function setActionViewFile($actionViewpath){

        $this->_action_view = $actionViewpath ;
    }
    public function setAppData($data){

        $this->_data = $data;
    }
    //TODO implement a better soliution
    public function swapTemplate($template){
        $this->_templateparts['template' ]= $template;
    }

    public function setRegistry($registry){
        $this->_registry = $registry;
    }
    private function renderTemplateHeaderStart(){
        require_once TEMPLATE_PATH . 'templateheaderstr.php';

    }
    private function renderTemplateHeaderEnd(){

        require_once TEMPLATE_PATH . 'templateheaderend.php';
    }
    private function renderTemplateFooter(){

        require_once TEMPLATE_PATH . 'templatefooter.php';
    }

    private  function renderTemplateBlocks(){
        if (!array_key_exists('template' , $this->_templateparts)){
                trigger_error('sorry yo have to define the template blocks ' . E_USER_WARNING);

        }else {
            $parts = $this->_templateparts['template'];
            if (!empty($parts)){
                        extract($this->_data);
                foreach ($parts as $partKey =>$file){
                    if ($partKey === ':view'){
                        require_once $this->_action_view;
                    }else {
                        require_once $file;
                    }
                }

            }

        }

    }
    private function renderHeaderResources(){
        $output = '';
        if (!array_key_exists('header_resources' , $this->_templateparts)){
            trigger_error('sorry yo have to define the header resources ' . E_USER_WARNING);

        }else {
            $resources = $this->_templateparts['header_resources'];
            //Generte css link
            $css = $resources['CSS'];
            if (!empty($css)){

                foreach ($css as $csskey  =>$path){
                    $output .= '<link type="text/css" rel="stylesheet" href="' . $path .'" /> ';

                }
            }

            //Generte js link
            $js = $resources['js'];
            if (!empty($js)){

                foreach ($js as $jskey  =>$path){
                    $output .= '<script src="' .$path . '"> </script>';

                }
            }


        }
        echo $output;

    }
    private function renderFooterResources(){
        $output = '';
        if (!array_key_exists('footer_resources' , $this->_templateparts)){
            trigger_error('sorry yo have to define the footer resources ' . E_USER_WARNING);

        }else {
            $resources = $this->_templateparts['footer_resources'];

            //Generte js link
            if (!empty($resources)){

                foreach ($resources as $resourceskey  =>$path){
                    $output .= '<script src="' .$path . '"> </script>';

                }
            }


        }
        echo $output;

    }



    public function  renderApp(){
         $this->renderTemplateHeaderStart();
        $this->renderHeaderResources();
        $this->renderTemplateHeaderEnd();
        $this->renderTemplateBlocks();
        $this->renderFooterResources();
        $this->renderTemplateFooter();

    }
 }