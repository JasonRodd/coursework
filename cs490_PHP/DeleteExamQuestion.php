<?php 
#Jason Rodd
#10-11-17

function DeleteAnExamQuestion($connection, $post) {
	$returnString = "";
	
	$containsQuestionId = empty($post['questionid']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsQuestionId && $containsExamId){
		
		$delete = sprintf("DELETE FROM ExamQuestions WHERE questionid = %s AND examid = %s", $post['questionid'],$post['examid']);
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>