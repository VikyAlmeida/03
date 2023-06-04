<?php
    require_once("conexion.php");

    class RolModel {
        const table = 'roles';

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
            if($sentencia->rowCount()>1):
                return $sentencia->fetchAll();
            else:
                return $sentencia->fetch();
            endif;

            $sentencia = null;
        }

        public static function insert($datos) {
            $conexion = Conectar::conectate();
            $table = self::table;

            $consulta = "insert into ".$table." (name, description, AboutUs, category_id, owner, logo, tlf, email, web_site, slug) values (?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"],$datos["description"],$datos["AboutUs"],$datos["category_id"],$datos["owner"],$datos["logo"],$datos["tlf"],$datos["email"],$datos["web_site"],$datos["slug"])))
            {return true;}
            else
            {return false;}
        }

        public static function update($datos, $id) {
            $conexion = Conectar::conectate();
            $table = self::table;

            $consulta = "UPDATE ".$table." SET name = ?, description = ?, AboutUs = ?, logo = ?, tlf = ?, email = ?, web_site = ?, slug = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"],$datos["description"],$datos["AboutUs"],$datos["logo"],$datos["tlf"],$datos["email"],$datos["web_site"],$datos["slug"],$id)))
            {return true;}
            else{return false;}
        }

        public static function delete($condition){
            $conexion = Conectar::conectate();
            $table = self::table;

            $consulta = "DELETE FROM ".$table." WHERE ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($condition)))
            {return true;}
            else{return false;}
        }
    }