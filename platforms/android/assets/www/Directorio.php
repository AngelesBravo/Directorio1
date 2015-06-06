
<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
$dir = getcwd();
 $array1=array();
chmod($dir, 755);

if(is_dir($dir))
{
              
   if (is_dir($dir))
    {
        // Abrimos el directorio y comprobamos que sea un directorio
        if ($aux = opendir($dir))
        {
			
            while (($archivo = readdir($aux)) !== false)
            {
                // Si quisieramos mostrar todo el contenido del directorio pondr?amos lo siguiente:
                // echo '<br />' . $file . '<br />';
                // Pero como lo que queremos es mostrar todos los archivos excepto "." y ".."
                $cad=str_split("".$archivo);
				$cad1=str_split("".$ht);
				//echo $ht;
                //el archivo que se va a leer debe llevar como nombre Directorio y un guión despúes de la palabra "Directorio-"
                if(($cad[0]=="D")&&($cad[1]=="i")&&($cad[2]=="r")&&($cad[3]=="e")&&($cad[4]=="c")&&($cad[5]=="t")&&($cad[6]=="o")&&($cad[7]=="r")&&($cad[8]=="i")&&($cad[9]=="o")&&($cad[10]=="-")&&(array_pop($cad)=="t"))
                ///Considir prefijo y ultima cadena en t para que no lea los se respaldo que terminan en v
                {
                    if ($archivo!="." && $archivo!="..")
                {
                    $ruta_completa = $dir . '/' . $archivo;
                    // Comprobamos si la ruta mis file es un directorio y si lo es, volvemos a
                    // llamar a la función de manera recursiva.
                    if (is_dir($ruta_completa))
                    {
                        //echo "<br /><strong>Directorio:</strong> " . $ruta_completa;
                        //echo "Estamos tratando el <b>fichero</b> $archivo que tiene un tama?o ".filesize($archivo).", su ?ltima acceso fue en ".fileatime($archivo).", su ?ltima modificaci?n fue en ".filemtime($archivo).", y su fecha de creaci?n fue en ". filectime($archivo)";
                        leer_archivos_y_directorios($ruta_completa . "/");
                    }
                    else
                    {/// si coincide todo lo que vimos de la condicion de prefijo y termine en t entramos a qui
                        $fichero_url = fopen ($ruta_completa, "r");/// leemos el archivo
                         $texto = "";
                         $ht1="<tr>";
                           
                        //bucle para ir recibiendo todo el contenido del fichero en bloques de 1024 bytes
						$inc=1;$i=0;$array="";$asunto;$autor;$categoria;$area;$prioridad;$fecha;$activo;$descripcion;$cadena="";
                        while ($trozo = fgets($fichero_url, 1024)){
                        //$texto .= $trozo;
                        $key="%META:FIELD";
                        $resultado = strpos($trozo, $key);
						if($inc!=1){
							if($resultado!==FALSE){
								$cad2=explode('name="',$trozo);
								$final2=explode('"',$cad2[1]);
								$cad1=explode('value="',$trozo);
								$final=explode('"',$cad1[1]);
								
								$texto = $final[0];//la variable final en la posicion 0 trae el nombre del campo con su valor
								

                                    ////////////RESCATAMOS LOS CAMPOS SON SUS VALORES
   									if($final2[0]=="Generacion")//Ponemos el nombre del campo tal como está en el form
									{ /*Creamos una variable para guardar el valor*/
                                        $Generacion=$texto; //El valor lo contiene la variable $texto
                                    }
                                    
                                    if($final2[0]=="Nombre")//Ponemos el nombre del campo tal como está en el form
									{ /*Creamos una variable para guardar el valor*/
                                        $Nombre=$texto;//El valor lo contiene la variable $texto
                                    }
                                    
									if($final2[0]=="Direccion")//Ponemos el nombre del campo tal como está en el form
									{/*Creamos una variable para guardar el valor*/
                                        $Direccion=$texto; //El valor lo contiene la variable $texto
                                    }
                                
                                    if($final2[0]=="Celular")//Ponemos el nombre del campo tal como está en el form
									{ /*Creamos una variable para guardar el valor*/
                                        $Celular=$texto; //El valor lo contiene la variable $texto
                                    }
                                
                                    if($final2[0]=="Correo")//Ponemos el nombre del campo tal como está en el form
									{ /*Creamos una variable para guardar el valor*/
                                        $Correo=$texto; //El valor lo contiene la variable $texto
                                    }
                                
                                    if($final2[0]=="Skype")//Ponemos el nombre del campo tal como está en el form
									{ /*Creamos una variable para guardar el valor*/
                                        $Skype=$texto; //El valor lo contiene la variable $texto
                                    }
                                
                                    if($final2[0]=="Whatsapp")//Ponemos el nombre del campo tal como está en el form
									{/*Creamos una variable para guardar el valor*/
                                        $Whatsapp=$texto; //El valor lo contiene la variable $texto
                                    }
                                
                                    if($final2[0]=="Facebook")//Ponemos el nombre del campo tal como está en el form
									{/*Creamos una variable para guardar el valor*/
                                        $Facebook=$texto; //El valor lo contiene la variable $texto
                                    }
                                
                                    if($final2[0]=="Blog")//Ponemos el nombre del campo tal como está en el form
									{ /*Creamos una variable para guardar el valor*/
                                        $Blog=$texto; //El valor lo contiene la variable $texto
                                    }
                                

                                    $var=explode(".",$archivo);
								}
								else{$porciones = explode(".",$archivo);
								}
								$i++;
							}
							$inc++;
                        }
					/*Creamos Json*/	$array1[]=array("Generacion"=>$Generacion,"Nombre"=>$Nombre,"Direccion"=>$Direccion,"Celular"=>$Celular,"Correo"=>$Correo,"Skype"=>$Skype,"Whatsapp"=>$Whatsapp,"Facebook"=>$Facebook,"Blog"=>$Blog);
                    }
					  
                } 
            }
        }
        echo json_encode($array1);
        //echo json_encode($Arrays);
		//$Arrays=array("".json_encode($array1));// se imprimen las lineas de JSon que seran leidas
        //echo implode($Arrays); 
        closedir($aux);
 
        //Tiene que ser ruta y no ruta_completa por la recursividad
            
        }
    }
   /* else
    {
        echo $ruta;
        //echo "<br />No es ruta valida";
    }*/

    //////////////
    }
        /*else
        {
            echo "$dir no es una ruta";
        }*/



?>
