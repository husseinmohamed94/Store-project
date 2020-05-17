<?php
namespace PHPMVC\Models;

class UserGroupPrivilegeModel extends AbstractModel
{
    public $id;
    public $GroupId;
    public $privilegeId;



    protected  static  $tableName = 'app_users_groups_privileges';


    protected  static  $tableSchema =array(
        'GroupId'               =>self::DATA_TYPE_INT,
        'privilegeId'             => self::DATA_TYPE_INT

    ) ;

    protected  static  $primaryKey = 'id';


    public static function getGroupPrivileges(UserGroupModel $group){
        $groupprivileges = self::getBy(['groupid' => $group->groupid]);

        $extractedPrivilegesIds = [];
        if (false !== $groupprivileges) {
            foreach ($groupprivileges as $privilege) {
                $extractedPrivilegesIds[] = $privilege->privilegeId;

            }
        }
        return $extractedPrivilegesIds;
    }
    public static function getPrivilegesForGroup($groupid) {
       $sql = 'SELECT augp.*, aup.privilege FROM ' . self::$tableName .  ' augp ' ;
        $sql .= ' INNER JOIN app_users_privileges aup ON aup.privilegeId = augp.privilegeId';
        $sql .= ' WHERE augp.GroupId =' . $groupid;  
        return self::get($sql) ;
        $extractedUrls = [] ;
        if(false !== $privileges){
                foreach($privileges as $privilege){
              $extractedUrls[] =$privilege->privilege ;
                }
        }
        return $extractedUrls;
    }





}