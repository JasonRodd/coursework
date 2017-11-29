<?php 
#Jason Rodd
#10-11-17

function SelectAllQuestions($connection, $post) {
	$returnString = "";
	
	$select = "SELECT * FROM QuestionBank";
	$result = $connection->query($select);

	while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$dataArray[] = $row;
	}

	$returnString = json_encode(array('questions' => $dataArray ));
	
	
	return $returnString;
}

function SelectSpecificQuestion($connection, $post) {
	$returnString = "";
	
	$containsQuestionId = empty($post['questionid']) ? False : True;
	
	if($containsQuestionId){
		
		$select = sprintf("SELECT * FROM QuestionBank WHERE questionid = '%s'", $post['questionid']);
		$result = $connection->query($select);

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dataArray[] = $row;
		}

		$returnString = json_encode(array('questions' => $dataArray ));
	
	
	}
	
	return $returnString;
}

function SelectQuestionsOrdered($connection, $post) {
	$returnString = "";
	
	$containsOrderBy = empty($post['column']) ? False : True;
	$containsAscend = empty($post['ascend']) ? False : True;
	
	if($containsOrderBy && $containsAscend){
		
		if($post['ascend'] == '1'){
			$select = sprintf("SELECT * FROM QuestionBank ORDER BY %s ASC", $post['column']);
		} else {
			$select = sprintf("SELECT * FROM QuestionBank ORDER BY %s DESC", $post['column']);
		}
		
		$result = $connection->query($select);

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dataArray[] = $row;
		}
	
	}

	$returnString = json_encode(array('questions' => $dataArray ));
	
	
	return $returnString;
}

function SelectQuestionsSearch($connection, $post) {
	$returnString = "";
	$containsOrderBy = empty($post['column']) ? False : True;
	$containsSearch = empty($post['search']) ? False : True;
	
	if($containsOrderBy && $containsSearch){
		$select = "SELECT * FROM QuestionBank WHERE " . $post['column'] . " LIKE '%" . $post['search'] . "%'";

		
		$result = $connection->query($select);

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dataArray[] = $row;
		}
	
	}

	$returnString = json_encode(array('questions' => $dataArray ));
	
	
	return $returnString;
}

?>