<!--**********************************
    Footer start
***********************************-->
<div class="footer">
    <div class="copyright">
        <p>Copyright &copy; All Rights Reserved | Developed by Anisuzzaman <?php echo date("Y") ?></p>
    </div>
</div>
<!--**********************************
    Footer end
***********************************-->
</div>
<!--**********************************
Main wrapper end
***********************************-->

<!--**********************************
Scripts
***********************************-->
<script src="public/plugins/common/common.min.js"></script>
<script src="public/js/custom.min.js"></script>
<script src="public/js/settings.js"></script>
<script src="public/js/gleek.js"></script>
<script src="public/js/styleSwitcher.js"></script>

<!-- Chartjs -->
<script src="public/plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Circle progress -->
<script src="public/plugins/circle-progress/circle-progress.min.js"></script>
<!-- Datamap -->
<script src="public/plugins/d3v3/index.js"></script>
<script src="public/plugins/topojson/topojson.min.js"></script>
<script src="public/plugins/datamaps/datamaps.world.min.js"></script>
<!-- Morrisjs -->
<script src="public/plugins/raphael/raphael.min.js"></script>
<script src="public/plugins/morris/morris.min.js"></script>
<!-- Pignose Calender -->
<script src="public/plugins/moment/moment.min.js"></script>
<script src="public/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
<!-- ChartistJS -->
<script src="public/plugins/chartist/js/chartist.min.js"></script>
<script src="public/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
<!-- DataTable -->
<script src="public/plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="public/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="public/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

<script src="public/js/dashboard/dashboard-1.js"></script>

<!-- jqueryui date picker -->
<script src="public/js/jQuery/jquery-ui.js"></script>

<!-- jqueryui date picker -->
<script>
$( function() {
  $( ".jqdatepicker" ).datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    yearRange: '2000:2025'
  });
} );
</script>

<script>
      tinymce.init({
        selector: '#richTextEditor1',
        // plugins: [ 'quickbars' ],
        plugins: 'lists advlist autolink link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount',
        toolbar: 'numlist bullist link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount'
      });
      tinymce.init({
        selector: '#richTextEditor2',
        // plugins: [ 'quickbars' ],
        plugins: 'lists advlist autolink link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount',
        toolbar: 'numlist bullist link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount'
      });
</script>

</body>

</html>