<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 08:11 PM
 */

require_once '../Fabrica/FabricaDao.php';
require_once '../Entidad/TipoDespacho.php';
require_once 'TestBase.php';
class DaoTipoDespachoTest extends PHPUnit_Framework_TestCase implements TestBase {


    var $TipoDespacho;

    public function setUp(){
        $TipoR = new TipoDespacho();
        $TipoR->setNombre("TipoDespacho#");
        $this->TipoDespacho = $TipoR;
    }


    public function testAgregar()
    {
        $dao = FabricaDao::obtenerDaoTipoDespacho($this->TipoDespacho);
        $dao->agregar();
    }

    public function testModificar()
    {
        $dao = FabricaDao::obtenerDaoTipoDespacho($this->TipoDespacho);
        $dao->modificar();
    }

    public function testConsultarPorId()
    {
        $dao = FabricaDao::obtenerDaoTipoDespacho($this->TipoDespacho);
        $dao->consultarPorId();
    }

    public function testConsultarXParametro()
    {
        $dao = FabricaDao::obtenerDaoTipoDespacho($this->TipoDespacho);
        $dao->consultarXParametro();
    }

    public function testConsultarXParametros()
    {
        $dao = FabricaDao::obtenerDaoTipoDespacho($this->TipoDespacho);
        $dao->consultarXParametros();
    }

    public function testConsultarTodos()
    {
        $dao = FabricaDao::obtenerDaoTipoDespacho($this->TipoDespacho);
        $dao->consultarTodos();
    }

    public function testEliminar()
    {
        $dao = FabricaDao::obtenerDaoTipoDespacho($this->TipoDespacho);
        $dao->eliminar();
    }
}
