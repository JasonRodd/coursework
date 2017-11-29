<?php 
#Jason Rodd
#10-11-17

function SelectAllExamQuestions($connection, $post) {
	$returnString = "";
	
	$containsExamid = empty($post['examid']) ? False : True;
	
	if($containsExamid){
		
	$select = sprintf("SELECT * FROM ExamQuestions WHERE examid = %s", $post['examid']);
	$result = $connection->query($select);

	while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$dataArray[] = $row;
	}

	$returnString = json_encode(array('examquestions' => $dataArray ));
	}
	
	return $returnString;
}

function SelectAllExamQuestionsDetailed($connection, $post) {
	$returnString = "";
	
	$containsExamid = empty($post['examid']) ? False : True;
	
	if($containsExamid){
		
	$select = sprintf("SELECT * FROM ExamQuestions, QuestionBank WHERE examid = %s AND ExamQuestions.questionid = QuestionBank.questionid", $post['examid']);
	$result = $connection->query($select);

	while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$dataArray[] = $row;
	}

	$returnString = json_encode(array('examquestions' => $dataArray ));
	}
	
	return $returnString;
}

?>