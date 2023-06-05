<?php
class ControllerUsers{
    public function ctrRegister(&$errors) {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $condicion = "email like '".$_POST["email"]."' or dni like '".$_POST["dni"]."'";
            $registros = UserModel::where("users",$condicion);

            $condicion = "name like 'visitor'";
            $role_visitor = RolModel::get($condicion);
            
            if(!$registros):

                $nombre = Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
                $username = Generales::sanar_datos($_POST["username"],'string', $errores, 'usuario');
                $dni = Generales::sanar_datos($_POST["dni"],'dni', $errores, 'DNI');
                $email = Generales::sanar_datos($_POST["email"],'string', $errores, 'email');
                $password = Generales::sanar_datos($_POST["password"],'pass', $errores, 'password');
                $photo = Generales::foto($_FILES["photo"],"./views/style1/img/users/", $errores);
                $role_id = $role_visitor["id"];

                if ( $_POST["password"] !== $_POST["password_repeat"] ): 
                    $errores["notRepeat"] = "Las contraseñas no coinciden";
                endif;

                if ( $errores ): 
                    return $errores;
                endif;

                $datos = compact('nombre','email', 'password','dni', 'username', 'photo', 'role_id');
                
                if(UserModel::insert("users",$datos)):                    
                        echo "<script>
                                Swal.fire(
                                    'Register!',
                                    'Se te ha dado de alta en el sistema.',
                                    'success'
                                ).then( () => window.location='login');
                             </script>"; 
                else:            
                    echo "<script>
                            Swal.fire(
                                'Oops...!',
                                'Ha ocurrido un error al darte de alta en el sistema.',
                                'error'
                            );
                         </script>"; 
                endif;            
            else:            
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Ese usuario ya existe en nuestro sistema.',
                            'error'
                        );
                     </script>"; 
            endif;
        }
    }

    public function ctrLogin(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $query = "email like '".$_POST["email"]."'";
            $userBd = UserModel::where("users",$query);
            if ($userBd):
                if(password_verify($_POST["password"], $userBd['password'])):
                    $_SESSION["user"] = $userBd;
                    $_SESSION["logged_message"] = true;
                    if ($userBd):
                        if($userBd['role_id']==1 or $userBd['role_id']==2):
                            echo "<script>window.location='menu'</script>";
                        else:
                            echo "<script>window.location='home'</script>";
                        endif;
                    endif;
                else:
                    $errors["login"] = "La contraseña introducida no es correcta";
                    return $errors;
                endif;
            else:
                $errors["login"] = "No hay ningun usuario con esos datos";
                return $errors;
            endif;
        }
    }

    public function generateCode(){
        // funcion que generará un codigo:
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = Generales::sanar_datos($_POST["email"],'string', $errores, 'email'); 
            $subject = $_POST["subject"];
            $condicion = "email like '".$email."'";
            $registros = UserModel::where("users",$condicion);
            if ($errores):
                return $errores;
            endif;

            if ($registros):
                //generar codigo: numero de 9 digitos 
                $code = rand(100000000,999999999);
                $message = '
                    <div style="padding:2em; border: 1px solid aqua; width: 30%; margin: 0 auto;">
                        <h1 style="color: rgb(3, 3, 142);">INAYA</h1>
                        <h2>Hemos recibido un aviso de cambio de contraseña, su código es:</h2>
                        <h1 style="color: rgb(3, 3, 142);border: aqua; text-align: center;">'.$code.'</h1>
                        <h2>Si no es usted ignore este mensaje.</h2>
                    </div>';
                // el cual se enviara al email enviado por POST
                $classEmail = new SendEmail();
                $classEmail->sendEmail($registros, $subject, $message);
                // el cual se guardará hasheado en la base de datos
                $name = $registros["name"];
                $dni = $registros["dni"];
                $pass = $registros["password"];

                $datos = compact("email", "name", "dni", "pass", "code");
                if (UserModel::update($datos, $registros["id"])) :
                    echo "<script>
                            Swal.fire(
                                'Codigo enviado!',
                                'Comprueba tu email, se te ha enviado el codigo para cambiar tu contraseña.',
                                'success'
                            ).then( () => window.location='code');
                            </script>"; 
                endif;
            else:           
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Ese usuario no existe en nuestro sistema.',
                            'error'
                        );
                     </script>"; 
            endif;
        }
    }

    public function forgotPassword() {
        // funcion que verificará si el codigo introducido es el que esta en la bd
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $code = $_POST['code'];
            $condicion = "forgot_password like '".$code."'";
            $registro = UserModel::where("users",$condicion);

            if ($registro) :
                if ($_POST["password"] === $_POST["password2"]) :
                    $name = $registro["name"];
                    $dni = $registro["dni"];
                    $pass = Generales::sanar_datos($_POST["password"],'pass', $errores, 'password');;
                    $email = $registro["email"];
                    $code = null;

                    $datos = compact("email", "name", "dni", "pass", "code");
                    if (UserModel::update($datos, $registro["id"])) :
                        echo "<script>
                                Swal.fire(
                                    'Contraseña cambiada!',
                                    'Hemos verificado que eres tú y te hemos cambiado la contraseña.',
                                    'success'
                                ).then( () => window.location='login');
                                </script>"; 
                    endif;
                else:
                    // las contraseñas son distintas
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Las contraseñas son distintas.',
                            'error'
                        );
                       </script>"; 
                endif;
            else:
                // el codigo es incorrecto
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'El codigo es incorrecto.',
                            'error'
                        );
                        </script>";
            endif;
        }

        // Si es así se modificará la contraseña
    }   
    public function ctrGetUser($condition) {
        $users = UserModel::where("users", $condition);
        return $users;
    }
    public function ctrAllUser() {
        $user = UserModel::all("users");
        return $user;
    }
    public function getUsers($query){
        if ($query == null) $query = 'SELECT * FROM users';
        
        $registros = UserModel::getUsers($query);
        return $registros;
    }

}