<?php 
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	$isForm = FALSE;
	$activePage = 'About';
	
	require 'header.php';

	function RenderTwitterLink($URL)
	{
		?>
		<a style="color:#00A3F3" href="<?=$URL?>" target="_blank">
			<span class="fa-stack fa-1x">
				<i class="fas fa-square fa-stack-2x"></i>
				<i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
			</span>
		</a>
		<?php
	}
	
	function RenderLinkedInLink($URL)
	{
		?>
		<a style="color:#0078B5" href="<?=$URL?>" target="_blank">
			<span class="fa-stack fa-1x">
				<i class="fas fa-square fa-stack-2x"></i>
				<i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
			</span>
		</a>  
		<?php
	}
	
?>

	<div class="container-fluid">
	<div class="row">
	<div class="col-xl-9 col-lg-11 m-2 pb-4 rounded text-center text-light mx-auto">
	

			<section class="jumbotron text-center bg-dark border-primary border">
				<div class="container">
					<h1 class="jumbotron-heading">Improve Your DevOps Capability</h1>
					<p class="lead">This online DevOps Maturity Assessment questionnaire will help you understand your current strengths and weaknesses and then recommend resources that can support you in taking the next steps on your DevOps journey.</p>
					<p>
						<a href="<?='section-' . SectionNameToURLName($survey->sections[0]['SectionName'])?>" class="btn btn-primary">Start the Questionnaire</a>
						<a href="https://github.com/atosorigin/DevOpsMaturityAssessment" target="_blank" class="btn btn-secondary">Fork us on GitHub</a>
					</p>
				</div>
			</section>
		
			<!-- Three columns of text below the jumbotron -->
			<div class="row">
			
				<div class="col-lg-4">
					<span class="fa-stack fa-5x mb-4">
						<i class="fas fa-circle fa-stack-2x text-primary"></i>
						<i class="far fa-chart-bar fa-stack-1x"></i>
					</span>
					<h2>Understand Where You Are</h2>
					<p class="text-justify">Our set of carefully designed questions across 7 different areas will help you quickly establish your current level of DevOps maturity.</p>
					<p class="text-justify">You can view the results online as well as downloading them in CSV format for more detailed analysis.</p>
				</div><!-- /.col-lg-4 -->
			
				<div class="col-lg-4">
					<span class="fa-stack fa-5x mb-4">
						<i class="fas fa-circle fa-stack-2x text-primary"></i>
						<i class="fas fa-shoe-prints fa-stack-1x"></i>
					</span>
					<h2>Identify Your Next Steps</h2>
					<p class="text-justify">For each area we have identified a range of free or commercially available books, videos, blog posts, white papers and websites that will help you take the next steps on your DevOps journey.</p>
				</div><!-- /.col-lg-4 -->
		  

				<div class="col-lg-4">
					<span class="fa-stack fa-5x mb-4">
						<i class="fas fa-circle fa-stack-2x text-primary"></i>
						<i class="fas fa-lock-open fa-stack-1x"></i>
					</span>
					<h2>Free and Open Source</h2>
					<p class="text-justify">This tool is made available under the MIT License: you are free to use, adapt and redistribute it, both for commercial and non-commercial use. There is no obligation to share your changes, although we always appreciate feedback! Why not <a href="https://github.com/atosorigin/DevOpsMaturityAssessment" target="_blank">fork us on GitHub</a>?</p>
		
				</div><!-- /.col-lg-4 -->
				
			</div><!-- /.row -->
		  
			<div class="row">
				<div class="col-lg-12">
					<p align="center"><em>We do not harvest your data and we will not share your results with anyone else.</em></p>
				</div>
			</div>
		  
			<section class="jumbotron text-center border border-primary bg-dark mt-2">
				<div class="container">
					<h1 class="jumbotron-heading">Meet The Team</h1>
					<p class="lead">This tool was created by members of the Atos Expert Community with contributions from many other practitioners across Atos and Worldline globally. You can find out more about the core team below.	</p>
				</div>
			</section>
		  
			<div class="row">
			
				<div class="col-lg-12">
					
					<div class="card-deck">
					
						<div class="card bg-transparent text-center">
							<div class="text-center">
								<img class="rounded-circle border border-primary mb-2" src="team-photos/CBH.jpg" alt="Generic placeholder image" width="140" height="140">
							</div>
							<div class="card-body pb-0 pt-0">
								<h6>Chris Baynham-Hughes</h6>	
								<p class="small">Head of UK Business Development RedHat Emerging Technologies & DevOps at Atos</p>
							</div>
							<div class="card-footer text-center pt-0">
								<?=RenderLinkedInLink('https://www.linkedin.com/in/chrisbh/')?>
								<?=RenderTwitterLink('https://twitter.com/OnlyChrisBH')?>	
							</div>
						</div>

	
						<div class="card bg-transparent text-center">
							<div class="text-center">
								<img class="rounded-circle border border-primary mb-2" src="team-photos/JC.jpg" alt="Generic placeholder image" width="140" height="140">
							</div>
							
							<div class="card-body  pb-0 pt-0">
								<h6>John Chatterton</h6>
								<p class="small">Principal Enterprise Architect</p>
							</div>
							<div class="card-footer text-center pt-0">
								<?=RenderLinkedInLink('https://www.linkedin.com/in/john-chatterton-73940a9/')?>
							</div>
						</div>

		
						<div class="card bg-transparent text-center">
							<div class="text-center">
								<img class="rounded-circle border border-primary mb-2" src="team-photos/DD.jpg" alt="Generic placeholder image" width="140" height="140">
							</div>
							<div class="card-body  pb-0 pt-0">
								<h6>David Daly</h6>								
								<p class="small">Global Deal Assurance Manager at Worldline</p>
							</div>
							<div class="card-footer text-center pt-0">
								<?=RenderLinkedInLink('https://www.linkedin.com/in/david-daly-fbcs-citp-7a84775/')?>
								<?=RenderTwitterLink('https://twitter.com/DavidDalyWL')?>
							</div>
						</div>
					

					</div>
					
				</div>
			</div>
			<div class="row mt-4">
				
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
					
					<div class="card-deck">
					
						<div class="card bg-transparent text-center">
							<div class="text-center">
								<img class="rounded-circle border border-primary mb-2" src="team-photos/PT.jpg" alt="Generic placeholder image" width="140" height="140">
							</div>
							<div class="card-body pb-0 pt-0">
								<h6>Panagiotis Tamtamis</h6>	
								<p class="small">Senior Software Engineer at Atos</p>
							</div>
							<div class="card-footer text-center pt-0">
								<?=RenderLinkedInLink('https://www.linkedin.com/in/panagiotis-tamtamis-2441a419/')?>
								<?=RenderTwitterLink('https://twitter.com/PTamis')?>	
							</div>
						</div>

	
						<div class="card bg-transparent text-center">
							<div class="text-center">
								<img class="rounded-circle border border-primary mb-2" src="team-photos/DU.jpg" alt="Generic placeholder image" width="140" height="140">
							</div>
							
							<div class="card-body  pb-0 pt-0">
								<h6>Dan Usher</h6>
								<p class="small">Head of Transformation, Digital Self Service at Worldline UK&I</p>
							</div>
							<div class="card-footer text-center pt-0">
								<?=RenderLinkedInLink('https://www.linkedin.com/in/daniel-usher-49198310/')?>
								<?=RenderTwitterLink('https://twitter.com/UsherDL')?>
							</div>
						</div>
					

					</div>
					
				
				</div><!-- /.col-lg-12 -->
				<div class="col-lg-2"></div>
			</div><!-- /.row -->
		
		
	
	</div><!-- /.col-lg-8 -->
	
	</div><!-- /.row -->
	
	</div><!-- /.container -->
	
<?php
	
	require 'footer.php';
	
?>		

	