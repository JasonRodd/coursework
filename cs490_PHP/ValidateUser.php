<?php 
#Jason Rodd
#10-4-17

function ValidateUseage($connection, $post) {
	$returnString = "";
	$ValidUser = False;
	
	$containsUsername = empty($post['username']) ? False : True;
	$ContainsSecret = empty($post['secret']) ? False : True;
	
	if($containsUsername && $ContainsSecret){
		$select = "SELECT username, secret, access, firstname, lastname FROM Users";
		$result = $connection->query($select);
	
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row["username"] == $post['username'] && $row["secret"] == $post['secret']){
					$ValidUser = True;
					$userObj->username = $row["username"];
					$userObj->secret = $row["secret"];
					$userObj->access = $row["access"];
					$userObj->firstname = $row["firstname"];
					$userObj->lastname = $row["lastname"];
					$userObj->validuser = $ValidUser;
					
					$JASON = json_encode($userObj);
					$returnString = $JASON;
					break;
				}
			}
		}
		
		if(!$ValidUser){
			$userObj->username = $post['username'];
			$userObj->secret = $post['secret'];
			$userObj->validuser = $ValidUser;
			
			$JASON = json_encode($userObj);
			$returnString = $JASON;
		}
		
	} elseif ($containsUsername && !$containsSecret){
		$returnString = "Missing secret";
	} elseif (!$containsUsername && $containsSecret){
		$returnString = "Missing username";
	} else {
		$returnString = "Missing username and secret";
	}
	
	return $returnString;
}






?>