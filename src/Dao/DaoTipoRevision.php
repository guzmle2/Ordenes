<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:12 PM
 */

require_once '../Entidad/TipoRevision.php';
require_once '../Contrato/IDaoTipoRevision.php';
class DaoTipoRevision implements IDaoTipoRevision {

    private $TipoRevision;
    const TABLA = 'tipo_revision';
    private  $conexion;

    function __construct(TipoRevision $TipoRevision)
    {
        $this->TipoRevision = $TipoRevision;
        $this->conexion = new Conexion();

    }

    public function agregar()
    {
        if( $this->TipoRevision->getNombre() != null || $this->TipoRevision->getNombre() != '' )
        {
            $consulta = $this->conexion->prepare('INSERT INTO ' . self::TABLA .'(nombre)
                VALUES  (:nombre)');
            $consulta->bindParam(':nombre', $this->TipoRevision->getNombre());
            $consulta->execute();
            $this->TipoRevision->setId($this->conexion->lastInsertId()) ;

        }else{
            $this->TipoRevision = null;
        }
        $this->conexion = null;
        return $this->TipoRevision;
    }

    public function modificar()
    {
        if ( $this->TipoRevision->getId() != null || $this->TipoRevision->getId() != '' )
        {
            if( $this->TipoRevision->getNombre() != null || $this->TipoRevision->getNombre() != '' ){
                $consulta = $this->conexion->prepare('UPDATE ' . self::TABLA .' SET nombre = :nombre'.
                    ' WHERE id = :id');
                $consulta->bindParam(':nombre', $this->TipoRevision->getNombre());
                $consulta->bindParam(':id', $this->TipoRevision->getId());
                $consulta->execute();
            }else{
                $this->TipoRevision = null;
            }
        }else{
            $this->TipoRevision = null;
        }
        $this->conexion = null;
        return $this->TipoRevision;
    }

    public function consultarPorId()
    {
        if ( $this->TipoRevision->getId() != null || $this->TipoRevision->getId() != '' )
        {
            $consulta = $this->conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $this->TipoRevision->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->TipoRevision->setNombre($registro['nombre']);
                $this->TipoRevision->setId($registro['id']);
            }else{
                $this->TipoRevision = null;
            }
        }else{
            $this->TipoRevision = null;
        }
        $this->conexion = null;
        return $this->TipoRevision;
    }

    public function consultarXParametro()
    {
        if ($this->TipoRevision->getId() != null) {
            $parametro = ' WHERE id = :parametro';
            $valor = $this->TipoRevision->getId();
        } elseif ($this->TipoRevision->getNombre() != null) {
            $parametro = ' WHERE nombre = :parametro';
            $valor = $this->TipoRevision->getNombre();
        } else {
            $parametro = ' WHERE id = :parametro';
            $valor = 0;
        }

        $consulta = $this->conexion->prepare('SELECT * FROM ' . self::TABLA . $parametro);
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $registro = $consulta->fetch();

        if ($registro) {
            $this->TipoRevision->setNombre($registro['nombre']);
            $this->TipoRevision->setId($registro['id']);

        } else {
            $this->TipoRevision = null;
        }

        $this->conexion = null;
        return $this->TipoRevision;
    }

    public function consultarXParametros()
    {
        // TODO: Implement consultarXParametros() method.
    }

    public function consultarTodos()
    {
        $consulta = $this->conexion->prepare('SELECT * FROM ' . self::TABLA );
        $consulta->execute();
        $Revisiones = $consulta->fetchAll();
        $this->conexion = null;
        return $Revisiones;
    }

    public function eliminar()
    {
        try{
            $consulta = $this->conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
            $consulta->bindParam(':parametro', $this->TipoRevision->getId());
            $consulta->execute();
            $conexion = null;

        }catch (Exception $e){
            $this->conexion = null;
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
        }
    }
}