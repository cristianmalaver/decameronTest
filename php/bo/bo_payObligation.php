<?php
#Author: cristian malaver
#Date: 1/6/2022
#Description : Is BO obligation
include "../dto/dto_payObligation.php";
include "../dao/dao_payObligation.php";
header("Content-type: application/json; charset=utf-8");
class BoPayObligation
{
  private $objObligation;
  private $objDao;
  private $intValidate;

  public function __construct()
  {
    $this->objObligation = new DtoPayObligation();
    $this->objDao = new DaoPayObligation();
  }

 #Description: Function for create a new obligation
 public function newObligation(
  $category_id,
  $id_create_product,
  $cantidad,
  $tipo_habi,
  $acomodacion
) {
  try {
    $this->objObligation->__setObligation(
      $category_id,
      $id_create_product,
      $cantidad,
      $tipo_habi,
      $acomodacion
    );
    $intValidate = $this->objDao->newObligation($this->objObligation);
  } catch (Exception $e) {
    echo 'Exception captured: ', $e->getMessage(), "\n";
    $intValidate = 0;
  }
  return $intValidate;
}
#Description: Function for delete a new obligation
public function deleteObligation($hotel_name)
{
  try {
    $this->objObligation->__setCod($hotel_name);
    $intValidate = $this->objDao->deleteObligation($this->objObligation);
  } catch (Exception $e) {
    echo 'Exception captured: ', $e->getMessage(), "\n";
    $intValidate = 0;
  }
  return $intValidate;
}

#Description: Function list Bank
public function selectBank()
{
  try {
    $intValidate = $this->objDao->selectBank();
  } catch (Exception $e) {
    echo 'Exception captured: ', $e->getMessage(), "\n";
    $intValidate = 0;
  }
  return $intValidate;
}
#Description: Function get obligation 
public function getObligation()
{
  try {
    $intValidate = $this->objDao->getObligation();
  } catch (Exception $e) {
    echo 'Exception captured: ', $e->getMessage(), "\n";
    $intValidate = 0;
  }
  return $intValidate;
}

#Description: Function get hoteles 
public function getHotels()
{
  try {
    $intValidate = $this->objDao->getHotels();
  } catch (Exception $e) {
    echo 'Exception captured: ', $e->getMessage(), "\n";
    $intValidate = 0;
  }
  return $intValidate;
}

}
$obj = new BoPayObligation();
/// We get the json sent
$getData = file_get_contents('php://input');
$data = json_decode($getData);

/**********CREATE ************/
if (isset($data->POST)) {
if ($data->POST == "POST") {
  echo $obj->newObligation(
    $data->category_id,
    $data->id_create_product,
    $data->cantidad,
    $data->tipo_habi,
    $data->acomodacion
  );
}
if ($data->POST == "POST_CHANGE_STATUS") {
  echo $obj->changeStatusObligation($data->hotel_name);
}
if ($data->POST == "POST_DELETE") {
  echo $obj->deleteObligation($data->hotel_name);
}
}

/**********READ AND CONSULT ************/
if (isset($data->GET)) {
if ($data->GET == "GET") {
  echo $obj->selectObligation($data->obligation_cod);
}
if ($data->GET == "GET_LIST_BANK") {
  echo $obj->selectBank();
}

if ($data->GET == "GET_OBLIGATION") {

  echo $obj->getObligation();
}

if ($data->GET == "GET_HOTELS") {

  echo $obj->getHotels();
}


}
/**********************/
//echo $obj->getHotels(); 
//echo $obj->getObligation(); 
//echo $obj->newObligation(0,59,25,'estandar','sencilla'); 
//echo $obj->selectObligation('28331710-1'); 
//echo $obj->deleteObligation('decameron decameron'); 
//echo $obj->updateObligation('11141346111', 'Holas6456asa', 'CCP1dfsd1111', 'Holdfsa', '2', '2', '2', '2', '2020-08-15', '111121121', '41', '711928700', '0', '0',"3" ,"2", "0", 3,'WDQWD34'); 


//"category_id":"0","acomodacion":"77","id_create_product":"60","cantidad":"triple","tipo_habi":"junior"