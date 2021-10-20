<?php

class Producto
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $disponible;
    private $imagen;


    function getId()
    {
        return $this->id;
    }

    function getCategoria_id()
    {
        return $this->categoria_id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getDisponible()
    {
        return $this->disponible;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio)
    {
        $this->precio = $precio;
    }


    function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getAll()
    {
        $Db = Database::connect();
        $productos = $Db->query("SELECT * FROM producto ORDER BY idproducto DESC");

        return $productos;
    }

    public function getAllCategory()
    {
        $Db = Database::connect();
        $productos = $Db->query("SELECT pro.idproducto, pro.imagen as imagen, pro.nombre as nombre,(SELECT COUNT(ord.idorden) as ordenes FROM orden as ord, detalleorden as det 
        WHERE det.orden = ord.idorden AND ord.estado = 'Pendiente' AND det.producto = pro.idproducto) as cantidadorden,
        (SELECT SUM(det.cantidad) as cantidad FROM orden as ord, detalleorden as det 
        WHERE det.orden = ord.idorden AND ord.estado = 'Pendiente' AND det.producto = pro.idproducto) as cantidadpro, pro.precio
        FROM producto as pro WHERE pro.disponible = 'SI' AND pro.categoria = {$this->getCategoria_id()}");
        return $productos;
    }

    public function getRandom()
    {
        $Db = Database::connect();
        $productos = $Db->query("SELECT pro.idproducto, pro.imagen as imagen, pro.nombre as nombre,(SELECT COUNT(ord.idorden) as ordenes FROM orden as ord, detalleorden as det 
        WHERE det.orden = ord.idorden AND ord.estado = 'Pendiente' AND det.producto = pro.idproducto) as cantidadorden,
        (SELECT SUM(det.cantidad) as cantidad FROM orden as ord, detalleorden as det 
        WHERE det.orden = ord.idorden AND ord.estado = 'Pendiente' AND det.producto = pro.idproducto) as cantidadpro, pro.precio
        FROM producto as pro WHERE pro.disponible = 'SI'");

        return $productos;
    }

    public function getOne()
    {
        $Db = Database::connect();
        $producto = $Db->query("SELECT * FROM producto WHERE idproducto = {$this->getId()}");

        return $producto->fetch_object();
    }

    public function save()
    {
        $Db = Database::connect();
        $save = $Db->query("INSERT INTO `producto`(`nombre`, `imagen`, `disponible`, `precio`, `descripcion`, `categoria`)
         VALUES('{$this->getNombre()}', '{$this->getImagen()}', '{$this->getDisponible()}', '{$this->getPrecio()}', '{$this->getDescripcion()}', '{$this->getCategoria_id()}')");

        $resultado = false;
        if ($save) {
            $resultado = true;
        }

        return $resultado;
    }

    public function delete()
    {

        $Db = Database::connect();
        $delete = $Db->query("DELETE FROM producto WHERE idproducto ={$this->id}");

        $resultado = false;
        if ($delete) {
            $resultado = true;
        }

        return $resultado;
    }

    public function update()
    {

        $Db = Database::connect();
        if ($this->getImagen() == '') {
            $save = $Db->query("UPDATE `producto` SET `nombre`='{$this->getNombre()}',`disponible`='{$this->getDisponible()}', `precio`='{$this->getPrecio()}', `descripcion`='{$this->getDescripcion()}', `categoria`='{$this->getCategoria_id()}' WHERE idproducto={$this->id}");
        } else {
            $save = $Db->query("UPDATE `producto` SET `nombre`='{$this->getNombre()}',`imagen`='{$this->getImagen()}',`disponible`='{$this->getDisponible()}', `precio`='{$this->getPrecio()}', `descripcion`='{$this->getDescripcion()}', `categoria`='{$this->getCategoria_id()}' WHERE idproducto={$this->id}");
        }
        $resultado = false;
        if ($save) {
            $resultado = true;
        }

        return $resultado;
    }
}
