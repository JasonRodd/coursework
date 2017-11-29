<?php 
#Jason Rodd
#10-16-17

function DeleteAllOfStudentExamByExamID($connection, $post) {
	$returnString = "";
	
	$containsExamId = empty($post['examid']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsExamId){
		
		$delete = sprintf("DELETE FROM StudentExams WHERE examid = '%s'", $post['examid']);
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}

function DeleteAllOfStudentExamByUserName($connection, $post) {
	$returnString = "";
	
	$containsUserName = empty($post['username']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsUserName){
		
		$delete = sprintf("DELETE FROM StudentExams WHERE username = '%s'", $post['username']);
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}

?>

