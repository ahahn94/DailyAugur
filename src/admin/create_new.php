<?php
/**
 * Created by ahahn94
 * on 04.01.19
 */

require_once "../php_includes/database/resources/Pages.php";

// Create a new, empty page on the database.
$page_id = Pages::get_next_id();
$now = date("Y-m-d H:i:s");
$page = array("page_id" => $page_id, "title" => "", "published_content" => "", "saved_title" => "",
    "saved_content" => "", "date_created" => $now, "date_published" => "NULL",
    "date_last_modified" => "NULL", "date_saved" => "NULL");
Pages::write_dataset($page);

// Redirect to editor for newly created page.
$redirect_link = 'edit_page.php?page_id=' . $page["page_id"];
echo "<script>window.location.replace('$redirect_link');</script>";