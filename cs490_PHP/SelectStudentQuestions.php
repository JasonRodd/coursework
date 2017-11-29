<?php 
#Jason Rodd
#10-16-17

function SelectASpecificStudentQuestion($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQNUM = empty($post['qnum']) ? False : True;
	
	if($containsUserName && $containsExamId && $containsQNUM){
		
		$select = sprintf("SELECT * FROM StudentQuestions WHERE username = '%s' AND examid = '%s' AND qnum = '%s'", $post['username'], $post['examid'], $post['qnum']);
		$result = $connection->query($select);

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dataArray[] = $row;
		}

		$returnString = json_encode(array('StudentExams' => $dataArray ));
	}
	
	return $returnString;
}

function SelectAllOfStudentQuestions($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsUserName && $containsExamId){
		
		$select = sprintf("SELECT * FROM StudentQuestions WHERE username = '%s' AND examid = '%s'", $post['username'], $post['examid']);
		$result = $connection->query($select);

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dataArray[] = $row;
		}

		$returnString = json_encode(array('StudentExams' => $dataArray ));
	}
	
	return $returnString;
}

function SelectRandomQuestion($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsUserName && $containsExamId){
		
		#$select = sprintf("SELECT ExamQuestions.examid, ExamQuestions.questionid FROM ExamQuestions, StudentQuestions WHERE StudentQuestions.username = '%s' AND ExamQuestions.examid = '%s' AND  ExamQuestions.examid = StudentQuestions.examid AND ExamQuestions.questionid != StudentQuestions.questionid ORDER BY RAND() LIMIT 1;", $post['username'], $post['examid']);
		$select = sprintf("SELECT ExamQuestions.examid, ExamQuestions.questionid FROM ExamQuestions WHERE ExamQuestions.examid = '%s' AND ExamQuestions.questionid NOT IN (SELECT questionid FROM StudentQuestions WHERE username = '%s' AND examid = '%s') ORDER BY RAND() LIMIT 1;", $post['examid'], $post['username'], $post['examid']);
		$result = $connection->query($select);

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dataArray[] = $row;
		}

		$returnString = json_encode(array('RandomQuestion' => $dataArray ));
	}
	
	return $returnString;
}

?>
