
	<!--====== Javascripts & Jquery ======-->
	<script src="./views/style1/js/mixitup.min.js"></script>
	<script src="./views/style1/js/circle-progress.min.js"></script>
	<script src="./views/style1/js/owl.carousel.min.js"></script>
	<script src="./views/style1/js/main.js"></script>
	<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			$('#tableAdminUsers').DataTable( {
				"responsive" : true,
				"autoWidth" : false,
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
				}
			} );
			
			$('#tableAdminEstablishments').DataTable( {
				"responsive" : true,
				"autoWidth" : false,
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
				}
			} );
			$('#tableAdminCategories').DataTable( {
				"responsive" : true,
				"autoWidth" : false,
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
				}
			} );
		} );
	</script>
	