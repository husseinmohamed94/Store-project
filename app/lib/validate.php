<?php
namespace PHPMVC\LIB;

 use http\Message;

 trait validate
{

    private $_regexPatterns = [
        'num'            => '/^[0-9]+(?:\.[0-9]+)?$/',
        'int'           => '/^[0-9]+$/',
        'float'          => '/^[0-9]+\.[0-9]+$/',
        'alpha'          =>'/^[a-zA-Z\p{Arabic} ]+$/u',
        'alphanum'      => '/^[a-zA-Z\p{Arabic}0-9 ]+$/u',
        'vdate'           => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
        'email'           => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'url'           => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
    ];

            public function req($value){
                return '' != $value || !empty($value);
            }
            public function num($value)
            {
                return (bool) preg_match($this->_regexPatterns['num'], $value);
            }
            public function int($value)
            {
                return (bool) preg_match($this->_regexPatterns['int'], $value);
            }
            public function float($value)
            {
                return (bool) preg_match($this->_regexPatterns['float'], $value);
            }

            public function alpha($value){
                return (bool) preg_match($this->_regexPatterns['alpha'], $value);

            }
            public function alphanum($value){
                return (bool) preg_match($this->_regexPatterns['alphanum'], $value);
            }

            public function eq($value,$matchagainst){
                return $value == $matchagainst;
            }
            public function eq_Field ($value,$otherFielsValue){
                return $value == $otherFielsValue;
            }
            public function lt($value,$matchagainst){
                if (is_string($value)){
                    return mb_strlen($value) < $matchagainst;

                    }elseif (is_numeric($value)){
                    return $value < $matchagainst;

                }
            }
            public function gt($value,$matchagainst){
                if (is_numeric($value)){
                    return $value > $matchagainst;
                    }elseif (is_string($value)){
                    return mb_strlen($value) > $matchagainst;

                }
            }
            public function min($value,$min){
                if (is_numeric($value)){
                    return $value >= $min;
                    }elseif (is_string($value)){
                    return mb_strlen($value) >= $min;

                }
            }
           public function max($value,$max){
               if(is_string($value)) {
                   return mb_strlen($value) <= $max;
               } elseif (is_numeric($value)) {
                   return $value <= $max;
               }
            }
            public function between($value,$min,$max){
                if (is_numeric($value)){
                    return $value >= $min && $value <= $max;
                    }elseif (is_string($value)){
                    return mb_strlen($value) >=$min && mb_strlen($value) <= $max;

                }
            }

            public function floatlike($value,$beforeDp,$afterDp){
                if (!$this->float($value)){
                    return false;
                }
                $pattern = '/^[0-9]{'. $beforeDp .  ' }\.[0-9]{'. $afterDp . '}$/';
                return (bool) preg_match($pattern,$value);
            }

            public function vdate($value){
                    return (bool) preg_match($this->_regexPatterns['vdate'],$value);

                }
            public function email($value){
                    return (bool) preg_match($this->_regexPatterns['email'],$value);

                }
            public function url($value){
                    return (bool) preg_match($this->_regexPatterns['url'],$value);

                }
            public function isValid($roles,$inputType){
                $errors = [];
                if (!empty($roles)){
                    foreach ($roles as $fieldName => $validationRoles) {
                                $value = $inputType[$fieldName];
                                $validationRoles =explode('|',$validationRoles);
                                foreach ($validationRoles as $validationRole){
                                    if(array_key_exists($fieldName, $errors))
                                        continue;
                                    if (preg_match_all('/(min)\((\d+)\)/',$validationRole ,$m )){
                                     if($this->min($value,$m[2][0]) === false){
                                  $this->messenger->add (
                                      $this->language->feedKey('text_error_'. $m[1][0],[ $this->language->get('text_label_'. $fieldName),$m[2][0]]),
                                      Messenger::APP_MESSAGE_ERROR
                                  );
                                  $errors[$fieldName] = true;
                                     }
                                }elseif (preg_match_all('/(max)\((\d+)\)/',$validationRole ,$m )){
                                        if($this->max($value,$m[2][0]) === false){
                                            $this->messenger->add (
                                                $this->language->feedKey('text_error_'. $m[1][0],[ $this->language->get('text_label_'. $fieldName),$m[2][0]]),
                                                Messenger::APP_MESSAGE_ERROR
                                            );
                                            $errors[$fieldName] = true;

                                        }

                                    }elseif (preg_match_all('/(lt)\((\d+)\)/',$validationRole ,$m )){
                                        if($this->lt($value,$m[2][0]) === false){
                                            $this->messenger->add (
                                                $this->language->feedKey('text_error_'. $m[1][0],[ $this->language->get('text_label_'. $fieldName),$m[2][0]]),
                                                Messenger::APP_MESSAGE_ERROR
                                            );
                                            $errors[$fieldName] = true;

                                        }

                                    }elseif(preg_match_all('/(gt)\((\d+)\)/',$validationRole ,$m )){
                                        if($this->gt($value,$m[2][0]) === false){
                                            $this->messenger->add (
                                                $this->language->feedKey('text_error_'. $m[1][0],[ $this->language->get('text_label_'. $fieldName),$m[2][0]]),
                                                Messenger::APP_MESSAGE_ERROR
                                            );
                                            $errors[$fieldName] = true;

                                        }

                                    }elseif(preg_match_all('/(between)\((\d+),(\d+)\)/',$validationRole ,$m )){

                                      if($this->between($value,$m[2][0],$m[3][0]) === false){
                                            $this->messenger->add (
                                                $this->language->feedKey('text_error_'. $m[1][0],[ $this->language->get('text_label_'. $fieldName),$m[2][0],$m[3][0]]),
                                                Messenger::APP_MESSAGE_ERROR
                                            );
                                          $errors[$fieldName] = true;

                                        }

                                    }elseif(preg_match_all('/(floatlike)\((\d+),(\d+)\)/',$validationRole ,$m )){

                                        if($this->floatlike($value,$m[2][0],$m[3][0]) === false){
                                            $this->messenger->add (
                                                $this->language->feedKey('text_error_'. $m[1][0],[ $this->language->get('text_label_'. $fieldName),$m[2][0],$m[3][0]]),
                                                Messenger::APP_MESSAGE_ERROR
                                            );
                                            $errors[$fieldName] = true;

                                        }

                                    }elseif(preg_match_all('/(eq)\((\w+)\)/',$validationRole ,$m )){

                                        if($this->eq($value,$m[2][0]) === false){
                                            $this->messenger->add (
                                                $this->language->feedKey('text_error_'. $m[1][0],[ $this->language->get('text_label_'. $fieldName),$m[2][0]]),
                                                Messenger::APP_MESSAGE_ERROR
                                            );
                                            $errors[$fieldName] = true;

                                        }

                                    }elseif(preg_match_all('/(eq_Field)\((\w+)\)/',$validationRole ,$m )){
                                        $otherFielsValue = $inputType[$m[2][0]];
                                        if($this->eq_Field($value,$otherFielsValue)   === false){

                                            $this->messenger->add (
                                                $this->language->feedKey('text_error_'. $m[1][0],[ $this->language->get('text_label_'. $fieldName),$this->language->get('text_label_'.$m[2][0])]),
                                                Messenger::APP_MESSAGE_ERROR
                                            );
                                            $errors[$fieldName] = true;

                                        }

                                    }else{
                                      if ($this->$validationRole($value) === false){
                                          $this->messenger->add (
                                              $this->language->feedKey('text_error_'. $validationRole ,[ $this->language->get('text_label_'. $fieldName)]),
                                              Messenger::APP_MESSAGE_ERROR
                                          );
                                          $errors[$fieldName] = true;

                                      }
                                    }
                                 }
                             }
                          }

            return empty($errors) ?  true : false ;
            }
        }