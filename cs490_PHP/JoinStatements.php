<?php 
#Jason Rodd
#10-16-17

function SelectAllReviewInfo($connection, $post) {
	$returnString = "";
	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsUserName && $containsExamId){
		
		$select = sprintf("SELECT QuestionBank.questionid, QuestionBank.difficulty, QuestionBank.question, A.qnum, A.answer, C.comment, SUM(G.gradevalue) AS Grade FROM QuestionBank, StudentAnswers A JOIN StudentGrades G ON G.examid = A.examid AND G.username = A.username AND G.qnum = A.qnum  JOIN StudentComments C ON C.examid = A.examid AND C.username = A.username AND C.qnum = A.qnum WHERE A.questionid = QuestionBank.questionid AND A.examid = '%s' AND A.username = '%s' GROUP BY G.qnum", $post['examid'], $post['username']);
		$result = $connection->query($select);

		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}
		
		

		$returnString = json_encode(array('ReviewInfo' => $dataArray ));
	}
	return $returnString;
}


?>

