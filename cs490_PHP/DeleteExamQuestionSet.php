<?php 
#Jason Rodd
#10-11-17

function DeleteAnExamQuestionSet($connection, $post) {
	$returnString = "";
	
	$containsExamId = empty($post['examid']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsExamId){
		
		$delete = sprintf("DELETE FROM ExamQuestions WHERE examid = %s",$post['examid']);
		
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>