<?php
/**
 * Created by ahahn94
 * on 25.11.18
 */
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Daily Augur</title>
    <?php
    require_once "res/style/head_includes.php";
    require_once __DIR__ . "/../php_includes/database/resources/Pages.php";
    ?>
    <script type="text/javascript" src="res/behaviour/editor.js"></script>
    <link rel="stylesheet" type="text/css" href="res/style/overlay.css">
</head>
<body>

<!-- Overlays -->
<div class="overlay" id="overlay-page-layout">
    <!-- Page layout selection. -->
    <?php
    require_once "res/style/page_layout_overlay.php";
    ?>
</div>
<div class="overlay" id="overlay-image-selection">
    <!-- Image selection overlay. -->
    <?php
    require_once "res/style/image_selection_overlay.php";
    ?>
</div>

<?php
require_once "res/style/menu.php";
?>

<?php

// Get page number.
$page_id = isset($_GET["page_id"]) ? $_GET["page_id"] : -1;

if ($page_id == -1) {
    // No page selected, show error message.
    echo "<h2>No page selected.</h2>";
} else {
    $page = Pages::read_dataset($page_id);
    if ($page == null) {
        // Page not found on database.
        echo "<h2>Page $page_id does not exist.</h2>";
    } else {
        ?>
        <!--Everything prepared. Main page layout starts here.-->

        <div style="margin: 2% 10%">
        <textarea class="h2" rows="1" style="width: 100%; color: black; line-height: initial;" id="saved_title"><?php
            echo $page["saved_title"];
            ?></textarea>
            <p>
                <!-- Editor button panel (top). -->
                <button class="btn btn-primary" id="button-undo" title="Undo last change.">
                    <i class="fa fa-undo"></i> Undo
                </button>
                <button class="btn btn-primary" id="button-redo" title="Redo last undone change.">
                    <i class="fa fa-redo"></i> Redo
                </button>
                <button class="btn btn-primary" id="button-bold" title="Format text as bold.">
                    <i class="fa fa-bold"></i> Bold
                </button>
                <button class="btn btn-primary" id="button-italic" title="Format text as italic.">
                    <i class="fa fa-italic"></i> Italic
                </button>
                <button class="btn btn-primary" id="button-underline" title="Format text as underlined.">
                    <i class="fa fa-underline"></i> Underline
                </button>
                <button class="btn btn-primary" id="button-newline" title="Insert a linebreak.">
                    <b>&lt;br&gt;</b> New Line
                </button>
                <button class="btn btn-primary" id="button-link" title="Insert a link.">
                    <i class="fa fa-link"></i> Link
                </button>
                <button class="btn btn-primary" id="button-heading" title="Format text as a heading.">
                    <i class="fa fa-heading"></i> Heading
                </button>
                <button class="btn btn-primary" id="button-picture" title="Insert tags for a picture incl. caption.">
                    <i class="fa fa-image"></i> Picture
                </button>
                <button class="btn btn-primary" id="button-gallery" title="Insert a picture from the gallery.">
                    <i class="fa fa-images"></i> Gallery
                </button>
                <button class="btn btn-primary" id="button-video" title="Insert tags for a video incl. caption.">
                    <i class="fa fa-video"></i> Video
                </button>
                <button class="btn btn-primary" id="button-page-layout" title="Insert a preformatted page layout.">
                    <i class="fa fa-columns"></i> Page Layout
                </button>
            </p>
            <textarea style="width: 100%; height: 70%;"
                      id="saved_content"><?php echo $page["saved_content"]; ?></textarea>
            <div class="container-fluid justify-content-end" style="margin: 5px 0 0 0">
                <div class="row">
                    <p class="col">
                        <label id="save_notification"></label>
                    </p>
                    <p>
                        <!-- Editor button panel (bottom). -->
                        <button class="btn btn-danger" id="button-delete" title="Delete this page.">Delete <i
                                    class="fa fa-trash"></i>
                        </button>
                        <button class="btn btn-primary" id="button-publish" title="Publish this version of this page.">
                            Publish <i class="fa fa-upload"></i>
                        </button>
                        <button class="btn btn-primary" id="button-preview" title="Open or refresh preview tab.">View
                            Preview <i class="fa fa-eye"></i>
                        </button>
                        <button class="btn btn-primary" id="button-save"
                                title="Save changes and refresh preview (if any).">Save <i class="fa fa-save"></i>
                        </button>
                    </p>
                </div>
            </div>
        </div>

        <script>
            // Variables.
            var page_id = "<?php echo $page_id; ?>";
            var previewTab = undefined;
            var preview_link = "preview.php?page_id=<?php echo $page_id?>";

            /*
            * Add functions to the buttons.
            */
            document.getElementById("button-undo").onclick = function () {
                undo();
            };

            document.getElementById("button-redo").onclick = function () {
                redo();
            };

            document.getElementById("button-bold").onclick = function () {
                insertBold();
            };

            document.getElementById("button-italic").onclick = function () {
                insertItalic();
            };

            document.getElementById("button-underline").onclick = function () {
                insertUnderline();
            };

            document.getElementById("button-newline").onclick = function () {
                insertNewline();
            };

            document.getElementById("button-link").onclick = function () {
                insertLink();
            };

            document.getElementById("button-picture").onclick = function () {
                insertPictureTag();
            };

            document.getElementById("button-gallery").onclick = function () {
                showOverlay("overlay-image-selection")
            };

            document.getElementById("button-video").onclick = function () {
                insertVideo();
            };

            document.getElementById("button-heading").onclick = function () {
                insertHeading();
            };

            document.getElementById("button-page-layout").onclick = function () {
                showOverlay("overlay-page-layout");
            };

            document.getElementById("button-delete").onclick = function () {
                /*
                Delete a page from the database.
                 */
                // Show confirmation dialog. If 'ok', proceed.
                if (confirm("Are you really sure that you want to delete this page? This can not be undone!")) {
                    // Fill POST form with page_id.
                    var formData = new FormData();
                    formData.append("page_id", page_id);
                    // Request database update via POST.
                    var request = new XMLHttpRequest();
                    request.open("POST", "delete_page.php", false);
                    request.send(formData);
                    // Set notification to status returned from updater.
                    var notification = request.responseText;
                    document.getElementById("save_notification").innerHTML = notification + " Redirecting to Pages...";
                    // Wait 3 seconds before redirecting to pages.php.
                    setTimeout(function () {
                        window.location.href = "pages.php";
                    }, 3000);
                }
            };

            document.getElementById("button-publish").onclick = function () {
                /*
                Publish the recent changes on the page.
                Saves changes from the textareas and publishes them.
                 */
                // Save changes.
                document.getElementById("button-save").click();
                // Publish saved changes.
                setTimeout(function () {
                    // Fill POST form with page_id.
                    var formData = new FormData();
                    formData.append("page_id", page_id);
                    // Request database update via POST.
                    var request = new XMLHttpRequest();
                    request.open("POST", "update_published_data.php", false);
                    request.send(formData);
                    // Set notification to status returned from updater.
                    document.getElementById("save_notification").innerHTML = request.responseText;
                }, 1000);
            };


            document.getElementById("button-preview").onclick = function () {
                /**
                 *Save changes and (re-)load the preview in a separate tab.
                 */
                if ((previewTab === undefined) || (previewTab.closed)) {
                    previewTab = window.open(preview_link, preview_link);
                } else {
                    previewTab.location.reload();
                }
            };

            document.getElementById("button-save").onclick = function () {
                /**
                 * Save changes. If preview is open, reload.
                 */
                    // Fill POST form with data.
                var formData = new FormData();
                formData.append("page_id", page_id);
                formData.append("saved_title", document.getElementById("saved_title").value);
                formData.append("saved_content", document.getElementById("saved_content").value);
                // Request database update via POST.
                var request = new XMLHttpRequest();
                request.open("POST", "update_saved_data.php", false);
                request.send(formData);
                // Set notification to status returned from updater.
                document.getElementById("save_notification").innerHTML = request.responseText;
                // Refresh preview tab if open. Wait 1 second so database update has finished before refresh.
                setTimeout(function () {
                    refreshPreview();
                }, 1000);
            };

            function refreshPreview() {
                /*
                Refresh the preview tab if it is open.
                 */
                if (!(previewTab === undefined) && !(previewTab.closed)) {
                    previewTab.location.reload();
                }
            }

            document.getElementById("saved_content").addEventListener('keydown', function (event) {
                /*
                Bind ctrl. + s on the saved_content textarea to the button_save function.
                 */
                var S = 83; // keycode of the key 'S'.
                if ((event.keyCode === S) && (event.ctrlKey)) {
                    event.preventDefault();
                    document.getElementById("button-save").click();
                }
            });

        </script>

        <?php
    }
}

?>

<?php
require_once "res/style/bootstrap_body_end.php"
?>
</body>

</html>