<?php
class ControllerEstablishment{
    public function ctrGetEstablishment($condition) {
        $establishments = EstablishmentModel::get($condition);
        return $establishments;
    }
    public function ctrAllEstablishment() {
        $establishment = EstablishmentModel::all();
        return $establishment;
    }
    public function ctrInsertEstablishment(&$errores) {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){            
            $condicion = "name like '".$_POST["name"]."'";
            $establishment = EstablishmentModel::get($condicion);

            if (!$establishment):
                $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
                $description =  Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');
                $url =  Generales::sanar_datos($_POST["url"],'string', $errores, 'url');            
                $photo = Generales::foto($_FILES["photo"],"./views/style1/img/users/", $errores);
                
                $datos = compact('name','description', 'photo','url');
                
                if(EstablishmentModel::insert($datos)):                  
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
    public function ctrUpdateEstablishment() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){     
            $id = $_POST["id"];
            $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
            $description =  Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');
            $url =  Generales::sanar_datos($_POST["url"],'string', $errores, 'url');            
            $photo = Generales::foto($_FILES["photo"],"./views/style1/img/users/", $errores);
            
            $datos = compact('name','description', 'photo','url');
            
            if(EstablishmentModel::update($datos, $id)):                  
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
    public function ctrDeleteEstablishment() {   
        $condicion = "id like '".$_POST["id"]."'";
        $establishment = EstablishmentModel::get($condicion);

        if ($establishment):
            if(EstablishmentModel::delete($condicion)):                  
                echo "<script>
                        Swal.fire(
                            'Actualizada!',
                            'Se ha actualizado el establecimiento ".$establishment["name"]." en el sistema.',
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