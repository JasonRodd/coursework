<?php 
#Jason Rodd
#10-14-17

function GradeAQuestion($post) {
	$returnString = "";
	
	#$username = $post['username'];
	#$examid = $post['examid'];
	#$questionid = $post['questionid'];

	$funcname = $post['funcname'];
	$arguments = $post['arguments'];
	$testcases = $post['testcase'];
	$rulesets = $post['ruleset'];
	$answer = $post['answer'];
	$multiplier = $post['multiplier'];
	
	#echo($funcname);
	#echo("<br>");
	#echo($arguments);
	#echo("<br>");
	#echo($testcases);
	#echo("<br>");
	#echo($rulesets);
	#echo("<br>");
	#echo($answer);
	#echo("<br>");
	#echo("<br>");
	
	
	$returnString = shell_exec("python /afs/cad/u/j/j/jjr42/cs490_PY/tester.py '$funcname' '$arguments' '$testcases' '$rulesets' '$answer' '$multiplier'");
	
	return $returnString;
}


?>
