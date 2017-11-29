<?php 
#Jason Rodd
#10-16-17

function InsertAStudentExam($connection, $post) {
	$returnString = "";
	
	$containsExamId = empty($post['examid']) ? False : True;
	$ContainsUserName = empty($post['username']) ? False : True;
	
	$jsonObj->validInsert = False;
	
	if($containsExamId && $ContainsUserName){
		
		$insert = sprintf("INSERT INTO StudentExams ( username, examid ) VALUES ( '%s', '%s' )" , $post['username'],$post['examid']);
		
		if (mysqli_query($connection, $insert)) {
			$jsonObj->validInsert = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>