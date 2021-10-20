<?php

class Empresa
{
    private $id;
    private $estado;
    private $fehca;
    private $timehab;
    private $timeinha;
    private $pedidos;
    private $saldo;

    /**
     * Get $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Get $fehca
     */
    public function getFehca()
    {
        return $this->fehca;
    }

    /**
     * Get $timehab
     */
    public function getTimehab()
    {
        return $this->timehab;
    }

    /**
     * Get $timeinha
     */
    public function getTimeinha()
    {
        return $this->timeinha;
    }

    /**
     * Get $pedidos
     */
    public function getPedidos()
    {
        return $this->pedidos;
    }

    /**
     * Get $saldo
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Set $fehca
     */
    public function setFehca($fehca)
    {
        $this->fehca = $fehca;
    }

    /**
     * Set $timehab
     */
    public function setTimehab($timehab)
    {
        $this->timehab = $timehab;
    }

    /**
     * Set $timeinha
     */
    public function setTimeinha($timeinha)
    {
        $this->timeinha = $timeinha;
    }

    /**
     * Set $pedidos
     */
    public function setPedidos($pedidos)
    {
        $this->pedidos = $pedidos;
    }

    /**
     * Set $saldo
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    public function nuevodia()
    {
        $Db = Database::connect();
        $save =  $Db->query("INSERT INTO `empresa`(`estado`,`fecha`, `time_habilitar`,`time_inhabilitar`,`pedidos`, `saldo`) 
        VALUES ('Activo',CURRENT_DATE(),'06:30:00','17:00:00',0,0)");

        $resultado = false;
        if ($save) {
            $resultado = true;
        }
        return $resultado;
    }

    public function terminaranterior()
    {
        $Db = Database::connect();
        $save =  $Db->query("UPDATE empresa set estado='Terminado' 
        WHERE fecha<=(SELECT CONCAT(EXTRACT(YEAR FROM CURRENT_DATE()),'-',EXTRACT(MONTH FROM CURRENT_DATE()),'-',EXTRACT(DAY FROM CURRENT_DATE())-1))");

        $resultado = false;
        if ($save) {
            $resultado = true;
        }
        return $resultado;
    }

    public function getAll()
    {
        $resultado = false;
        $Db = Database::connect();
        $orden = $Db->query("SELECT id_laboral, estado,  DATE_FORMAT(fecha,'%d/%m/%Y')as 'fecha', pedidos, saldo FROM `empresa` ORDER BY id_laboral DESC");

        if ($orden) {
            $resultado = $orden;
        }
        return $resultado;
    }

    public function getOne()
    {
        $resultado = false;
        $Db = Database::connect();
        $orden = $Db->query("SELECT id_laboral, estado,DATE_FORMAT(fecha,'%d/%m/%Y')as 'fecha', pedidos, saldo FROM `empresa` WHERE id_laboral = {$this->getId()}");

        if ($orden) {
            $resultado = $orden;
        }
        return $resultado->fetch_object();
    }

    public function verificar()
    {
        $resultado = false;
        $Db = Database::connect();
        $orden = $Db->query("SELECT * FROM `empresa` WHERE fecha = CURRENT_DATE()");

        if ($orden) {
            $resultado = $orden->fetch_object();
        }
        return $resultado;
    }

    public function actualizar()
    {
        $resultado = false;
        $Db = Database::connect();
        $orden = $Db->query("UPDATE `empresa` SET `pedidos`=(SELECT COUNT(idorden) FROM orden WHERE fecha = CURRENT_DATE() GROUP BY fecha),
        `saldo`=(SELECT SUM(costototal) FROM orden WHERE fecha = CURRENT_DATE() GROUP BY fecha)
        WHERE fecha = CURRENT_DATE()");

        if ($orden) {
            $resultado = $orden;
        }
        return $resultado;
    }

    public function cerrar()
    {
        $Db = Database::connect();
        $save =  $Db->query("UPDATE empresa set estado='Cerrado' WHERE id_laboral='{$this->getId()}'");

        $resultado = false;
        if ($save) {
            $resultado = true;
        }
        return $resultado;
    }

    public function activar()
    {
        $Db = Database::connect();
        $save =  $Db->query("UPDATE empresa set estado='Activo' WHERE id_laboral='{$this->getId()}'");

        $resultado = false;
        if ($save) {
            $resultado = true;
        }
        return $resultado;
    }
}
