<?php
require_once('init.inc.php');
    /*
    Script for update record from X-editable.
    */
    
    $validNames = array('budget', 'percent');
    if (!in_array($_POST['name'], $validNames)) {
    	$message = 'Invalid field.';
    }
    
    $pk = $_POST['pk'];
    $name = $_POST['name'];
    $value = $_POST['value'];

    if(!empty($value)) {
    	try {
	    	$dbh = Database::getPdo();
	    	$sql = "UPDATE overhead_split SET $name = :value WHERE id = :id";
	    	$stmt = $dbh->prepare($sql);
	    	$stmt->bindParam(':value', $value, PDO::PARAM_STR);
	    	$stmt->bindParam(':id', $pk, PDO::PARAM_INT);
	    	$result = $stmt->execute();
    	}
    	catch (PDOException $e) {
    		echo 'Could not update record';
    	}
        
        //here, for debug reason we just return dump of $_POST, you will see result in browser console
        //print_r($_POST);

    } else {
        header('HTTP 400 Bad Request', true, 400);
        echo "This field is required!";
    }

?>