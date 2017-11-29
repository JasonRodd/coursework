<?php 
#Jason Rodd
#10-16-17

function DeleteAStudentAnswer($connection, $post) {
	$returnString = "";
	
	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQuestionId = empty($post['questionid']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsUserName && $containsExamId && $containsQuestionId){
		
		$delete = sprintf("DELETE FROM StudentAnswers WHERE username = '%s' AND examid = '%s' AND questionid = '%s'", $post['username'],$post['examid'], $post['questionid']);
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>