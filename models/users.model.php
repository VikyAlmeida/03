<?php
    require_once("conexion.php");

    class UserModel {
        public static function all($tabla){
            $conexion = Conectar::conectate();
            
            $sentencia = $conexion->prepare("SELECT * FROM $tabla");
            $sentencia->execute();
            if($sentencia->rowCount()>1):
                return $sentencia->fetchAll();
            else:
                return $sentencia->fetch();
            endif;

            $sentencia = null;
        }
        
        public static function where($tabla,$condicion){
            $conexion = Conectar::conectate();
            
            $sentencia = $conexion->prepare("SELECT * FROM $tabla where ".$condicion);
            $sentencia->execute();
            if($sentencia->rowCount()>1):
                return $sentencia->fetchAll();
            else:
                return $sentencia->fetch();
            endif;

            $sentencia = null;
        }
        
        public static function insert($tabla,$datos){
            $conexion = Conectar::conectate();
            
            $consulta = "Insert into $tabla (role_id,name,dni,email,password,username,photo)values(?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["role_id"],$datos["nombre"],$datos["dni"],$datos["email"],$datos["password"],$datos["username"],$datos["photo"])))
            {return true;}
            else
            {return false;}
        }
        
        public static function update($datos,$id){
            $conexion = Conectar::conectate();

            $tabla = "users";	
            $consulta = "UPDATE $tabla SET forgot_password = ?, name = ?, dni = ?, email = ?, password = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["code"], $datos["name"],$datos["dni"],$datos["email"],$datos["pass"],$id)))
            {return true;}
            else{return false;}
        }
        
        public static function getUsers($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            if($result->rowCount()>1):
                return $result->fetchAll();
            else:
                return $result->fetch();
            endif;
        }

    }