<?php

/**
 * Description of index
 * Created on : Jun 24, 2018, 3:03:48 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

?>
<?php $this->setTitle("Admin"); ?>
<?php $this->open("head"); ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'A', 'B','C','D'],
          ['2004',  45,      87 ,60,16],
          ['2005',  67,      77,23,5],
          ['2006',  10,       102,52,7],
          ['2007',  6,     89,56,20],
          ['2008',  16,      57,10,27],
          ['2009',  35,      91,17,3],
          ['2010',  45,       125,34,0],
          ['2011',  30,     140,23,2]
        ]);

        var options = {
          title: 'KCSE Performance Trends',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
<?php $this->close(); ?>
<?php $this->open("body"); ?>
    
<?php  navigation();?>
<?php  sidebar();?>
<div class="row offset main" id="main">
    <h3 class="page-header">Admin Dashboard</h3>
    <section class="content">
        <div class="col col-md-5 one-half ">
            <div id="curve_chart" style=""></div>

        </div>
        
        <div class="col col-md-5 one-half">
            <h3 class="text-center">School Stats</h3>
            <div class="">
                Enrolled Students&nbsp;&nbsp;<span class="badge"><?= $data->adm_no?></span>
            </div>
            <div class="">
                New Students&nbsp;&nbsp;<span class="badge"><?= $data->name?></span>
            </div>
            <div class="">
                Students With Outstanding Balances&nbsp;&nbsp;<span class="badge"><?= $data->class_id?></span>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
   <hr> 
</div>

    

<?php $this->close(); ?>
