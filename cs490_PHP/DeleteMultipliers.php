<?php 
#Jason Rodd
#11-28-17

function DeleteAMultiplier($connection, $post) {
	$returnString = "";
	
	$containsQuestionId = empty($post['questionid']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsQuestionId && $containsExamId){
		
		$delete = sprintf("DELETE FROM ExamQuestionMultiplier WHERE examid = '%s' AND questionid = '%s'", $post['examid'], $post['questionid']);
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>