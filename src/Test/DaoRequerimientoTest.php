<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 08:11 PM
 */

require_once '../Fabrica/FabricaDao.php';
require_once '../Entidad/Requerimiento.php';
require_once 'TestBase.php';
class DaoRequerimientoTest extends PHPUnit_Framework_TestCase implements TestBase{


    var $Requerimiento;

    public function setUp(){

        $Miembro = new Miembro();
        $Miembro->setNombre("Nombre");
        $Miembro->setApellido("Apellido");
        $Miembro->setCedula("19720104");
        $Miembro->setCorreo("ronoel54@gmail.com");
        $Miembro->setTipo("administrador");
        $Miembro->setClave("1234");

        $dao = FabricaDao::obtenerDaoMiembro($this->$Miembro);
        $dao->agregar();

        $Tecnico = new Miembro();
        $Tecnico->setNombre("Nombre");
        $Tecnico->setApellido("Apellido");
        $Tecnico->setCedula("19720104");
        $Tecnico->setCorreo("ronoel54@gmail.com");
        $Tecnico->setTipo("tecnico");
        $Tecnico->setClave("1234");

        $dao = FabricaDao::obtenerDaoMiembro($this->$Tecnico);
        $dao->agregar();

        $TipoR = new TipoRevision();
        $TipoR->setNombre("TipoRevision#");
        $dao = FabricaDao::obtenerDaoTipoRevision($TipoR);
        $dao->agregar();

        $TipoD = new TipoDespacho();
        $TipoD->setNombre("TipoDespacho#");
        $dao = FabricaDao::obtenerDaoTipoDespacho($TipoD);
        $dao->agregar();

        $TipoS = new TipoSolucion();
        $TipoS->setNombre("TipoSolucion#");
        $dao = FabricaDao::obtenerDaoTipoSolucion($TipoS);
        $dao->agregar();

        $Requer = new Requerimiento();
        $Requer->setCreador($Miembro);
        $Requer->setNombreSolicitante("Apellido");
        $Requer->setTlfSolicitante("12345");
        $Requer->setTipoRevision("12345");
        $Requer->setObservaciones("Observacion");
        $Requer->setIp("0000");
        $Requer->setDireccionEquipo("Direccion");
        $Requer->setPrivilegios(true);
        $Requer->setTipoSolucion($TipoS);
        $Requer->setTipoDespacho($TipoD);
        $Requer->setTecnico($Tecnico);
        $Requer->setUsuarioNotificado("UsuarioNotificado");

        $this->Requerimiento = $Requer;



    }


    public function testAgregar()
    {
        $dao = FabricaDao::obtenerDaoRequerimiento($this->Requerimiento);
        $dao->agregar();
    }

    public function testModificar()
    {
        $dao = FabricaDao::obtenerDaoRequerimiento($this->Requerimiento);
        $dao->modificar();
    }

    public function testConsultarPorId()
    {
        $dao = FabricaDao::obtenerDaoRequerimiento($this->Requerimiento);
        $dao->consultarPorId();
    }

    public function testConsultarXParametro()
    {
        $dao = FabricaDao::obtenerDaoRequerimiento($this->Requerimiento);
        $dao->consultarXParametro();
    }

    public function testConsultarXParametros()
    {
        $dao = FabricaDao::obtenerDaoRequerimiento($this->Requerimiento);
        $dao->consultarXParametros();
    }

    public function testConsultarTodos()
    {
        $dao = FabricaDao::obtenerDaoRequerimiento($this->Requerimiento);
        $dao->consultarTodos();
    }

    public function testEliminar()
    {
        $dao = FabricaDao::obtenerDaoRequerimiento($this->Requerimiento);
        $dao->eliminar();
    }
}
