<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Document</title>
        <style>
            body{
                margin-left: 10px;
                margin-top: 10px;
            }
            body,input{
                background-color: black;
                color:white;
            }
            input{
                border:2pt solid white;
            }
            input:hover{
                background-color: deepskyblue;
                border:2pt solid #363636;
                font-weight: bold;
            }
            td{
                background-color: #363636;
            }
            table, th, td {
                 border:2pt solid white;
                 padding: 10px;
                 text-align: center;
            }
            table{
                margin-left: 10px;
            }
        </style>
    </head>
    <body>
<div align="center">
<?php
function points($value)
{
    if ($value==1) {
        $puntos=25;
    } elseif($value==2) {
        $puntos=18;
    } elseif($value==3) {
        $puntos=15;
    } elseif($value==4) {
        $puntos=12;
    } elseif($value==5) {
        $puntos=10;
    } elseif($value==6) {
        $puntos=8;
    } elseif($value==7) {
        $puntos=6;
    } elseif($value==8) {
        $puntos=4;
    } elseif($value==9) {
        $puntos=2;
    } elseif($value==10) {
        $puntos=1;
    } else{
        $puntos=0;
    }
    return $puntos;
}

$piloto=$_POST['piloto']??"";
$corredores = array(
    array(1,2,1,2,1),
    array(2,1,5,1,2),
    array(5,5,2,6,6),
    array(3,3,3,4,3),
    array(4,6,12,5,5)
);


if ($piloto==0) {
    $nombre="Verstappen";
}elseif ($piloto==1) {
    $nombre="Vettel";
}elseif ($piloto==2) {
    $nombre="Hamilton";
}elseif ($piloto==3) {
    $nombre="Alonso";
}elseif ($piloto==4) {
    $nombre="Sainz";
}


?>
<h2>CLASIFICACIÓN DE <?php echo strtoupper($nombre); ?></h2>
<br>
<table>
    
    <tr>
        <th>Gran Premio</th>
        <th>Posición</th>
        <th>Puntos</th>
    </tr>
    
<?php
$puntos_totales=0;
foreach ($corredores[$piloto] as $i => $value) {
    echo "<tr>";
    if ($i==0) {
        echo "<td>Bahrein</td>";
    } elseif ($i==1) {
        echo "<td>Arabia S.</td>";
    } elseif ($i==2) {
        echo "<td>Australia</td>";
    } elseif ($i==3) {
        echo "<td>Azerbaiyan</td>";
    } elseif ($i==4) {
        echo "<td>Miami</td>";
    }
    echo "<td>$value</td>";
   
    $puntos=points($value);

    $puntos_totales=$puntos_totales+$puntos;

    echo "<td>$puntos</td>";
    echo "</tr>";
}

?>

</table>
<?php
echo "<br>";
echo "Logo de <b>$i</b> carreiras <b>$nombre</b> leva <b>$puntos_totales</b> puntos."
?>
<form action="POST" action="index.php">
    <br>
    <input type="submit" value="Volver">

</form>

</div> 
</body>
</html>