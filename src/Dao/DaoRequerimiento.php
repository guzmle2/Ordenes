<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:12 PM
 */

require_once '../Entidad/Requerimiento.php';
require_once '../Contrato/IDaoRequerimiento.php';
class DaoRequerimiento implements IDaoRequerimiento {

    private $Requerimiento;
    private $Valor;
    private $Valor_parametro;
    private $sql_modificar;
    const TABLA = 'requerimiento';
    private $conexion;
    const STRING_SQL = ' (  id_usrCreador, nombre, tlf, tipoRevision, observacion, ip, direccion, privilegios, tipoSolucion, tipoDespacho, tecnico, usuario_notificado)';
    const STRING_SQL_VALOR = '( :id_usrCreador, nombre, :tlf, tipoRevision, :observacion, :ip, :direccion, :privilegios, :tipoSolucion, :tipoDespacho, :tecnico, :usuario_notificado )';

    function __construct(Requerimiento $Requerimiento)
    {
        $this->Requerimiento = $Requerimiento;
        $this->conexion = new Conexion();
        $this->valorCargado();
        $this->valorCargadoModificar();
    }


    public function agregar()
    {

        if( $this->RequerimientoCompleto() && $this->Requerimiento->getId() == null )
        {
            $consulta = $this->conexion->prepare(
                'INSERT INTO ' . self::TABLA.self::STRING_SQL . ' VALUES ' . self::STRING_SQL_VALOR);
            $consulta->bindParam(':nombre', $this->Requerimiento->getNombre());
            $consulta->bindParam(':apellido', $this->Requerimiento->getApellido());
            $consulta->bindParam(':correo', $this->Requerimiento->getCorreo());
            $consulta->bindParam(':clave', $this->Requerimiento->getClave());
            $consulta->bindParam(':cedula', $this->Requerimiento->getCedula());
            $consulta->bindParam(':tipo_usuario', $this->Requerimiento->getTipo());
            $consulta->execute();
            $this->Requerimiento->setId($this->conexion->lastInsertId()) ;
        }else{
            $this->Requerimiento = null;
        }
        $this->conexion = null;
        return $this->Requerimiento;
    }

    public function modificar()
    {
        if ( $this->Requerimiento->getId() != null || $this->Requerimiento->getId() != '' )
        {
            if( $this->RequerimientoCompleto() ){
                $consulta = $this->conexion->prepare('UPDATE ' . self::TABLA .' SET'.$this->sql_modificar.' WHERE id = :id');
                $consulta->bindParam(':nombre', $this->Requerimiento->getNombre());
                $consulta->bindParam(':apellido', $this->Requerimiento->getApellido());
                $consulta->bindParam(':correo', $this->Requerimiento->getCorreo());
                $consulta->bindParam(':clave', $this->Requerimiento->getClave());
                $consulta->bindParam(':cedula', $this->Requerimiento->getCedula());
                $consulta->bindParam(':tipo_usuario', $this->Requerimiento->getTipo());
                $consulta->bindParam(':id', $this->Requerimiento->getId());
                $consulta->execute();
            }else{
                $this->Requerimiento = null;
            }
        }else{
            $this->Requerimiento = null;
        }
        $this->conexion = null;
        return $this->Requerimiento;
    }

    public function consultarPorId()
    {
        if ( $this->Requerimiento->getId() != null )
        {
            $consulta = $this->conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $this->Requerimiento->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->armarRequerimiento($registro);
            }else{
                $this->Requerimiento = null;
            }
        }else{
            $this->Requerimiento = null;
        }
        $this->conexion = null;
        return $this->Requerimiento;
    }

    public function consultarXParametro()
    {
        $consulta = $this->conexion->prepare('SELECT * FROM ' . self::TABLA . ' where '.$this->Valor);
        $consulta->execute();
        $registro = $consulta->fetch();

        if ($registro) {
            $this->armarRequerimiento($registro);

        } else {
            $this->Requerimiento = null;
        }

        $this->conexion = null;
        return $this->Requerimiento;
    }

    public function consultarXParametros()
    {

        $consulta = $this->conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE '. $this->Valor);
        $consulta->execute();
        $registro = $consulta->fetchAll();
        $this->conexion = null;
        return $registro;
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
            $consulta->bindParam(':parametro', $this->Requerimiento->getId());
            $resultado = $consulta->execute();
            $this->conexion = null;
            return $resultado;

        }catch (Exception $e){
            $this->conexion = null;
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            return false;
        }
    }

    public function RequerimientoCompleto(){

        if ( ($this->Requerimiento->getNombre() != '' && $this->Requerimiento->getNombre() != null)
            || ($this->Requerimiento->getApellido() != '' && $this->Requerimiento->getApellido() != null)
            || ($this->Requerimiento->getCorreo() != '' && $this->Requerimiento->getCorreo() != null)
            || ($this->Requerimiento->getClave() != '' && $this->Requerimiento->getClave() != null)
            || ($this->Requerimiento->getCedula() != '' && $this->Requerimiento->getCedula() != null)
            || ($this->Requerimiento->getTipo() != '' && $this->Requerimiento->getTipo() != null) )
        {
            return true;
        }else
        {
            return false;
        }

    }

    public function valorCargado(){
        $valor = "";
        $patametro = "";
        if (($this->Requerimiento->getNombre() != '' && $this->Requerimiento->getNombre() != null)){
            $valor = "nombre = '".$this->Requerimiento->getNombre()."'";
        }elseif(($this->Requerimiento->getApellido() != '' && $this->Requerimiento->getApellido() != null)){
            $valor = "apellido = '".$this->Requerimiento->getApellido()."'";
        }elseif(($this->Requerimiento->getCorreo() != '' && $this->Requerimiento->getCorreo() != null)){
            $valor = "correo = '".$this->Requerimiento->getCorreo()."'";
        }elseif(($this->Requerimiento->getClave() != '' && $this->Requerimiento->getClave() != null)){
            $valor = "clave = '".$this->Requerimiento->getClave()."'";
        }elseif($this->Requerimiento->getCedula() != '' && $this->Requerimiento->getCedula() != null){
            $valor = "cedula = '".$this->Requerimiento->getCedula()."'";
        }elseif($this->Requerimiento->getTipo() != '' && $this->Requerimiento->getTipo() != null) {
            $valor = "tipo_usuario = '".$this->Requerimiento->getTipo()."'";
        }else{
            $valor = '';
        }
        $this->Valor = $valor;

    }

    public function valorCargadoModificar(){

        $query = "";

        if ($this->Requerimiento->getNombre() != null)
        {
            if($query == ''){
                $query .=' nombre = :nombre';
            }else{
                $query .=', nombre = :nombre';
            }
        }

        if ($this->Requerimiento->getApellido() != null)
        {
            if($query == ''){
                $query .='apellido = :apellido';
            }else{
                $query .=', apellido = :apellido';
            }
        }
        if( $this->Requerimiento->getCorreo() != null){
            if($query == ''){
                $query .='correo = :correo';
            }else{
                $query .=', correo = :correo';
            }
        }
        if($this->Requerimiento->getClave() != null){
            if($query == ''){
                $query .='clave = :clave';
            }else{
                $query .=', clave = :clave';
            }

        }
        if($this->Requerimiento->getCedula() != null){
            if($query == ''){
                $query .='cedula = :cedula';
            }else{
                $query.=', cedula = :cedula';
            }

        }

        if( $this->Requerimiento->getTipo() != null){
            if($query == ''){
                $query .='tipo_usuario = :tipo_usuario ';
            }else{
                $query .=', tipo_usuario = :tipo_usuario ';
            }
        }

        $this->sql_modificar = $query;


    }


    public function armarRequerimiento($registro)
    {
        $this->Requerimiento->setId($registro['id']);
        $this->Requerimiento->setNombre($registro['nombre']);
        $this->Requerimiento->setApellido($registro['apellido']);
        $this->Requerimiento->setCorreo($registro['correo']);
        $this->Requerimiento->setClave($registro['clave']);
        $this->Requerimiento->setCedula($registro['cedula']);
        $this->Requerimiento->setTipo($registro['tipo_usuario']);
    }
}