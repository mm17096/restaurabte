<?php

class Orden
{
    private $idorden;
    private $cliente;
    private $fecha;
    private $latitud;
    private $longitud;
    private $costototal;
    private $estado;
    private $tipopago;
    private $correopaypal;

    /**
     * Get $idorden
     */
    public function getIdorden()
    {
        return $this->idorden;
    }

    /**
     * Get $cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Get $fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Get $latitud
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Get $longitud
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Get $costototal
     */
    public function getCostototal()
    {
        return $this->costototal;
    }

    /**
     * Get $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Get $tipopago
     */
    public function getTipopago()
    {
        return $this->tipopago;
    }

    /**
     * Get $correopaypal
     */
    public function getCorreopaypal()
    {
        return $this->correopaypal;
    }

    /**
     * Set $idorden
     */
    public function setIdorden($idorden)
    {
        $this->idorden = $idorden;
    }

    /**
     * Set $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Set $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Set $latitud
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }

    /**
     * Set $longitud
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }

    /**
     * Set $costototal
     */
    public function setCostototal($costototal)
    {
        $this->costototal = $costototal;
    }

    /**
     * Set $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Set $tipopago
     */
    public function setTipopago($tipopago)
    {
        $this->tipopago = $tipopago;
    }

    /**
     * Set $correopaypal
     */
    public function setCorreopaypal($correopaypal)
    {
        $this->correopaypal = $correopaypal;
    }

    public function getAllempresa()
    {
        $resultado = false;
        $Db = Database::connect();
        $orden = $Db->query("SELECT idorden, cliente,latitud, longitud,DATE_FORMAT(fecha,'%d/%m/%Y') as 'fecha',hora,costototal,estado,tipodepago,costototal,correopaypal FROM `orden` WHERE DATE_FORMAT(fecha,'%d/%m/%Y') = '{$this->getFecha()}' ORDER BY idorden DESC");

        if ($orden) {
            $resultado = $orden;
        }
        return $resultado;
    }

    public function getAll()
    {
        $resultado = false;
        $Db = Database::connect();
        $orden = $Db->query("SELECT idorden, cliente,latitud, longitud,DATE_FORMAT(fecha,'%d/%m/%Y') as 'fecha',hora,costototal,estado,tipodepago,costototal,correopaypal  FROM `orden` WHERE estado = '{$this->getEstado()}' ORDER BY idorden ASC");

        if ($orden) {
            $resultado = $orden;
        }
        return $resultado;
    }

    public function getOne()
    {
        $resultado = false;
        $Db = Database::connect();
        $orden = $Db->query("SELECT idorden, cliente,latitud, longitud,DATE_FORMAT(fecha,'%d/%m/%Y') as 'fecha',hora,costototal,estado,tipodepago,costototal,correopaypal FROM `orden` WHERE idorden = {$this->getIdorden()}");

        if ($orden) {
            $resultado = $orden;
        }
        return $resultado->fetch_object();
    }

    public function guardar()
    {
        $Db = Database::connect();
        $save = $Db->query("INSERT INTO `orden`(`cliente`, `latitud`, `longitud`, `fecha`, `hora`,`costototal`, `estado`, `tipodepago`, `correopaypal`) VALUES('{$this->getCliente()}', '{$this->getLatitud()}', '{$this->getLongitud()}',CURRENT_DATE(), CURRENT_TIME(),'{$this->getCostototal()}', 'Pendiente', '{$this->getTipopago()}', '{$this->getCorreopaypal()}')");
        $resultado = false;
        $idorden = $Db->insert_id;
        if ($idorden != 0) {
            $resultado = $idorden;
        }
        return $resultado;
    }

    public function delete()
    {
        $Db = Database::connect();
        $update = $Db->query("DELETE FROM `orden` WHERE idorden = '{$this->getIdorden()}'");
        $resultado = false;
        if ($update) {
            $resultado = true;
        }
        return $resultado;
    }

    public function updatecorreopay()
    {
        $Db = Database::connect();
        $update = $Db->query("UPDATE `orden` SET `correopaypal`='{$this->getCorreopaypal()}' WHERE idorden = '{$this->getIdorden()}'");
        $resultado = false;
        if ($update) {
            $resultado = true;
        }
        return $resultado;
    }

    public function updateestado()
    {
        $resultado = false;
        $Db = Database::connect();
        $update = $Db->query("UPDATE `orden` SET `estado`='Entregado' WHERE idorden = '{$this->getIdorden()}'");
        $idusuario = $Db->affected_rows;
        if ($idusuario != 0) {
            $resultado = true;
        }
        return $resultado;
    }

    public function getAllme()
    {
        $resultado = false;
        $Db = Database::connect();
        $orden = $Db->query("SELECT idorden, cliente,latitud, longitud,DATE_FORMAT(fecha,'%d/%m/%Y') as 'fecha',hora,costototal,estado,tipodepago,costototal,correopaypal  FROM `orden` WHERE cliente = '{$this->getCliente()}' ORDER BY idorden DESC");

        if ($orden) {
            $resultado = $orden;
        }
        return $resultado;
    }
}
