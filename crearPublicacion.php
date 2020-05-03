<?php
    session_start();
    $var=$_SESSION['sesion'];
    if($var == null || $var = '' ){
        echo "Erro al autentificar";
        header("Location:index.php?error=x");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Vista/bootstrap.css">
</head>
<body>
<header class="bg-info w-100 p-4">
        <h4 class="font-italic">Bienvenda <?php echo $_SESSION['sesion']; ?></h4>
        <a href="form_cerrarSession.php" class="float-right text-dark">cerrar session</a>
    </header>
    <div id="idConvicatoria" class="mx-auto w-75 p-4 my-5 border border-primary">
    <h1>Publicar Convocatoria</h1>
    <form action="form_subirPublicacion.php" method="post" enctype="multipart/form-data">
        <input type="text" name="titulo" id="titulo" placeholder="Titulo" required autocomplete="off">
        <br>
        <br>
        <textarea id="descripcion" rows="10" cols="170" name="descripcion" style="resize:none;"> </textarea>
        <br>
        <br>
        <input type="file" name="archivo" id="archivo" required accept='.pdf'> 
        <br>
        <br>
        <input class="d-block mx-auto btn btn-primary" type="submit" value="Publicar">
    </form>
    </div>
</body>
</html>