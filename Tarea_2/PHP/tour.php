<?php
    include "funciones.php";
    $enlace=init();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour</title>
    <link rel="stylesheet" href="../css/bar.css" type="text/css" media="all">
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="../css/style2.css" type="text/css" media="all">
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
            <input type="submit" name="reservar_tour" placeholder="reservar tour" value="reservar tour">
            <input type="submit" name="cancelar_reserva_tour" placeholder="cancelar reserva" value="cancelar reserva">
        </form>
    </div>
    <?php
        if(isset($_GET["reservar_tour"])){
            echo"
            <div class='formulario'>
                <form action='#' name='Tarea_2' method='post'>
                    <input type='number' name='numero_reserva' placeholder='numero de reserva' class='dato'><br>
                    <input type='number' name='opcion' placeholder='opcion de tour' class='dato'><br>
                    <input type='submit' name='reservar' placeholder='reservar' value='reservar'>
                </form>
            </div>";
            reservar_tour($enlace);
        }
        if(isset($_GET["cancelar_reserva_tour"])){
            echo"
            <div class='formulario'>
                <form action='#' name='Tarea_2' method='post'>
                    <input type='number' name='numero_reserva' placeholder='numero de reserva' class='dato'><br>
                    <input type='number' name='opcion' placeholder='opcion de tour' class='dato'><br>
                    <input type='submit' name='eliminar' placeholder='eliminar' value='eliminar'>
                </form>
            </div>";
            eliminar_tour($enlace);
        }
    ?>

    <div class="contenedor">

        <?php
            ver_tours($enlace)
        ?>
    </div>
</body>
</html>