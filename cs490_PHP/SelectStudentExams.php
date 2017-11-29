<?php 
#Jason Rodd
#10-16-17

function SelectAStudentExams($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	
	if($containsUserName){
		
		$select = sprintf("SELECT * FROM StudentExams WHERE username = '%s'", $post['username']);
		$result = $connection->query($select);

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dataArray[] = $row;
		}

		$returnString = json_encode(array('StudentExams' => $dataArray ));
	}
	
	return $returnString;
}

function StudentExamExists($connection, $post) {
	$returnString = "";

	$containsUserName = empty($post['username']) ? False : True;
	$containsExamID = empty($post['examid']) ? False : True;
	
	$jsonObj->exists = False;
	
	if($containsUserName && $containsExamID){
		
		$select = sprintf("SELECT * FROM StudentExams WHERE username = '%s' AND examid = '%s'", $post['username'], $post['examid']);
		$result = $connection->query($select);

		if ($result->num_rows > 0) {
			$jsonObj->exists = True;
		}

		$JASON = json_encode($jsonObj);
		$returnString = $JASON;
	}
	
	return $returnString;

}

?>
