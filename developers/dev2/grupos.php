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

$elementos = array(
    array("H"=>5,"Li"=>3,"Na"=>11,"K"=>19,"Rb"=>37,"Cs"=>5,"Fr"=>87),
    array("Be"=>4,"Mg"=>12,"Ca"=>20,"Sr"=>38,"Ba"=>56,"Ra"=> 88),
    array("Fl"=>9,"Cl"=>17,"Br"=>35,"I"=> 53,"At"=> 85,"Ts"=> 117),
    array("He"=>2,"Ne"=>10,"Ar"=>18,"Kr"=>36,"Xe"=> 54,"Rn"=> 86,"Og"=>118),
);


$grupo=$_POST['grupo']??"";
if ($grupo==0) {
    $nombre="Metales Alcalinos";
}elseif ($grupo==1) {
    $nombre="Alcalino Térreos";
}elseif ($grupo==2) {
    $nombre="Halógenos";
}elseif ($grupo==3) {
    $nombre="Gases Nobles";
}
?>
<h2><?php echo $nombre; ?></h2>
<br>
<table>
    
    <tr>
        <th>Nombre</th>
        <th>NºAtómico</th>
    </tr>
<?php
$elementos_totales=0;
foreach ($elementos[$grupo] as $key => $value) {
    echo "<tr>";
    echo "<td>$key</td>";
    echo "<td>$value</td>";
    echo "</tr>";
    $elementos_totales++;
}


?>

</table>
<?php
    echo "<br>";
    echo "Hay un total de <b>$elementos_totales</b> elementos <b>$nombre</b>"; 
    echo "<br>";
    ?>

<form action="POST" action="index.php">
    <br>
    <input type="submit" value="Volver">

</form>

</div> 
</body>
</html>