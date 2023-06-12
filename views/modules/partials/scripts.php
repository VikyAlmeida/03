
	<!--====== Javascripts & Jquery ======-->
	<script src="./views/style1/js/mixitup.min.js"></script>
	<script src="./views/style1/js/circle-progress.min.js"></script>
	<script src="./views/style1/js/owl.carousel.min.js"></script>
	<script src="./views/style1/js/main.js"></script>
	<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->
	<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script>
		
		// datatables
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

		// secciones del menu
		const partial = localStorage.getItem('partial');
		if (partial === null) localStorage.setItem('partial', 'statistics');
		document.getElementById(partial).style.display = "flex";

		function getPartial (value) {
			console.log('hola');
			const partial =  localStorage.getItem('partial');
			localStorage.setItem("partial", value);
			location.reload();

			document.getElementById('statistics').style.display = "none";
			document.getElementById(partial).style.display = "none";
			document.getElementById(value).style.display = "flex";
		}

		// graficas
		const grafica1 = document.getElementById('myChart1');
		const grafica2 = document.getElementById('myChart2');
		const grafica3 = document.getElementById('myChart3');

		const array_users = <?= $users_json ?>;
		let data = [array_users[0].usersByRole, array_users[1].usersByRole];
		
		new Chart(grafica1,{
			type:'doughnut',
			data:{
				labels:['Administrador','Propietario','Usuario'],
				datasets:[{
					label: 'num',
					data: data, 
					backgroundColor: [
						'hsla(347, 100%, 92%, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
					],
				}]
			},
			options: {
				resposive:true
			}
		});
		new Chart(grafica2,{
			type:'polarArea',
			data:{
				labels:['Restaurantes','Moda'],
				datasets:[{
					label: 'num',
					data: [1, 2], 
					backgroundColor: [
						'hsla(347, 100%, 92%, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
					],
				}]
			},
			options: {
				resposive:true
			}
		});
		let i = 0;
		let a = 0;
		const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
		const date = new Date();
		const threeMonthActuals = [ date.getMonth(), date.getMonth()-1<0?meses.length-1:date.getMonth()-1, date.getMonth()-2<0?meses.length-2:date.getMonth()-2 ];
		const array_establishment = new Array(<?= $establishment_json ?>);
		let result = array_establishment.map((value) => threeMonthActuals.indexOf(parseInt(value.mes,10)-1)>-1 ? value : false);
		result = result.filter(value => value !== false);
		result = threeMonthActuals.sort(( a, b ) => { return a - b; }).map((mes) => { 
			a=i;
			if (result[i]) {
				if ((mes)+1 == result[i].mes) {
					i++;
					return result[a].establishemnByCreatedDate;
				} else {
					return 0;
				}
			}
			return 0;
		})
		new Chart(grafica3, {
			type: 'scatter',
			data: {
				labels: [meses[threeMonthActuals[0]],meses[threeMonthActuals[1]],meses[threeMonthActuals[2]]],
				datasets: [{
					type: 'bar',
					label: 'Barras graficas',
					data: [result[0],result[1],result[2]],
					borderColor: 'rgb(255, 99, 132)',
					backgroundColor: 'rgba(255, 99, 132, 0.2)'
				}, {
					type: 'line',
					label: 'Grafico de crecida',
					data: [result[0],result[1],result[2]],
					fill: false,
					borderColor: 'rgb(54, 162, 235)'
				}]
				},
			options: {
				scales: {
				y: {
					beginAtZero: true
				}
				}
			}
		});

	</script>