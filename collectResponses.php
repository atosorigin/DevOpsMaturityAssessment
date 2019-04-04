<?php 
	/* Copyright 2018 Atos SE and Worldline
	 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE) */
	
	$isForm = TRUE;
	$activePage = 'Questionaire';
	require 'header.php';
?> 
 
	<div class="container-fluid">
	<form action="test.php" method="POST">
  
<?php

	// Determine which section of the assessment we are showing
	$uri = $_SERVER["REQUEST_URI"];
	$currentSection = explode("section-", $uri)[1];
	
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
?>

	<div class="row">
		<div class="col-xl-9 col-lg-11 m-2 pb-4 rounded text-center text-light mx-auto">
			<h3><?=$survey->sections[$sectionIndex]['SectionName']?></h3>
		

<?php	
	// Render all the question for the current section
	foreach ($survey->sections[$sectionIndex]['Questions'] as $index=>$question)
	{	
		renderQuestion($question, $index);	
	}
	?>

		</div>

	</div>
	
	<div class="row form-group">
	<div class="text-center col-lg-12">
		<div class="btn-group btn-group-justified">
			<?php if ($previousSection != '') { ?>
			<div class="btn-group">
				<button type="submit" class="btn btn-primary" onclick="$('form').attr('action', 'section-<?=$previousSection?>');">Previous</button>
			</div>
			<?php } ?>
			<?php if ($nextSection != '') { ?>
			<div class="btn-group" role="group">
				<button type="submit" class="btn btn-primary" onclick="$('form').attr('action', 'section-<?=$nextSection?>');">Next</button>
			</div>
			<?php } ?>
		</div>
		<!-- Show results button if we are on the final section -->
		<?php if ($nextSection == '') { ?>
			<button type="submit" class="btn btn-primary" onclick="$('form').attr('action', 'results');">View Results</button>
		<?php } ?>
	</div>
	</div>
	
	</form>
	</div>
	
	<?php
	
	require 'footer.php';
	
	function renderQuestion($question) { 
		
		?>
		
				<div class="card mt-4  ml-sm-2 ml-xs-0 mr-sm-2 mr-xs-0 text-left bg-dark border-primary border">
					<?php if ($question['Type']!='Banner') {?>
					<h6 class="card-header"><?=$question['QuestionText']?></h6>
					<?php } ?>
					<div class="card-body pt-1 pb-1 bg-gradient-secondary">
						<?php 
							switch ($question['Type']) {
								case 'Option':
									renderOptions($question);
									break;
								case 'Checkbox':
									renderCheckboxes($question);
									break;
								case 'Banner':
									echo $question['QuestionText'];
									break;
							} ?>
		
					</div>
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

	