<?php 
#Jason Rodd
#10-11-17

function DeleteAQuestion($connection, $post) {
	$returnString = "";
	
	$containsQuestionId = empty($post['questionid']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsQuestionId){
		
		$delete = sprintf("DELETE FROM QuestionBank WHERE questionid = %s", $post['questionid']);
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>