<?php 
#Jason Rodd
#11-25-17

function InsertAMultiplier($connection, $post) {
	$returnString = "";
	
	$containsQuestionId = empty($post['questionid']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsMultiplier = empty($post['multiplier']) ? False : True;
	
	$jsonObj->validInsert = False;
	
	if($containsQuestionId && $containsExamId && $containsMultiplier){
		
		$insert = sprintf("INSERT INTO ExamQuestionMultiplier ( examid, questionid, multiplier ) VALUES ( '%s', '%s', %s )" , $post['examid'],$post['questionid'],$post['multiplier']);
		
		if (mysqli_query($connection, $insert)) {
			$jsonObj->validInsert = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>