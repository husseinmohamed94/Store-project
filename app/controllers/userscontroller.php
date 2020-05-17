<?php
namespace PHPMVC\Controllers;

use http\Client\Curl\User;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\UserProfilesModel;

class UsersController extends AbstractController
{
    use InputFilter;
    use Helper;
        private $_createActionRoles =
            [
               'firstName' => 'req|alpha|between(3,10)',
               'lastName' => 'req|alpha|between(3,10)',
               'Username' => 'req|alphanum|between(3,15)',
               'password' => 'req|min(6)|eq_Field(cpassword)',
               'cpassword' => 'req|min(6)',
                'email'    => 'req|email|eq_Field(cemail)',
                'cemail'    => 'req|email',
                'phoneNumber' =>'alphanum|max(15)',
                'groupid'  => 'req|int'
            ];
        private $_editActionRoles =
            [

                'phoneNumber' =>'alphanum|max(15)',
                'groupid'  => 'req|int'
            ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('users.default');

            $this->_data['users'] = UserModel::getUsers($this->session->u);
            $this->_view();

        }
        public function createAction()
        {

            $this->language->load('template.common');
            $this->language->load('users.create');
            $this->language->load('users.labels');
            $this->language->load('users.messages');
            $this->language->load('validtion.errors');

            $this->_data['groups'] = UserGroupModel::getAll();


            if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles,$_POST)){
                    $user = new UserModel();
                    $user->Username =$this->filterString($_POST['Username']);
                    //$user->cryptPassword($_POST['password']);
                    $user->password = $this->filterString($_POST['password']);
                    $user->email = $this->filterString($_POST['email']);
                    $user->phoneNumber = $this->filterString($_POST['phoneNumber']);
                    $user->GroupId = $this->filterInt($_POST['groupid']);
                    $user->subscriptionDate = date('Y-m-d   ');
                    $user->lastlogin = date('Y-m-d H:i:s');
                    $user->Status = 1;
                    if (UserModel::userExists($user->Username)){
                        $this->messenger->add($this->language->get('mesage_user_exists'), Messenger::APP_MESSAGE_ERROR);
                        $this->redirect('/mvcapp/public/index.php/users/create');

                    }
                    //TODO:: SEND THE USER WELCOME EMAIL
                    if ($user->save()){
                        $userProfile = new UserProfilesModel();
                        $userProfile->UserId = $user->UserId ;
                        $userProfile->firstName = $this->filterString($_POST['firstName']);
                        $userProfile->lastName = $this->filterString($_POST['lastName']);
                        $userProfile->save(false);
                     
                        $this->messenger->add($this->language->get('mesage_create_success'));
                    }else{
                        $this->messenger->add($this->language->get('mesage_create_failed'), Messenger::APP_MESSAGE_ERROR);

                    }
                    $this->redirect('/mvcapp/public/index.php/users');
            }


            $this->_view();

        }
        public function editAction()
        {
            $id =$this->filterInt( $this->_params[0]);
            $user = UserModel::getByPK($id);
            
            if($user === false || $this->session->u->UserId == $id){
                $this->redirect('/mvcapp/public/index.php/users');
            }
            $this->_data['user']  = $user;
        $this->language->load('template.common');
        $this->language->load('users.edit');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validtion.errors');

        $this->_data['groups'] = UserGroupModel::getAll();


        if(isset($_POST['submit']) && $this->isValid($this->_editActionRoles,$_POST)){


            $user->phoneNumber = $this->filterString($_POST['phoneNumber']);
            $user->GroupId = $this->filterInt($_POST['groupid']);

            $user->Status = 1;
            if ($user->save()){
                $this->messenger->add($this->language->get('mesage_create_success'));
            }else{
                $this->messenger->add($this->language->get('mesage_create_failed'), Messenger::APP_MESSAGE_ERROR);

            }
            $this->redirect('/mvcapp/public/index.php/users');
        }


        $this->_view();

    }
        public function deleteAction()
        {
            $id =$this->filterInt( $this->_params[0]);
            $user = UserModel::getByPK($id);
            if($user === false  ||$this->session->u->UserId == $id ){
                $this->redirect('/mvcapp/public/index.php/users');
            }
            $this->language->load('users.messages');

            if ($user->delete()){
                $this->messenger->add($this->language->get('mesage_delete_success'));
            }else{
                $this->messenger->add($this->language->get('mesage_delete_failed'), Messenger::APP_MESSAGE_ERROR);

            }
            $this->redirect('/mvcapp/public/index.php/users');



    }


        //TODO:: make sure this is Ajax Request
        //TODO:: explain the different types of header used in this course
        public function checkUserExistsAjaxAction()
        {
            if(isset($_POST['Username'])){

             header('Content-type: text/plain');
                if(UserModel::userExists($this->filterString($_POST['Username'])) !== false){
                    echo 1;
                }else{
                    echo 2;
                }
            }
        }

}