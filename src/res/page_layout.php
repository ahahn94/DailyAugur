<?php
require_once $_SERVER["DOCUMENT_ROOT"]. "/php_includes/database/resources/Pages.php";

// Handle page selection.
$page_id = isset($_GET["page_id"]) ? $_GET["page_id"] : 0;

$page = Pages::read_dataset($page_id);
$page_count = Pages::count_datasets();
?>
<table width="100%" class="header_table" style="margin: 0; padding: 0;" border="0">
    <tr>
        <td>
            <h2 class="text_center"><?php echo date("F jS", strtotime($page["date_published"])) ?></h2>
            <h2 class="text_center">Week
                N° <?php echo date("W", strtotime($page["date_published"])) . ",<br>" . date("Y", strtotime($page["date_published"])) ?></h2>
        </td>
        <td>
            <h1 class="text_center">Daily Augur</h1>
            <h3 class="text_center">
                <i class="fa fa-hat-wizard"></i>
                <i class="fa fa-moon"></i>
                The n° 1 magical newspaper
                <i class="fa fa-magic"></i>
                <i class="fa fa-flask"></i>
            </h3>
        </td>
        <td>
            <h2 class="text_center"><?php echo "Issue N° " . $page["page_id"] ?></h2>
            <h2 class="text_center">1 Knut</h2>

            <table width="100%" class="header_table" style="font-family: Mugglenews, arial, serif;">
                <td width="40%"
                    <?php
                    if ($page_id == 0) {
                        echo 'style="visibility: hidden"';
                    }
                    ?>
                ><a href="index.php?page_id=<?php echo $page_id - 1; ?>"><i
                                class="fa fa-arrow-left"></i>
                        Previous</a></td>
                <td width="30%"
                    <?php
                    if ($page_id == 0) {
                        echo 'style="visibility: hidden"';
                    }
                    ?>
                ><a href="index.php"><i class="fa fa-home"></i> Home</a></td>
                <td width="30%"
                    <?php
                    if ($page_id == ($page_count - 1)) {
                        echo 'style="visibility: hidden"';
                    }
                    ?>
                ><a href="index.php?page_id=<?php echo $page_id + 1; ?>">Next <i
                                class="fa fa-arrow-right"></i></a></td>
            </table>
        </td>
    </tr>
</table>

<h2 class="text_center" style="padding: 5px 0 0 0"><?php echo $page["title"]; ?></h2>
<p style="font-family: Mugglenews, arial, serif;" class="text_area">
    <?php

    echo $page["published_content"];

    ?>
</p>