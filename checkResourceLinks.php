<?php 
	
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	$isForm = FALSE;
	$activePage = 'Resources';
	
	require 'header.php';
	require 'renderAdvice.php';
	
	function CheckURL($Href)
	{
		$urlHeaders = @get_headers($Href);
		if(!$urlHeaders || $urlHeaders[0] == 'HTTP/1.1 404 Not Found')
		{
			$exists = false;
		}
		else
		{
			$exists = true;
		}
		
		return $exists;
	}
	
?>
	
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-xl-9 col-lg-11  pt-0 pb-4 rounded text-left mx-auto">
				<div class="bg-light rounded p-2 p-sm-4 border-primary border ml-sm-2 ml-xs-2 mb-2 mr-sm-2 mr-xs-2">
						
						<?php
						
						$counter = 0;
						
						foreach ($advice as $adviceIndex=>$adviceSection)
						{	
							if ( $adviceIndex != "//" )
							{	
								foreach ( $adviceSection['Links'] as $link )
								{
									$counter++;
									$testText = '';
									if ( CheckURL($link['Href']) )
									{
										$testText = '<b><font color="green">OK</font></em></b>';
									}
									else
									{
										$testText = '<b><font color="red">Not Available</font></b>';
									}
						?>
						
								<p><?=$counter?>. <a href="<?=$link['Href']?>"><?=$link['Text']?></a> <?=$testText?></p>
						
						<?php 
								}
							}
						} ?>
				</div>
			</div>

			
		
		</div>
		
	</div>
	
	
<?php
	
	require 'footer.php';
	
?>		

	