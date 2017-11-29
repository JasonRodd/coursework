<?php 
#Jason Rodd
#11-25-17

function SelectASpecificMultiplier($connection, $post) {
	$returnString = "";

	$containsQuestionId = empty($post['questionid']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsExamId && $containsQuestionId){
		
		$select = sprintf("SELECT * FROM ExamQuestionMultiplier WHERE examid = '%s' AND questionid = '%s'", $post['examid'], $post['questionid']);
		$result = $connection->query($select);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}
		
		$returnString = json_encode(array('Multiplier' => $dataArray ));
	}
	
	return $returnString;
}

function SelectAllExamMultipliers($connection, $post) {
	$returnString = "";

	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsExamId){
		
		$select = sprintf("SELECT * FROM ExamQuestionMultiplier WHERE examid = '%s'", $post['examid']);
		$result = $connection->query($select);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}
		
		$returnString = json_encode(array('ExamMultipliers' => $dataArray ));
	}
	
	return $returnString;
}

function SelectExamTotalPoints($connection, $post) {
	$returnString = "";

	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsExamId){
		
		$select = sprintf("SELECT SUM(multiplier) AS TotalPoints FROM ExamQuestionMultiplier WHERE examid = '%s' GROUP BY multiplier", $post['examid']);
		$result = $connection->query($select);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}
		
		$returnString = json_encode(array('totalPoints' => $dataArray ));
	}
	
	return $returnString;
}

?>