<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:09 PM
 */
require_once 'EntidadBase.php';
class TipoRevision extends EntidadBase {

    private $nombre;

    function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function __toString()
    {
        return ('TipoRevision: '.$this->getId().', '.
            $this->getNombre());

    }
}