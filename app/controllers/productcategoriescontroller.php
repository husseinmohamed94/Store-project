<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\Validate;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\ProductCategorieModel;
use PHPMVC\LIB\FileUpload;
use PHPMVC\LIB\Messenger;

class ProductCategoriesController extends AbstractController
{
    use InputFilter;
    use Helper;
    use validate;
    private $_createActionRoles =
    [
       'Name' => 'req|alphanum|between(3,30)',
        
    ];
        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('productcategories.default');

            $this->_data['categories'] = ProductCategorieModel::getAll();
            $this->_view();

        }

    public function  createAction()
    {

        $this->language->load('template.common');
        $this->language->load('productcategories.create');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validtion.errors');

        $uploadError = false;
        //TODO:: explain abetter solution to check against file type
        //TODO:: explain abetter solution to secure the uplod folder
        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles , $_POST)){
          $categorie = new ProductCategorieModel();
          $categorie ->Name = $this->filterString($_POST['Name']);
          if(!empty($_FILES['Image']['name'])){
            $uploader = new FileUpload($_FILES['Image']);
            try{
                $uploader->upload(); 
                $categorie->Image = $uploader->getFileName();

            }catch(\Exception $e){
                $this->messenger->add($e->getMessage(),Messenger::APP_MESSAGE_ERROR); 

                $uploadError = true;
            }
          }  
         if ($uploadError === false && $categorie->save()){
            $this->messenger->add($this->language->get('mesage_create_success')); 
            $this->redirect('/mvcapp/public/index.php/productcategories');
          }else{
            $this->messenger->add($this->language->get('mesage_create_failed'),Messenger::APP_MESSAGE_ERROR); 
          }

        }

      $this->_view();
    }

    public function  editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $categorie = ProductCategorieModel::getByPK($id);
        if ($categorie === false) {
            $this->redirect('/mvcapp/public/index.php/productcategories/');
        }

        $this->language->load('template.common');
        $this->language->load('productcategories.edit');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validtion.errors');

        $this->_data['categorie'] = $categorie;
        $uploadError = false;

       
        if (isset($_POST['submit'])) {
            $categorie ->Name = $this->filterString($_POST['Name']);
            if(!empty($_FILES['Image']['name'])){
                //romove the old image
            if($categorie->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS .$categorie->Image) && is_writable(IMAGES_UPLOAD_STORAGE)){
                unlink(IMAGES_UPLOAD_STORAGE . DS .$categorie->Image);
            }
            //create a new image
            $uploader = new FileUpload($_FILES['Image']);
                try{
                    $uploader->upload(); 
                    $categorie->Image = $uploader->getFileName();
    
                }catch(\Exception $e){
                    $this->messenger->add($e->getMessage(),Messenger::APP_MESSAGE_ERROR); 
    
                    $uploadError = true;
                }
              }  
            if ($uploadError === false && $categorie->save()){
            $this->messenger->add($this->language->get('mesage_create_success'));
            $this->redirect('/mvcapp/public/index.php/productcategories');
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
        $categorie = ProductCategorieModel::getByPK($id);
        if ($categorie === false) {
            $this->redirect('/mvcapp/public/index.php/productcategories/');
        }


       
        if ($categorie->delete()){
            if($categorie->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS .$categorie->Image)){
                unlink(IMAGES_UPLOAD_STORAGE . DS .$categorie->Image);
            }
            $this->messenger->add($this->language->get('mesage_delete_success'));
        }else{
            $this->messenger->add($this->language->get('mesage_delete_failed')); 
          }
          $this->redirect('/mvcapp/public/index.php/productcategories/');

    }

}