<?php

    ####
    #
    # init()
    # hace el enlace con la base de datos y lo retorna
    #
    ####
    function init(){
    $servidor="localhost";
    $usuario="root";
    $clave="";
    $baseDeDatos="Tarea_2";
    $enlace= mysqli_connect($servidor,$usuario,$clave,$baseDeDatos);
    return $enlace;
    }


    ####
    #
    # consultar($enlace)
    # revisa si la habitacion ingresada por el usuario esta siendo utilizada o no
    #
    ####
    function consultar($enlace){
        $dia = date("d");
        $mes = date("m");
        $anio = date("20y");
        if(isset($_POST["buscar"])){
            $flag=true;
            $f=true;
            $numero=$_POST["numero_habitacion"];
            $consulta="SELECT numero_habitacion, f_chek_in, f_chek_out FROM reserva";
            $resultado=mysqli_query($enlace,$consulta);
            if ($resultado){
                while ($fila = mysqli_fetch_array($resultado)){
                    $numero_habitacion=$fila['numero_habitacion'];
                    if ($numero_habitacion== $numero){
                        $flag=false;
                        $in=$fila['f_chek_in'];
                        $out=$fila['f_chek_out'];
                        $partes_fecha_in = explode("-", $in);
                        $partes_fecha_out = explode("-", $out);
                        if ($anio>=$partes_fecha_in[0] and $anio<=$partes_fecha_out[0]){
                            if ($mes>=($partes_fecha_in[1]%12) and ($mes<=$partes_fecha_out[1]%12)){
                                if ($dia>=($partes_fecha_in[2]%31) and $dia<=($partes_fecha_out[2]%31)){
                                    echo"<div class='respuesta'><h3><br>habitacion numero ".$numero." ya esta utilizada</h3></div>";
                                    $f=false;
                                }
                            }
                        }
                    }
                }
                if ($flag or $f){
                    echo"<div class='respuesta'><h3><br>habitacion numero ".$numero." esta actualmente disponible</h3></div>";
                }
            }
        }
    }



    ####
    #
    # calculo_check_out($enlace)
    # calcula el precio real, en base al precio de la habitacion por dia y los tours
    #
    ####
    function calculo_check_out($enlace){
        if(isset($_POST["Calcular"])){
            $id_habitacion = $_POST['Id'];
            $consulta = "SELECT * FROM reserva WHERE (ID_reserva = $id_habitacion)";
            $resultado=mysqli_query($enlace,$consulta);
            $fila_reserva = mysqli_fetch_array($resultado);
            $fecha_salida = $_POST['chek_out'];
            $fecha_inicio = $fila_reserva['f_chek_in'];
            
            $timestamp_inicio = strtotime($fecha_inicio);
            $timestamp_fin = strtotime($fecha_salida);
            
            // Calcular la diferencia en segundos
            $diferencia_segundos = $timestamp_fin - $timestamp_inicio;
        
            // Convertir la diferencia de segundos a días (1 día = 86400 segundos)
            $diferencia_dias = $diferencia_segundos / (60 * 60 * 24);
            
            // Redondear el resultado si es necesario
            $diferencia_dias = round($diferencia_dias);
            
            $num_habitacion = $fila_reserva['numero_habitacion'];

            $consulta_habitaciones="SELECT * FROM habitacion WHERE (numero_habitacion = $num_habitacion)";
            $resultado_habitaciones=mysqli_query($enlace, $consulta_habitaciones);
            $fila_habitaciones = mysqli_fetch_array($resultado_habitaciones);
            $precio_habitacion = $fila_habitaciones["precio"];
            $pago_habitaciones = $diferencia_dias * $precio_habitacion;
            echo"<div class='respuesta'><h3><br>Precio por los dias: ".$pago_habitaciones."</h3></div>";


            
            $consulta_tour="SELECT * FROM reserva_tour WHERE (ID_reserva = $id_habitacion)";
            $resultado_tour=mysqli_query($enlace, $consulta_tour);
            $precio_total_tour = 0;

            if ($resultado_tour){
                while ($fila_tour = mysqli_fetch_array($resultado_tour)){
                $precio_total_tour += $fila_tour["precio"];
            
                }
                echo"<div class='respuesta'><h3><br>Precio por los tours: ".$precio_total_tour."</h3></div>";
            }
            $precio_total = $pago_habitaciones + $precio_total_tour;
            echo"<div class='respuesta'><h3><br>Precio total por pagar (Id: ".$id_habitacion."): ".$precio_total."</h3></div>";

        }
    }



    ####
    #
    # crear($enlace)
    # crea un registro en la tabla reservas
    #
    ####
    function crear($enlace){
        if(isset($_POST["aceptar"])){
            $rut_huesped=$_POST["rut"];
            $numero_habitacion=$_POST["numero_habitacion"];
            $f1=$_POST["chek_in"];
            $f2=$_POST["chek_out"];

            $insert = "INSERT INTO reserva VALUES ('','$rut_huesped','$numero_habitacion','$f1','$f2','')";

            if(mysqli_query($enlace,$insert)){
                $id_insertado = mysqli_insert_id($enlace);
                echo"<div class='respuesta'><h3><br>Agregado exitosamente. ID: $id_insertado</h3></div>";
            } 
            else {
                echo "<div class='respuesta'><h3><br>Error al agregar el registro</h3></div>";
            }
        }
    }



    ####
    #
    # buscar($id,$enlace)
    # busca si el $id ingresado pertenece o no a la tabla reserva
    #
    ####
    function buscar($id,$enlace){
        if(isset($_POST["buscar"])){
            $consulta="SELECT rut_huesped, numero_habitacion, f_chek_in, f_chek_out FROM reserva WHERE ID_Reserva = '$id'";
            $resultado=mysqli_query($enlace,$consulta);
            if(mysqli_num_rows($resultado) > 0){
                return true;
            }
            else {
                echo "<div class='respuesta'><h3><br>No se encontró ningún registro con el ID proporcionado.</h3></div>";
                return false;
            }
        }
    }



    ####
    #
    # modificar($id,$enlace)
    # cambia los valores de la reserva $id
    #
    ####
    function modificar($id,$enlace){
        if(isset($_POST["modificar_registro"])){
            $rut_huesped = $_POST["rut"];
            $numero_habitacion = $_POST["numero_habitacion"];
            $check_in = $_POST["chek_in"];
            $check_out = $_POST["chek_out"];
            $calificacion = $_POST["calificacion"];
            $actualizar = "UPDATE reserva SET rut_huesped='$rut_huesped', numero_habitacion='$numero_habitacion', f_chek_in='$check_in', f_chek_out='$check_out', calificacion='$calificacion' WHERE ID_Reserva='$id'";
            if(mysqli_query($enlace, $actualizar)){
                echo "<div class='respuesta'><h3>Registro modificado exitosamente.</h3></div>";
            } 
            else {
                echo "<div class='respuesta'><h3>Error al modificar el registro.</h3></div>";
            }
        }
    }



    ####
    #
    # calificar($enlace)
    # ingresa una calificacion a la tabla reserva
    #
    ####
    function calificar($enlace){
        if(isset($_POST["calificar"])){
            $id = $_POST["id_a_modificar"];
            $calificacion = $_POST["calificacion"];
            $actualizar = "UPDATE reserva SET calificacion='$calificacion' WHERE ID_Reserva='$id'";
            if(mysqli_query($enlace, $actualizar)){
                echo "<div class='respuesta'><h3>calificacion ingresada exitosamente.</h3></div>";
            } 
            else {
                echo "<div class='respuesta'><h3>Error al ingresar calificacion.</h3></div>";
            } 
        }
    }



    ####
    #
    # eliminar($enlace)
    # elimina una reserva
    #
    ####
    function eliminar($enlace){
        if(isset($_POST["borrar"])){
            $id = $_POST["id_a_borrar"];
            $sql = "DELETE FROM reserva WHERE ID_Reserva = $id";
            if(mysqli_query($enlace, $sql)){
                echo "<div class='respuesta'><h3>reserva eliminada exitosamente.</h3></div>";
            } 
            else {
                echo "<div class='respuesta'><h3>Error al eliminar la reserva.</h3></div>";
            } 
        }
    }



    ####
    #
    # ver_tours($enlace)
    # muestra los tours con sus datos
    #
    ####
    function ver_tours($enlace){
        $consulta="SELECT * FROM tour";
        $resultado=mysqli_query($enlace,$consulta);
        if ($resultado){
            while($fila = mysqli_fetch_array($resultado)){
                $lugar=$fila['lugar'];
                $transporte=$fila['medio_transporte'];
                $fecha=$fila['fecha'];
                $precio=$fila['precio_tour'];
                echo'<div class="tour"><h2 class="title">'.$lugar.'</h2><div class="valores">';
                if ($lugar=="Demacia")
                    echo '<img src="../static/Demacia.png" class="img-normalizada">';
                if ($lugar=="Dust_II")
                    echo '<img src="../static/Dust_II.png" class="img-normalizada">';
                if ($lugar=="Namek")
                    echo '<img src="../static/Namek.png" class="img-normalizada">';
                echo '<p class="info">opcion: '.$fila["ID_tour"].'<br><br>fecha: '.$fecha.'<br><br>medio de transporte: '.$transporte.'<br><br>precio: '.$precio.'</p></div></div>';
            }
        }
    }



    ####
    #
    # reservar_tour($enlace)
    # reserva un tour
    #
    ####
    function reservar_tour($enlace){
        if(isset($_POST["reservar"])){
            $f1=$_POST["numero_reserva"];
            $f2=$_POST["opcion"];
            $consulta="SELECT precio_tour FROM tour WHERE ID_tour = '$f2'";
            $resultado=mysqli_query($enlace,$consulta);
            if ($resultado){
                while ($fila = mysqli_fetch_array($resultado)){
                    $precio=$fila['precio_tour'];
                }
            }

            $insert = "INSERT INTO reserva_tour VALUES ('$f1','$f2','$precio')";
            #$insert = "INSERT INTO **nombre tabla** VALUES (**valores de la tabla separados por , los vacios van '')";

            if(mysqli_query($enlace,$insert)){
                echo"<div class='respuesta'><h3><br>Reservado exitosamente.</h3></div>";
            }
            else {
                echo "<div class='respuesta'><h3><br>Error al reservar</h3></div>";
            }
        }
    }



    ####
    #
    # eliminar_tour($enlace)
    # elimina una reserva de un tour (elimina en reserva_tour)
    #
    ####
    function eliminar_tour($enlace){
        if(isset($_POST["eliminar"])){
            $f1=$_POST["numero_reserva"];
            $f2=$_POST["opcion"];
            $sql = "DELETE FROM reserva_tour WHERE (ID_reserva = $f1 AND ID_tour = $f2)";
            if(mysqli_query($enlace, $sql)){
                echo "<div class='respuesta'><h3>reserva eliminada exitosamente.</h3></div>";
            } 
            else {
                echo "<div class='respuesta'><h3>Error al eliminar la reserva.</h3></div>";
            } 
        }
    }



    ####
    #
    # calcular_promedio($enlace)
    # calcula el promedio de las calificaciones de las habitaciones y los muestra
    #
    ####
    function calcular_promedio($enlace){
        $consulta_reserva="SELECT * FROM reserva";
        $resultado_reserva=mysqli_query($enlace,$consulta_reserva);
        $consulta_habitaciones="SELECT * FROM habitacion";
        $resultado_habitaciones=mysqli_query($enlace, $consulta_habitaciones);
        if ($resultado_reserva){
            $suma_calificaciones = [0,0,0];
            $cant_calificaciones = [0,0,0];
            while($fila = mysqli_fetch_array($resultado_reserva)){
                $ID_reserva=$fila['ID_Reserva'];
                $numero_habitacion=$fila['numero_habitacion'];
                $calificacion=$fila['calificacion'];
                $suma_calificaciones[$numero_habitacion-1] = $calificacion + $suma_calificaciones[$numero_habitacion-1] ;
                $cant_calificaciones[$numero_habitacion-1] = 1 + $cant_calificaciones[$numero_habitacion-1];
            }
            $cont = 0;
            while($fila = mysqli_fetch_array($resultado_habitaciones)){
                $numero_habitacion=$fila['numero_habitacion'];
                $tipo=$fila['tipo'];
                if ($cant_calificaciones[$cont] == 0){
                    $promedio = 0;
                }else{
                    $promedio = $suma_calificaciones[$cont]/$cant_calificaciones[$cont];
                }
                $promedio = round( $promedio,1);
                echo'<div class="tour"><h2 class="title">Habitacion numero: '.$numero_habitacion.'</h2><div class="valores">';
                if ($numero_habitacion=="1")
                    echo '<img src="../static/habitacion_fea.png" class="img-normalizada">';
                if ($numero_habitacion=="2")
                    echo '<img src="../static/habitacion_2.png" class="img-normalizada">';
                if ($numero_habitacion=="3")
                    echo '<img src="../static/habitacion_bonita.png" class="img-normalizada">';
                echo '<p class="info">tipo: '.$tipo.' <br><br>Promedio calificacion: '.$promedio.'</p></div></div>';
                $cont = 1 + $cont;
            }

            
        }
    }
