		</div>
	</body>
</html>
<script type="text/javascript">
			function printContent(el){
			var restorepage = document.body.innerHTML;
			var printcontent = document.getElementById(el).innerHTML;
			document.body.innerHTML = printcontent;
			window.print();
			document.body.innerHTML = restorepage;
			window.location.reload();
			
		}
		</script>
<script src="js/jquery-1.10.2.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script src="js/general.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker1.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
<script src="js/jquery-ui.min.js"></script>