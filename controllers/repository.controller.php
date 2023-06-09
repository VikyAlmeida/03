<?php
class Generales{
    public static function sanar_datos($campo,$tipo,&$errores,$nombre)
    {
        if(isset($campo) && !empty($campo))
        {
            switch($tipo)
            {
                case "string":
                    $campo = filter_var(stripslashes($campo),FILTER_SANITIZE_STRING);
                    return $campo;
                break;
                case "email":
                    $campo = filter_var($campo,FILTER_SANITIZE_EMAIL);
                    if(filter_var($campo,FILTER_VALIDATE_EMAIL))
                    {return $campo;}
                    else{$errores.="email invalido";}
                break;
                case "dni":
                    $letter = substr($campo, -1);
                    $numbers = (int) substr($campo, 0, -1);
                    if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23, 1) == $letter && strlen($letter) == 1 && strlen ($numbers) == 8 ){
                        return $campo;
                    }
                    else {
                        $errores[$nombre]="El dni no es correcto<br>";
                    }
                break;
                case "pass":
                    $campo = filter_var(stripslashes($campo),FILTER_SANITIZE_STRING);
                    $campo = password_hash($campo, PASSWORD_DEFAULT);
                    return $campo;
                break;
                case "int":
                    $campo = (int)$campo;
                    $campo = floor($campo);
                    if($campo == ""){$campo = 0;}
                    return $campo;
                break;
                case "foto":
                    $rand = rand();
                    if(!empty($_FILES["foto"]))
                    {
                        if($_FILES["foto"]["size"]>0)
                        {
                            $comprueba = @getimagesize($_FILES["foto"]["tmp_name"]);
                            if($comprueba != false){
                                $ruta = "views/img/inmuebles_images/".$rand."".$_FILES["foto"]["name"];
                                move_uploaded_file($_FILES["foto"]["tmp_name"],$ruta);
                                $campo = $_FILES["foto"]["name"];
                                $campo = $rand."".$campo;
                                return $campo;
                            }
                            else{$error = "El archivo no es una imagen";}
                        }
                        else{$campo = "default.jpg";return $campo;}
                        
                    }else{$campo = "default.jpg";return $campo;}
                    
                break;
            }
        }
        else{$errores[$nombre]="Campo ".$nombre." vacio<br>";}
    }
    public static function encriptar($campo){
        $campo = password_hash($campo, PASSWORD_DEFAULT);
        return $campo;
    }
    public static function foto($campo, $rutaFolder, &$error){
        $rand = rand();
        if(!empty($campo))
        {
            if($campo["size"]>0)
            {
                $comprueba = @getimagesize($campo["tmp_name"]);
                if($comprueba != false){
                    $ruta = $rutaFolder."".$rand."".$campo["name"];
                    move_uploaded_file($campo["tmp_name"],$ruta);
                    return $ruta;
                }
                else{$error["img"] = "El archivo no es una imagen";}
            }
            else{$campo = "./views/style1/img/users/default.png";return $campo;}
            
        }else{$campo = "./views/style1/img/users/default.png";return $campo;}       
    }
    public static function file($campo, $rutaFolder){
        $rand = rand();
        if(!empty($campo))
        {
            if($campo["type"] == 'application/octet-stream')
            {
                var_dump($campo);
                $ruta = $rutaFolder."".$campo["name"];
                move_uploaded_file($campo["tmp_name"],$ruta);
                return  $campo["name"];
            }
            else{$campo = "default.jpg";return $campo;}
            
        }else{$campo = "default.jpg";return $campo;}       
    }
    public static function formato_fecha($fecha){
        $fecha = explode("-",$fecha);  
        $cadena = $fecha[2]."-".$fecha[1]."-".$fecha[0]; 
        return $cadena; 
    }
}