<?php
namespace PHPMVC\Controllers;

use http\Client\Curl\User;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\ExpensesCategoriesModel;

class ExpensesCategoriesController extends AbstractController
{
    use InputFilter;
    use Helper;
        private $_createActionRoles =
            [
               'ExpenseName' => 'req|alphanum|between(3,30)',
                'fixedPayment'    => 'req|num'
              
            ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('expenses.default');

            $this->_data['expenses'] = ExpensesCategoriesModel::getAll();
            $this->_view();

        }
        public function createAction()
        {

            $this->language->load('template.common');
            $this->language->load('expenses.create');
            $this->language->load('expenses.labels');
            $this->language->load('expenses.messages');
            $this->language->load('validtion.errors');

            if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles,$_POST)){
                $expense =new ExpensesCategoriesModel();
                $expense->ExpenseName =$this->filterString($_POST['ExpenseName']);
                $expense->fixedPayment = $this->filterInt($_POST['fixedPayment']);
                  
                    if ($expense->save()){
                      
                        $this->messenger->add($this->language->get('mesage_create_success'));
                    }else{
                        $this->messenger->add($this->language->get('mesage_create_failed'), Messenger::APP_MESSAGE_ERROR);

                    }
                    $this->redirect('/mvcapp/public/index.php/expensescategories');
            }


            $this->_view();

        }
        public function editAction()
        {
            $id =$this->filterInt( $this->_params[0]);
            $expense = ExpensesCategoriesModel::getByPK($id);
            
            if($expense === false){
                $this->redirect('/mvcapp/public/index.php/expensescategories');
            }
            $this->_data['expense']  = $expense;
        $this->language->load('template.common');
        $this->language->load('expenses.edit');
        $this->language->load('expenses.labels');
        $this->language->load('expenses.messages');
        $this->language->load('validtion.errors');



        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles,$_POST)){
           
            $expense->ExpenseName =$this->filterString($_POST['ExpenseName']);
            $expense->fixedPayment = $this->filterInt($_POST['fixedPayment']);
            if ($expense->save()){
                $this->messenger->add($this->language->get('mesage_create_success'));
            }else{
                $this->messenger->add($this->language->get('mesage_create_failed'), Messenger::APP_MESSAGE_ERROR);

            }
            $this->redirect('/mvcapp/public/index.php/expensescategories');
        }


        $this->_view();

    }
        public function deleteAction()
        {
            $id =$this->filterInt( $this->_params[0]);
            $expense = ExpensesCategoriesModel::getByPK($id);
            
            if($expense === false  ){
                $this->redirect('/mvcapp/public/index.php/expensescategories');
            }
            $this->language->load('suppliers.messages');

            if ($expense->delete()){
                $this->messenger->add($this->language->get('mesage_delete_success'));
            }else{
                $this->messenger->add($this->language->get('mesage_delete_failed'), Messenger::APP_MESSAGE_ERROR);

            }
            $this->redirect('/mvcapp/public/index.php/expensescategories');



    }


      
}