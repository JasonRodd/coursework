<?php 
#Jason Rodd
#10-11-17

function UpdateAnExam($connection, $post) {
	$returnString = "";
	
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQuestioncount = empty($post['questioncount']) ? False : True;
	$containsName = empty($post['name']) ? False : True;
	$containsState = empty($post['state']) ? False : True;
	
	$jsonObj->validUpdate = False;
	
	if($containsExamId){
		
		$questionCountSet = $containsQuestioncount ? (($containsName or $containsState) ? sprintf("questioncount = '%s',",$post['questioncount']) : sprintf("questioncount = '%s'",$post['questioncount'])) : "";
		$nameSet = $containsName ? ($containsState ? sprintf("name = '%s',",$post['name']) : sprintf("name = '%s'",$post['name'])) : "";
		$stateSet = $containsState ? sprintf("state = '%s'",$post['state']) : "";
		
		if($containsQuestioncount or $containsName or $containsState){
			$update = sprintf("UPDATE Exams SET %s %s %s WHERE examid = %s" , $questionCountSet, $nameSet, $stateSet, $post['examid']);
			if (mysqli_query($connection, $update)) {
				$jsonObj->validUpdate = True;
			}
		}

	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>