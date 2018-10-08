<?php 
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */

	require 'survey.php'; 
	
	$survey = new Survey;
	
	// Create an array of onclick handlers for each link in the nav bar
	
	// Start with each section of the survey
	foreach ($survey->sections as $section)
	{
		$sectionURL = 'section-' . SectionNameToURLName($section['SectionName']);
		$navBarLinks[$section['SectionName']]['URL'] = $sectionURL;
	}
	
	// Now add the other links
	$navBarLinks['Questionaire']['URL'] = 'section-' . SectionNameToURLName($survey->sections[0]['SectionName']); // Link to first section
	$navBarLinks['Results']['URL'] = 'results';
	$navBarLinks['Download CSV']['URL'] = 'devops-maturity.csv';
	// TODO: Make detailed reports dynamic based on config
	$navBarLinks['Detailed Report Automation']['URL'] = 'results-automation';
	$navBarLinks['Detailed Report DevOps Practices']['URL'] = 'results-devops-practices';
	$navBarLinks['Detailed Report Org Structure']['URL'] = 'results-org-structure-culture-and-incentives';
	$navBarLinks['About']['URL'] = 'about';
	
	// Now create the right onClick handler for each URL
	foreach ($navBarLinks as $index=>$navBarLink)
	{
		$url = $navBarLink['URL'];
		if ( $isForm )
		{
			// If the page contains a form then we need to set the form action and submit
			$onClick = "$('form').attr('action', '$url'); $('form').submit();";
		}
		else
		{
			// If the page is not a form then just navigate to the right URL
			$onClick = "window.location = '$url';";
		}
		$navBarLinks[$index]['OnClick'] = $onClick;
	}
	 
	function SectionNameToURLName($sectionName) {
		return strtolower(str_replace(',', '', str_replace(' ', '-', $sectionName)));
	}
?>

<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">

		<title>DevOps Maturity Assessment</title>
		<script src="./js/chart.bundle.min.js"></script>		
		<style>
			#bigwrapper {
				background-image: url('backdrop.jpg');
				background-height: 100%;
				background-repeat: no-repeat;
				background-position: top center;
				background-attachment: fixed;
				padding-top: 100px;
			}
		</style>
		
	</head>
	
	<body id="bigwrapper">

	<nav class="navbar navbar-default navbar-dark fixed-top navbar-expand-md form-group" style="background-color: #000000;">
		<a href="#" class="navbar-brand">DevOps Maturity Assesment</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li>
					<a href="#" class="nav-link" onclick="<?=$navBarLinks['Questionaire']['OnClick']?>">Questionaire</a>
				</li>
				<li class="navbar-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Sections
					</a>
					<div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
						<?php foreach ($survey->sections as $section) { ?>
						<a class="dropdown-item" href="#" onclick="<?=$navBarLinks[$section['SectionName']]['OnClick']?>"><?=$section['SectionName']?></a>
						<?php }?>
					</div>
				</li>
				<li>
					<a href="#" class="nav-link active" onclick="<?=$navBarLinks['Results']['OnClick']?>">Results</a>
				</li>
				<li class="navbar-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Detailed Reports</a>
					<div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#" onclick="<?=$navBarLinks['Download CSV']['OnClick']?>">Download CSV</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#" onclick="<?=$navBarLinks['Detailed Report Automation']['OnClick']?>">Automation</a>
						<a class="dropdown-item" href="#" onclick="<?=$navBarLinks['Detailed Report DevOps Practices']['OnClick']?>">DevOps Practices</a>
						<a class="dropdown-item" href="#" onclick="<?=$navBarLinks['Detailed Report Org Structure']['OnClick']?>">Org Structure, Culture and Incentivisation</a>
					</div>
				</li>
				<li>
					<a href="#" class="nav-link"  onclick="<?=$navBarLinks['About']['OnClick']?>">About</a>
				</li>
			</ul>
		</div>
	</nav>	