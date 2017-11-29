<?php 
#Jason Rodd
#11-25-17

function UpdateAMultiplier($connection, $post) {
	$returnString = "";
	
	
	$containsQuestionId = empty($post['questionid']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsMultiplier = empty($post['multiplier']) ? False : True;
	
	$jsonObj->validUpdate = False;

	if($containsExamId && $containsQuestionId && $containsMultiplier){
	
		$update = sprintf("UPDATE ExamQuestionMultiplier SET multiplier = '%s' WHERE examid = '%s' AND questionid = '%s'" , $post['multiplier'], $post['examid'], $post['questionid']);
		if (mysqli_query($connection, $update)) {
			$jsonObj->validUpdate = True;
		}
		
	}

	
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>