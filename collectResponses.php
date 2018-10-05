<?php 
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	require 'header.php';
	require 'survey.php'; 
?> 
 
	<div class="container-fluid">
	<form action="test.php" method="POST">
  
<?php

	$survey = new Survey;

	// Determine which section of the assessment we are showing
	if (isset($_GET['Section']))
	{
		$currentSection = $_GET['Section'];
	}
	else
	{
		// TODO: Better default handling
		$currentSection = 'introduction';
	}
	
	// Find the current section in our model
	$sectionIndex = 0;
	foreach ($survey->sections as $index=>$section)
	{
		if ( SectionnameToURLName($section['SectionName']) == $currentSection )
		{
			$sectionIndex = $index;
		}
	}
	
	// Determine the URL names for the next and previous sections
	$nextSection = '';
	if ( $sectionIndex<sizeof($survey->sections)-1 )
	{
		$nextSection = SectionnameToURLName($survey->sections[$sectionIndex + 1]['SectionName']);
	}
	$previousSection = '';
	if ( $sectionIndex>0 )
	{
		$previousSection = SectionnameToURLName($survey->sections[$sectionIndex - 1]['SectionName']);
	}
	
	// Render all the question for the current section
	foreach ($survey->sections[$sectionIndex]['Questions'] as $index=>$question)
	{	
		renderQuestion($question, $index);	
	}
	
	?>
	
	<div class="row form-group">
	<div class="text-center col-lg-12">
		<div class="btn-group btn-group-justified">
			<?php if ($previousSection != '') { ?>
			<div class="btn-group">
				<button type="submit" class="btn btn-dark" onclick="$('form').attr('action', 'section-<?=$previousSection?>');">Previous</button>
			</div>
			<?php } ?>
			<?php if ($nextSection != '') { ?>
			<div class="btn-group" role="group">
				<button type="submit" class="btn btn-dark" onclick="$('form').attr('action', 'section-<?=$nextSection?>');">Next</button>
			</div>
			<?php } ?>
		</div>
	</div>
	</div>
	
	</form>
	</div>
	
	<?php
	
	require 'footer.php';
	
	function SectionNameToURLName($sectionName) {
		return strtolower(str_replace(',', '', str_replace(' ', '-', $sectionName)));
	}
	
	function renderQuestion($question) { 
		
		?>
		<div class="row form-group">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<div class="card <?=$question['Type']=='Banner' ? 'bg-dark text-white' : ''?>" style="opacity: 0.7">
					<div class="card-body my-2">
						<h6 class="card-subtitle"> <?=$question['QuestionText']?> </h6>
		
						<?php 
							switch ($question['Type']) {
								case 'Option':
									renderOptions($question);
									break;
								case 'Checkbox':
									renderCheckboxes($question);
									break;
							} ?>
		
					</div>
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
		
		<?php
	}
	
	function renderCheckboxes($question) { 
		
		// We render a hidden field for each checkbox to enable us to recognise if chckboxes have been unchecked
		foreach ($question['Answers'] as $index=>$answer) { ?>
			<div class="custom-control custom-checkbox my-2">
			<input type="checkbox" class="custom-control-input" id="<?=$answer['ID']?>" name="<?=$answer['ID']?>" <?=$answer['Value']?>>
			<input type="hidden" name="<?=$answer['ID']?>-hidden" value="0" />
			<label class="custom-control-label" for="<?=$answer['ID']?>" name="<?=$answer['ID']?>"><?=$answer['Answer']?></label>
			</div>
		<?php } 
	
	}
	
	function renderOptions($question) { 
		
		foreach ($question['Answers'] as $index=>$answer) { ?>
			<div class="custom-control custom-radio my-2">
			<input type="radio" class="custom-control-input" id="<?=$answer['ID']?>" value="<?=$answer['ID']?>" name="<?=$question['ID']?>" <?=$answer['Value']?>>
			<label class="custom-control-label" for="<?=$answer['ID']?>"><?=$answer['Answer']?></label>
			</div>
		<?php } 
	}
	
?>	

	