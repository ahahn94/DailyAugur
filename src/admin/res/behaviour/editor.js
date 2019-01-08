function insertAtCursor(text) {
    /*
    Insert text at the cursor position inside the last active textarea.
     */
    document.execCommand("insertText", false, text);
}

function surroundSelectionWithText(textBeforeSelection, textAfterSelection) {
    /*
    Surround the selection inside the last active text area with text.
     */
    // Save selection and assemble text for insertion.
    var selection = document.getSelection().toString();
    var text = textBeforeSelection + selection + textAfterSelection;
    // Delete selection and insert text.
    document.execCommand("delete", false);
    document.execCommand("insertText",false, text);
}

/*
Insert formatting tags.
 */

function insertBold(){
    surroundSelectionWithText("<b>", "</b>");
}

function insertItalic(){
    surroundSelectionWithText("<i>", "</i>");
}

function insertUnderline(){
    surroundSelectionWithText("<u>", "</u>");
}

function insertNewline(){
    insertAtCursor("<br>");
}

function insertLink(){
    surroundSelectionWithText("<a href=\"\">", "</a>");
}

function insertPicture(){
    insertAtCursor("<img src=\"\"></img>");
}

function insertVideo(){
    insertAtCursor(
        "\n<video class=\"wrap_left\" autoplay loop muted width=\"30%\">\n" +
        "        <source src=\"\" type=\"video/webm\">\n" +
        "</video>\n");
}