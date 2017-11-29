<?php 
#Jason Rodd
#10-28-17

function DeleteAStudentComment($connection, $post) {
	$returnString = "";
	
	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQNUM = empty($post['qnum']) ? False : True;
	
	$jsonObj->validDelete = False;
	
	if($containsUserName && $containsExamId && $containsQNUM){
		
		$delete = sprintf("DELETE FROM StudentComments WHERE username = '%s' AND examid = '%s' AND qnum = '%s'", $post['username'],$post['examid'], $post['qnum']);
		
		if (mysqli_query($connection, $delete)) {
			$jsonObj->validDelete = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>