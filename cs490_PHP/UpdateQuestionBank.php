<?php 
#Jason Rodd
#10-11-17

function UpdateAQuestion($connection, $post) {
	$returnString = "";
	
	$containsQuestionId = empty($post['questionid']) ? False : True;
	
	$containsQuestion = empty($post['question']) ? False : True;
	$containsFuncname = empty($post['funcname']) ? False : True;
	$containsArguments = empty($post['arguments']) ? False : True;
	$containsTestCase = empty($post['testcase']) ? False : True;
	$containsRuleset = empty($post['ruleset']) ? False : True;
	$containsCategory = empty($post['category']) ? False : True;
	$containsDifficulty = empty($post['difficulty']) ? False : True;
	$containsName = empty($post['name']) ? False : True;
	
	$jsonObj->validUpdate = False;
	
	if($containsQuestionId){
		
		$QuestionSet = $containsQuestion ? (($ContainsFuncname or $containsArguments or $containsTestCase or $ContainsRuleset or $ContainsCategory or $ContainsDifficulty or $ContainsName) ? sprintf("question = '%s',",$post['question']) : sprintf("question = '%s'",$post['question']) ) : "";
		$FunctionNameSet = $containsFuncname ? (($containsArguments or $containsTestCase or $ContainsRuleset or $ContainsCategory or $ContainsDifficulty or $ContainsName) ? sprintf("funcname = '%s',",$post['funcname']) : sprintf("funcname = '%s'",$post['funcname']) ) : "";
		$ArgumentsSet = $containsArguments ? (($containsTestCase or $ContainsRuleset or $ContainsCategory or $ContainsDifficulty or $ContainsName) ? sprintf("arguments = '%s',",$post['arguments']) : sprintf("arguments = '%s'",$post['arguments']) ) : "";
		$TestcaseSet = $containsTestCase ? (($ContainsRuleset or $ContainsCategory or $ContainsDifficulty or $ContainsName) ? sprintf("testcase = '%s',",$post['testcase']) : sprintf("testcase = '%s'",$post['testcase']) ) : "";
		$RulesetSet = $containsRuleset ? (($ContainsCategory or $ContainsDifficulty or $ContainsName) ? sprintf("ruleset = '%s',",$post['ruleset']) : sprintf("ruleset = '%s'",$post['ruleset']) ) : "";
		$CategorySet = $containsCategory ? (($ContainsDifficulty or $ContainsName) ? sprintf("category = '%s',",$post['category']) : sprintf("category = '%s'",$post['category']) ) : "";
		$DifficultySet = $containsDifficulty ? (($ContainsName) ? sprintf("difficulty = '%s',",$post['difficulty']) : sprintf("difficulty = '%s'",$post['difficulty']) ) : "";
		$NameSet = $containsName ?  sprintf("name = '%s'",$post['name']) : "";

		
		
		

	
		if($containsQuestion or $containsFuncname or $containsArguments or $containsTestCase or $containsRuleset or $containsCategory or $containsDifficulty or $containsName){
			$update = sprintf("UPDATE QuestionBank SET %s %s %s %s %s %s %s %s WHERE questionid = %s" , $QuestionSet, $FunctionNameSet, $ArgumentsSet, $TestcaseSet, $RulesetSet, $CategorySet, $DifficultySet, $NameSet, $post['questionid']);
			if (mysqli_query($connection, $update)) {
				$jsonObj->validUpdate = True;
			}
		}

	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}

?>