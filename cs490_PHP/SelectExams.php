<?php 
#Jason Rodd
#10-11-17

function SelectAllExams($connection, $post) {
	$returnString = "";
	
	$select = "SELECT * FROM Exams";
	$result = $connection->query($select);


	while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$dataArray[] = $row;
	}

	$returnString = json_encode(array('exams' => $dataArray ));
	
	return $returnString;
}

function GetExamState($connection, $post) {
	$returnString = "";
	
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsExamId){
	
		$select = sprintf("SELECT state FROM Exams WHERE examid = '%s'", $post['examid']);
		$result = $connection->query($select);

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dataArray[] = $row;
		}
	
	}
	 
	$returnString = json_encode(array('state' => $dataArray));
	
	return $returnString;
}

function GetSingleExam($connection, $post) {
	$returnString = "";
	
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsExamId){
	
		$select = sprintf("SELECT * FROM Exams WHERE examid = '%s'", $post['examid']);
		$result = $connection->query($select);

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dataArray[] = $row;
		}
	
	}
	 
	$returnString = json_encode(array('state' => $dataArray));
	
	return $returnString;
}

?>