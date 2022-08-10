<?php 
#Author: cristian malaver
#Date: 1/6/2022
#Description : Is DTO obligation

class DtoObligation
{
    private $user;
    private $password;

    private $product_id ;
    private $hotel_name;
    private $city;
    private $rooms;
    private $direccion;
    private $nit;

    public function __construct()
    {
        $this->user = "MAXADMIN";
        $this->password = "Renting123*";
    }
    
    public function __setObligation(
    $product_id ,
    $hotel_name,
    $city,
    $rooms,
    $direccion,
    $nit
    )
    {
        $this->product_id = $product_id;
        $this->hotel_name = $hotel_name;
        $this->city = $city;
        $this->rooms = $rooms;
        $this->direccion = $direccion;
        $this->nit = $nit;
    }

    public function __getObligation()
    {
        $objObligation = new DtoObligation();
        $objObligation->__getPassword();
        $objObligation->__getproduct_id();
        $objObligation->__gethotel_name();
        $objObligation->__getcity();
        $objObligation->__getrooms();
        $objObligation->__getdireccion();
        $objObligation->__getnit();
        

        return $objObligation;
    }


    //SET OBLIGATION
    
    public function __setCod($hotel_name)
    {
        $this->hotel_name = $hotel_name;
    }
 
    public function __getUser()
    {
        return $this->user;
    }

    public function __getPassword()
    {
        return $this->password;
    }

    /////////////////////////////////////////////////////
 
    public function __getproduct_id()
    {
        return $this->product_id;
    }

    public function __gethotel_name()
    {
        return $this->hotel_name;
    }

    public function __getcity()
    {
        return $this->city;
    }
    public function __getrooms()
    {
        return $this->rooms;
    }
    public function __getdireccion()
    {
        return $this->direccion;
    }
    public function __getnit()
    {
        return $this->nit;
    }

    
}

