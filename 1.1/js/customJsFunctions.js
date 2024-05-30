
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

// This will spawn two inputs on click of a button /////////////////////////
$(document).ready
(
  function()
  {
    var qCount = 0;
    var qName = 'q';
    var aName = 'a';
    var lineBreak = '<br />';

    $('#spawnButton').click(function()
    {
      qCount++;
      qName = qName + 'q';
      aName = aName + 'a';
      //aCount++;

      var label1 = $('<label>').attr('for', qName).text
      ('Question ' + qCount + ': ');

      var input1 = $('<input>').attr({
        type: 'text',
        name: qName,
        id: qName
      });

      var label2 = $('<label>').attr('for', aName).text
      ('Answer: ');

      var input2 = $('<input>').attr({
        type: 'text',
        name: aName,
        id: aName
      });

      let divNum = qCount;

      var div = $('<div>').attr({
        id: 'answerDiv' + qCount
      });
      
      var newAnswerButton = $('<button>').attr(
        {
          id: 'spawnAnswer' + qCount, 
          onClick: 'spawnNewAnswer(this.id)',
          class: 'btn btn-primary',
          type: 'button'
        }).text('New answer');

      $('#dynamicForm').append(label1, input1, lineBreak,
       label2, input2, lineBreak, div, newAnswerButton, lineBreak, lineBreak);

      $('html, body').animate({ scrollTop: $(document).height() }, 1);

      //$('#answerDiv' + qCount).append(newAnswerButton);
    });
  }
);

let aCount = 2
let buttonIDTrack = '';

// This will spawn a new answer input field after the previous one above the button clicked
function spawnNewAnswer(buttonID)
{
  let numberIndex = -1;

  // Iterate through the string to find the index of the first numeric character
  for(let i = 0; i < buttonID.length; i++)
  {
    if (!isNaN(buttonID[i]) && buttonID[i] !== ' ')
    {
      numberIndex = i; // Update the index when the first numeric character is found
      break;
    }
  }

  // Check if a numeric character was found and remove characters before it
  let qNumber = numberIndex !== -1 ? buttonID.substring(numberIndex) : 'failed';
  // now the current question number is in the questionNumber variable

  // this retrieves the element id of the last answer /////////////////////////////////////
  const currentElement = $('#' + buttonID);

  const previousElement = $(currentElement).prev();
  const previousElementId = $(previousElement).attr('id');

  const beforePreviousElement = $(previousElement).prev();

  const lastInputElement = $(beforePreviousElement).prev();
  const lastInputElementId = $(lastInputElement).attr('id');

  const previousElementChild = $('#' + previousElementId).children().last();
  const beforePreviousElementChild = $(previousElementChild).prev();
  const beforePreviousElementChildId = $(beforePreviousElementChild).attr('id');

  /*
  const beforePreviousElement = $(previousElement).prev();
  const beforePreviousElementId = $(beforePreviousElement).attr('id');
  const parentElement = $(currentElement).parent();
  const parentInputId = parentElement.attr('id');
  const beforeParentElement = $(parentElement).prev();
  const firstAnswer = $(beforeParentElement).prev();
  const firstAnswerId = $(firstAnswer).attr('id');
  */

  //////////////////////////////////////////////////////////////////////////////////////////

  /*
  if (previousElement.childElementCount > 0) 
  {
    // The previous sibling has children
    // Add your logic or styles here

    // test
    document.getElementById("test").innerHTML = previousElement.childElementCount;
  }
  */

  var aName;

  if(typeof beforePreviousElementChildId === 'undefined')
  {
    aName = lastInputElementId + 'e';
  }
  else
  {
    aName = beforePreviousElementChildId + 'e';
  }

  // new answer input with label to prepend to the new answer button

  var label = $('<label>').attr('for', aName).text
  ('Answer: ');

  var input = $('<input>').attr({
    type: 'text',
    name: aName,
    id: aName
  });

  var lineBreak = '<br />';

  $('#' + previousElementId).append(label, input, lineBreak);

  // test
  //document.getElementById("test2").innerHTML = aName;
  //$('#test').append(firstPreviousElement, secondPreviousElement);
}
  
// This will prevent the enter button from submitting the forms
$(document).ready(function() {
  $('form').on('keypress',
  function(event) {
    if(event.keyCode === 13) {
      event.preventDefault();
    }
  });
});
//////////////////////////////////////////////////////////////////////////