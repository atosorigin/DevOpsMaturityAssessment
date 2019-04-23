<?php 
	
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	$isForm = FALSE;
	$activePage = 'Results';
	
	// Determine whether we are showing detailed results for one section
	$sectionURL = '';
	$uri = $_SERVER["REQUEST_URI"];
	if ( strpos($uri, "results-") )
	{
		$sectionURL = explode("results-", $uri)[1];
		$activePage = 'Detailed Reports';
	}
	
	require 'header.php';
	require 'renderAdvice.php';

	// Get either the overall results, or the results for the chosen sub-categories
	if ( $sectionURL == '' )
	{
		$resultsSummary = $survey->GenerateResultsSummary();
		// Sort into the order they should be displayed on the spider diagram
		uasort( $resultsSummary, function($a, $b) { return $a['SpiderPos'] - $b['SpiderPos']; } );	
		$chartTitle = 'DevOps Maturity by Area';
	}
	else
	{
		// Need to find the name of the section we want to view
		foreach ($survey->sections as $section)
		{
			if ( SectionnameToURLName($section['SectionName']) == $sectionURL )
			{
				$sectionName = $section['SectionName'];
			}
		}
		$resultsSummary = $survey->GenerateSubCategorySummary($sectionName);
		$chartTitle = 'Breakdown for ' . $sectionName;
	}
	
	// Create one variable with the labels and one with the data
	$labels = '[';
	$data = '[';
	
	foreach ($resultsSummary as $sectionName=>$result)
	{
		$labels .= '"' . $sectionName . '",';
		$data .= $result['ScorePercentage'] . ',';
	}
	
	// Replace trailing comma with closing square bracket
	$labels = substr($labels, 0, -1) . ']';
	$data = substr($data, 0, -1) . ']';
	
	// Now sort by highest to lowest score
	uasort( $resultsSummary, function($a, $b) { return $b['ScorePercentage'] - $a['ScorePercentage']; } );
	
	// Now create the preamble, telling people about strengths and weaknesses
	$preAmble = '';
	switch ( count($resultsSummary) )
	{
		case 3:
			$preAmble = '<p>Please find below links to resources that you may find useful for each of these areas.</p>';
			break;
		case 4:
			$preAmble = '<p>The responses to the questionaire show that the area in which you are strongest is ' . array_keys($resultsSummary)[0] . 
						'.</p><p>The 3 areas where you have the most potential to improve are listed below, together with links to resources that you may find useful.</p>';
			break;
		case 5:
			$preAmble = '<p>The responses to the questionaire show that the 2 areas in which you are strongest are ' . array_keys($resultsSummary)[0] . 
						' and ' . array_keys($resultsSummary)[1] . '.</p>' .
						'<p>The 3 areas where you have the most potential to improve are listed below, together with links to resources that you may find useful.</p>';
			break;
		default:
			$preAmble = '<p>The responses to the questionaire show that the 3 areas in which you are strongest are ' . array_keys($resultsSummary)[0] . 
						', ' . array_keys($resultsSummary)[1] . ' and ' . array_keys($resultsSummary)[2] . '.</p>' .
						'<p>The 3 areas where you have the most potential to improve are listed below, together with links to resources that you may find useful.</p>';
			break;
	}

?>
	
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-xl-9 col-lg-11 pb-0 rounded text-center text-light mx-auto">
				<div class="rounded-top p-2 ml-sm-2 ml-xs-2 mt-2 mr-sm-2 mr-xs-2 border-primary border-top border-left border-right" style="opacity: 0.6; background-color: #000000;">
					<canvas  id="chartOverallResults"></canvas>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xl-9 col-lg-11  pt-0 pb-4 rounded text-left mx-auto">
				<div class="bg-light rounded-bottom p-2 p-sm-4 border-primary border ml-sm-2 ml-xs-2 mb-2 mr-sm-2 mr-xs-2">
						<div class="row">
							<div class="col-lg-12">
								<?=$preAmble?>
							</div>
						</div>
				
						<?php
							// Now sort by lowest to highest score
							uasort( $resultsSummary, function($a, $b) { return $a['ScorePercentage'] - $b['ScorePercentage']; } );
						?>
				
						<div class="row">
							<div class="col-lg-12 mt-1">
								<div class="card-deck">
									<div class="card border-primary">
										<h5 class="card-header text-center text-white bg-primary">
											<?=array_keys($resultsSummary)[0]?>
										</h5>
										<div class="card-body p-1">
											<div>
											<?php RenderAdvice(array_keys($resultsSummary)[0], true) ?>
											</div>
										</div>
										<div class="card-footer text-center text-white bg-primary">
											Your score: <?=$resultsSummary[array_keys($resultsSummary)[0]]['ScorePercentage']?>%
										</div>
									</div>
									<div class="card border-primary">
										<h5 class="card-header text-center text-white bg-primary">
											<?=array_keys($resultsSummary)[1]?>
										</h5>
										<div class="card-body p-1">
											<?php RenderAdvice(array_keys($resultsSummary)[1], true) ?>
										</div>
										<div class="card-footer text-center text-white bg-primary">
											Your score: <?=$resultsSummary[array_keys($resultsSummary)[1]]['ScorePercentage']?>%
										</div>
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-lg-12 mt-sm-4">
								<div class="card border-primary">
									<h5 class="card-header text-center text-white bg-primary">
										<?=array_keys($resultsSummary)[2]?>
									</h5>
									<div class="card-body p-1">
										<?php RenderAdvice(array_keys($resultsSummary)[2], true) ?>
									</div>
									<div class="card-footer text-center text-white bg-primary">
										Your score: <?=$resultsSummary[array_keys($resultsSummary)[2]]['ScorePercentage']?>%
									</div>
								</div>
							</div>
						
						
						</div>
					
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

	