<?php 
#Jason Rodd
#10-11-17

function DeleteAnExam($connection, $post) {
	$returnString = "";
	
	$containsExamId = empty($post['examid']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsExamId){
		
		$delete = sprintf("DELETE FROM Exams WHERE examid = %s", $post['examid']);
		echo($delete);
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>