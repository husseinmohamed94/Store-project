<?php

namespace PHPMVC\Controllers;


class AccessdeniedController extends AbstractController
{

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->_view();
    }

}