<?php

class Database
{
    public static function connect()
    {
        $db = new mysqli('localhost', 'mm17096', 'rootmm17096', 'quevaquerer');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
