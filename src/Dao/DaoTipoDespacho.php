<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:12 PM
 */
require_once '../Entidad/TipoDespacho.php';
require_once '../Contrato/IDaoTipoDespacho.php';
class DaoTipoDespacho implements IDaoTipoDespacho {


    private $TipoDespacho;
    const TABLA = 'tipo_despacho';
    private $conexion;

    function __construct(TipoDespacho $TipoDespacho)
    {
        $this->TipoDespacho = $TipoDespacho;
        $this->conexion = new Conexion();
    }

    public function agregar()
    {
        if( $this->TipoDespacho->getNombre() != null || $this->TipoDespacho->getNombre() != '' )
        {
            $consulta = $this->conexion->prepare('INSERT INTO ' . self::TABLA .'(nombre)
                VALUES  (:nombre)');
            $consulta->bindParam(':nombre', $this->TipoDespacho->getNombre());
            $consulta->execute();
            $this->TipoDespacho->setId($this->conexion->lastInsertId()) ;

        }else{
            $this->TipoDespacho = null;
        }
        $this->conexion = null;
        return $this->TipoDespacho;
    }

    public function modificar()
    {
        if ( $this->TipoDespacho->getId() != null || $this->TipoDespacho->getId() != '' )
        {
            if( $this->TipoDespacho->getNombre() != null || $this->TipoDespacho->getNombre() != '' ){
                $consulta = $this->conexion->prepare('UPDATE ' . self::TABLA .' SET nombre = :nombre'.
                    ' WHERE id = :id');
                $consulta->bindParam(':nombre', $this->TipoDespacho->getNombre());
                $consulta->bindParam(':id', $this->TipoDespacho->getId());
                $consulta->execute();
            }else{
                $this->TipoDespacho = null;
            }
        }else{
            $this->TipoDespacho = null;
        }
        $this->conexion = null;
        return $this->TipoDespacho;
    }

    public function consultarPorId()
    {
        if ( $this->TipoDespacho->getId() != null || $this->TipoDespacho->getId() != '' )
        {
            $consulta = $this->conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $this->TipoDespacho->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->TipoDespacho->setNombre($registro['nombre']);
                $this->TipoDespacho->setId($registro['id']);
            }else{
                $this->TipoDespacho = null;
            }
        }else{
            $this->TipoDespacho = null;
        }
        $this->conexion = null;
        return $this->TipoDespacho;
    }

    public function consultarXParametro()
    {
        if ($this->TipoDespacho->getId() != null) {
            $parametro = ' WHERE id = :parametro';
            $valor = $this->TipoDespacho->getId();
        } elseif ($this->TipoDespacho->getNombre() != null) {
            $parametro = ' WHERE nombre = :parametro';
            $valor = $this->TipoDespacho->getNombre();
        } else {
            $parametro = ' WHERE id = :parametro';
            $valor = 0;
        }

        $consulta = $this->conexion->prepare('SELECT * FROM ' . self::TABLA . $parametro);
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $registro = $consulta->fetch();

        if ($registro) {
            $this->TipoDespacho->setNombre($registro['nombre']);
            $this->TipoDespacho->setId($registro['id']);

        } else {
            $this->TipoDespacho = null;
        }

        $this->conexion = null;
        return $this->TipoDespacho;
    }

    public function consultarXParametros()
    {
        // TODO: Implement consultarXParametros() method.
    }

    public function consultarTodos()
    {
        $consulta = $this->conexion->prepare('SELECT * FROM ' . self::TABLA );
        $consulta->execute();
        $Despachoes = $consulta->fetchAll();
        $this->conexion = null;
        return $Despachoes;
    }

    public function eliminar()
    {
        try{
            $consulta = $this->conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
            $consulta->bindParam(':parametro', $this->TipoDespacho->getId());
            $consulta->execute();
            $conexion = null;

        }catch (Exception $e){
            $this->conexion = null;
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
        }
    }
}