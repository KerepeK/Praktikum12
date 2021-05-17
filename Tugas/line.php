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
	<title>Line Chart COVID-19</title>
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
			type: 'line',
			data: {
				labels: <?php echo json_encode($country_other); ?>,
				datasets: [
				{
					label: 'New Cases',
					// Menghilangkan blok warna yang ada di bawah garis (menjadi garis saja)
					fill: false,
					data: <?php echo json_encode($new_cases); ?>,
					backgroundColor: 'rgba(0, 0, 255, 1)',
					borderColor: 'rgba(0,0,255,1)',
					//mengatur ketebalan garis
					borderWidth: 1
				},
				{
					label: 'Total Deaths',
					// Menghilangkan blok warna yang ada di bawah garis (menjadi garis saja)
					fill: false,
					data: <?php echo json_encode($total_deaths); ?>,
					backgroundColor: 'rgba(0, 0, 0, 1)',
					borderColor: 'rgba(0, 0, 0,1)',
					//mengatur ketebalan garis
					borderWidth: 1
				},
				{
					label: 'New Death',
					// Menghilangkan blok warna yang ada di bawah garis (menjadi garis saja)
					fill: false,
					data: <?php echo json_encode($new_death); ?>,
					backgroundColor: 'rgba(128, 128, 128, 1)',
					borderColor: 'rgba(128, 128, 128,1)',
					//mengatur ketebalan garis
					borderWidth: 1
				},
				{
					label: 'Total Recovered',
					// Menghilangkan blok warna yang ada di bawah garis (menjadi garis saja)
					fill: false,
					data: <?php echo json_encode($total_recovered); ?>,
					backgroundColor: 'rgba(133, 245, 29, 1)',
					borderColor: 'rgba(133, 245, 29,1)',
					//mengatur ketebalan garis
					borderWidth: 1
				},
				]
			},
			options: {
				//membuat garis tegak
				elements: {
			        line: {
			            tension: 0
			        }
			    },
				legend: {
					display: true
				},
				barValueSpacing: 20,
				scales: {
					yAxes: [{
						ticks: {
							//Mengatur nilai minimum
							min: 0,
						}
					}],
					xAxes: [{
						gridLines: {
							//mengatur agar baris vertikal muncul atau tidak dan berwarna apa
							color: "rgba(0, 0, 0, 0)",
						}
					}]
				}
			}
		});
	</script>
</body>
</html>