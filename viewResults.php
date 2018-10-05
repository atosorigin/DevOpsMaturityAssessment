<?php 
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	require 'header.php';
	require 'survey.php'; 

	// Create one variable with the labels and one with the data
	$survey = new Survey;
	$resultsSummary = $survey->GenerateResultsSummary();	
	
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
								<p>The responses to the questionaire show that the 3 areas in which you are strongest are Standardisation, DevOps Practices, and Automation.
								<p>The 3 areas where you have the most potential to improve are listed below, together with links to resources that you may find useful.</p>
							</div>
						</div>
				
						<div class="row">
							<div class="col-lg-6 mt-4 d-flex">
								<div class="card"  style="flex: 1">
									<h5 class="card-header text-center">
										Collaboration
									</h5>
									<div class="card-body">
										
									
										<ul class="list-group list-group-flush">
											<li class="list-group-item"><b>Video:</b> <a class="card-link" href="https://martinfowler.com/articles/extract-data-rich-service.html#Step8.PointNewServiceToTheNewDatabase">How to extract a data-rich service from a monolith</a></li>
											<li class="list-group-item"><b>Blog:</b> <a class="card-link" href="#">How to build great teams</a></li>
											<li class="list-group-item"><b>Book:</b> <a class="card-link" href="#">How to build great teams</a></li>
										</ul>
									</div>
									<div class="card-footer text-muted text-center">
										Your score: 78%
									</div>
								</div>
							</div>
							<div class="col-lg-6 mt-4 d-flex">
								<div class="card"  style="flex: 1">
									<h5 class="card-header text-center">
										Organisation Structure, Culture and Incentives
									</h5>
									<div class="card-body">
										
									
										<ul class="list-group list-group-flush">
											<li class="list-group-item"><b>Video:</b> <a class="card-link" href="#">How to build great teams blah blah blah blah blah</a></li>
											<li class="list-group-item"><b>Blog:</b> <a class="card-link" href="#">How to build great teams</a></li>
											<li class="list-group-item"><b>Book:</b> <a class="card-link" href="#">How to build great teams</a></li>
										</ul>
									</div>
									<div class="card-footer text-muted text-center">
										Your score: 78%
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-lg-12 mt-4 d-flex">
								<div class="card" style="flex: 1">
									<h5 class="card-header text-center">
										Collaboration
									</h5>
									<div class="card-body">
										
									
										<ul class="list-group list-group-flush">
											<li class="list-group-item"><b>Video:</b> <a class="card-link" href="#">How to build great teams</a></li>
											<li class="list-group-item"><b>Blog:</b> <a class="card-link" href="#">How to build great teams</a></li>
											<li class="list-group-item"><b>Book:</b> <a class="card-link" href="#">How to build great teams</a></li>
										</ul>
									</div>
									<div class="card-footer text-muted text-center">
										Your score: 78%
									</div>
								</div>
							</div>
						
						
						</div>
					
				</div>
			</div>
			<div class="col-lg-2"></div>
			
		
		</div>
		
	</div>
		
		
		<!--
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<div class="bg-dark rounded-top p-2 ml-2 mt-2 mr-2" style="opacity: 0.7">
					<canvas id="chartDevOpsPractices"></canvas>
				</div>
				<div class="bg-light rounded-bottom p-2 ml-2 mb-2 mr-2 text-dark" style="opacity: 0.7">
				
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam dapibus fermentum ipsum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Phasellus rhoncus. Aliquam erat volutpat. Integer lacinia. Nulla non arcu lacinia neque faucibus fringilla. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Phasellus rhoncus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent dapibus. Aliquam ornare wisi eu metus. Suspendisse sagittis ultrices augue. Etiam bibendum elit eget erat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero.
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<div class="bg-dark rounded-top p-2 ml-2 mt-2 mr-2" style="opacity: 0.7">
					<canvas id="chartAutomation"></canvas>
				</div>
				<div class="bg-light rounded-bottom p-2 ml-2 mb-2 mr-2 text-dark" style="opacity: 0.7">
				
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam dapibus fermentum ipsum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Phasellus rhoncus. Aliquam erat volutpat. Integer lacinia. Nulla non arcu lacinia neque faucibus fringilla. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Phasellus rhoncus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent dapibus. Aliquam ornare wisi eu metus. Suspendisse sagittis ultrices augue. Etiam bibendum elit eget erat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero.
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<div class="bg-dark rounded-top p-2 ml-2 mt-2 mr-2" style="opacity: 0.7">
					<canvas id="chartOrgStructure"></canvas>
				</div>
				<div class="bg-light rounded-bottom p-2 ml-2 mb-2 mr-2 text-dark" style="opacity: 0.7">
				
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam dapibus fermentum ipsum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Phasellus rhoncus. Aliquam erat volutpat. Integer lacinia. Nulla non arcu lacinia neque faucibus fringilla. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Phasellus rhoncus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent dapibus. Aliquam ornare wisi eu metus. Suspendisse sagittis ultrices augue. Etiam bibendum elit eget erat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero.
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
	</div>	
	-->
	



	
<script>

	
	Chart.defaults.global.animation.duration = 0;

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

	