<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        input,select{
            border:2pt solid white;
        }
        body{
            margin-left: 10px;
            margin-top: 10px;

        }
        body,input,select{
            background-color: black;
            color:white;
        }
        input:hover{
                background-color: deepskyblue;
                border:2pt solid #363636;
                font-weight: bold;
        }
    </style>
    <title>Tabla Periódica</title>
</head>
<body>
    <div align="center">
        <h1>TABLA PERIÓDICA</h1><br>
        <form action="grupos.php" method="post">
            <label for="grupo">Seleccione o grupo deseado: </label>
            <select name="grupo" id="grupo" value="grupo">
                <option value="0">Metales Alcalinos</option>
                <option value="1">Alcalino Térreos</option>
                <option value="2">Halógenos</option>
                <option value="3">Gases Nobles</option>
            </select>
            <input type="submit" name="submit" value="Buscar">
        </form>
    </div>
</body>
</html>