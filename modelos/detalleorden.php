<?php

class Detalleorden
{
    private $orden;
    private $producto;
    private $precio;
    private $cantidad;

    /**
     * Get $orden
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Get $producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Get $precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Get $cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    }

    /**
     * Set $producto
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    /**
     * Set $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * Set $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function guardar()
    {
        $Db = Database::connect();
        $save = $Db->query("INSERT INTO `detalleorden`(`orden`, `producto`, `precio`, `cantidad`)  VALUES('{$this->getOrden()}', '{$this->getProducto()}', '{$this->getPrecio()}', '{$this->getCantidad()}')");
        $resultado = false;
        if ($save) {
            $resultado = true;
        }
        return $resultado;
    }

    public function getOne()
    {
        $resultado = false;
        $Db = Database::connect();
        $detalle = $Db->query("SELECT pro.imagen, pro.nombre, pro.precio, det.cantidad FROM detalleorden as det, orden as ord, producto as pro, cliente as cli 
        WHERE det.orden = ord.idorden AND det.producto = pro.idproducto AND ord.cliente = cli.idcliente AND ord.idorden = '{$this->getOrden()}'");

        if ($detalle) {
            $resultado = $detalle;
        }
        return $resultado;
    }
}
