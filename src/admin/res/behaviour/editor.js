/**
 * Insert text at the cursor position inside the last active textarea.
 * @param text Text to insert.
 */
function insertAtCursor(text) {
    document.execCommand("insertText", false, text);
}

/**
 * Surround the selection inside the last active text area with text.
 * @param textBeforeSelection Text to insert in front of the selection.
 * @param textAfterSelection Text to insert behind the selection.
 */
function surroundSelectionWithText(textBeforeSelection, textAfterSelection) {
    // Save selection and build text for insertion.
    var selection = document.getSelection().toString();
    var text = textBeforeSelection + selection + textAfterSelection;
    // Delete selection and insert text.
    document.execCommand("delete", false);
    document.execCommand("insertText", false, text);
}

/*
Undo/Redo functions.
 */

function undo() {
    document.execCommand("undo", false);
}

function redo() {
    document.execCommand("redo", false);
}

/*
Insert formatting tags.
 */

function insertBold() {
    surroundSelectionWithText("<b>", "</b>");
}

function insertItalic() {
    surroundSelectionWithText("<i>", "</i>");
}

function insertUnderline() {
    surroundSelectionWithText("<u>", "</u>");
}

function insertNewline() {
    insertAtCursor("<br>");
}

function insertLink() {
    surroundSelectionWithText("<a href=\"\">", "</a>");
}

/**
 * Insert a picture as a figure incl. figure caption.
 * @param imagePath Path to the image file.
 */
function insertPicture(imagePath) {
    insertAtCursor(
        "<figure class=\"wrap_left\">\n" +
        "    <img src=\"" + imagePath + "\"></img>\n" +
        "    <figcaption>\n" +
        "        <!-- Caption -->\n" +
        "    </figcaption>\n" +
        "</figure>" +
        "\n"
    );
}

/**
 * Insert tags for a picture as a figure incl. figure caption.
 * The src attribute will be blank.
 */
function insertPictureTag() {
    surroundSelectionWithText(
        "<figure class=\"wrap_left\">\n" +
        "    <img src=\"", "\"></img>\n" +
        "    <figcaption>\n" +
        "        <!-- Caption -->\n" +
        "    </figcaption>\n" +
        "</figure>" +
        "\n"
    );
}

/**
 * Insert tags for a video as a figure incl. figure caption.
 * The src attribute of the <source> tag will be blank.
 */
function insertVideo() {
    insertAtCursor(
        "<figure class=\"wrap_left\">\n" +
        "    <video class=\"wrap_left\" autoplay loop muted width=\"30%\">\n" +
        "        <source src=\"\" type=\"video/webm\">\n" +
        "    </video>\n" +
        "    <figcaption>\n" +
        "        <!-- Caption -->\n" +
        "    </figcaption>\n" +
        "</figure>" +
        "\n");
}

function insertHeading() {
    surroundSelectionWithText("<h2 class='text-center textflow'>", "</h2>");
}

/**
 * Insert a table of one top cell and 2 smaller bottom cells.
 * The size of bottom cells is set by the width of the bottom left cell.
 * @param firstColumnWidth
 */
function insert2ColumnLayout(firstColumnWidth) {
    insertAtCursor(
        "<table width='100%'>\n" +
        "<tbody>\n" +
        "<tr>\n" +
        "    <td colspan='2'>\n" +
        "\n<!-- Upper cell. -->\n\n" +
        "    </td>\n" +
        "</tr>\n" +
        "<tr>\n" +
        "    <td width='" + firstColumnWidth + "'>\n" +
        "\n<!-- Left cell. -->\n\n" +
        "    </td>\n" +
        "    <td>\n" +
        "\n<!-- Right cell. -->\n\n" +
        "    </td>\n" +
        "</tr>\n" +
        "</tbody>\n" +
        "</table>\n"
    );
}

/**
 * Insert a table of one top cell and 3 smaller bottom cells.
 * The top cell width is the sum of the 3 bottom cells, which are of equal size.
 */
function insert3ColumnLayout() {
    insertAtCursor(
        "<table width='100%'>\n" +
        "<tbody>\n" +
        "<tr>\n" +
        "    <td colspan='3'>\n" +
        "\n<!-- Upper cell. -->\n\n" +
        "    </td>\n" +
        "</tr>\n" +
        "<tr>\n" +
        "    <td>\n" +
        "\n<!-- Left cell. -->\n\n" +
        "    </td>\n" +
        "    <td>\n" +
        "\n<!-- Middle cell. -->\n\n" +
        "    </td>\n" +
        "    <td>\n" +
        "\n<!-- Right cell. -->\n\n" +
        "    </td>\n" +
        "</tr>\n" +
        "</tbody>\n" +
        "</table>\n"
    );
}

/**
 * Show the overlay in the foreground. Blocks view to background.
 * @param elementID ID of the overlay to show.
 */
function showOverlay(elementID) {
    document.getElementById(elementID).style.display = "block";
}

/**
 * Hide the overlay.
 * @param elementID ID of the overlay to hide.
 */
function hideOverlay(elementID) {
    document.getElementById(elementID).style.display = "none";
}
