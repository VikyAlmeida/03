<?php
    require_once("conexion.php");

    class CategoriesModel {
        const table = 'categories';

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
        
        public static function last () {
            $conexion = Conectar::conectate();
            $table = self::table;

            $sentencia = $conexion->prepare("SELECT * FROM ".$table." order by id desc limit 1");
            $sentencia->execute();
            return $sentencia->fetch();
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

            $consulta = "insert into ".$table." (name, description, photo) values (?,?,?)";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"],$datos["description"],$datos["photo"])))
            {return true;}
            else
            {return false;}
        }

        public static function update($datos, $id) {
            $conexion = Conectar::conectate();
            $table = self::table;

            $consulta = "UPDATE ".$table." SET name = ?, description = ?, photo = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"],$datos["description"],$datos["photo"],$id)))
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
        public static function getCategory($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            if($result->rowCount()>1):
                return $result->fetchAll();
            else:
                return $result->fetch();
            endif;
        }
    }