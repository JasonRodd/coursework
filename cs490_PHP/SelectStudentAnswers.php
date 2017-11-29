<?php 
#Jason Rodd
#10-16-17

function SelectASpecificStudentAnswer($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQNUM = empty($post['qnum']) ? False : True;
	
	if($containsUserName && $containsExamId && $containsQNUM){
		
		$select = sprintf("SELECT * FROM StudentAnswers WHERE username = '%s' AND examid = '%s' AND qnum = '%s'", $post['username'], $post['examid'], $post['qnum']);
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

function SelectAllOfStudentAnswers($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsUserName && $containsExamId){
		
		$select = sprintf("SELECT * FROM StudentAnswers WHERE username = '%s' AND examid = '%s'", $post['username'], $post['examid']);
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