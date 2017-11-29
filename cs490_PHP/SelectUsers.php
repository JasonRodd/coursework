<?php 
#Jason Rodd
#10-11-17

function SelectAllUsers($connection, $post) {
	$returnString = "";
	
	$select = "SELECT * FROM Users";
	$result = $connection->query($select);

	while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$dataArray[] = $row;
	}

	$returnString = json_encode(array('users' => $dataArray ));
	
	
	return $returnString;
}

?>