<?php 
#Jason Rodd
#10-16-17

function UpdateAStudentGrade($connection, $post) {
	$returnString = "";
	
	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQNUM = empty($post['qnum']) ? False : True;
	$containsGradePart = empty($post['gradepart']) ? False : True;
	
	$containsGradeValue = empty($post['gradevalue']) ? False : True;
	
	$jsonObj->validUpdate = False;
	
	if($containsUserName && $containsExamId && $containsQNUM && $containsGradePart && $containsGradeValue){
		
		$update = sprintf("UPDATE StudentGrades SET gradevalue = '%s' WHERE examid = '%s' AND username = '%s' AND qnum = '%s' AND gradepart = '%s' " ,$post['gradevalue'], $post['examid'], $post['username'], $post['qnum'], $post['gradepart']);
		if (mysqli_query($connection, $update)) {
			$jsonObj->validUpdate = True;
		}
		

	}
	
	$JASON = json_encode($jsonObj);
	$returnString = $JASON;
	
	return $returnString;
}


?>