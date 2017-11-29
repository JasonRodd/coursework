<?php 
#Jason Rodd
#10-16-17

function UpdateAStudentAnswer($connection, $post) {
	$returnString = "";
	
	
	
	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQuestionId = empty($post['questionid']) ? False : True;
	
	$containsAnswer = empty($post['answer']) ? False : True;
	
	$jsonObj->validUpdate = False;

	if($containsExamId && $containsUserName && $containsQuestionId && $containsAnswer){
	
		$update = sprintf("UPDATE StudentAnswers SET answer = '%s' WHERE examid = '%s' AND username = '%s' AND questionid = '%s'" , $post['answer'], $post['examid'], $post['username'], $post['questionid']);
		if (mysqli_query($connection, $update)) {
			$jsonObj->validUpdate = True;
		}
		
	}

	
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>