<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 08:11 PM
 */

require_once '../Fabrica/FabricaDao.php';
require_once '../Entidad/Miembro.php';
require_once 'TestBase.php';
class DaoMiembroTest extends PHPUnit_Framework_TestCase implements TestBase {

    var $Miembr;
    var $Dao;

    public function setUp(){
        $Miembro = new Miembro();
        $Miembro->setNombre("Nombre");
        $Miembro->setApellido("Apellido");
        $Miembro->setCedula("19720104");
        $Miembro->setCorreo("ronoel54@gmail.com");
        $Miembro->setTipo("admin");
        $Miembro->setClave("1234");
        $this->Miembr = $Miembro;
        $this->Dao = FabricaDao::obtenerDaoMiembro($this->Miembr);
    }

    public function testAgregar()
    {
        $usuario = $this->Dao->agregar();
        $this->Miembr->setId($usuario->getId());
        $this->assertTrue($usuario->getId() != 0);
        $this->testEliminar();
    }

    public function testModificar()
    {
        $this->Miembr->setNombre("NombreModificado");
        $usuarioModificado = $this->Dao->modificar();
        $this->assertEquals($usuarioModificado,$this->Miembr );
        $this->testEliminar();
    }

    public function testConsultarPorId()
    {
        $usuario = $this->Dao->agregar();
        $this->Miembr->setId($usuario->getId());
        $Miembro = $this->Dao->consultarPorId();
        $this->assertNotNull($Miembro );
        $this->testEliminar();
    }

    public function testConsultarXParametro()
    {
        $usuario = $this->Dao->agregar();
        $this->Miembr->setId($usuario->getId());
        $Miembro = new Miembro();
        $Miembro->setTipo($this->Miembr->getTipo());
        $Miembro = $this->Dao->consultarXParametro();
        $this->assertNotNull($Miembro );
        $this->testEliminar();
    }

    public function testConsultarXParametros()
    {
        $usuario = $this->Dao->agregar();
        $this->Miembr->setId($usuario->getId());
        $Miembro = new Miembro();
        $Miembro->setTipo($this->Miembr->getTipo());
        $Miembro = $this->Dao->consultarXParametros();
        $this->assertNotNull($Miembro );
        $this->testEliminar();
    }

    public function testConsultarTodos()
    {
        $usuario = $this->Dao->agregar();
        $this->Miembr->setId($usuario->getId());
        $Miembro = new Miembro();
        $Miembro = $this->Dao->consultarTodos();
        $this->assertNotNull($Miembro );
        $this->testEliminar();

    }

    public function testEliminar()
    {
        $Miembro = $this->Dao->eliminar();
        $this->assertTrue($Miembro );
    }
}
