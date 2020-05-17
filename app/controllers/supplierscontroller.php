<?php
namespace PHPMVC\Controllers;

use http\Client\Curl\User;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\SupplierModel;

class suppliersController extends AbstractController
{
    use InputFilter;
    use Helper;
        private $_createActionRoles =
            [
               'Name' => 'req|alpha|between(3,40)',
                'Email'    => 'req|email',
                'phoneNumber' =>'alphanum|max(15)',
                'address'  => 'req|alphanum| max(50)'
            ];
       

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('suppliers.default');

            $this->_data['suppliers'] = SupplierModel::getAll();
            $this->_view();

        }
        public function createAction()
        {

            $this->language->load('template.common');
            $this->language->load('suppliers.create');
            $this->language->load('suppliers.labels');
            $this->language->load('suppliers.messages');
            $this->language->load('validtion.errors');

            if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles,$_POST)){
                    $supplier = new SupplierModel();
                    $supplier->Name =$this->filterString($_POST['Name']);
                    $supplier->Email = $this->filterString($_POST['Email']);
                    $supplier->phoneNumber = $this->filterString($_POST['phoneNumber']);
                    $supplier->address = $this->filterString($_POST['address']);
                  
                    if ($supplier->save()){
                       
                        $this->messenger->add($this->language->get('mesage_create_success'));
                    }else{
                        $this->messenger->add($this->language->get('mesage_create_failed'), Messenger::APP_MESSAGE_ERROR);

                    }
                    $this->redirect('/mvcapp/public/index.php/suppliers');
            }


            $this->_view();

        }
        public function editAction()
        {
            $id =$this->filterInt( $this->_params[0]);
            $supplier = SupplierModel::getByPK($id);
            
            if($supplier === false){
                $this->redirect('/mvcapp/public/index.php/suppliers');
            }
            $this->_data['supplier']  = $supplier;
        $this->language->load('template.common');
        $this->language->load('suppliers.edit');
        $this->language->load('suppliers.labels');
        $this->language->load('suppliers.messages');
        $this->language->load('validtion.errors');



        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles,$_POST)){
           
            $supplier->Name =$this->filterString($_POST['Name']);
            $supplier->Email = $this->filterString($_POST['Email']);
            $supplier->phoneNumber = $this->filterString($_POST['phoneNumber']);
            $supplier->address = $this->filterString($_POST['address']);
            if ($supplier->save()){
                $this->messenger->add($this->language->get('mesage_create_success'));
            }else{
                $this->messenger->add($this->language->get('mesage_create_failed'), Messenger::APP_MESSAGE_ERROR);

            }
            $this->redirect('/mvcapp/public/index.php/suppliers');
        }


        $this->_view();

    }
        public function deleteAction()
        {
            $id =$this->filterInt( $this->_params[0]);
            $supplier = SupplierModel::getByPK($id);
            
            if($supplier === false  ){
                $this->redirect('/mvcapp/public/index.php/suppliers');
            }
            $this->language->load('suppliers.messages');

            if ($supplier->delete()){
                $this->messenger->add($this->language->get('mesage_delete_success'));
            }else{
                $this->messenger->add($this->language->get('mesage_delete_failed'), Messenger::APP_MESSAGE_ERROR);

            }
            $this->redirect('/mvcapp/public/index.php/suppliers');



    }


      
}