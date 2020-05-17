<?php
namespace PHPMVC\Models;

class ClientModel extends AbstractModel
{
    public $supplierId;
    public $Name;
    public $phoneNumber;
    public $Email;
    public $address;
    


    protected  static  $tableName = 'app_clients';
    protected  static  $tableSchema =array(
        'Name'                   =>self::DATA_TYPE_STR,
        'phoneNumber'            => self::DATA_TYPE_STR,
        'Email'                  => self::DATA_TYPE_STR,
        'address'                =>self::DATA_TYPE_STR
      

    ) ;

    protected  static  $primaryKey = 'clienId';



	



 
}