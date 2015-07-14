<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 08:11 PM
 */

require_once '../Fabrica/FabricaDao.php';
require_once '../Entidad/TipoRevision.php';
require_once 'TestBase.php';
class DaoTipoRevisionTest extends PHPUnit_Framework_TestCase implements TestBase {


    var $TipoRevision;

    public function setUp(){
        $TipoR = new TipoRevision();
        $TipoR->setNombre("TipoRevision#");
        $this->TipoRevision = $TipoR;
    }


    public function testAgregar()
    {
        $dao = FabricaDao::obtenerDaoTipoRevision($this->TipoRevision);
        $dao->agregar();
    }

    public function testModificar()
    {
        $dao = FabricaDao::obtenerDaoTipoRevision($this->TipoRevision);
        $dao->modificar();
    }

    public function testConsultarPorId()
    {
        $dao = FabricaDao::obtenerDaoTipoRevision($this->TipoRevision);
        $dao->consultarPorId();
    }

    public function testConsultarXParametro()
    {
        $dao = FabricaDao::obtenerDaoTipoRevision($this->TipoRevision);
        $dao->consultarXParametro();
    }

    public function testConsultarXParametros()
    {
        $dao = FabricaDao::obtenerDaoTipoRevision($this->TipoRevision);
        $dao->consultarXParametros();
    }

    public function testConsultarTodos()
    {
        $dao = FabricaDao::obtenerDaoTipoRevision($this->TipoRevision);
        $dao->consultarTodos();
    }

    public function testEliminar()
    {
        $dao = FabricaDao::obtenerDaoTipoRevision($this->TipoRevision);
        $dao->eliminar();
    }
}
