<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 08:11 PM
 */

require_once '../Fabrica/FabricaDao.php';
require_once '../Entidad/TipoSolucion.php';
require_once 'TestBase.php';
class DaoTipoSolucionTest extends PHPUnit_Framework_TestCase implements TestBase {

var $TipoSolucion;
    
    public function setUp(){
        $TipoS = new TipoSolucion();
        $TipoS->setNombre("TipoSolucion#");
        $this->TipoSolucion = $TipoS;
    }

    public function testAgregar()
    {
        $dao = FabricaDao::obtenerDaoTipoSolucion($this->TipoSolucion);
        $valor= $dao->agregar();
        $this->assertTrue($valor->getId() != 0);
        $this->TipoSolucion->setId($valor->getId());

    }

    public function testModificar()
    {
        $TipoSolucionw = new TipoSolucion();
        $TipoSolucionw->setId(1);
        $TipoSolucionw->setNombre("Modificado");
        $dao = FabricaDao::obtenerDaoTipoSolucion($TipoSolucionw);
        $valor= $dao->modificar();
        $this->assertTrue($valor->getId() != 0);
        $this->assertEquals($TipoSolucionw, $valor);
    }

    public function testConsultarPorId()
    {
        $TipoSolucionw = new TipoSolucion();
        $TipoSolucionw->setId(1);
        $dao = FabricaDao::obtenerDaoTipoSolucion($TipoSolucionw);
        $valor= $dao->consultarPorId();

        $this->assertNotNull($valor);
    }

    public function testConsultarXParametro()
    {
        $dao = FabricaDao::obtenerDaoTipoSolucion($this->TipoSolucion);
        $dao->consultarXParametro();
    }

    public function testConsultarXParametros()
    {
        $dao = FabricaDao::obtenerDaoTipoSolucion($this->TipoSolucion);
        $dao->consultarXParametros();
    }

    public function testConsultarTodos()
    {
        $dao = FabricaDao::obtenerDaoTipoSolucion($this->TipoSolucion);
        $dao->consultarTodos();
    }

    public function testEliminar()
    {
        $dao = FabricaDao::obtenerDaoTipoSolucion($this->TipoSolucion);
        $dao->eliminar();
    }

}
