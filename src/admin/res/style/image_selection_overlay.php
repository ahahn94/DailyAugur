<?php
/**
 * Created by ahahn94
 * on 13.01.19
 */

/*
 * Overlay for inserting images from the CMS into a page.
 */

require_once __DIR__ . "/../../../php_includes/database/resources/Images.php";
?>
<div class="album py-5 bg-light">
    <br>
    <table width="100%">
        <tr>
            <td width="10%">
                <!-- Button to hide overlay. -->
                <button class="btn btn-secondary" onclick="hideOverlay('overlay-image-selection')"><i
                            class="fa fa-arrow-left"></i> Back
                </button>
            </td>
            <td width="80%">
                <h2 class="text-center">Select a picture from the gallery</h2>
            </td>
            <td width="10%"></td>
        </tr>
    </table>
    <br>
    <div class="container-fluid">

        <div class="row">
            <?php

            $images = Images::read_datasets();

            if ($images != null) {
                // If there are any images on the database, show them as an album.
                foreach ($images as $image) {
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
                                        <button class="btn btn-primary btn-sm" type="button"
                                                onclick="hideOverlay('overlay-image-selection'); insertPicture('<?php echo $image_path; ?>')">
                                            <i class="fa fa-check"></i> Select
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
                            <h2 class="text-center">You can upload images at the <a href="images.php">Images</a>
                                section of the menu.</h2>
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