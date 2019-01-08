<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/php_includes/database/resources/Pages.php";

// Handle page selection.
$page_ids = Pages::get_saved_pages_ids(); // Get page_ids of all pages.
$page_id = isset($_GET["page_id"]) ? $_GET["page_id"] : $page_ids[0]["page_id"];

$page = Pages::read_dataset($page_id);
$page_count = Pages::count_datasets();
?>

<?php

// Match previous and next against page_ids on the database.
$current_position = array_search(array("page_id" => $page_id), $page_ids);
$previous_id = ($current_position != 0) ? $page_ids[$current_position-1]["page_id"] : -1;
$next_id = ($current_position != $page_count - 1) ? $page_ids[$current_position+1]["page_id"] : -1;

$previous = ($previous_id != -1) ? "index.php?page_id=" . $previous_id : "";
$next = ($next_id != -1) ? "index.php?page_id=" . $next_id : "";
$home = "index.php";
?>

<a href="index.php" data-transition="slide"></a>

<div id="seite" data-role="page">
    <table width="100%" class="header_table" style="margin: 0; padding: 0;" border="0">
        <tr>
            <td>
                <h2 class="text_center"><?php echo date("F jS", strtotime($page["date_created"])) ?></h2>
                <h2 class="text_center">Week
                    N° <?php echo date("W", strtotime($page["date_created"])) . ",<br>" . date("Y", strtotime($page["date_created"])) ?></h2>
            </td>
            <td>
                <h1 class="text_center"><a onclick="loadPage('<?php echo $home; ?>')">Daily Augur</a></h1>
                <h3 class="text_center">
                    <i class="fa fa-hat-wizard" id="Hat"></i>
                    <i class="fa fa-moon"></i>
                    The n° 1 magical newspaper
                    <i class="fa fa-magic"></i>
                    <i class="fa fa-flask"></i>
                </h3>
            </td>
            <td>
                <h2 class="text_center"><?php echo "Issue N° " . $page["page_id"] ?></h2>
                <h2 class="text_center">1 Knut</h2>
            </td>
        </tr>
    </table>

    <h2 class="text_center" style="padding: 5px 0 0 0"><?php echo $page["saved_title"]; ?></h2>
    <p style="font-family: Mugglenews, arial, serif;" class="text_area" id="content">
        <?php

        echo $page["saved_content"];

        ?>
    </p>

    <script>

        function loadPage(link) {
            window.location.href = link;
        }

        // Handle swiping.
        swiper.init(document);
        swiper.setSwipeLeft(function () {
            loadPage("<?php echo $next ?>");
        });
        swiper.setSwipeRight(function () {
            loadPage("<?php echo $previous ?>");
        });


    </script>
</div>