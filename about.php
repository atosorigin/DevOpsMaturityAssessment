<?php 
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	$isForm = FALSE;
	$activePage = 'About';
	
	require 'header.php';

?>

	<div class="container-fluid">
	<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8 mb-4 pb-4 rounded border text-light pt-4 text-center">
	
		<div class="container">

			<section class="jumbotron text-center bg-dark" style="opacity: 0.9">
				<div class="container">
					<h1 class="jumbotron-heading">Improve Your DevOps Capability</h1>
					<p class="lead">This online DevOps Maturity Assessment questionaire will help you understand your current strengths and weeknesses and then recommend resources that can support you in taking the next steps on your DevOps journey.</p>
					<p>
						<a href="<?='section-' . SectionNameToURLName($survey->sections[0]['SectionName'])?>" class="btn btn-primary">Start the Questionaire</a>
						<a href="https://github.com/atosorigin/DevOpsMaturityAssessment" target="_blank" class="btn btn-secondary">Fork us on GitHub</a>
					</p>
				</div>
			</section>
		
			<!-- Three columns of text below the jumbotron -->
			<div class="row">
			
				<div class="col-lg-4">
					<span class="fa-stack fa-5x mb-2">
						<i class="fas fa-circle fa-stack-2x text-primary"></i>
						<i class="far fa-chart-bar fa-stack-1x"></i>
					</span>
					<h2>Understand Where You Are</h2>
					<p align="left">Our set of carefully designed questions accross 6 different areas will help you quickly establish your current level of DevOps maturity.</p>
					<p align="left">You can view the results online as well as downloading them in CSV format for more detailed analysis.</p>
				</div><!-- /.col-lg-4 -->
			
				<div class="col-lg-4">
					<span class="fa-stack fa-5x mb-2">
						<i class="fas fa-circle fa-stack-2x text-primary"></i>
						<i class="fas fa-shoe-prints fa-stack-1x"></i>
					</span>
					<h2>Identify Next Steps</h2>
					<p align="left">For each area we have identified a range of free or commercially available books, videos, blog posts, white papers and websites that will help you take the next steps on your DevOps journey.</p>
				</div><!-- /.col-lg-4 -->
		  

				<div class="col-lg-4">
					<span class="fa-stack fa-5x mb-2">
						<i class="fas fa-circle fa-stack-2x text-primary"></i>
						<i class="fas fa-lock-open fa-stack-1x"></i>
					</span>
					<h2>Free and Open Source</h2>
					<p align="left">This tool is made avaialble under the MIT License: you are free to use, adapt and redistribute it, both for commercial and non-commercial use. There is no obligation to share your changes, although we always appreciate feedback! Why not <a href="https://github.com/atosorigin/DevOpsMaturityAssessment" target="_blank">fork us on GitHub</a>?</p>
		
				</div><!-- /.col-lg-4 -->
				
			</div><!-- /.row -->
		  
			<div class="row">
				<div class="col-lg-12">
					<p align="center"><em>We do not harvest your data and we will not share your results with anyone else.</em></p>
				</div>
			</div>
		  
			<section class="jumbotron text-center bg-dark" style="opacity: 0.9">
				<div class="container">
					<h1 class="jumbotron-heading">Meet The Team</h1>
					<p class="lead">This tool was created by members of the Atos Expert Community with contributions from many other practitioners accross Atos and Worldline globally. You can find out more about the core team below.	</p>
				</div>
			</section>
		  
			<div class="row">
			
				<div class="col-lg-4">
					<img class="rounded-circle border mb-2" src="team-photos/CBH.jpg" alt="Generic placeholder image" width="140" height="140">
					<div style="height: 80px;">
						<h6>Chris Baynham-Hughes</h6>
						<p class="small">Head of UK Business Development RedHat Emerging Technologies & DevOps at Atos</p>
					</div>
					<p><a class="fab fa-linkedin fa-2x" href="https://www.linkedin.com/in/chrisbh/" target="_blank"></a>  <a class="fab fa-twitter-square fa-2x" href="https://twitter.com/OnlyChrisBH" target="_blank"></a></p>
				</div><!-- /.col-lg-4 -->
				
				<div class="col-lg-4">
					<img class="rounded-circle border mb-2" src="team-photos/JC.jpg" alt="Generic placeholder image" width="140" height="140">
					<div style="height: 80px;">
						<h6>John Chatterton</h6>
						<p class="small">Principal Enterprise Architect at Atos</p>
					</div>
					<p><a class="fab fa-linkedin fa-2x" href="https://www.linkedin.com/in/john-chatterton-73940a9/" target="_blank"></a>
				</div><!-- /.col-lg-4 -->
			
				<div class="col-lg-4">
					<img class="rounded-circle border mb-2" src="team-photos/DD.jpg" alt="Generic placeholder image" width="140" height="140">
					<div style="height: 80px;">
						<h6>David Daly</h6>
						<p class="small">Global Deal Assurance Manager at Worldline</p>
					</div>
					<p><a class="fab fa-linkedin fa-2x" href="https://www.linkedin.com/in/david-daly-fbcs-citp-7a84775/" target="_blank"></a>  <a class="fab fa-twitter-square fa-2x" href="https://twitter.com/DavidDalyWL" target="_blank"></a></p>
				</div><!-- /.col-lg-4 -->
		
			</div><!-- /.row -->
		
		
			<div class="row mt-4">
			
				<div class="col-lg-2"></div>
			
				<div class="col-lg-4">
					<img class="rounded-circle border mb-2" src="team-photos/PT.jpg" alt="Generic placeholder image" width="140" height="140">
					<div style="height: 80px;">
						<h6>Panagiotis Tamtamis</h6>
						<p class="small">Senior Software Engineer at Atos</p>
					</div>
					<p><a class="fab fa-linkedin fa-2x" href="https://www.linkedin.com/in/panagiotis-tamtamis-2441a419/" target="_blank"></a>  <a class="fab fa-twitter-square fa-2x" href="https://twitter.com/PTamis" target="_blank"></a></p>
				</div><!-- /.col-lg-4 -->
			
				<div class="col-lg-4">
					<img class="rounded-circle border mb-2" src="team-photos/DU.jpg" alt="Generic placeholder image" width="140" height="140">
					<div style="height: 80px;">
						<h6>Dan Usher</h6>
						<p class="small">Head of Transformation, Digital Self Service at Worldline UK&I</p>
					</div>
					<p><a class="fab fa-linkedin fa-2x" href="https://www.linkedin.com/in/daniel-usher-49198310/" target="_blank"></a>  <a class="fab fa-twitter-square fa-2x" href="https://twitter.com/UsherDL" target="_blank"></a></p>
				</div><!-- /.col-lg-4 -->
		  
			</div><!-- /.row -->
			
			<div class="col-lg-2"></div>
		
		</div><!-- /.container -->
	
	</div><!-- /.col-lg-8 -->
	
	<div class="col-lg-2"></div>
	
	</div><!-- /.row -->
	
	</div><!-- /.container -->
	
<?php
	
	require 'footer.php';
	
?>		

	