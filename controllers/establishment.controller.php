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
    public function ctrInsertEstablishment() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){            
            $condicion = "name like '".$_POST["name"]."'";
            $establishment = EstablishmentModel::get($condicion);

            if (!$establishment):
                $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
                $aboutUs =  $_POST["aboutUs"];
                $description = Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');
                $url =  $_POST["web_site"];        
                $logo = Generales::foto($_FILES["photo"],"./views/style1/img/establishment/", $errores);
                $tlf  = Generales::sanar_datos($_POST["tlf"],'string', $errores, 'telefono'); 
                $owner = $_SESSION['user']['id'];
                $slug = str_replace("", "-", $name);
                $email = Generales::sanar_datos($_POST["email"],'string', $errores, 'email'); 
                if ($_POST['category'] !== 0)
                    $category = $_POST["category"];
                else 
                    $errores .= '<li>No ha seleccionado ninguna categoria</li>';

                if ($errores) return $errores;

                $datos = compact('name','aboutUs', 'description', 'url', 'logo', 'tlf', 'owner', 'email', 'category', 'slug');
                
                if(EstablishmentModel::insert($datos)):                  
                    echo "<script>
                            Swal.fire(
                                'Insertada!',
                                'Se ha registrado el establecimiento ".$name." en el sistema.',
                                'success'
                            ).then( () => window.location='menu');
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
            $aboutUs =  $_POST["aboutUs"];
            $description = Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');
            $url =  $_POST["web_site"];   
            if($_FILES["photo"]["size"]>0):
                $logo = Generales::foto($_FILES["photo"],"./views/style1/img/establishment/", $errores);
            else:
                $logo = $_POST['fotoAntes'];
            endif;
            $tlf  = Generales::sanar_datos($_POST["tlf"],'string', $errores, 'telefono'); 
            $owner = $_SESSION['user']['id'];
            $slug = str_replace("", "-", $name);
            $email = Generales::sanar_datos($_POST["email"],'string', $errores, 'email'); 
            if ($_POST['category'] !== 0)
                $category = $_POST["category"];
            else 
                $errores .= '<li>No ha seleccionado ninguna categoria</li>';

            if ($errores) return $errores;

            $datos = compact('name','aboutUs', 'description', 'url', 'logo', 'tlf', 'email', 'slug');
            
            if(EstablishmentModel::update($datos, $id)):                  
                echo "<script>
                        Swal.fire(
                            'Actualizado!',
                            'Se ha actualizado el establecimiento ".$name." en el sistema.',
                            'success'
                        ).then( () => window.location='menu');
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
        if($_SERVER['REQUEST_METHOD'] === 'POST'){     
        $condicion = "id like '".$_POST["id"]."'";
        $establishment = EstablishmentModel::get($condicion);

        if ($establishment):
            if(EstablishmentModel::delete($condicion)):                  
                echo "<script>
                        Swal.fire(
                            'Eliminada!',
                            'Se ha eliminado el establecimiento ".$establishment["name"]." en el sistema.',
                            'success'
                        ).then( () => window.location='menu');
                        </script>"; 
            else:
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'A ocurrido un error.',
                            'error'
                        );
                    </script>"; 
            endif;
        else:               
            echo "<script>
                    Swal.fire(
                        'Eliminada!',
                        'Se ha eliminado el establecimiento en el sistema.',
                        'success'
                    ).then( () => window.location='menu');
                    </script>"; 
        endif;
    }
    }
    public function ctrGetEstablishmentByCondicion($query) { 
        if ($query == null) $query = 'SELECT * FROM establishments';
        
        $registros = EstablishmentModel::getEstablishment($query);
        return $registros;
    }
}