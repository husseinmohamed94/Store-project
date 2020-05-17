<?php
namespace PHPMVC\Controllers;


use PHPMVC\Models\UserModel;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\ExpensesDailyModel;
use PHPMVC\Models\ExpensesCategoriesModel;


class ExpensesDailyController extends AbstractController
{
    use InputFilter;
    use Helper;
        private $_createActionRoles =
            [

                'ExpenseId'    => 'req|num',
                'payment'      => 'req|num',
                'created'      =>'req|vdate'

            ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('dailys.default');

            $this->_data['dailys'] = ExpensesDailyModel::getAll();
            $this->_view();

        }
        public function createAction()
        {

            $this->language->load('template.common');
            $this->language->load('dailys.create');
            $this->language->load('dailys.labels');
            $this->language->load('dailys.messages');
            $this->language->load('validtion.errors');

            $this->_data['expenses'] = ExpensesCategoriesModel::getAll();
              $this->_data['users'] = UserModel::getAll();

            if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles,$_POST)){
          //    var_dump($_POST);exit;

                $daily =new ExpensesDailyModel();
                $daily->ExpenseId =$this->filterInt($_POST['ExpenseId']);
                $daily->payment = $this->filterString($_POST['payment']);
                $daily->created  = date('Y-m-d');
                $daily->userid = $this->filterInt($_POST['userid']);
                    if ($daily->save()){

                        $this->messenger->add($this->language->get('mesage_create_success'));
                    }else{
                        $this->messenger->add($this->language->get('mesage_create_failed'), Messenger::APP_MESSAGE_ERROR);

                    }
                    $this->redirect('/mvcapp/public/index.php/expensesdaily');
            }


            $this->_view();

        }

        public function editAction()
        {
            $id =$this->filterInt( $this->_params[0]);
            $expense = ExpensesCategoriesModel::getByPK($id);

            if($expense === false){
                $this->redirect('/mvcapp/public/index.php/expensesdaily');
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
