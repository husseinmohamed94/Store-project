<?php
namespace PHPMVC\Models;

class ExpensesDailyModel extends AbstractModel
{
    public $DExpenseId;
    public $ExpenseId;
    public $payment;
    public $created;
    public $userid;





    protected  static  $tableName = 'app_expenses_daily_list';
    protected  static  $tableSchema =array(
        'ExpenseId'                   =>self::DATA_TYPE_INT,
        'payment'                     =>self::DATA_TYPE_DECIMAL,
        'created'                     => self::DATA_TYPE_DATE,
        'userid'                      =>self::DATA_TYPE_INT

    ) ;

    protected  static  $primaryKey = 'DExpenseId';

    public static function  getAll(){
        $sql = ' SELECT aedl. *, aec.ExpenseName  ExpenseName  FROM ' . self::$tableName . ' aedl ';
        $sql .= ' INNER JOIN ' . ExpensesCategoriesModel::getModelTableName() . ' aec ';
        $sql .=' ON aec.ExpenseId = aedl.ExpenseId';

        return self::get($sql);

        $sqll = ' SELECT aedl. *, au.Username  Username  FROM ' . self::$tableName . ' aedl ';
        $sqll .= ' INNER JOIN ' . UserModel::getModelTableName() . ' au ';
        $sqll .=' ON  au.UserId = aedl.userid  ';

        return self::get($sqll);
    }



 /*public static function  getUser(){
        $sqll = ' SELECT aedl. *, au.Username  Uname  FROM ' . self::$tableName . ' aedl ';
        $sqll .= ' INNER JOIN ' . UserModel::getModelTableName() . ' au ';
        $sqll .=' ON  au.UserId = aedl.userid ';
echo $sqll;
        return self::get($sqll);

    }*/

  /*  public static function  getAll(){
           $sql = ' SELECT aedl. *, au.Username  Username  FROM ' . self::$tableName . ' aedl ';
           $sql .= ' INNER JOIN ' . UserModel::getModelTableName() . ' au ';
           $sql .=' ON  au.UserId = aedl.userid  ';

           return self::get($sql);

       }*/


}
