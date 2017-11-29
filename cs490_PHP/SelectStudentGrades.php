<?php 
#Jason Rodd
#10-16-17

function SelectASpecificStudentGrade($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQNUM = empty($post['qnum']) ? False : True;
	
	if($containsUserName && $containsExamId && $containsQNUM){
		
		$select = sprintf("SELECT username, examid, qnum, SUM(gradevalue) AS Grade FROM StudentGrades WHERE username = '%s' AND examid = '%s' AND qnum = '%s' GROUP BY qnum", $post['username'], $post['examid'], $post['qnum']);
		$result = $connection->query($select);

		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}

		$returnString = json_encode(array('StudentExams' => $dataArray ));
	}
	
	return $returnString;
}

function SelectASpecificStudentGradeParts($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQNUM = empty($post['qnum']) ? False : True;
	
	if($containsUserName && $containsExamId && $containsQNUM){
		
		$select = sprintf("SELECT qnum, gradevalue FROM StudentGrades WHERE username = '%s' AND examid = '%s' AND qnum = '%s' AND (gradepart = 1 OR gradepart = 2 OR gradepart = 3)", $post['username'], $post['examid'], $post['qnum']);
		$result = $connection->query($select);

		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}

		$returnString = json_encode(array('gradeparts' => $dataArray ));
	}
	
	return $returnString;
}

function SelectASpecificStudentGradePartsAll($connection, $post) {
	$returnString = "";
	$placeholder = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsUserName && $containsExamId){
		
		$select = sprintf("SELECT qnum, gradevalue FROM StudentGrades WHERE username = '%s' AND examid = '%s' AND (gradepart = 1 OR gradepart = 2 OR gradepart = 3) ORDER BY qnum ASC", $post['username'], $post['examid']);
		$result = $connection->query($select);
		
		
		$qn = 1;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					if($row["qnum"] == $qn){
						$dataArray[] = $row;
					} else {
						$qn += 1;
						$returnString .= json_encode($dataArray);
						$finalArray[] = $dataArray;
						unset($dataArray);
						$dataArray[] = $row;
					}
			}
		}
		$returnString .= json_encode($dataArray);
		$finalArray[] = $dataArray;
		$returnString = json_encode(array('gradeparts' => $finalArray));
	}
	
	return $returnString;
}

function SelectAllOfStudentGrades($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsUserName && $containsExamId){
		
		$select = sprintf("SELECT username, examid, qnum, SUM(gradevalue) AS Grade FROM StudentGrades WHERE username = '%s' AND examid = '%s' GROUP BY qnum", $post['username'], $post['examid']);
		$result = $connection->query($select);

		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}
		$returnString = json_encode(array('StudentExams' => $dataArray ));
	}
	
	return $returnString;
}

function SelectAStudentFinalGrades($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsUserName && $containsExamId){
		
		$select = sprintf("SELECT username, examid, SUM(gradevalue) AS Grade FROM StudentGrades WHERE username = '%s' AND examid = '%s' GROUP BY examid, username", $post['username'], $post['examid']);
		$result = $connection->query($select);

		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}

		$returnString = json_encode(array('StudentExams' => $dataArray ));
	}
	
	return $returnString;
}

?>