<?php
/**
 * Created by PhpStorm.
 * User: ahahn94
 * Date: 07.11.18
 * Time: 09:59
 */

// Handle logout.
$logout = isset($_GET["logout"]) ? $_GET["logout"] : false;
if ($logout == "true") {
    header("HTTP/1.1 401 Unauthorized", true, 401);
}

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="res/style/style.css">
    <?php
    require_once "res/style/head_includes.php";
    require_once __DIR__ . "/../res/style/head_includes.php";
    ?>
</head>

<body style="background-color: #f9f7f1">

<?php
require_once "res/style/menu.php"
?>

<?php
require_once __DIR__ . "/../res/page_layout.php";
?>

<?php
require_once "res/style/bootstrap_body_end.php";
?>
</body>


</html>
