<?php 
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/????/LICENSE) */
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
					<a href="#" class="nav-link">Questionaire</a>
				</li>
				<li class="navbar-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Sections
					</a>
					<div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#" onclick="$('form').attr('action', 'section-team-agility'); $('form').submit();">Team Agility</a>
						<a class="dropdown-item" href="#">Automation</a>
						<a class="dropdown-item" href="#">DevOps Practices</a>
					</div>
				</li>
				<li>
					<a href="#" class="nav-link active" onclick="$('form').attr('action', 'results'); $('form').submit();">Results</a>
				</li>
				<li class="navbar-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Detailed Reports</a>
					<div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">Download CSV</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Automation</a>
						<a class="dropdown-item" href="#">DevOps Practices</a>
						<a class="dropdown-item" href="#">Org Structure, Culture and Incentivisation</a>
					</div>
				</li>
				<li>
					<a href="#" class="nav-link">About</a>
				</li>
			</ul>
		</div>
	</nav>	