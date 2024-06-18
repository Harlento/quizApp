// String insertion function
function stringInsert(string, toInsert, position) {
    var newString;

    newString = string.slice(0, position)
    + toInsert + string.slice(position);

    return newString;
}

// A function for counting a specific character in a string
function charCount(string, char) {
    var count = 0;

    for(var i = 0; i < (string.length - 1); i++) {
        if(string.charAt(i) == char) {
            count += 1;
        }
    }
    return count;
}

// This is for auto formatting the telephone field of a form
function autoFormat() {
    // numString is the number, length is how many characters it consists of
    var numString;
    var length;
    
    numString = $("#phoneN").val();

    length = numString.length;

    // For debugging
    //$("#p").text(length);

    numString.string

    if(length === 1){
        numString = numString + "-";
    }

    if(length === 5){
        numString = stringInsert(numString, "(", 2);
        numString = numString + ")";
    }

    if(length === 8) {
        numString = stringInsert(numString, "-", 7);
    }

    // && (countDashes(numString) )
    if(length === 11) {
        numString = numString + "-";
    }

    $("#phoneN").val(numString);
}