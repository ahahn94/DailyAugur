<?php
/**
 * Created by ahahn94
 * on 08.01.19
 */

/*
 * Page for managing and uploading images to the image cache.
 */

require_once __DIR__ . "/../php_includes/database/resources/Images.php";

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

<!-- Hidden form and file input. -->
<form style="visibility: hidden; width: 0px; height: 0px;" action="upload_image.php" method="post">
    <input type="file" id="image_file" accept="image/png, image/jpeg" multiple>
</form>
<div class="row justify-content-end" style="margin: 10px">
    <div class="col-10"></div>
    <div class="col-auto">
        <button class="btn btn-primary" id="button-select-image"><i class="fa fa-image"> Select Image for Upload</i>
        </button>
    </div>
</div>

<!-- Album of the cached images. -->

<div class="album py-5 bg-light">
    <div class="container-fluid">

        <div class="row">
            <?php

            $images = Images::read_datasets();

            if ($images != null) {
                // If there are any images on the database, show them as an album.
                foreach ($images as $image) {
                    $image_id = $image["image_id"];
                    $image_path = $image["path"];
                    $image_name = $image["name"];
                    ?>
                    <div class="col-6 col-md-3 col-lg-2 col-xl-2">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top"
                                 data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                                 alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                                 src="<?php echo $image_path; ?>"
                                 data-holder-rendered="true">
                            <div class="card-body">
                                <p class="card-text"><?php echo $image_name; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <a class="btn btn-primary btn-sm" target="_blank" rel="noopener noreferrer"
                                           href="<?php echo $image_path ?>">
                                            <i class="fa fa-eye"></i> View</a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteImage('<?php echo $image_id; ?>')"><i
                                                    class="fa fa-trash"></i>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Show a notification if there are no images on the database.
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col"><h1 class="text-center"><b>There Are No Images On The Database!</b></h1>
                            <h2 class="text-center">Use the upload button in the upper right corner to add images.</h2>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<script>

    /*
    Bind functions to buttons.
     */

    document.getElementById("image_file").onchange = function () {
        /*
        Automatically upload one or multiple image files on selection.
         */
        var image_file = document.getElementById("image_file");
        if (image_file.value !== "") {
            const files = image_file.files;
            var counter = 0;
            var length = image_file.files.length;
            Object.keys(files).forEach(i => {
                var name = image_file.files[i].name;
                var reader = new FileReader();
                // Read files as base64 encoded strings.
                reader.readAsDataURL(image_file.files[i]);
                reader.onload = function () {
                    var formData = new FormData();
                    formData.append("name", name);
                    formData.append("file", reader.result);

                    // Request database update via POST.
                    var request = new XMLHttpRequest();
                    request.open("POST", "upload_image.php", false);
                    request.send(formData);
                    request.responseText;
                    // Reload page after last file has been uploaded.
                    if (counter === length - 1) {
                        location.reload();
                    }
                    counter += 1;
                }
            });
        }
    };

    document.getElementById("button-select-image").onclick = function () {
        /*
        Open file selection dialog.
         */
        document.getElementById("image_file").click();
    };

    function deleteImage(image_id) {
        /*
        Delete an image from the cache.
         */
        var formData = new FormData();
        formData.append("image_id", image_id);

        // Request database update via POST.
        var request = new XMLHttpRequest();
        request.open("POST", "delete_image.php", false);
        request.send(formData);
        request.responseText;
        location.reload();
    }

</script>

<?php
require_once "res/style/bootstrap_body_end.php";
?>
</body>


</html>
