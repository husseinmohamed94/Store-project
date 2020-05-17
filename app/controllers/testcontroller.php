<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\validate;
use PHPMVC\Models\UserGroupPrivilegeModel;
use PHPMVC\Models\UserModel;
class TestController extends AbstractController
{
    use validate;
    public function defaultAction()
    {
     
      //  var_dump($this->session->u->privileges);
     //    var_dump($this->_session->u->privileges);
    }



}