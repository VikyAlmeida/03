
	<!--====== Javascripts & Jquery ======-->
	<script src="./views/style1/js/jquery-3.2.1.min.js"></script>
	<script src="./views/style1/js/bootstrap.min.js"></script>
	<script src="./views/style1/js/mixitup.min.js"></script>
	<script src="./views/style1/js/circle-progress.min.js"></script>
	<script src="./views/style1/js/owl.carousel.min.js"></script>
	<script src="./views/style1/js/main.js"></script>
	<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
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