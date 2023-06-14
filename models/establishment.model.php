<?php
    require_once("conexion.php");

    class EstablishmentModel {
        const table = 'establishments';

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
            if($resultado->execute(array($datos["name"],$datos["description"],$datos["aboutUs"],$datos["category"],$datos["owner"],$datos["logo"],$datos["tlf"],$datos["email"],$datos["url"],$datos["slug"])))
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

            try
            {
                $consulta = "DELETE FROM ".$table." WHERE ". $condition;
                if($conexion->query($consulta))
                {return true;}
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
        }

        public static function getEstablishment($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            if($result->rowCount()>1):
                return $result->fetchAll();
            else:
                return $result->fetch();
            endif;
        }
    }