<?php
namespace PHPMVC\Models;

class PrivilegesModel extends AbstractModel
{
    public $privilegeId ;
    public $privilege ;
    public $privilegeTitle ;



    protected  static  $tableName = 'app_users_privileges';


    protected  static  $tableSchema =array(
        'privilegeId'      => self::DATA_TYPE_INT,
        'privilege'        => self::DATA_TYPE_STR,
        'privilegeTitle'   => self::DATA_TYPE_STR

    ) ;

    protected  static  $primaryKey = 'privilegeId';



	




 
}