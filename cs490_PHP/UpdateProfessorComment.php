<?php 
#Jason Rodd
#11-5-17

function UpdateAProfessorComment($connection, $post) {
	$returnString = "";
	
	
	
	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQNUM = empty($post['qnum']) ? False : True;
	
	$containsComments = empty($post['comment']) ? False : True;
	
	$jsonObj->validUpdate = False;

	if($containsExamId && $containsUserName && $containsQNUM && $containsComments){
	
		$update = sprintf("UPDATE ProfessorComments SET comment = '%s' WHERE examid = '%s' AND username = '%s' AND qnum = '%s'" , $post['comment'], $post['examid'], $post['username'], $post['qnum']);
		if (mysqli_query($connection, $update)) {
			$jsonObj->validUpdate = True;
		}
		
	}

	
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>