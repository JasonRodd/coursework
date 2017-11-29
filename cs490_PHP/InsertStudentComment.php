<?php 
#Jason Rodd
#10-28-17

function InsertAStudentComment($connection, $post) {
	$returnString = "";
	
	$containsQNUM = empty($post['qnum']) ? False : True;
	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsComment = empty($post['comment']) ? False : True;
	
	$jsonObj->validInsert = False;
	
	if($containsUserName && $containsQNUM && $containsExamId && $containsComment){
		
		$insert = sprintf("INSERT INTO StudentComments ( qnum, username, examid, comment ) VALUES ( '%s', '%s', '%s', '%s' )" , $post['qnum'],$post['username'],$post['examid'],$post['comment']);
		
		if (mysqli_query($connection, $insert)) {
			$jsonObj->validInsert = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>