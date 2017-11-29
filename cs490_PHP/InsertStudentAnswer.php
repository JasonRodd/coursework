<?php 
#Jason Rodd
#10-16-17

function InsertAStudentAnswer($connection, $post) {
	$returnString = "";
	
	$containsQNUM = empty($post['qnum']) ? False : True;
	$containsUserName = empty($post['username']) ? False : True;
	$containsQuestionId = empty($post['questionid']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsAnswer = empty($post['answer']) ? False : True;
	
	$jsonObj->validInsert = False;
	
	if($containsUserName && $containsQNUM && $containsQuestionId && $containsExamId && $containsAnswer){
		
		$insert = sprintf("INSERT INTO StudentAnswers ( qnum, username, questionid, examid, answer ) VALUES ( '%s', '%s', '%s', '%s', '%s' )" , $post['qnum'],$post['username'],$post['questionid'],$post['examid'],$post['answer']);
		
		if (mysqli_query($connection, $insert)) {
			$jsonObj->validInsert = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>