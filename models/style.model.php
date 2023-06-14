<?php
    require_once("conexion.php");

    class StyleModel {
        const table1 = 'data';
        const table2 = 'style_home';
        const table3 = 'style_establishment';
        public static function lastId($table){
            $conexion = Conectar::conectate();
            try
            {
                $result = $conexion->query('SELECT * FROM '.$table.' order by id desc limit 1');
                return $result->fetch();
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}

        }
        public static function addData($datum){
            $conexion = Conectar::conectate();
            $table = self::table1;
            try
            {
                $consulta = "insert into ".$table." (datum) values (?)";
                $resultado = $conexion->prepare($consulta);
                if($resultado->execute(array($datum))){
                    return self::lastId('data');
                }
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
        }
        public static function addStyleHome($datum, $section){
            $conexion = Conectar::conectate();
            $table = self::table2;

            try
            {
                $consulta = "insert into ".$table." (sections_home,data) values (?,?)";
                $resultado = $conexion->prepare($consulta);
                if($resultado->execute(array($section, $datum))){
                    return true;
                }
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
        }
        public static function delete($sections_home){
            $conexion = Conectar::conectate();
            $table = self::table2;

            try
            {
                $consulta = "DELETE FROM ".$table." WHERE sections_home = ".$sections_home;
                $resultado = $conexion->prepare($consulta);
                if($resultado->execute())
                {return true;}
                else{return false;}
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
        }
        public static function getDataBySection($section){
            $conexion = Conectar::conectate();
            $table = self::table2;
            try
            {
                $result = $conexion->query('SELECT * FROM '.$table.' where sections_home = '.$section);
                return $result->fetch();
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}

        }
        public static function getDataById($id){
            $conexion = Conectar::conectate();
            $table = self::table1;
            try
            {
                $result = $conexion->query('SELECT * FROM '.$table.' where id = '.$id);
                return $result->fetch();
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}

        }
        public static function addStyle($datos){
            $conexion = Conectar::conectate();
            $table = self::table3;

            try
            {
                $consulta = "insert into ".$table." (establishments_id,	data_id, sections_id) values (?,?,?)";
                $resultado = $conexion->prepare($consulta);
                if($resultado->execute(array($datos['id_establishment'],$datos['id_data'],$datos['section_id']))){
                    return true;
                }
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
        }
        public static function getData($query){            
            $conexion = Conectar::conectate();

            try{
                $result = $conexion->query($query);
                return $result->fetchAll();
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
        }
        public static function deleteData($id){
            $conexion = Conectar::conectate();
            $table = self::table1;

            try
            {
                $consulta = "DELETE FROM ".$table." WHERE id = ".$id;
                $resultado = $conexion->prepare($consulta);
                if($resultado->execute())
                {return true;}
                else{return false;}
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
        }
        public static function deleteStyle($id){
            
            $conexion = Conectar::conectate();
            $table = self::table3;

            try
            {
                $consulta = "DELETE FROM ".$table." WHERE data_id = ".$id;
                $resultado = $conexion->prepare($consulta);
                if($resultado->execute())
                {return true;}
                else{return false;}
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
        }
    }