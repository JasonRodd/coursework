<?php 
#Jason Rodd
#11-5-17

function SelectASpecificProfessorComment($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	$containsQNUM = empty($post['qnum']) ? False : True;
	
	if($containsUserName && $containsExamId && $containsQNUM){
		
		$select = sprintf("SELECT * FROM ProfessorComments WHERE username = '%s' AND examid = '%s' AND qnum = '%s'", $post['username'], $post['examid'], $post['qnum']);
		$result = $connection->query($select);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}
		
		$returnString = json_encode(array('ProfessorComments' => $dataArray ));
	}
	
	return $returnString;
}

function SelectAllOfProfessorComments($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamId = empty($post['examid']) ? False : True;
	
	if($containsUserName && $containsExamId){
		
		$select = sprintf("SELECT * FROM ProfessorComments WHERE username = '%s' AND examid = '%s'", $post['username'], $post['examid']);
		$result = $connection->query($select);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$dataArray[] = $row;
			}
		}
		
		$returnString = json_encode(array('ProfessorComments' => $dataArray ));
	}
	
	return $returnString;
}

?>