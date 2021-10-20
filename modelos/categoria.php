<?php

class Categoria
{
    private $idcategoria;
    private $nombre;


    function getIdcategoria()
    {
        return $this->idcategoria;
    }

    function getNombre()
    {
        return $this->nombre;
    }


    function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


    public function getAll()
    {
        $Db = Database::connect();
        $categorias = $Db->query("SELECT * FROM `categoria` ORDER BY idcategoria DESC");
        return $categorias;
    }

    public function getOne()
    {
        $Db = Database::connect();
        $categoria = $Db->query("SELECT * FROM `categoria` WHERE idcategoria = {$this->getIdcategoria()}");

        return $categoria->fetch_object();
    }

    public function save()
    {
        $Db = Database::connect();
        $save = $Db->query("INSERT INTO `categoria`(`nombre`) VALUES('{$this->getNombre()}')");
        $resultado = false;

        if ($save) {
            $resultado = true;
        }

        return $resultado;
    }

    public function delete()
    {

        $Db = Database::connect();
        $delete = $Db->query("DELETE FROM categoria WHERE idcategoria = {$this->getIdcategoria()}");

        $resultado = false;
        if ($delete) {
            $resultado = true;
        }

        return $resultado;
    }

    public function update()
    {

        $Db = Database::connect();
        $update = $Db->query("UPDATE categoria SET nombre ='{$this->getNombre()}' WHERE idcategoria = {$this->getIdcategoria()}");

        $resultado = false;
        if ($update) {
            $resultado = true;
        }
        return $resultado;
    }
}
