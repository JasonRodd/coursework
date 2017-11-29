<?php 
#Jason Rodd
#10-16-17

function InsertAStudentGrade($connection, $post) {
	$returnString = "";
	
	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQNUM = empty($post['qnum']) ? False : True;
	$containsGradePart = empty($post['gradepart']) ? False : True;
	$containsGradeValue = empty($post['gradevalue']) ? False : True;
	
	$jsonObj->validInsert = False;
	
	if($containsUserName && $containsQNUM && $containsGradePart && $containsExamId && $containsGradeValue){
		
		$insert = sprintf("INSERT INTO StudentGrades ( username, examid,  qnum,  gradepart, gradevalue ) VALUES ( '%s', '%s', '%s', '%s', %s )" , $post['username'],$post['examid'],$post['qnum'],$post['gradepart'],$post['gradevalue']);
		
		if (mysqli_query($connection, $insert)) {
			$jsonObj->validInsert = True;
		}
		
	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>
