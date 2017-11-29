<?php 
#Jason Rodd
#10-11-17

function InsertAnExam($connection, $post) {
	$returnString = "";
	
	
	$containsQuestioncount = empty($post['questioncount']) ? False : True;
	$containsName = empty($post['name']) ? False : True;
	$containsState = empty($post['state']) ? False : True;
	
	$jsonObj->validInsert = False;
	
	if($containsState && $containsQuestioncount && $containsName){
		
		$insert = sprintf("INSERT INTO Exams ( questioncount, name, state) VALUES ( '%s', '%s', '%s' )" , $post['questioncount'], $post['name'], $post['state']);
		
		if (mysqli_query($connection, $insert)) {
			$jsonObj->validInsert = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>
