<?php
/**
 * Created by ahahn94
 * on 25.11.18
 */

require_once __DIR__ . "/../php_includes/database/resources/Pages.php";

// Get pages.
$pages = Pages::read_datasets();

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daily Augur</title>
    <link rel="stylesheet" type="text/css" href="res/style/style.css">
    <?php
    require_once "res/style/head_includes.php";
    ?>
</head>
<body>
<?php
require_once "res/style/menu.php";
?>

<?php

if (isset($pages)) {
    ?>
    <div style="margin: 10px">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="5%">Page ID</th>
                <th scope="col" width="65%">Title</th>
                <th scope="col" width="10%">Last Change to Page</th>
                <th scope="col" width="10%">Last Change to Draft</th>
                <th scope="col" width="10%" class="text-center">Options</th>
            </tr>
            </thead>
            <?php
            foreach ($pages as $page) {
                // Show '-' if date_last_modified and/or date_saved is not set (happens if new page has not yet been saved/published).
                $date_last_modified = ($page["date_last_modified"] != "0000-00-00 00:00:00") ? date("F jS, H:m", strtotime($page["date_last_modified"])) : "-";
                $date_saved = ($page["date_saved"] != "0000-00-00 00:00:00") ? date("F jS, H:m", strtotime($page["date_saved"])) : "-";
                echo '<tr>';
                echo '<td>' . $page["page_id"] . '</td>';
                echo '<td>' . $page["title"] . '</td>';
                echo '<td>' . $date_last_modified . '</td>';
                echo '<td>' . $date_saved . '</td>';
                echo '<td class="text-center">
<a class="btn btn-primary btn-sm" href="edit_page.php?page_id=' . $page["page_id"] . '"><b>Edit  </b><i class="fas fa-edit"></i></a>
</td>';
                echo '</tr>';
            } ?>
            <!-- Show "New Page" Button in an additional table row. -->
            <tr>
                <td><!--Spacer--></td>
                <td><!--Spacer--></td>
                <td><!--Spacer--></td>
                <td><!--Spacer--></td>
                <td class="text-center"><a class="btn btn-primary btn-sm" href="create_new.php"><b>New Page </b><i
                                class="fas fa-plus"></i></a></td>
            </tr>
        </table>
    </div>
    <?php
}

?>

<?php
require_once "res/style/bootstrap_body_end.php";
?>
</body>


</html>
