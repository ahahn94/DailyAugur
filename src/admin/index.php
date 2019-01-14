<?php
/**
 * Created by ahahn94
 * on 07.11.18
 */

// Handle logout.
$logout = isset($_GET["logout"]) ? $_GET["logout"] : false;
if ($logout == "true") {
    header("HTTP/1.1 401 Unauthorized", true, 401);
    ?>
    <script>
        // Redirect to index.php of user area at logout.
        location.replace("/index.php");
    </script>
    <?php
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daily Augur</title>
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
