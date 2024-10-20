<?php
    include "funciones.php";
    $enlace=init();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link rel="stylesheet" href="../css/bar.css" type="text/css" media="all">
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all">
</head>
<body>
    <ul id="barra">
        <div class="contenedor-botones">
            <li><a href="index.php" class="button">
                <div class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                </div>
            <span>Menú</span></a>
            </li>
            <li><a href="reservas.php" class="button"><div class="icono"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
            </svg></div><span>reservas</span></a></li>
            <li><a href="tour.php" class="button" ><div class="icono"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
            </svg></div><span>tours</span></a></li>
            <li><a href="chekOut.php" class="button" ><div class="icono"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
            </svg></div><span>Check Out</span></a></li>
            <li><a href="calificaciones.php" class="button" ><div class="icono"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
            </svg></div><span>calificaciones</span></a></li>
        </div>
    </ul>
    

    <div class='f'>
        <form>
            <h3 style="margin:50px 20px 30px ;">Por favor seleccione una opcion:</h3>
            <input type="submit" name="consultar" placeholder="consultar" value="consultar habitacion">
            <input type="submit" name="crear" placeholder="crear" value="crear reserva">
            <input type="submit" name="modificar" placeholder="modificar" value="modificar reserva">
            <input type="submit" name="eliminar" placeholder="eliminar" value="eliminar reserva">
            <input type="submit" name="agregar_calificacion" placeholder="agregar_calificacion" value="agregar calificacion">
        </form>
    </div>



    <?php
        if(isset($_GET["consultar"])){
            echo"
            <div class='formulario'>
                <form action='#' name='Tarea_2' method='post'>
                    <input type='number' name='numero_habitacion' placeholder='numero habitacion' class='dato'><br>
                    <input type='submit' name='buscar' placeholder='buscar' value='buscar'>
                </form>
            </div>";
            consultar($enlace);
        }


        if(isset($_GET["crear"])){
            echo"
            <div class='formulario'>
                <form action='#' name='Tarea_2' method='post'>
                    <input type='number' name='rut' placeholder='rut' class='dato'><br>
                    <input type='number' name='numero_habitacion' placeholder='numero habitacion' class='dato'><br>
                    <input type='date' name='chek_in' placeholder='chek in' class='dato'><br>
                    <input type='date' name='chek_out' placeholder='chek out' class='dato'><br>
        
                    <input type='submit' name='aceptar' placeholder='aceptar'>
                </form>
            </div>";
            crear($enlace);
        }
        

        if(isset($_GET["modificar"])){
            echo"
            <div class='formulario'>
                <form action='#' name='Tarea_2' method='post'>
                    <input type='number' name='id_a_modificar' placeholder='id_a_modificar' class='dato'><br>
                    <input type='number' name='rut' placeholder='rut' class='dato'><br>
                    <input type='number' name='numero_habitacion' placeholder='numero habitacion' class='dato'><br>
                    <input type='date' name='chek_in' placeholder='chek in' class='dato'><br>
                    <input type='date' name='chek_out' placeholder='chek out' class='dato'><br>
                    <input type='numer' name='calificaion' placeholder='calificacion' class='dato'><br>
                    <input type='submit' name='modificar_registro' value='Modificar'>
                </form>
            </div>";
            if(isset($_POST["modificar_registro"])){
                $id = $_POST["id_a_modificar"];
                if (buscar($id,$enlace)){
                    modificar($id,$enlace);
                }
            }
        }

        if(isset($_GET["agregar_calificacion"])){
            echo"
            <div class='formulario'>
                <form action='#' name='Tarea_2' method='post'>
                    <input type='number' name='id_a_modificar' placeholder='reserva calificadora' class='dato'><br>
                    <input type='numer' name='calificacion' placeholder='calificacion' class='dato'><br>
                    <input type='submit' name='calificar' value='Calificar'>
                </form>
            </div>";
            calificar($enlace);
        } 

        if(isset($_GET["eliminar"])){
            echo"
            <div class='formulario'>
                <form action='#' name='Tarea_2' method='post'>
                    <input type='number' name='id_a_borrar' placeholder='reserva a borrar' class='dato'><br>
                    <input type='submit' name='borrar' value='borrar'>
                </form>
            </div>";
            eliminar($enlace);
        } 
    ?>
</body>
</html>


