<?php
class ControllerRol{
    public function ctrGetRol($condition) {
        $Rols = RolModel::get($condition);
        return $Rols;
    }
    public function ctrAllRol() {
        $Rol = RolModel::all();
        return $Rol;
    }
    public function ctrInsertRol(&$errores) {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){            
            $condicion = "name like '".$_POST["name"]."'";
            $Rol = RolModel::get($condicion);

            if (!$Rol):
                $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
                $description =  Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');
                $url =  Generales::sanar_datos($_POST["url"],'string', $errores, 'url');            
                $photo = Generales::foto($_FILES["photo"],"./views/style1/img/users/", $errores);
                
                $datos = compact('name','description', 'photo','url');
                
                if(RolModel::insert($datos)):                  
                    echo "<script>
                            Swal.fire(
                                'Insertada!',
                                'Se ha registrado el establecimiento ".$name." en el sistema.',
                                'success'
                            ).then( () => window.location='login');
                         </script>"; 
                else:
                    echo "<script>
                            Swal.fire(
                                'Oops...!',
                                'Ese establecimiento ya existe en nuestro sistema.',
                                'error'
                            );
                        </script>"; 
                endif;
            else:
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Ese establecimiento ya existe en nuestro sistema.',
                            'error'
                        );
                    </script>"; 
            endif;
        }
    }
    public function ctrUpdateRol() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){     
            $id = $_POST["id"];
            $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
            $description =  Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');
            $url =  Generales::sanar_datos($_POST["url"],'string', $errores, 'url');            
            $photo = Generales::foto($_FILES["photo"],"./views/style1/img/users/", $errores);
            
            $datos = compact('name','description', 'photo','url');
            
            if(RolModel::update($datos, $id)):                  
                echo "<script>
                        Swal.fire(
                            'Actualizado!',
                            'Se ha actualizado el establecimiento ".$name." en el sistema.',
                            'success'
                        ).then( () => window.location='login');
                        </script>"; 
            else:
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Ese establecimiento ya existe en nuestro sistema.',
                            'error'
                        );
                    </script>"; 
            endif;
        }
    }
    public function ctrDeleteRol() {   
        $condicion = "id like '".$_POST["id"]."'";
        $Rol = RolModel::get($condicion);

        if ($Rol):
            if(RolModel::delete($condicion)):                  
                echo "<script>
                        Swal.fire(
                            'Actualizada!',
                            'Se ha actualizado el establecimiento ".$Rol["name"]." en el sistema.',
                            'success'
                        ).then( () => window.location='login');
                        </script>"; 
            else:
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Ese establecimiento no existe en nuestro sistema.',
                            'error'
                        );
                    </script>"; 
            endif;
        else: 
            echo "<script>
                    Swal.fire(
                        'Oops...!',
                        'Ese establecimiento no existe en nuestro sistema.',
                        'error'
                    );
                </script>"; 
        endif;
    }
}