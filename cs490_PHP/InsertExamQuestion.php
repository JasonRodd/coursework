<?php 
#Jason Rodd
#10-11-17

function InsertAnExamQuestion($connection, $post) {
	$returnString = "";
	
	$containsQuestionId = empty($post['questionid']) ? False : True;
	$ContainsExamId = empty($post['examid']) ? False : True;
	
	$jsonObj->validInsert = False;
	
	if($containsQuestionId && $ContainsExamId){
		
		$insert = sprintf("INSERT INTO ExamQuestions ( examid, questionid ) VALUES ( '%s', '%s' )" ,$post['examid'], $post['questionid']);
		
		if (mysqli_query($connection, $insert)) {
			$jsonObj->validInsert = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>