<?php
class Conectar
{
    public static function conectate()
    {
        try
        {
            $bd = "inaya3";
            $conexion = new PDO("mysql:host=localhost;dbname=$bd","root","");
            $conexion->exec("set names utf8");
            return $conexion;
        }
        catch(PDOexception $e){echo $e->getMessage();}
    }
    public static function conectate2()
    {
        try
        {
            $bd = "inaya2";
            $conexion = new PDO("mysql:host=localhost;dbname=$bd","root","");
            $conexion->exec("set names utf8");
            return $conexion;
        }
        catch(PDOexception $e){echo $e->getMessage();}
    }
    public static function conectate3()
    {
        try
        {
            $bd = "inaya";
            $conexion = new PDO("mysql:host=localhost;dbname=$bd","root","");
            $conexion->exec("set names utf8");
            return $conexion;
        }
        catch(PDOexception $e){echo $e->getMessage();}
    }
}