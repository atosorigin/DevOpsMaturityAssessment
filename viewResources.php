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
				<div class="bg-light rounded pl-2 pl-sm-4 pr-2 pr-sm-4 pb-2 pb-sm-4 border-primary border ml-sm-2 ml-xs-2 mb-2 mr-sm-2 mr-xs-2">
						
						<?php
						
						foreach ($advice as $adviceIndex=>$adviceSection)
						{	
							if ( $adviceIndex != '//' ) {
						?>
						
						<div class="row">
							<div class="col-lg-12 mt-2 mt-sm-4">
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
	
<?php
	
	require 'footer.php';
	
?>		

	