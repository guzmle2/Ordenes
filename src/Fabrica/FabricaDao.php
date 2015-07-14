<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:16 PM
 */


require_once '../Entidad/Miembro.php';
require_once '../Dao/DaoMiembro.php';

require_once '../Entidad/Requerimiento.php';
require_once '../Dao/DaoRequerimiento.php';

require_once '../Entidad/TipoDespacho.php';
require_once '../Dao/DaoTipoDespacho.php';

require_once '../Entidad/TipoRevision.php';
require_once '../Dao/DaoTipoRevision.php';

require_once '../Entidad/TipoSolucion.php';
require_once '../Dao/DaoTipoSolucion.php';

class FabricaDao {

    public static function obtenerDaoMiembro(Miembro $Miembro){
        return new DaoMiembro($Miembro);
    }

    public static function obtenerDaoRequerimiento(Requerimiento $requerimiento){
        return new DaoRequerimiento($requerimiento);
    }

    public static function obtenerDaoTipoDespacho(TipoDespacho $tipoDespacho){
        return new DaoTipoDespacho($tipoDespacho);
    }

    public static function obtenerDaoTipoRevision(TipoRevision $tipoRevision){
        return new DaoTipoRevision($tipoRevision);
    }

    public static function obtenerDaoTipoSolucion(TipoSolucion $tipoSolucion){
        return new DaoTipoSolucion($tipoSolucion);
    }

}