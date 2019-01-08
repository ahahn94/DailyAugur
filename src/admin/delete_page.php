<?php
/**
 * Created by ahahn94
 * on 04.01.19
 */

require_once "../php_includes/database/resources/Pages.php";

// Get page data from POST.
$page_id = $_POST["page_id"] ? $_POST["page_id"] : null;
if ($page_id != null){
    // Delete dataset from database.
    $result = Pages::delete_dataset($page_id);
    if ($result == 0){
        echo "Sucessfully deleted page no. $page_id.";
    } else {
        echo "Changes rejected by database!";
    }
} else {
    echo "Error in POST form. Could not delete!";
}