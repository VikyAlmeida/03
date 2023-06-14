<?php
class ControllerSection{
    public function ctrGetSections($condition) {
        try
        {
            $Sections = SectionsModel::get($condition);
            return $Sections;
        }
        catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
    }
    public function ctrAllSections() {
        $Sections = SectionsModel::all();
        return $Sections;
    }
    public function ctrInsertSections(&$errores) {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){            
            $condicion = "name like '".$_POST["name"]."'";
            $section = SectionsModel::get($condicion);

            if (!$section):
                $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
                $description =  Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');       
                $photo = Generales::foto($_FILES["photo"],"./views/style1/img/users/", $errores);
                
                $datos = compact('name','description', 'photo');
                
                if(SectionsModel::insert($datos)):                  
                    echo "<script>
                            Swal.fire(
                                'Insertada!',
                                'Se ha registrado la categoria ".$name." en el sistema.',
                                'success'
                            ).then( () => window.location='login');
                         </script>"; 
                else:
                    echo "<script>
                            Swal.fire(
                                'Oops...!',
                                'Esa categoria ya existe en nuestro sistema.',
                                'error'
                            );
                        </script>"; 
                endif;
            else:
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Esa categoria ya existe en nuestro sistema.',
                            'error'
                        );
                    </script>"; 
            endif;
        }
    }
    public function ctrUpdateSections() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){     
            echo "hola";
            $id = $_POST["id"];
            $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
            $description =  Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');        
            $photo = Generales::foto($_FILES["photo"],"./views/style1/img/users/", $errores);
            var_dump($_POST);
            $datos = compact('name','description', 'photo');
            
            if(SectionsModel::update($datos, $id)):                  
                echo "<script>
                        Swal.fire(
                            'Actualizada!',
                            'Se ha actualizado la categoria ".$name." en el sistema.',
                            'success'
                        ).then( () => window.location='menu');
                        </script>"; 
            else:
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Esa categoria no existe en nuestro sistema.',
                            'error'
                        );
                    </script>"; 
            endif;
        }
    }
    public function ctrDeleteSections() {   
        if($_SERVER['REQUEST_METHOD'] === 'POST'){    
            $condicion = "id like '".$_POST["id"]."'";
            $section = SectionsModel::get($condicion);

            if ($section):
                if(SectionsModel::delete($condicion)):                  
                    echo "<script>
                            Swal.fire(
                                'Eliminada!',
                                'Se ha eliminado la categoria ".$section["name"]." en el sistema.',
                                'success'
                            ).then( () => window.location='menu');
                            </script>"; 
                else:
                    echo "<script>
                            Swal.fire(
                                'Oops...!',
                                'Esa categoria no existe en nuestro sistema.',
                                'error'
                            );
                        </script>"; 
                endif;
            else: 
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Esa categoria no existe en nuestro sistema.',
                            'error'
                        );
                    </script>"; 
            endif;
        }
    }
}