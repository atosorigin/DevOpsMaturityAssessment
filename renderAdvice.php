<?php 
	
	/* Copyright 2019 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	// Load the "next steps" advice from json file
	$json = file_get_contents("advice.json");
	$advice = json_decode($json, true);
	
	// Routine that renders the advice and links for one section
	function RenderAdvice($sectionName, $includeDetailedReportLink)
	{
		global $advice, $survey;
		
		// If we are providing advice for a section that has sub categories, then include a link to the detailed report
		$detailedReportLink = '';
		if ($includeDetailedReportLink)
		{
			if ( $survey->sections[$survey->SectionNameToIndex($sectionName)]['HasSubCategories'] )
			{
				$detailedReportLink = '</p><p>See also <a href="results-' . SectionNameToURLName($sectionName) . '">detailed report for ' .
										$sectionName . '</a>.';
			}
		}
			
		// If there is "ReadMore" advice included, create a link for this
		$readMoreLink = '';
		if ( isset($advice[$sectionName]['ReadMore']) )
		{
			$readMoreAdvice = str_replace('"', '&quot', $advice[$sectionName]['ReadMore']);
			$readMoreAdvice = str_replace("'", '&lsquo;', $readMoreAdvice);
			$sectionNameNoSpace = str_replace(' ', '', $sectionName);
			$readMoreJS = "onclick=\"$('#$sectionNameNoSpace').html('$readMoreAdvice');\"";
			$readMoreLink = '</p><p id="' . $sectionNameNoSpace . '"><a href="#/" ' . $readMoreJS . '>Show more advice >></a>';
		}
		
		?>
		
		<ul class="list-group list-group-flush">
			<li class="list-group-item"><p><?=$advice[$sectionName]['Advice'] . $readMoreLink . $detailedReportLink?></p></li>
			<?php foreach ( $advice[$sectionName]['Links'] as $link ) { 
				$icon = '';
				switch ($link['Type']) {
					case 'Video':
						$icon = 'fa fa-video';
						break;
					case 'Blog':
						$icon = 'fab fa-blogger';
						break;
					case 'Book':
						$icon = 'fas fa-book-open';
						break;
					case 'Website':
						$icon = 'fas fa-link';
						break;
					case 'Article':
						$icon = 'fas fa-file-alt';
						break;							
				}
				$paidIcon = '';
				if ( isset($link['Paid']) and $link['Paid'] == 'Yes' )
				{
					$paidIcon = '  <span class="fas fa-dollar-sign text-primary"></span>';
				}
				?>
				
				<li class="list-group-item"><span class="<?=$icon?> text-primary"></span><?=$paidIcon?>  <a class="card-link" target="_blank" href="<?=$link['Href']?>"><?=$link['Text']?></a></li>
			<?php } ?>						
		</ul>
	
	<?php
	} 

?>