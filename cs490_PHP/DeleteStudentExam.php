<?php 
#Jason Rodd
#10-16-17

function DeleteAStudentExam($connection, $post) {
	$returnString = "";
	
	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsUserName && $containsExamId){
		
		$delete = sprintf("DELETE FROM StudentExams WHERE username = '%s' AND examid = '%s'", $post['username'],$post['examid']);
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>
