<?php
  session_start();
  $con = mysqli_connect("localhost","root","","charts");
 
  $sql = "SELECT COUNT(*) AS total  FROM `contribution` ";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            $_SESSION['total'] = $result['total'];
            echo"total". $_SESSION['total'];
          }

          $sql = "SELECT COUNT(*) AS enLigne  FROM `contribution` where etat='En ligne' ";
          $fire = mysqli_query($con,$sql);
           while ($result = mysqli_fetch_assoc($fire)) {
             $_SESSION['enLigne'] = $result['enLigne'];
             echo"en  ligne". $_SESSION['enLigne'];
           } 
           
           $sql = "SELECT COUNT(*) AS horsLigne  FROM `contribution` where etat='Hors ligne' ";
           $fire = mysqli_query($con,$sql);
            while ($result = mysqli_fetch_assoc($fire)) {
              $_SESSION['horsLigne'] = $result['horsLigne'];
              echo"hors ligne". $_SESSION['horsLigne'];
            } 
            
            $_SESSION['enLignePourcentage'] = $_SESSION['enLigne']*100/$_SESSION['total'];
            $_SESSION['horsLignePourcentage'] = $_SESSION['horsLigne']*100/$_SESSION['total'];
            echo"en ligne pourcent". $_SESSION['enLignePourcentage'];
            echo"hors ligne pourcent". $_SESSION['horsLignePourcentage'];
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['students', 'contribution'],
         <?php
         
            echo"['Succèes',".$_SESSION['enLignePourcentage']."],";
            echo"['Echec',".$_SESSION['horsLignePourcentage']."],";
          

         ?>
        ]);

        var options = {
          title: 'Taux de concentrateur actif actuel)'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
