<?php
include('koneksi.php');
$negara = mysqli_query($koneksi,"select * from tb_covid");
while($row = mysqli_fetch_array($negara)){
	$country_other[] = $row['country_other'];
	$new_cases[] = $row['new_cases'];
	$total_deaths[] = $row['total_deaths'];
	$new_death[] = $row['new_death'];
	$total_recovered[] = $row['total_recovered'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart New Cases COVID-19</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>


	<!-- bar chart new cases -->
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($country_other); ?>,
				datasets: [
				{
					label: 'New Cases',
					data: <?php echo json_encode($new_cases); ?>,
					backgroundColor: 'rgba(0, 0, 255, 1)',
					borderColor: 'rgba(0,0,255,1)',
					//mengatur ketebalan garis
					borderWidth: 1
				},
				{
					label: 'Total Deaths',
					data: <?php echo json_encode($total_deaths); ?>,
					backgroundColor: 'rgba(0, 0, 0, 1)',
					borderColor: 'rgba(0, 0, 0,1)',
					//mengatur ketebalan garis
					borderWidth: 1
				},
				{
					label: 'New Death',
					data: <?php echo json_encode($new_death); ?>,
					backgroundColor: 'rgba(128, 128, 128, 1)',
					borderColor: 'rgba(128, 128, 128,1)',
					//mengatur ketebalan garis
					borderWidth: 1
				},
				{
					label: 'Total Recovered',
					data: <?php echo json_encode($total_recovered); ?>,
					backgroundColor: 'rgba(133, 245, 29, 1)',
					borderColor: 'rgba(133, 245, 29,1)',
					//mengatur ketebalan garis
					borderWidth: 1
				},
				]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>	
</body>
</html>