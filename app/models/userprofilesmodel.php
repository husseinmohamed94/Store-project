<?php
namespace PHPMVC\Models;

class UserProfilesModel extends AbstractModel
{
    public $UserId;
    public $firstName;
    public $lastName;
    public $address;
    public $DOB;
    public $Image;


    protected  static  $tableName = 'app_users_profiles';


    protected  static  $tableSchema =array(
        'UserId'                  =>self::DATA_TYPE_INT,
        'firstName'                     => self::DATA_TYPE_STR,
        'lastName'                => self::DATA_TYPE_STR,
        'address'                =>self::DATA_TYPE_STR,
        'DOB'                     =>self::DATA_TYPE_DATE,
        'Image'                   => self::DATA_TYPE_STR

    ) ;

    protected  static  $primaryKey = 'UserId';


}