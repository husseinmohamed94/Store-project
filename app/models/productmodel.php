<?php
namespace PHPMVC\Models;

class ProductModel extends AbstractModel
{

    public $productid;
    public $categoryid;
    public $Name;
    public $Image;
    public $Quantity; 
    public $BuyPrice;
    public $sallPrice;
    public $Barcode;
    public $unit;


    protected  static  $tableName = 'app_products_list';
    protected  static  $tableSchema =array(
        'categoryid'             =>self::DATA_TYPE_INT,
        'Name'                   =>self::DATA_TYPE_STR,
        'Image'                  => self::DATA_TYPE_STR,
        'Quantity'               => self::DATA_TYPE_INT,
        'BuyPrice'                  => self::DATA_TYPE_DECIMAL,
        'sallPrice'                  => self::DATA_TYPE_DECIMAL,
        'Barcode'                => self::DATA_TYPE_STR, 
        'unit'                  => self::DATA_TYPE_INT
    ) ;

    protected  static  $primaryKey = 'productid';
    public static function  getAll(){
        $sql = ' SELECT apl. *, apc.Name  categortyName  FROM ' . self::$tableName . ' apl ';
        $sql .= ' INNER JOIN ' . ProductCategorieModel::getModelTableName() . ' apc ';
        $sql .=' ON apc.categortyid = apl.categoryid';
        return self::get($sql);
    }


	



 
}