<?php
namespace PHPMVC\Models;

class UserGroupModel extends AbstractModel
{
    public $groupid;
    public $GroupName;



    protected  static  $tableName = 'app_users_groups';


    protected  static  $tableSchema =array(
        'groupid'               =>self::DATA_TYPE_INT,
        'GroupName'             => self::DATA_TYPE_STR,

    ) ;

    protected  static  $primaryKey = 'groupid';



	




 
}