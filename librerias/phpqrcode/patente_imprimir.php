
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Impresión Patente HyV</title>
    <meta charset="UTF-8"> <?php include_once('../../inc_headers_meta.php'); ?>

</head>
<body>
<header>
    <h1>Imprimir Código QR</h1>
</header>
<nav>
    <a href="../../">Volver</a>

</nav>
<section>
    <table id="dt-basic-example" class="table table-bordered   table-striped w-100 border-0 m-1">
        <thead>
        <tr>
            <th>QR</th>
            <th>Patente</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td><img src="patente.png" alt="patente"></td>

            <td><h1 style="font-size: xxx-large"><?php echo $_GET['patente']; ?></h1></td>
        </tr>

        </tbody>
        <tfood>
            <tr>
                <td>Fecha: <?php echo date("d-m-Y"); ?></td>
                <td><a href="https://www.hyv.cl/siniestros/fotos_siniestro.php?patente=<?php echo $_GET['patente']; ?>">
                        Abrir link
                    </a> </td>
            </tr>
        </tfood>
    </table>
</section>
<style>

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

</body>
</html>
