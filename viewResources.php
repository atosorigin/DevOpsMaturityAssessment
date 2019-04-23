<?php 
	
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	$isForm = FALSE;
	$activePage = 'Resources';
	
	require 'header.php';
	require 'renderAdvice.php';
	
?>
	
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-xl-9 col-lg-11  pt-0 pb-4 rounded text-left mx-auto">
				<div class="bg-light rounded p-2 p-sm-4 border-primary border ml-sm-2 ml-xs-2 mb-2 mr-sm-2 mr-xs-2">
						
						<?php
						
						foreach ($advice as $adviceIndex=>$adviceSection)
						{	
							if ( $adviceIndex != '//' ) {
						?>
						
						<div class="row">
							<div class="col-lg-12 mt-sm-4">
								<div class="card border-primary">
									<h5 class="card-header text-center text-white bg-primary">
										<?=$adviceIndex?>
									</h5>
									<div class="card-body p-1">
										<?php RenderAdvice($adviceIndex, false) ?>
									</div>
								</div>
							</div>
						
						
						</div>
						
						<?php 
							}
						} ?>
				</div>
			</div>

			
		
		</div>
		
	</div>
	
<script>
	
	Chart.defaults.global.animation.duration = 3000;

	new Chart(document.getElementById("chartOverallResults"), {
		type: 'radar',
		data: {
			labels: <?=$labels?>,
			datasets: [{
				lineTension: 0.4,
				label: '',
				pointStyle: 'circle',
				pointRadius: 5,
				data: <?=$data?>,
				pointBackgroundColor: 'rgba(99,255,132,1)',
				backgroundColor: 'rgba(99, 255, 132, 0.2)',
				borderColor: 'rgba(99,255,132,1)'
				}]
		},
		options: {
					responsive: true,
					title: {
						display: true,
						text: '<?=$chartTitle?>',
						fontSize: 16,
						fontColor: "white"
					},
					tooltips: {
						custom: function(tooltip) {
							if (!tooltip) return;
							// disable displaying the color box;
							tooltip.displayColors = false;
						},
						callbacks: {
							label: function(tooltipItem, data) {
								return tooltipItem.yLabel + '%';
							}
						}
					},
					legend: {
						display: false
					},
					scaleShowLabels: true,
					scale: {
						ticks: {
							display: false,
							beginAtZero: true,
							min: 0,
							max: 100,
							stepSize: 25,
							callback: function(value, index, values) {
								return value + '%';
							}
						},
						pointLabels: {
							fontSize: 14,
							fontColor: "white"
						},
						gridLines: { color: "white" },
						angleLines: { color: "white" }, 
					}
				}
		}
	);

</script>
	
<?php
	
	require 'footer.php';
	
?>		

	