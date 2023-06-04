<?php
    require_once("conexion.php");

    class SectionsModel {
        const table = 'sections';

        public static function get($condicion) {
            $conexion = Conectar::conectate();
            $table = self::table;

            $sentencia = $conexion->prepare("SELECT * FROM ".$table." where ".$condicion);
            $sentencia->execute();
            if($sentencia->rowCount()>1):
                return $sentencia->fetchAll();
            else:
                return $sentencia->fetch();
            endif;

            $sentencia = null;
        }

        public static function all(){
            $conexion = Conectar::conectate();
            $table = self::table;

            $sentencia = $conexion->prepare("SELECT * FROM ".$table);
            $sentencia->execute();
            return $sentencia->fetchAll();
        }

        public static function insert($datos) {
            $conexion = Conectar::conectate();
            $table = self::table;

            $consulta = "insert into ".$table." (name, file) values (?,?)";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"],$datos["file"])))
            {return true;}
            else
            {return false;}
        }

        public static function update($datos, $id) {
            $conexion = Conectar::conectate();
            $table = self::table;

            $consulta = "UPDATE ".$table." SET name = ?, file = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"],$datos["file"],$id)))
            {return true;}
            else{return false;}
        }

        public static function delete($condition){
            $conexion = Conectar::conectate();
            $table = self::table;

            $consulta = "DELETE FROM ".$table." WHERE ".$condition;
            echo "<script>console.log('".$consulta."')</script>";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute())
            {return true;}
            else{return false;}
        }
    }