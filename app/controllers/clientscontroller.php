<?php
namespace PHPMVC\Controllers;

use http\Client\Curl\User;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\ClientModel;

class clientsController extends AbstractController
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
            $this->language->load('clients.default');

            $this->_data['clients'] = ClientModel::getAll();
            $this->_view();

        }
        public function createAction()
        {

            $this->language->load('template.common');
            $this->language->load('clients.create');
            $this->language->load('clients.labels');
            $this->language->load('clients.messages');
            $this->language->load('validtion.errors');

            if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles,$_POST)){
                    $client = new ClientModel();
                    $client->Name =$this->filterString($_POST['Name']);
                    $client->Email = $this->filterString($_POST['Email']);
                    $client->phoneNumber = $this->filterString($_POST['phoneNumber']);
                    $client->address = $this->filterString($_POST['address']);
                  
                    if ($client->save()){
                       
                        $this->messenger->add($this->language->get('mesage_create_success'));
                    }else{
                        $this->messenger->add($this->language->get('mesage_create_failed'), Messenger::APP_MESSAGE_ERROR);

                    }
                    $this->redirect('/mvcapp/public/index.php/clients');
            }


            $this->_view();

        }
        public function editAction()
        {
            $id =$this->filterInt( $this->_params[0]);
            $client = ClientModel::getByPK($id);
            
            if($client === false){
                $this->redirect('/mvcapp/public/index.php/clients');
            }
            $this->_data['client']  = $client;
        $this->language->load('template.common');
        $this->language->load('clients.edit');
        $this->language->load('clients.labels');
        $this->language->load('clients.messages');
        $this->language->load('validtion.errors');



        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles,$_POST)){
           
            $client->Name =$this->filterString($_POST['Name']);
            $client->Email = $this->filterString($_POST['Email']);
            $client->phoneNumber = $this->filterString($_POST['phoneNumber']);
            $suclientpplier->address = $this->filterString($_POST['address']);
            if ($client->save()){
                $this->messenger->add($this->language->get('mesage_create_success'));
            }else{
                $this->messenger->add($this->language->get('mesage_create_failed'), Messenger::APP_MESSAGE_ERROR);

            }
            $this->redirect('/mvcapp/public/index.php/clients');
        }


        $this->_view();

    }
        public function deleteAction()
        {
            $id =$this->filterInt( $this->_params[0]);
            $client = ClientModel::getByPK($id);
            
            if($client === false  ){
                $this->redirect('/mvcapp/public/index.php/clients');
            }
            $this->language->load('clients.messages');

            if ($client->delete()){
                $this->messenger->add($this->language->get('mesage_delete_success'));
            }else{
                $this->messenger->add($this->language->get('mesage_delete_failed'), Messenger::APP_MESSAGE_ERROR);

            }
            $this->redirect('/mvcapp/public/index.php/clients');



    }


      
}