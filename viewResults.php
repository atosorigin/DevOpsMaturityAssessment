<?php 
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	$isForm = FALSE;
	$activePage = 'Results';
	require 'header.php';

	// Create one variable with the labels and one with the data
	$resultsSummary = $survey->GenerateResultsSummary();	
	
	// Sort into the order they should be displayed on the spider diagram
	uasort( $resultsSummary, function($a, $b) { return $a['SpiderPos'] - $b['SpiderPos']; } );
	
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
	
	// Load the "next steps" advice from json file
	$json = file_get_contents("advice.json");
	$advice = json_decode($json, true);
	
	// Routine that renders the advice and links for one section
	function RenderAdvice($sectionName)
	{
		global $advice; ?>
		
		<ul class="list-group list-group-flush">
			<li class="list-group-item"><?=$advice[$sectionName]['Advice']?></li>
			<?php foreach ( $advice[$sectionName]['Links'] as $link ) { ?>
				<li class="list-group-item"><b><?=$link['Type']?>:</b> <a class="card-link" target="_blank" href="<?=$link['Href']?>"><?=$link['Text']?></a></li>
			<?php } ?>						
		</ul>
	
	<?php
	} 

	?>
	
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8" style="opacity: 1">
				<div class="rounded-top p-2 ml-2 mt-2 mr-2 border-top border-left border-right" style="opacity: 0.6; background-color: #000000;">
					<canvas  id="chartOverallResults"></canvas>
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
		
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8" style="opacity: 0.9 ">
				<div class="bg-light rounded-bottom p-2 ml-2 mb-2 mr-2">
				
					
						
						<div class="row">
							<div class="col-lg-12 mt-2">
								<p>The responses to the questionaire show that the 3 areas in which you are strongest are <?=array_keys($resultsSummary)[0]?>, <?=array_keys($resultsSummary)[1]?>, and <?=array_keys($resultsSummary)[2]?>.
								<p>The 3 areas where you have the most potential to improve are listed below, together with links to resources that you may find useful.</p>
							</div>
						</div>
				
						<?php
							// Now sort by lowest to highest score
							uasort( $resultsSummary, function($a, $b) { return $a['ScorePercentage'] - $b['ScorePercentage']; } );
						?>
				
						<div class="row">
							<div class="col-lg-6 mt-4 d-flex">
								<div class="card"  style="flex: 1">
									<h5 class="card-header text-center">
										<?=array_keys($resultsSummary)[0]?>
									</h5>
									<div class="card-body">
										<?php RenderAdvice(array_keys($resultsSummary)[0]) ?>
									</div>
									<div class="card-footer text-muted text-center">
										Your score: <?=$resultsSummary[array_keys($resultsSummary)[0]]['ScorePercentage']?>%
									</div>
								</div>
							</div>
							<div class="col-lg-6 mt-4 d-flex">
								<div class="card"  style="flex: 1">
									<h5 class="card-header text-center">
										<?=array_keys($resultsSummary)[1]?>
									</h5>
									<div class="card-body">
										<?php RenderAdvice(array_keys($resultsSummary)[1]) ?>
									</div>
									<div class="card-footer text-muted text-center">
										Your score: <?=$resultsSummary[array_keys($resultsSummary)[1]]['ScorePercentage']?>%
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-lg-12 mt-4 d-flex">
								<div class="card" style="flex: 1">
									<h5 class="card-header text-center">
										<?=array_keys($resultsSummary)[2]?>
									</h5>
									<div class="card-body">
										<?php RenderAdvice(array_keys($resultsSummary)[2]) ?>
									</div>
									<div class="card-footer text-muted text-center">
										Your score: <?=$resultsSummary[array_keys($resultsSummary)[2]]['ScorePercentage']?>%
									</div>
								</div>
							</div>
						
						
						</div>
					
				</div>
			</div>
			<div class="col-lg-2"></div>
			
		
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
						text: 'DevOps Maturity by Area',
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


new Chart(document.getElementById("chartDevOpsPractices"), {
    type: 'polarArea',
    data: {
      labels: ["CI", "CD", "Code Review", "TDD"],
      datasets: [
        {
          label: "",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [50,20,70,100]
        }
      ]
    },
    options: {
				responsive: true,
				title: {
					display: true,
					text: 'Deep Dive on DevOps Practices',
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
					display: true
				},
				scaleShowLabels: true,
				scale: {
					ticks: {
						display: false,
						beginAtZero: true,
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
	});


new Chart(document.getElementById("chartAutomation"), {
    type: 'polarArea',
    data: {
      labels: ["CI", "CD", "Code Review", "TDD", "Refactoring"],
      datasets: [
        {
          label: "",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [50,20,70,100, 30]
        }
      ]
    },
    options: {
				responsive: true,
				title: {
					display: true,
					text: 'Deep Dive on Automation',
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
					display: true
				},
				scaleShowLabels: true,
				scale: {
					ticks: {
						display: false,
						beginAtZero: true,
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
	});

new Chart(document.getElementById("chartOrgStructure"), {
    type: 'polarArea',
    data: {
      labels: ["CI", "CD", "Code Review", "TDD", "Refactoring"],
      datasets: [
        {
          label: "",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [50,20,70,100, 30]
        }
      ]
    },
    options: {
				responsive: true,
				title: {
					display: true,
					text: 'Deep Dive on Organisation Structure and Culture',
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
							return [data.labels[tooltipItem.index], tooltipItem.yLabel + '%'];
						}
					}
				},
				legend: {
					display: true
				},
				scaleShowLabels: true,
				scale: {
					ticks: {
						display: false,
						beginAtZero: true,
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
	});
 

</script>
	
<?php
	
	require 'footer.php';
	
?>		

	