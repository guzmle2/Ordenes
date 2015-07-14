<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:08 PM
 */

class EntidadBase {

    private $id;


    function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}