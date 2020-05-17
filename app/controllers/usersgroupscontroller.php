<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\PrivilegesModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserGroupPrivilegeModel;

class UsersGroupsController extends AbstractController
{
    use InputFilter;
    use Helper;
        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('usersgroups.default');

            $this->_data['groups'] = UserGroupModel::getAll();
            $this->_view();

        }

    public function  createAction()
    {

        $this->language->load('template.common');
        $this->language->load('usersgroups.create');
        $this->language->load('usersgroups.labels');

        $this->_data['privileges'] = PrivilegesModel::getAll();
        if (isset($_POST['submit'])){
          $group = new UserGroupModel();
          $group ->GroupName = $this->filterString($_POST['GroupName']);
         if ($group->save()){
            if (isset($_POST['privileges']) && is_array($_POST['privileges']))
                foreach ($_POST['privileges'] as $privilegeId){
                    $groupprivilege = new  UserGroupPrivilegeModel();
                    $groupprivilege ->GroupId = $group->groupid;
                    $groupprivilege->privilegeId = $privilegeId;
                    $groupprivilege->save();

                }
                $this->redirect('/mvcapp/public/index.php/usersgroups');
          }

        }

      $this->_view();
    }

    public function  editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($id);
        if ($group === false) {
            $this->redirect('/mvcapp/public/index.php/usersgroups/');
        }

        $this->language->load('template.common');
        $this->language->load('usersgroups.edit');
        $this->language->load('usersgroups.labels');

        $this->_data['group'] = $group;
        $this->_data['privileges'] = PrivilegesModel::getAll();

        $extractedPrivilegesIds = $this->_data['groupprivileges'] = UserGroupPrivilegeModel::getGroupPrivileges($group);

        if (isset($_POST['submit'])) {
            $group->GroupName = $this->filterString($_POST['GroupName']);

            if ($group->save()) {
                if (isset($_POST['privileges']) && is_array($_POST['privileges']))
                    $privilegeIdsToBeDeleted = array_diff($extractedPrivilegesIds, $_POST['privileges']);
                    $privilegeIdsToBeAdded = array_diff($_POST['privileges'], $extractedPrivilegesIds);
                //Delete the unwanted privileges
                foreach ($privilegeIdsToBeDeleted as $deletedprivilege) {
                    $unwantedprivilege = UserGroupPrivilegeModel::getBy(['privilegeId' => $deletedprivilege, 'groupid' => $group->groupid]);
                    $unwantedprivilege->current()->delete();
                }
                //add the new privilege
                foreach ($privilegeIdsToBeAdded as $privilegeId) {
                    $groupprivilege = new  UserGroupPrivilegeModel();
                    $groupprivilege->GroupId = $group->groupid;
                    $groupprivilege->privilegeId = $privilegeId;
                    $groupprivilege->save();

                }
            }
            $this->redirect('/mvcapp/public/index.php/usersgroups');
        }



        $this->_view();
    }

    public function  deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($id);
        if ($group === false) {
            $this->redirect('/mvcapp/public/index.php/usersgroups/');
        }

        $groupprivileges = UserGroupPrivilegeModel::getBy(['groupid' => $group->groupid]);

        if (false !==$groupprivileges ){
            foreach ($groupprivileges as $groupprivilege){
                $groupprivilege->delete();

            }

        }
        if ($group->delete()){

            $this->redirect('/mvcapp/public/index.php/usersgroups/');

        }




    }

}