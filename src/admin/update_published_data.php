<?php
/**
 * Created by ahahn94
 * on 03.01.19
 */

require_once "../php_includes/database/resources/Pages.php";
/**
 * Publish saved changes.
 */
// Get page_id from POST.
$page_id = $_POST["page_id"] ? $_POST["page_id"] : null;
if ($page_id != null) {
    // Read page dataset from database.
    $page = Pages::read_dataset($page_id);
    $now = date("Y-m-d H:i:s");
    // Make changes on dataset.
    $page["title"] = $page["saved_title"];
    $page["published_content"] = $page["saved_content"];
    if ($page["date_published"] === "0000-00-00 00:00:00") {
        // date_published is the initial publication, all following ones will update date_last_modified.
        $page["date_published"] = $now;
    }
    $page["date_last_modified"] = $now;

    // Write changes to the database.
    $result = Pages::write_dataset($page);
    if ($result == 0) {
        echo "Published at " . $now;
    } else {
        echo "Changes rejected by database!";
    }
} else {
    echo "Error in POST form. Could not publish!";
}
