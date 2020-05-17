<?php
namespace PHPMVC\Models;

class ExpensesCategoriesModel extends AbstractModel
{
    public $ExpenseId;
    public $ExpenseName;
    public $fixedPayment;
  
    


    protected  static  $tableName = 'app_expenses_categories';
    protected  static  $tableSchema =array(
        'ExpenseName'                   =>self::DATA_TYPE_STR,
        'fixedPayment'            => self::DATA_TYPE_DECIMAL
        

    ) ;

    protected  static  $primaryKey = 'ExpenseId';

    

	



 
}