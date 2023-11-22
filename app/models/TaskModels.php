<?php
namespace app\models;

use Respect\Validation\Validator as v;

class TaskModels
{
    public static function postModel($taskData)
    {
       // checa  se o body  foi  passado
        if (isset($taskData)) {
          // valida o  body da requisição post
            $nameIsValid = v::key('name')->validate($taskData); 
            $descriptionIsvalid = v::key('description')->validate($taskData);

            if(!$nameIsValid){
               return "propety name is missing";
            }

            if(!$descriptionIsvalid){
               return "propety description is missing";
            }
            
            if(!v::key('date')->validate($taskData)){
               return "propety data is missing";
            }

            $dateIsValid = v::date()->validate($taskData['date']);
             if(!$dateIsValid) {
               return "data must be  a  valid date format like 'Y-m-d'";
             }
             
            if ($nameIsValid && $descriptionIsvalid && $dateIsValid){
               // valida se o name e a descrição  são  strings
                $nameFormat  = v::stringType()->validate($taskData['name']);
                $descriptionFormat = v::stringType()->validate($taskData['description']);

                if(!$nameFormat || !$descriptionFormat){
                  return "Name or  description are not a string";
                }
                return true;
            } 
            
        } else {
         return "Propety name,description and date missing" ;
        }
    }

    public static function updateModel($taskData){
      {
         // checa  se o body  foi  passado
          if (isset($taskData)) {
            // valida o  body da requisição post
              $nameIsValid = v::key('name')->validate($taskData); 
              $descriptionIsvalid = v::key('description')->validate($taskData);
              $taskId =  v::key('taskId')->validate($taskData);
              if(!$nameIsValid){
                 return "propety name is missing";
              }
  
              if(!$descriptionIsvalid){
                 return "propety description is missing";
              }
              
              if(!v::key('date')->validate($taskData)){
                 return "propety data is missing";
              }
              
              if(!$taskId){
                 return "propety taskId is missing";
              }

              $dateIsValid = v::date()->validate($taskData['date']);
               if(!$dateIsValid) {
                 return "data must be  a  valid date format like 'Y-m-d'";
               }
               
              if ($nameIsValid && $descriptionIsvalid && $dateIsValid){
                 // valida se o name e a descrição  são  strings e se taskId é um numero
                  $nameFormat  = v::stringType()->validate($taskData['name']);
                  $descriptionFormat = v::stringType()->validate($taskData['description']);
                  $taskIdFormat = v::number()->validate($taskData['taskId']);
                  if(!$nameFormat || !$descriptionFormat || !$taskIdFormat){
                    return "Name or  description are not a string or tskId is not a number";
                  }
                  return true;
              } 
              
          } else {
           return "Propety name,description and date missing" ;
          }
      }
    }

}
