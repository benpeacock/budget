<?php
require_once('init.inc.php');
    // Script for update record from X-editable.
    $pk = filter_input(INPUT_POST, 'pk', FILTER_SANITIZE_NUMBER_INT);
    if (filter_var($pk, FILTER_VALIDATE_INT) == false) {
    	exit('Invalid item id');
    }
    
   	// Name and value are applied to multiple data types, so using strip_tags() 
   	// and htmlspecialchars() rather than filter_input() and filter_var()
    $name = trim(strip_tags(htmlspecialchars($_POST['name'])));
    $value = trim(strip_tags(htmlspecialchars($_POST['value'])));
    if (strlen($value) > 45) {
    	exit ('Invalid valie. Max length 45 characters.');
    }
//     $pk = $_POST['pk'];
//     $name = $_POST['name'];
//     $value = $_POST['value'];
    $validNames = array('name', 'category', 'tag', 'amount', 'note');
    if (!in_array($name, $validNames)) {
    	exit ('Invalid filed name');
    }

    if(!empty($value)) {
    	try {
	    	$dbh = Database::getPdo();
	    	$sql = "UPDATE item SET $name = :value WHERE id = :id";
	    	$stmt = $dbh->prepare($sql);
	    	$stmt->bindParam(':value', $value, PDO::PARAM_STR);
	    	$stmt->bindParam(':id', $pk, PDO::PARAM_INT);
	    	$result = $stmt->execute();
    	}
    	catch (PDOException $e) {
    		echo 'Could not update record';
    	}

    } else {
        header('HTTP 400 Bad Request', true, 400);
        echo "This field is required!";
    }

?>