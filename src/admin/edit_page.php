<?php
/**
 * Created by PhpStorm.
 * User: ahahn94
 * Date: 25.11.18
 * Time: 22:56
 */
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
require_once "res/style/bootstrap_body_end.php";
?>
</body><?php
/**
 * Created by PhpStorm.
 * User: ahahn94
 * Date: 25.11.18
 * Time: 22:24
 */

require_once __DIR__ . "/../php_includes/database/resources/Pages.php";

// Handle page selection.
$page_id = isset($_GET["page_id"]) ? $_GET["page_id"] : 0;

$page = Pages::read_dataset($page_id);
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="res/style/style.css">
    <?php
    require_once "res/style/head_includes.php";
    ?>
</head>
<body style="color: #e9ecef;">
<?php
require_once "res/style/menu.php";
?>

<div style="margin: 2% 10%">
    <form id="modified_page">
        <textarea class="h2" rows="1" style="width: 100%; color: black; line-height: initial; margin: 5px"><?php
            echo $page["saved_title"];
            ?></textarea>
        <div class="container-fluid">
            <div class="row">
                <div class="col text_left" style="">
                    <button class="btn btn-primary">Spacer for menu band <i class="fa fa-arrows-alt-h"></i></button>
                </div>
            </div>
        </div>
        <textarea style="width: 100%; height: 70%; margin: 5px"><?php
            echo $page["saved_content"];
            ?></textarea>
    </form>
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <!--Spacer-->
            </div>
            <div class="col-1">
                <button class="btn btn-primary">Publish <i class="fa fa-upload"></i></button>
            </div>
            <div class="col-1">
                <button class="btn btn-primary">Preview <i class="fa fa-eye"></i></button>
            </div>
            <div class="col-1">
                <button class="btn btn-primary">Save <i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>

<?php
require_once "res/style/bootstrap_body_end.php";
?>
</body>


</html>


</html>
