
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
    var aCount = 0;
    var lineBreak = '<br />';

    $('#spawnButton').click(function()
    {
      qCount++;
      aCount = 0;
      aCount++;

      var label1 = $('<label>').attr('for', 'q' + qCount).text
      ('Question ' + qCount + ': ');

      var input1 = $('<input>').attr({
        type: 'text',
        name: qCount,
        id: 'q' + qCount
      });

      var label2 = $('<label>').attr('for', 'q' + qCount + 'a' + aCount).text
      ('Answer: ');

      var input2 = $('<input>').attr({
        type: 'text',
        name: aCount,
        id: 'q' + qCount + 'a' + aCount
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
       label2, input2, lineBreak, div, lineBreak, lineBreak);

      

      $('#answerDiv' + qCount).append(newAnswerButton);
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
  const beforePreviousElement = $(previousElement).prev();
  const beforePreviousElementId = $(beforePreviousElement).attr('id');
  const parentElement = $(currentElement).parent();
  const parentInputId = parentElement.attr('id');
  const beforeParentElement = $(parentElement).prev();
  const firstAnswer = $(beforeParentElement).prev();
  const firstAnswerId = $(firstAnswer).attr('id');

  //////////////////////////////////////////////////////////////////////////////////////////

  let numberIndex2 = -1;

  var numberInstance = 0;

  // Iterate through the string to find the index of the first numeric character
  for(let j = 0; j < firstAnswerId.length; j++)
  {
    if (!isNaN(firstAnswerId[j]) && firstAnswerId[j] !== ' ')
    {
      if(numberInstance > 0)
      {
        numberIndex2 = j; // Update the index when the first numeric character is found
        break;
      }
      numberInstance++;
    }
  }

  // Check if a numeric character was found and remove characters before it
  let aNumber = numberIndex2 !== -1 ? firstAnswerId.substring(numberIndex2) 
  : 'failed';

  /*
  if(currentElementId != )
  {

  }
  */

  if(typeof beforePreviousElementId === 'undefined')
  {
    aNumber = Number(aNumber);
    aNumber = aNumber + 1;
    aNumber = aNumber.toString();
  }
  else
  {
    let numberIndex3 = -1;

    numberInstance = 0;

    // Iterate through the string to find the index of the first numeric character
    for(let k = 0; k < beforePreviousElementId.length; k++)
    {
      if (!isNaN(beforePreviousElementId[k]) && beforePreviousElementId[k] !== ' ')
      {
        if(numberInstance > 0)
        {
          numberIndex3 = k; // Update the index when the first numeric character is found
          break;
        }
        numberInstance++;
      }
    }

    // Check if a numeric character was found and remove characters before it
    let aNumber = numberIndex2 !== -1 ? firstAnswerId.substring(numberIndex2) 
    : 'failed';


  }
  
  
  // new answer input with label to prepend to the new answer button

  var label = $('<label>').attr('for', 'q' + qNumber + 'a' + aNumber).text
  ('Answer: ');

  var input = $('<input>').attr({
    type: 'text',
    name: aNumber,
    id: 'q' + qNumber + 'a' + aNumber
  });

  var lineBreak = '<br />';

  $('#' + parentInputId).prepend(label, input, lineBreak);

  // test
  document.getElementById("test").innerHTML = aNumber;
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