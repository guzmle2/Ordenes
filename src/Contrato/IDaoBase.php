<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:14 PM
 */

interface IDaoBase {

    public function agregar();

    public function modificar();

    public function consultarPorId();

    public function consultarXParametro();

    public function consultarXParametros();

    public function consultarTodos();

    public function eliminar();

}