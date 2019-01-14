<?php
/**
 * Created by ahahn94
 * on 12.01.19
 */

/*
 * Overlay for inserting a page layout into a page.
 */

?>

<div class="album py-5 bg-light">
    <br>
    <table width="100%">
        <tr>
            <td width="10%">
                <!-- Button to hide overlay. -->
                <button class="btn btn-secondary" onclick="hideOverlay('overlay-page-layout')"><i
                            class="fa fa-arrow-left"></i> Back
                </button>
            </td>
            <td width="80%">
                <h2 class="text-center">Select a page layout:</h2>
            </td>
            <td width="10%"></td>
        </tr>
    </table>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top"
                         data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                         alt="Thumbnail [100%x225]" src="res/images/table_even.png" data-holder-rendered="true"
                         style="height: 25%; width: 100%; display: block;">
                    <div class="card-body">
                        <div class="text-center">
                            Two cells of the same size.
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary"
                                        onclick="hideOverlay('overlay-page-layout'); insert2ColumnLayout('50%')"><i
                                            class="fa fa-check"></i> Select
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top"
                         data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                         alt="Thumbnail [100%x225]" src="res/images/table_3.png" data-holder-rendered="true"
                         style="height: 25%; width: 100%; display: block;">
                    <div class="card-body">
                        <div class="text-center">
                            Three cells of the same size.
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary"
                                        onclick="hideOverlay('overlay-page-layout'); insert3ColumnLayout()"><i
                                            class="fa fa-check"></i> Select
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top"
                         data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                         alt="Thumbnail [100%x225]" src="res/images/table_big_left.png" data-holder-rendered="true"
                         style="height: 25%; width: 100%; display: block;">
                    <div class="card-body">
                        <div class="text-center">
                            Left cell two thirds, right cell one third.
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary"
                                        onclick="hideOverlay('overlay-page-layout'); insert2ColumnLayout('66%')"><i
                                            class="fa fa-check"></i> Select
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top"
                         data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                         alt="Thumbnail [100%x225]" src="res/images/table_big_right.png" data-holder-rendered="true"
                         style="height: 25%; width: 100%; display: block;">
                    <div class="card-body">
                        <div class="text-center">
                            Left cell one third, right cell two thirds.
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary"
                                        onclick="hideOverlay('overlay-page-layout'); insert2ColumnLayout('33%')"><i
                                            class="fa fa-check"></i> Select
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>