<?php 
#Jason Rodd
#10-16-17

function InsertAStudentQuestion($connection, $post) {
	$returnString = "";
	
	$containsUserName = empty($post['username']) ? False : True;
	$ContainsQNUM = empty($post['qnum']) ? False : True;
	$containsQuestionId = empty($post['questionid']) ? False : True;
	$ContainsExamId = empty($post['examid']) ? False : True;
	
	$jsonObj->validInsert = False;
	
	if($containsUserName && $ContainsQNUM && $containsQuestionId && $ContainsExamId){
		
		$insert = sprintf("INSERT INTO StudentQuestions ( qnum, username, questionid, examid ) VALUES ( '%s', '%s', '%s', '%s' )" , $post['qnum'],$post['username'],$post['questionid'],$post['examid']);
		
		if (mysqli_query($connection, $insert)) {
			$jsonObj->validInsert = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>
