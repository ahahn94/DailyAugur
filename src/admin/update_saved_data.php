<?php
/**
 * Created by ahahn94
 * on 03.01.19
 */

require_once "../php_includes/database/resources/Pages.php";

// Get page data from POST.
$page_id = $_POST["page_id"] ? $_POST["page_id"] : null;
$saved_title = $_POST["saved_title"] ? $_POST["saved_title"] : null;
$saved_content = $_POST["saved_content"] ? $_POST["saved_content"] : null;

if (($page_id != null) && ($saved_title != null) && ($saved_content != null)){
    $now = date("Y-m-d H:i:s");
    // Insert page data into array and add date_saved.
    $page = array("page_id" => $page_id, "saved_title" => $saved_title, "saved_content" => $saved_content,
        "date_saved" => $now);
    // Write changes to database.
    $result = Pages::write_dataset($page);
    if ($result == 0){
        echo "Saved at " . $now;
    } else {
        echo "Changes rejected by database!";
    }
} else {
    echo "Error in POST form. Could not save!";
}