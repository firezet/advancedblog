  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Info', 'Count'],
          ['Page Views',     <?php echo $session->count; ?>],
          ['Comments', <?php echo Comment::countAll(); ?>],
          ['Users',  <?php echo User::countAll(); ?>],
          ['Photos',      <?php echo Photo::countAll(); ?>]
        ]);

        var options = {
          legend: "none",
          pieSliceText: "label",
          title: 'My Daily Activities',
          backgroundColor: "transparent"
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</body>

</html>
