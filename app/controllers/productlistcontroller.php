<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\Validate;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\ProductModel;
use PHPMVC\Models\ProductCategorieModel;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\FileUpload;


class productlistController extends AbstractController
{
    use InputFilter;
    use Helper;
    use validate;
    private $_createActionRoles =
    [
       'categoryid'              => 'req|num',
       'Name'                    => 'req|alphanum|between(3,50)',
       'Quantity'                => 'req|num',
       'BuyPrice'                => 'req|num',
       'sallPrice'               => 'req|num',
       'unit'                    => 'req|num',
        
    ];
        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('productlist.default');

            $this->_data['Products'] = ProductModel::getAll();
            $this->_view();

        }

    public function  createAction()
    {

        $this->language->load('template.common');
        $this->language->load('productlist.create');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validtion.errors');

        $this->_data['categories'] = ProductCategorieModel::getAll();
        $uploadError = false;
       
        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles , $_POST)){
        
            $Product = new ProductModel();
          $Product ->Name = $this->filterString($_POST['Name']);
          $Product ->categoryid = $this->filterInt($_POST['categoryid']);
          $Product ->Quantity = $this->filterInt($_POST['Quantity']);
          $Product ->BuyPrice = $this->filterFloat($_POST['BuyPrice']);
          $Product ->sallPrice = $this->filterFloat($_POST['sallPrice']);
          $Product ->unit = $this->filterInt($_POST['unit']);
        
        
          if(!empty($_FILES['Image']['name'])){
            $uploader = new FileUpload($_FILES['Image']);
            try{
                $uploader->upload(); 
                $Product->Image = $uploader->getFileName();

            }catch(\Exception $e){
                $this->messenger->add($e->getMessage(),Messenger::APP_MESSAGE_ERROR); 

                $uploadError = true;
            }
          }  
         if ($uploadError === false && $Product->save()){
            $this->messenger->add($this->language->get('mesage_create_success')); 
            $this->redirect('/mvcapp/public/index.php/productlist');
          }else{
            $this->messenger->add($this->language->get('mesage_create_failed'),Messenger::APP_MESSAGE_ERROR); 
          }

        }

      $this->_view();
    }

    public function  editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $Product = ProductModel::getByPK($id);
        if ($Product === false) {
            $this->redirect('/mvcapp/public/index.php/productlist/');
        }

        $this->language->load('template.common');
        $this->language->load('productlist.edit');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validtion.errors');

        $this->_data['Product'] = $Product;
        $this->_data['categories'] = ProductCategorieModel::getAll();

        $uploadError = false;

       
        if (isset($_POST['submit'])) {
            $Product ->Name = $this->filterString($_POST['Name']);
            $Product ->categoryid = $this->filterInt($_POST['categoryid']);
            $Product ->Quantity = $this->filterInt($_POST['Quantity']);
            $Product ->BuyPrice = $this->filterFloat($_POST['BuyPrice']);
            $Product ->sallPrice = $this->filterFloat($_POST['sallPrice']);
            $Product ->unit = $this->filterInt($_POST['unit']);
          

            if(!empty($_FILES['Image']['name'])){
                //romove the old image
            if($Product->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS .$Product->Image) && is_writable(IMAGES_UPLOAD_STORAGE)){
                unlink(IMAGES_UPLOAD_STORAGE.DS.$Product->Image);
            }
            //create a new image
            $uploader = new FileUpload($_FILES['Image']);
                try{
                    $uploader->upload(); 
                    $Product->Image = $uploader->getFileName();
    
                }catch(\Exception $e){
                    $this->messenger->add($e->getMessage(),Messenger::APP_MESSAGE_ERROR); 
    
                    $uploadError = true;
                }
              }  
            if ($uploadError === false && $Product->save()){
            $this->messenger->add($this->language->get('mesage_create_success'));
            $this->redirect('/mvcapp/public/index.php/productlist');
            }else{
            $this->messenger->add($this->language->get('mesage_create_failed'),Messenger::APP_MESSAGE_ERROR); 
              }
        }
            
        $this->_view();
    }

    public function  deleteAction()
    {
        $this->language->load('productcategories.messages');
        $id = $this->filterInt($this->_params[0]);
        $Product = ProductModel::getByPK($id);
        if ($Product === false) {
            $this->redirect('/mvcapp/public/index.php/productlist/');
        }


       
        if ($Product->delete()){
            if($Product->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS .$categorie->Image) && is_writable(IMAGES_UPLOAD_STORAGE)){
                unlink(IMAGES_UPLOAD_STORAGE . DS .$Product->Image);
            }
            $this->messenger->add($this->language->get('mesage_delete_success'));
        }else{
            $this->messenger->add($this->language->get('mesage_delete_failed')); 
          }
          $this->redirect('/mvcapp/public/index.php/productlist/');

    }

}