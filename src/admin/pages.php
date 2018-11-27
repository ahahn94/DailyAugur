<?php
/**
 * Created by PhpStorm.
 * User: ahahn94
 * Date: 25.11.18
 * Time: 22:24
 */

require_once __DIR__ . "/../php_includes/database/resources/Pages.php";

// Get pages.
$pages = Pages::read_datasets();

?>
<html>
<head>
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
                <th scope="col" width="75%">Title</th>
                <th scope="col" width="10%">Last modified</th>
                <th scope="col" width="10%" class="text-center">Options</th>
            </tr>
            </thead>
            <?php
            foreach ($pages as $page) {
                echo '<tr>';
                echo '<td>' . $page["page_id"] . '</td>';
                echo '<td>' . $page["title"] . '</td>';
                echo '<td>' . date("F jS, H:m", strtotime($page["date_last_modified"])) . '</td>';
                echo '<td class="text-center">
<a class="btn btn-primary btn-sm" href="edit_page.php?page_id=' . $page["page_id"] . '"><b>Edit  </b><i class="fas fa-edit"></i></a>
</td>';
                echo '</tr>';
            } ?>
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
