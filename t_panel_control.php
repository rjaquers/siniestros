<?php include_once("c_connections/conec6.php");  

 $q_total_patentes =  "SELECT
    COUNT(`P`.`patente`) AS total,
    `P`.`id_usuario`,
    `U`.`nombres_usuario`
FROM
    `tbl_patentes` as P
    LEFT JOIN `tbl_usuarios` as U on `P`.`id_usuario` = `U`.`id_usuario`
WHERE
    `P`.`activo` = 1
GROUP BY
    `P`.`id_usuario`";
  $re_total_patentes = mysqli_query($conec6, $q_total_patentes) or die(mysqli_error($conec6) . " - Error 43 $q_total_patentes");
  $row_total_patentes = mysqli_fetch_assoc($re_total_patentes);
  $totalRows_total_patentes = mysqli_num_rows($re_total_patentes);







?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([ <?php   do { ?>
            ['<?php echo $row_total_patentes['nombres_usuario']; ?>', <?php echo $row_total_patentes['total']; ?>],
            <?php  } while ($row_total_patentes = mysqli_fetch_assoc($re_total_patentes)); ?>
        ]);



        // Set chart options
        var options = {'title':'Cantidad de Vehículos ingresados.',
            'width':400,
            'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2> Panel de Control Siniestros <span class="fw-300"><i><?php echo $_GET['accion']; ?> </i></span></h2>

                <div class="panel-toolbar  ">
                    <div class="pull-right">
                      .
                    </div>
                    <?php include_once("inc_balls.inc"); ?>
                </div>

            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    <!--No borrar este es el gráfico-->
                    <div id="chart_div"></div>


                </div>
            </div>
        </div>
    </div>


