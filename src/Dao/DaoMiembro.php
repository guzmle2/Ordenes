<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:12 PM
 */
require_once '../Contrato/IDaoMiembro.php';
require_once '../Entidad/Miembro.php';

class DaoMiembro implements IDaoMiembro {

    private $Miembro;
    private $Valor;
    private $Valor_parametro;
    private $sql_modificar;
    const TABLA = 'miembro';
    private $conexion;
    const STRING_SQL = ' (  nombre, apellido, correo, clave, cedula, tipo_usuario)';
    const STRING_SQL_VALOR = '( :nombre, :apellido, :correo, :clave, :cedula, :tipo_usuario )';

    function __construct(Miembro $Miembro)
    {
        $this->Miembro = $Miembro;
        $this->conexion = new Conexion();
        $this->valorCargado();
        $this->valorCargadoModificar();
    }


    public function agregar()
    {

        if( $this->miembroCompleto() && $this->Miembro->getId() == null )
        {
            $consulta = $this->conexion->prepare(
                'INSERT INTO ' . self::TABLA.self::STRING_SQL . ' VALUE ' . self::STRING_SQL_VALOR);
            $consulta->bindParam(':nombre', $this->Miembro->getNombre());
            $consulta->bindParam(':apellido', $this->Miembro->getApellido());
            $consulta->bindParam(':correo', $this->Miembro->getCorreo());
            $consulta->bindParam(':clave', $this->Miembro->getClave());
            $consulta->bindParam(':cedula', $this->Miembro->getCedula());
            $consulta->bindParam(':tipo_usuario', $this->Miembro->getTipo());
            $consulta->execute();
            $this->Miembro->setId($this->conexion->lastInsertId()) ;
        }else{
            $this->Miembro = null;
        }
        $this->conexion = null;
        return $this->Miembro;
    }

    public function modificar()
    {
        if ( $this->Miembro->getId() != null || $this->Miembro->getId() != '' )
        {
            if( $this->miembroCompleto() ){
                $consulta = $this->conexion->prepare('UPDATE ' . self::TABLA .' SET'.$this->sql_modificar.' WHERE id = :id');
                $consulta->bindParam(':nombre', $this->Miembro->getNombre());
                $consulta->bindParam(':apellido', $this->Miembro->getApellido());
                $consulta->bindParam(':correo', $this->Miembro->getCorreo());
                $consulta->bindParam(':clave', $this->Miembro->getClave());
                $consulta->bindParam(':cedula', $this->Miembro->getCedula());
                $consulta->bindParam(':tipo_usuario', $this->Miembro->getTipo());
                $consulta->bindParam(':id', $this->Miembro->getId());
                $consulta->execute();
            }else{
                $this->Miembro = null;
            }
        }else{
            $this->Miembro = null;
        }
        $this->conexion = null;
        return $this->Miembro;
    }

    public function consultarPorId()
    {
        if ( $this->Miembro->getId() != null )
        {
            $consulta = $this->conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $this->Miembro->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->armarMiembro($registro);
            }else{
                $this->Miembro = null;
            }
        }else{
            $this->Miembro = null;
        }
        $this->conexion = null;
        return $this->Miembro;
    }

    public function consultarXParametro()
    {
        $consulta = $this->conexion->prepare('SELECT * FROM ' . self::TABLA . ' where '.$this->Valor);
        $consulta->execute();
        $registro = $consulta->fetch();

        if ($registro) {
            $this->armarMiembro($registro);

        } else {
            $this->Miembro = null;
        }

        $this->conexion = null;
        return $this->Miembro;
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
            $consulta->bindParam(':parametro', $this->Miembro->getId());
            $resultado = $consulta->execute();
            $this->conexion = null;
             return $resultado;

        }catch (Exception $e){
            $this->conexion = null;
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            return false;
        }
    }

    public function miembroCompleto(){

        if ( ($this->Miembro->getNombre() != '' && $this->Miembro->getNombre() != null)
            || ($this->Miembro->getApellido() != '' && $this->Miembro->getApellido() != null)
            || ($this->Miembro->getCorreo() != '' && $this->Miembro->getCorreo() != null)
            || ($this->Miembro->getClave() != '' && $this->Miembro->getClave() != null)
            || ($this->Miembro->getCedula() != '' && $this->Miembro->getCedula() != null)
            || ($this->Miembro->getTipo() != '' && $this->Miembro->getTipo() != null) )
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
        if (($this->Miembro->getNombre() != '' && $this->Miembro->getNombre() != null)){
            $valor = "nombre = '".$this->Miembro->getNombre()."'";
        }elseif(($this->Miembro->getApellido() != '' && $this->Miembro->getApellido() != null)){
            $valor = "apellido = '".$this->Miembro->getApellido()."'";
        }elseif(($this->Miembro->getCorreo() != '' && $this->Miembro->getCorreo() != null)){
            $valor = "correo = '".$this->Miembro->getCorreo()."'";
        }elseif(($this->Miembro->getClave() != '' && $this->Miembro->getClave() != null)){
            $valor = "clave = '".$this->Miembro->getClave()."'";
        }elseif($this->Miembro->getCedula() != '' && $this->Miembro->getCedula() != null){
            $valor = "cedula = '".$this->Miembro->getCedula()."'";
        }elseif($this->Miembro->getTipo() != '' && $this->Miembro->getTipo() != null) {
            $valor = "tipo_usuario = '".$this->Miembro->getTipo()."'";
        }else{
            $valor = '';
        }
        $this->Valor = $valor;

    }

    public function valorCargadoModificar(){

        $query = "";

        if ($this->Miembro->getNombre() != null)
        {
            if($query == ''){
                $query .=' nombre = :nombre';
            }else{
                $query .=', nombre = :nombre';
            }
        }

        if ($this->Miembro->getApellido() != null)
        {
            if($query == ''){
                $query .='apellido = :apellido';
            }else{
                $query .=', apellido = :apellido';
            }
        }
        if( $this->Miembro->getCorreo() != null){
            if($query == ''){
                $query .='correo = :correo';
            }else{
                $query .=', correo = :correo';
            }
        }
        if($this->Miembro->getClave() != null){
            if($query == ''){
                $query .='clave = :clave';
            }else{
                $query .=', clave = :clave';
            }

        }
        if($this->Miembro->getCedula() != null){
            if($query == ''){
                $query .='cedula = :cedula';
            }else{
                $query.=', cedula = :cedula';
            }

        }

        if( $this->Miembro->getTipo() != null){
            if($query == ''){
                $query .='tipo_usuario = :tipo_usuario ';
            }else{
                $query .=', tipo_usuario = :tipo_usuario ';
            }
        }

        $this->sql_modificar = $query;


    }


    public function armarMiembro($registro)
    {
        $this->Miembro->setId($registro['id']);
        $this->Miembro->setNombre($registro['nombre']);
        $this->Miembro->setApellido($registro['apellido']);
        $this->Miembro->setCorreo($registro['correo']);
        $this->Miembro->setClave($registro['clave']);
        $this->Miembro->setCedula($registro['cedula']);
        $this->Miembro->setTipo($registro['tipo_usuario']);
    }

}