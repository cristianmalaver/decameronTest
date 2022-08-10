<?php 
#Author: cristian malaver
#Date: 1/6/2022
#Description : Is DTO obligation

class DtoPayObligation
{
    private $user;
    private $password;

    private $category_id;
    private $id_create_product;
    private $cantidad;
    private $tipo_habi;
    private $acomodacion;

    public function __construct()
    {
        $this->user = "MAXADMIN";
        $this->password = "Renting123*";
    }
    
    public function __setObligation(
    $category_id,
    $id_create_product,
    $cantidad,
    $tipo_habi,
    $acomodacion
    )
    {
        $this->category_id = $category_id;
        $this->id_create_product = $id_create_product;
        $this->cantidad = $cantidad;
        $this->tipo_habi = $tipo_habi;
        $this->acomodacion = $acomodacion;
    }

    public function __getObligation()
    {
        $objObligation = new DtoPayObligation();
        $objObligation->__getPassword();
        $objObligation->__getcategory_id();
        $objObligation->__getid_create_product();
        $objObligation->__getcantidad();
        $objObligation->__gettipo_habi();
        $objObligation->__getacomodacion();
        

        return $objObligation;
    }


    //SET OBLIGATION
    
    public function __setCod($category_id)
    {
        $this->category_id = $category_id;
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
 
    public function __getcategory_id()
    {
        return $this->category_id;
    }

    public function __getid_create_product()
    {
        return $this->id_create_product;
    }

    public function __getcantidad()
    {
        return $this->cantidad;
    }
    public function __gettipo_habi()
    {
        return $this->tipo_habi;
    }
    public function __getacomodacion()
    {
        return $this->acomodacion;
    }
    
}

