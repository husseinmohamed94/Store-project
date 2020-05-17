<?php
 namespace PHPMVC\LIB;


use PHPMVC\LIB\Template\Template;

class  FrontController
{
    use Helper;
    const NOT_FOUND_ACTION = 'notFoundAction';
    const NOT_FOUND_CONTROLLER = 'PHPMVC\Controllers\\NotFoundController';


    private $_controller ='index' ;
    private $_action = 'default';
    private $_params = array();

    private  $_registry;
    private  $_template ;
    private $_authentication;

    public function __construct(Template $template , Registry $registry , Authentication $auth)
    {

        $this->_template = $template;
        $this->_registry = $registry;
        $this->_authentication = $auth;
        $this->_parseUrl();
    }

    private  function  _parseUrl()
    {
        $url = explode('/',trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),6);
        if(isset($url[3]) && $url[3] !=''){
            $this->_controller =$url[3];
        }
        if(isset($url[4]) && $url[4] !=''){
            $this->_action =$url[4];
        }
        if(isset($url[5]) && $url[5] !=''){
            $this->_params =explode( '/',$url[5]);

        }

    }

    public function  dispatch()
    {

        $controllerClassName ='PHPMVC\Controllers\\' . ucfirst( $this->_controller) .'controller';
        $actionName = $this->_action . 'Action';
        // check if the ia authorized to access the applion
        if (!$this->_authentication->isAuthorized()){
            if ($this->_controller != 'auth' && $this->_action != 'login'){
                $this->redirect('/mvcapp/public/index.php/auth/login/');

            }
        }else{
            //deny access to the auth/login
            if ($this->_controller == 'auth' && $this->_action == 'login'){
                isset($_SERVER['HTTP_REFERER']) ? $this->redirect($_SERVER['HTTP_REFERER']) : $this->redirect('/mvcapp/public/index.php/');

            }
    //check if the user has access to specific url
            if((bool)CHECK_FOR_PRIVILEGES === true){
                if(!$this->_authentication->hasAccess($this->_controller , $this->_action)){
                    $this->redirect('/mvcapp/public/index.php/accessdenied/');
            }
          

            }
           
            
        }
        


       /*
           if(!class_exists( $controllerClassName) ){
           $controllerClassName =self::NOT_FOUND_CONTROLLER;

           }

        $controller = new $controllerClassName();

        if(!method_exists($controller,$actionName)){

         $this->_action  = $actionName = self::NOT_FOUND_ACTION;
        }
*/
if(!class_exists($controllerClassName) || !method_exists($controllerClassName, $actionName)) {
    $controllerClassName = self::NOT_FOUND_CONTROLLER;
    $this->_action = $actionName = self::NOT_FOUND_ACTION;
}

      $controller = new $controllerClassName();
      $controller->setController($this->_controller);
      $controller->setAction($this->_action);
      $controller->setParams($this->_params);
      $controller->setTemplate($this->_template);
      $controller->setRegistry($this->_registry);
      $controller->$actionName();

}





}