<?php
/**
 * Created by ahahn94
 * on 25.11.18
 */
?>
<?php
// Get filename to highlight right link.
$filename = basename($_SERVER["PHP_SELF"], ".php");
?>
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php" style="font-family: Mugglenews, arial, serif;">Daily Augur</a>
    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php
            if ($filename == "index") echo "active"
            ?>">
                <a class="nav-link" href="index.php" title="Go to Home."><i class="fas fa-home"></i>  Home</a>
            </li>
            <li class="nav-item <?php
            if ($filename == "pages") echo "active"
            ?>">
                <a class="nav-link" href="pages.php" title="Go to the Pages section."><i class="fas fa-book"></i>  Pages</a>
            </li>
            <li class="nav-item <?php
            if ($filename == "images") echo "active"
            ?>">
                <a class="nav-link" href="images.php" title="Go to the Images section."><i class="fas fa-image"></i>  Images</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="btn btn-primary" href="index.php?logout=true" title="Log out of the Admin area.">
                    Logout  <i class="fas fa-sign-out-alt"></i></a>
            </li>
        </ul>
    </div>
</nav>