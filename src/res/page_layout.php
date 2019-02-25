<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/php_includes/database/resources/Pages.php";

// Handle page selection.
$page_ids = Pages::get_published_pages_ids(); // Get page_ids of published pages.
$page_id = isset($_GET["page_id"]) ? $_GET["page_id"] : $page_ids[0]["page_id"];

$page = Pages::read_dataset($page_id);
$page_count = Pages::count_published_pages_datasets();

$home = "index.php";

// Show page content if page_count > 0.
if ($page_count > 0){
?>

<?php

// Match previous and next against page_ids on the database.
$current_position = array_search(array("page_id" => $page_id), $page_ids);
$previous_id = ($current_position != 0) ? $page_ids[$current_position - 1]["page_id"] : -1;
$next_id = ($current_position != $page_count - 1) ? $page_ids[$current_position + 1]["page_id"] : -1;

$previous = ($previous_id != -1) ? "index.php?page_id=" . $previous_id : "";
$next = ($next_id != -1) ? "index.php?page_id=" . $next_id : "";
?>

<a href="index.php" data-transition="slide" id="testing"></a>

<div id="seite" data-role="page">
    <table width="100%" class="header_table" style="margin: 0; padding: 0;" border="0">
        <tr>
            <td>
                <h2 class="text_center"><?php echo date("F jS", strtotime($page["date_published"])) ?></h2>
                <h2 class="text_center">Week
                    N° <?php echo date("W", strtotime($page["date_published"])) . ",<br>" . date("Y", strtotime($page["date_published"])) ?></h2>
            </td>
            <td>
                <h1 class="text_center"><a onclick="loadPage('<?php echo $home; ?>')">Daily Augur</a></h1>
                <h3 class="text_center">
                    <a onclick="loadPage('/admin/index.php')">
                        <i class="fa fa-hat-wizard" id="Hat"></i></a>
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

    <h2 class="text_center textflow" style="padding: 5px 0 0 0"><?php echo $page["title"]; ?></h2>
    <div class="text_area textflow" id="content">
        <?php

        echo $page["published_content"];

        ?>


        <?php
        } else {
            // Show a message if page_count = 0 and hide date and issue from the header.
            ?>
            <table width="100%" class="header_table" style="margin: 0; padding: 0;" border="0">
                <tr>
                    <td>
                        <!-- Spacer-->
                    </td>
                    <td>
                        <h1 class="text_center"><a onclick="loadPage('<?php echo $home; ?>')">Daily Augur</a></h1>
                        <h3 class="text_center">
                            <a onclick="loadPage('/admin/index.php')">
                                <i class="fa fa-hat-wizard" id="Hat"></i></a>
                            <i class="fa fa-moon"></i>
                            The n° 1 magical newspaper
                            <i class="fa fa-magic"></i>
                            <i class="fa fa-flask"></i>
                        </h3>
                    </td>
                    <td>
                        <!-- Spacer-->
                    </td>
                </tr>
            </table>
            <table width="100%" class="header_table" style="margin: 0; padding: 0;" border="0">
                <tr>
                    <td>
                        <!-- Spacer-->
                    </td>
                    <td>
                        <br>
                        <h2 class="text_center">There Are No Pages On The Database!</2>
                        <h3 class="text_center">Click on the wizards hat to get to the admin area.</h3>
                    </td>
                    <td>
                        <!-- Spacer-->
                    </td>
                </tr>
            </table>
            <?php
        }
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