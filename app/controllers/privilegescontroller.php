<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\PrivilegesModel;
use PHPMVC\Models\UserGroupPrivilegeModel;


class PrivilegesController extends AbstractController
{
            use InputFilter;
            use Helper;
            public function defaultAction()
        {

            $this->language->load('template.common');
            $this->language->load('privileges.default');
            $this->_data['privileges'] = PrivilegesModel::getAll();
            $this->_view();

        }
            // TOOO: we need to implement csrf prevention
            public function  createAction()
            {

                $this->language->load('template.common');
                $this->language->load('privileges.labels');
                $this->language->load('privileges.create');
                if (isset($_POST['submit'])){
                  $privilege = new PrivilegesModel();
                  $privilege->privilegeTitle = $this->filterString($_POST['privilegeTitle']);
                  $privilege->privilege = $this->filterString($_POST['privilege']);

                  if ($privilege->save()){
                      $this->messenger->add('تم حفظ الصلاحيه بنجاح') ;

                      $this->redirect('/mvcapp/public/index.php/privileges');
                  }
                }

                $this->_view();


            }

            public function  editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $privilege = PrivilegesModel::getByPK($id) ;
            if ($privilege ===  false){
                $this->redirect('/mvcapp/public/index.php/privileges');

            }

            $this->_data['privilege'] = $privilege;
        $this->language->load('template.common');
        $this->language->load('privileges.labels');
        $this->language->load('privileges.edit');


        if (isset($_POST['submit'])){
            $privilege->privilegeTitle = $this->filterString($_POST['privilegeTitle']);
            $privilege->privilege = $this->filterString($_POST['privilege']);

            if ($privilege->save()){
                $this->messenger->add('تم تعديل الصلاحيه بنجاح') ;

                $this->redirect('/mvcapp/public/index.php/privileges');
            }
        }

        $this->_view();


    }
            public function  deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $privilege = PrivilegesModel::getByPK($id) ;
        if ($privilege ===  false){
            $this->redirect('/mvcapp/public/index.php/privileges');

        }
        $groupprivileges = UserGroupPrivilegeModel::getBy(['privilegeId' =>$privilege->privilegeId ]);
        if(false !== $groupprivileges){
            foreach ($groupprivileges as $groupprivilege){
                $groupprivilege->delete();
            }
        }


        if ($privilege->delete()){
            $this->messenger->add('تم حدف الصلاحيه') ;

            $this->redirect('/mvcapp/public/index.php/privileges');
        }


    }

}