<?php


namespace PHPMVC\LIB;


class Language
{
        private $dictionary = [];

        public function load($path){
        $defaultlanguage = APP_DEFAULT_LANGUAGE ;
        if (isset($_SESSION['lang'])){
            $defaultlanguage = $_SESSION['lang'];
        }
         $pathArray = explode('.',$path);
         $languageFileToLoad =  LANGUAGES_PATH . $defaultlanguage . DS . $pathArray[0] . DS .$pathArray[1] . '.lang.php';
         $languageFileContent = file_get_contents($languageFileToLoad);
            if (file_exists($languageFileToLoad)){
                require $languageFileToLoad;
               if (is_array($_) && !empty($_)){
                    foreach ($_ as $key => $value){
                        $this->dictionary[$key] = $value;



                    }

               }else{
                   trigger_error('sorry the language filr' . $path . 'doens\'t exists' . E_USER_WARNING);
               }

            }


        }

        public function get($key){
            if (array_key_exists($key,$this->dictionary)){
                return $this->dictionary[$key];
            }
        }
        public function feedKey($key,$data ){
            if (array_key_exists($key,$this->dictionary)){
                array_unshift($data , $this->dictionary[$key]);

            return call_user_func_array('sprintf'  , $data);
            }
        }
        public function  getDictionary(){
       return  $this->dictionary;
        }


}