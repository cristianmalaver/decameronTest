<?php 
#Author: ristian Malaver
#Date: 1/6/2022
#Description : Is DAO Obligation
include "../class/connectionDB.php";
class DaoObligation


{
  private $objConntion;
  private $arrayResult;
  private $intValidatio;

  public function __construct()
  {
    $this->objConntion = new Connection();
    $this->arrayResult = array();
    $this->intValidatio;
  }

  #Description: Function list Bank
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function selectBank()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("SELECT * FROM create_product")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
  #Description: Function list type obligation
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function selectTypeObligation()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("SELECT * FROM credit_type")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
    #Description: Function list type interes
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function selectTypeInteres()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("SELECT * FROM interesting_type")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
    #Description: Function list method amortization
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function selectMethodAmortization()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("SELECT * FROM amortization_type")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
  #Description: Function of query to maximo contract
  #Date:30/10/2020
  #Author:Cristian Malaver

  public function selectClientMaximo($user, $password)

  {
    try {
      $datos = json_decode(file_get_contents("https://rentingautomayor.maximo.com/maxrest/rest/os/RA_CLIENTE?_format=json&_lid=" . $user . "&_lpwd=" . $password . ""), true);
      $nit = "";
      $select = [];
      $nodatos[0] = "POR ENTREGAR";
      $nodatos[1] = "RENTING USAD";
      $nodatos[2] = "SINIESTRO";
      $nodatos[3] = "RENTENS";
      $nodatos[4] = "RENTNEW";
      $nodatos[5] = "RENTUSED";
      foreach ($datos as $key => $value) {

        $cliente = $value["RA_CLIENTESet"]["LOCATIONS"];
        for ($i = 0; $i < count($cliente); $i++) {
          if (isset($cliente[$i]["Attributes"]["DESCRIPTION"]["content"])) {
            $descripcion = ($cliente[$i]["Attributes"]["DESCRIPTION"]["content"]);
            $nit = ($cliente[$i]["Attributes"]["LOCATION"]["content"]);

            if ($nit != $nodatos[0] && $nit != $nodatos[1] && $nit != $nodatos[2] && $nit != $nodatos[3] && $nit != $nodatos[4] && $nit != $nodatos[5]) {

              array_push($select, array("Client_nit" => $nit, "Client_name" => $descripcion));
            }
          }
        }
      }
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($select);
  }

  public function selectContractMaximo($user, $password, $nit)
  {
    try {
      $datos = json_decode(file_get_contents("https://rentingautomayor.maximo.com/maxrest/rest/os/RA_CONTRATOS?_format=json&_lid=" . $user . "&_lpwd=" . $password . "&RACLIENTE=" . $nit . ""), true);
      $select = [];
      foreach ($datos as $key => $value) {

        $contrato = $value["RA_CONTRATOSSet"]["RA_CONTRATOCLIENTE"];
        for ($i = 0; $i < count($contrato); $i++) {
          if (isset($contrato[$i]["Attributes"]["DESCRIPTION"]["content"])) {
            $descripcion = ($contrato[$i]["Attributes"]["DESCRIPTION"]["content"]);
            $codeContrat = ($contrato[$i]["Attributes"]["RACODIGOCONTRATO"]["content"]);
            array_push($select, array("Contract_id" => $codeContrat, "Contract_name" => $descripcion));
          }
        }
      }
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($select);
  }

  //$obj = new DaoObligation();
  //echo $obj -> contractQuery("MAXADMIN", "Renting123*", "830058272");
  #Description: Function for get obligation
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function getObligation()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("CALL sp_obligation_select()")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
    #Description: Function for get hotels
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function getHotels()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("CALL sp_hotels_category()")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
  public function selectObligation($code)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
    
      if ($con != null) {
        if ($result = $con->query("CALL sp_obligation_select_update ('$code')")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
  public function getObligationSearch($data)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
    
      if ($con != null) {
        if ($result = $con->query("CALL sp_obligation_search('$data')")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
  #Description: Function for create a new obligation
  public function newObligation($objObligation)
  {
    try {
   
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        $dataObligation = 
          $objObligation->__getproduct_id () . ",'" .
          $objObligation->__gethotel_name() . "','" .
          $objObligation->__getcity() . "'," .
          $objObligation->__getrooms() . ",'" .  
          $objObligation->__getdireccion() . "','" .
          $objObligation->__getnit() . "'";
        //  echo 'CALL sp_obligation_insert_update('. $dataObligation .')';
         if ($con->query('CALL sp_obligation_insert_update('. $dataObligation .')')) {
          $this->intValidatio = 1;
        } else {
          $this->intValidatio = 0;
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return $this->intValidatio;
  }
 
  #Description: Function for change status obligation
  public function changeStatusObligation($objObligation)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {

        $dataObligation = "WHERE obligation_cod ='".$objObligation->__getObligation_cod()."'";
        //echo "UPDATE obligation SET Stat_id = 4 ".$dataObligation;
        if ($con->query(  "UPDATE obligation SET Stat_id = 4 ".$dataObligation)) 
         
         { $this->intValidatio = 1;
        } else {
          $this->intValidatio = 0;
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return $this->intValidatio;
  }
  #Description: Function for delete obligation
  public function deleteObligation($objObligation)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {

        $dataObligation = "WHERE hotel_name ='".$objObligation->__gethotel_name()."'";
        //echo "DELETE FROM create_product " .$dataObligation;
        if ($con->query(  "DELETE FROM create_product " .$dataObligation)) 
         
         { $this->intValidatio = 1;
        } else {
          $this->intValidatio = 0;
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return $this->intValidatio;
  }
}
