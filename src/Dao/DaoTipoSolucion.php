<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:16 PM
 */



include_once 'Conexion.php';
require_once '../Entidad/TipoSolucion.php';
require_once '../Contrato/IDaoTipoSolucion.php';

class DaoTipoSolucion implements IDaoTipoSolucion{


    private $TipoSolucion;
    private $conexion;
    const TABLA = 'tipo_solucion';

    function __construct( TipoSolucion $TipoSolucion)
    {
        $this->TipoSolucion = $TipoSolucion;
        $this->conexion = new Conexion();
    }


    public function agregar()
    {
        if( $this->TipoSolucion->getNombre() != null || $this->TipoSolucion->getNombre() != '' )
        {
            $consulta = $this->conexion->prepare('INSERT INTO ' . self::TABLA .'(nombre)
                VALUES  (:nombre)');
            $consulta->bindParam(':nombre', $this->TipoSolucion->getNombre());
            $consulta->execute();
            $this->TipoSolucion->setId($this->conexion->lastInsertId()) ;

        }else{
            $this->TipoSolucion = null;
        }
        $this->conexion = null;
        return $this->TipoSolucion;
    }

    public function modificar()
    {
        if ( $this->TipoSolucion->getId() != null || $this->TipoSolucion->getId() != '' )
        {
            if( $this->TipoSolucion->getNombre() != null || $this->TipoSolucion->getNombre() != '' ){
                $consulta = $this->conexion->prepare('UPDATE ' . self::TABLA .' SET nombre = :nombre'.
                    ' WHERE id = :id');
                $consulta->bindParam(':nombre', $this->TipoSolucion->getNombre());
                $consulta->bindParam(':id', $this->TipoSolucion->getId());
                $consulta->execute();
            }else{
                $this->TipoSolucion = null;
            }
        }else{
            $this->TipoSolucion = null;
        }
        $this->conexion = null;
        return $this->TipoSolucion;
    }

    public function consultarPorId()
    {
        if ( $this->TipoSolucion->getId() != null || $this->TipoSolucion->getId() != '' )
        {
            $consulta = $this->conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $this->TipoSolucion->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->TipoSolucion->setNombre($registro['nombre']);
                $this->TipoSolucion->setId($registro['id']);
            }else{
                $this->TipoSolucion = null;
            }
        }else{
            $this->TipoSolucion = null;
        }
        $this->conexion = null;
        return $this->TipoSolucion;
    }

    public function consultarXParametro()
    {
        if ($this->TipoSolucion->getId() != null) {
            $parametro = ' WHERE id = :parametro';
            $valor = $this->TipoSolucion->getId();
        } elseif ($this->TipoSolucion->getNombre() != null) {
            $parametro = ' WHERE nombre = :parametro';
            $valor = $this->TipoSolucion->getNombre();
        } else {
            $parametro = ' WHERE id = :parametro';
            $valor = 0;
        }

        $consulta = $this->conexion->prepare('SELECT * FROM ' . self::TABLA . $parametro);
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $registro = $consulta->fetch();

        if ($registro) {
            $this->TipoSolucion->setNombre($registro['nombre']);
            $this->TipoSolucion->setId($registro['id']);

        } else {
            $this->TipoSolucion = null;
        }

        $this->conexion = null;
        return $this->TipoSolucion;
    }

    public function consultarXParametros()
    {
        // TODO: Implement consultarXParametros() method.
    }

    public function consultarTodos()
    {
        $consulta = $this->conexion->prepare('SELECT * FROM ' . self::TABLA );
        $consulta->execute();
        $Soluciones = $consulta->fetchAll();
        $this->conexion = null;
        return $Soluciones;
    }

    public function eliminar()
    {
        try{
            $consulta = $this->conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
            $consulta->bindParam(':parametro', $this->TipoSolucion->getId());
            $consulta->execute();
            $conexion = null;

        }catch (Exception $e){
            $this->conexion = null;
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
        }
    }
}