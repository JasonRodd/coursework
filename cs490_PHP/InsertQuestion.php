<?php 
#Jason Rodd
#10-11-17

function InsertAQuestion($connection, $post) {
	$returnString = "";
	
	$containsQuestion = empty($post['question']) ? False : True;
	$containsFuncname = empty($post['funcname']) ? False : True;
	$containsArguments = empty($post['arguments']) ? False : True;
	$containsCategory = empty($post['category']) ? False : True;
	$containsDifficulty = empty($post['difficulty']) ? False : True;
	$containsTestcase = empty($post['testcase']) ? False : True;
	$containsRuleset = empty($post['ruleset']) ? False : True;
	$containsName = empty($post['name']) ? False : True;
	
	$jsonObj->validInsert = False;
	
	if($containsQuestion && $containsFuncname && $containsArguments && $containsCategory && $containsDifficulty && $containsTestcase && $containsRuleset && $containsName){
		
		$insert = sprintf("INSERT INTO QuestionBank ( question, funcname, arguments, testcase, ruleset, category, difficulty, name ) VALUES ( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'  )" , $post['question'],$post['funcname'],$post['arguments'],$post['testcase'],$post['ruleset'],$post['category'],$post['difficulty'],$post['name']);
		
		if (mysqli_query($connection, $insert)) {
			$jsonObj->validInsert = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>