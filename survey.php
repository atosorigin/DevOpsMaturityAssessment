<?php

/* Copyright 2018 Atos SE and Worldline
 * Licensed under MIT (https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE)
 
 */

session_name('devopsassessment');
session_start();

Class Survey
{
	public $sections;

	public function __construct() 
	{
		// Load all the questions into session storage if we haven't already done so
		if (!isset($_SESSION['Sections'])) {
			$json = file_get_contents("questions.json");
			$_SESSION['Sections'] = json_decode($json, true);
		}
		$this->sections = &$_SESSION['Sections'];
		$this->SetupAnswerIDs(); // TODO: This should only be called first time we setup the Sections sesssion variable
		$this->SaveResponses();
	}
	
	public function GenerateResultsSummary()
	{
		foreach ($this->sections as $section)
		{
			$summaryResults[$section['SectionName']] = array('MaxScore'=>0, 'Score'=>0, 'ScorePercentage'=>0);
			if ( isset($section['SpiderPos']) )
			{
				$summaryResults[$section['SectionName']]['SpiderPos'] = $section['SpiderPos'];
			}
			
			foreach ($section['Questions'] as $question)
			{
				$summaryResults[$section['SectionName']]['MaxScore'] += $this->GetQuestionMaxScore($question); 
				$summaryResults[$section['SectionName']]['Score'] += $this->GetQuestionScore($question);
			}
			
			if ( $summaryResults[$section['SectionName']]['MaxScore'] != 0 )
			{
				$summaryResults[$section['SectionName']]['ScorePercentage'] = 
					round( $summaryResults[$section['SectionName']]['Score'] /
							$summaryResults[$section['SectionName']]['MaxScore'] * 100);
			}
			
			// Do not include sections where you cannot score (i.e. MaxScore == 0)
			if ( $summaryResults[$section['SectionName']]['MaxScore'] == 0 )
			{
				unset($summaryResults[$section['SectionName']]);
			}
		}
		
		return $summaryResults;
	}
	
	// returns summary results for the sub-categories in a specified section
	public function GenerateSubCategorySummary($sectionName)
	{
		foreach ($this->sections as $section)
		{
			if ( $section['SectionName'] == $sectionName )
			{
				foreach ($section['Questions'] as $question)
				{
					if ( isset($question['SubCategory']) )
					{
						if ( !isset($summaryResults[$question['SubCategory']]) )
						{
							// If we haven't yet added an entry into the summary results for this sub-category, then add one
							$summaryResults[$question['SubCategory']] = array('MaxScore'=>0, 'Score'=>0, 'ScorePercentage'=>0);
						}
						
						$summaryResults[$question['SubCategory']]['MaxScore'] += $this->GetQuestionMaxScore($question); 
						$summaryResults[$question['SubCategory']]['Score'] += $this->GetQuestionScore($question);
					}
				}
			}
		}
		
		foreach ($summaryResults as &$subCategory)
		{
			$subCategory['ScorePercentage'] = 
					round( $subCategory['Score'] / $subCategory['MaxScore'] * 100);	
		}
		
		return $summaryResults;
	}
	
	public function GetQuestionMaxScore($question)
	{
		$maxScore = 0;
		if ($question['Type'] != 'Banner')
		{
			foreach ($question['Answers'] as $answer)
			{
				if ($question['Type'] == 'Option')
				{
					if ($answer['Score'] > $maxScore)
					{
						$maxScore = $answer['Score'];
					}
				}
				if ($question['Type'] == 'Checkbox')
				{
					$maxScore += $answer['Score'];
				}
			}
		}
		
		return $maxScore;
	}

	public function GetQuestionScore($question)
	{
		$score = 0;
		if ($question['Type'] != 'Banner')
		{
			foreach ($question['Answers'] as $answer)
			{
				if ($answer['Value'] == 'checked')
				{
					$score += $answer['Score'];
				}
			}
		}
		
		return $score;
	}
	
	public function SectionNameToIndex($sectionName)
	{
		$sectionIndex = 0;
		foreach ($this->sections as $index=>$section)
		{
			if ( $section['SectionName'] == $sectionName )
			{
				$sectionIndex = $index;
				break;
			}
		}
		return $sectionIndex;
	}
	
	private function SetupAnswerIDs()
	{	
		// Loop through the model and assign a unique ID to each question and answer to assist with form rendering and submission
		foreach ($this->sections as $sectionIndex=>&$section)
		{
			if ( !isset($section['HasSubCategories']) )
			{
				$section['HasSubCategories'] = FALSE;
			}
			foreach ($section['Questions'] as $questionIndex=>&$question)
			{
				if ( $question['Type'] != 'Banner')
				{
					$question['ID'] = 'S' . ($sectionIndex + 1) . '-Q' . ($questionIndex + 1);
					
					if ( !isset($question['Answers']) )
					{
						// Add default yes/no answers
						$question['Answers'] = array( array('Answer' => 'Yes', 'Score' => 1), array('Answer' => 'No', 'Score' => 0) );
					}
					
					foreach ($question['Answers'] as $answerIndex=>&$answer)
					{
						$answer['ID'] = 'S' . ($sectionIndex + 1) . '-Q' . ($questionIndex + 1) . '-A' . ($answerIndex + 1);
						if (!isset($answer['Value']))
						{
							$answer['Value'] = '';
						}
					}
				}
				if ( isset($question['SubCategory']) )
				{
					$section['HasSubCategories'] = TRUE;
				}			
			}
		}
	}
	
	private function SaveResponses()
	{	
		// Loop through each question in our session storage and, if we find post variable matching the question ID, then save the answer
		foreach ($this->sections as $sectionIndex=>&$section)
		{
			foreach ($section['Questions'] as $questionIndex=>&$question)
			{
				if ( $question['Type'] == 'Option' )
				{
					if ( isset($_POST[$question['ID']]) )
					{
						foreach ($question['Answers'] as $answerIndex=>&$answer)
						{
							if ( $answer['ID'] == $_POST[$question['ID']] )
							{
								$answer['Value'] = 'checked';
							}
							else
							{
								$answer['Value'] = '';
							}
						}
					}
				}
				
				if ( $question['Type'] == 'Checkbox' )
				{
					foreach ($question['Answers'] as $answerIndex=>&$answer)
					{
						// If hidden field is there then we can use the presense of the non-hidden field to determine if the checkbox was checked
						if ( isset($_POST[$answer['ID'] . '-hidden']) )
						{
							if ( isset($_POST[$answer['ID']] ) )
							{
								$answer['Value'] = 'checked';
							}
							else
							{
								$answer['Value'] = '';
							}
						}
					}
				}
			}
		}
	}
	
}

?>