<?php
require_once "DbConnector.php";

function saveNodeData($node){
	
	$result = array (
			"result"  => "",
			"errors" => ""
	);
	$connection = connectToDB();
	// Prepare an insert statement	
	if(!empty($node['id']) && is_numeric($node['id'])){		
		$sql = "UPDATE node SET firstname = ?, secondnames = ?, familyname = ?, maidenname = ?, photo = ?, files = ?, description = ?, date_birth = ?, date_death = ?, decade  = ? WHERE node_id = ".$node['id'].";";		
	}else{		
		$sql = "INSERT INTO node (firstname, secondnames, familyname, maidenname, photo, files, description, date_birth, date_death, decade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	}
	
	$stmt = mysqli_prepare($connection, $sql);
	
	if($stmt){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "ssssssssss", 
				$param_firstname,
				$param_secondnames,
				$param_surname,
				$param_maidenname,
				$param_photo,
				$param_files,
				$param_description,
				$param_datebirth,
				$param_datedeath,				
				$param_decade);
		
		// Set parameters
		$param_firstname = empty($node['firstname']) ? "": $node['firstname'];
		$param_secondnames = empty($node['secondnames']) ? "": $node['secondnames'];
		$param_surname = empty($node['surname']) ? "": $node['surname'];
		$param_maidenname = empty($node['maidenname']) ? "": $node['maidenname'];
		$param_datebirth = empty($node['datebirth']) ? "": $node['datebirth'];
		$param_datedeath = empty($node['datedeath']) ? "": $node['datedeath'];
		$param_photo = empty($node['photo']) ? "": $node['photo'];
		$param_files = empty($node['files']) ? "": $node['files'];
		$param_description = empty($node['description']) ? "": $node['description'];
		$param_decade = empty($node['decade']) ? "": $node['decade'];
		
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			// Redirect to login page
			$result['result'] = 'success';
		} else{
			$result['errors'] = "Cos poszło nie tak.";
		}
		mysqli_stmt_close($stmt);
	}
	
	//Close connection
	closeDBConnection($connection);
	
	return $result;
}

function loadNodeData($nodeid){
	
	$result = array (
			"node"  => array(
					'firstname' => "",
					'secondnames' => "",
					'surname' => "",
					'maidenname' => "",
					'datebirth' => "",
					'datedeath' => "",
					'photo' => "",
					'description' => "",
					'decade' => "",
					'id' => 0
			),
			"errors" => ""
	);
	
	if(!empty($nodeid) && is_numeric(trim($nodeid))){
		$connection = connectToDB();
		// Prepare an insert statement
		$sql = "SELECT firstname, secondnames, familyname, maidenname, photo, files, description, date_birth, date_death, decade FROM node WHERE node_id = ?";
		$stmt = mysqli_prepare($connection, $sql);
		if($stmt){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_id);
			
			$param_id = trim($nodeid);
			
			
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt) == 1){
					mysqli_stmt_bind_result($stmt, 
							$res_firstname,
							$res_secondnames,
							$res_surname,
							$res_maidenname,
							$res_photo,
							$res_files,
							$res_description,
							$res_datebirth,
							$res_datedeath,
							$res_decade
				);
					if(mysqli_stmt_fetch($stmt)){
						$result["node"]['firstname'] = $res_firstname;
						$result["node"]['secondnames'] = $res_secondnames;
						$result["node"]['surname'] = $res_surname;
						$result["node"]['maidenname'] = $res_maidenname;
						$result["node"]['photo'] = $res_photo;
						$result["node"]['files'] = $res_files;
						$result["node"]['description'] = $res_description;
						$result["node"]['datebirth'] = $res_datebirth;
						$result["node"]['datedeath'] = $res_datedeath;
						$result["node"]['decade'] = $res_decade;	
						$result["node"]['id'] = trim($nodeid);
					}					
					
				}elseif(mysqli_stmt_num_rows($stmt) == 0){
					$result["errors"] = "Nie znaleziono podanego węzła drzewa";					
				}else{
					$result["errors"] = "Otrzymano niejednoznaczny wynik";
				}
			}
			
			
		}
	}else{
		$result['errors'] = "Nie znaleziono podanego węzła drzewa";
	}		
	
	//Close connection
	closeDBConnection($connection);
	
	return $result;
}

function updateNodeData(){
	
}
?>