
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

// this disables inpecting of elements ////////////////////////////////////////////
/*
$(document).ready(
  document.addEventListener("contextmenu", e => e.preventDefault(), false)
);
*/
/////////////////////////////////////////////////////////////////////////////////

//e.ctrlKey || 

// this will diable the use of the F12 key so you may not inspect the page in 
// normal ways
/*
$(document).ready
(
  document.addEventListener
  ("keydown", e => 
    {
      if (e.key === 'F12') 
      {
          e.stopPropagation();
          e.preventDefault();
      }
    }
  )
);
*/
/////////////////////////////////////////////////////////////////////////////////

// This will spawn two inputs at the click of a button /////////////////////////
$(document).ready
(
  function()
  {
    var $qCount = 0;
    var qName = 'q';
    var aName = 'a';
    var lName = 'l';
    var lineBreak = '<br />';

    $('#spawnButton').click(function()
    {
      $qCount++;
      qName = qName + 'q';
      aName = aName + 'a';
      lName = lName + 'l';
      //aCount++;

      var questionLabel = $('<label>').attr(
        {
          for: qName,
          id: lName
        }).text('Question ' + $qCount + ': ');

      var questionInput = $('<input>').attr({
        type: 'text',
        name: qName,
        id: qName
      });

      var answerLabel = $('<label>').attr('for', aName).text
      ('Answer: ');

      var answerInput = $('<input>').attr({
        type: 'text',
        name: aName,
        id: aName
      });

      let divNum = $qCount;

      var div = $('<div>').attr({
        id: 'answerDiv' + $qCount
      });

      var deleteQuestionButton = $('<button>').attr(
      {
        id: 'deleteQuestion' + $qCount,
        onClick: 'deleteQuestion(this.id)',
        class: 'btn btn-danger',
        type: 'button',
      }).text('Delete question');
      
      var newAnswerButton = $('<button>').attr(
      {
        id: 'spawnAnswer' + $qCount, 
        onClick: 'spawnNewAnswer(this.id)',
        class: 'btn btn-primary',
        type: 'button'
      }).text('New answer');

      $('#dynamicForm').append(questionLabel, questionInput, deleteQuestionButton, lineBreak,
       answerLabel, answerInput, lineBreak, div, newAnswerButton, lineBreak, lineBreak);

      // fix the numbers of the questions ////////////////////////////////////////////////////////
      const numberOfElements = $('#dynamicForm').children().length;

      // test
      //document.getElementById("test2").innerHTML = 'Number of elements: ' + numberOfElements;

      var element = $('#dynamicForm').children().first();
      var elementID = $(element).attr('id');

      var currentQuestion = 'qq';
      var qCounter = 1;

      // test
      //document.getElementById("test3").innerHTML = element;

      // iterate through every element in the dynamicForm form
      for(var i = 0; i < numberOfElements; i++)
      {
        element = $(element).next();
        elementID = $(element).attr('id');
        elementLabel = $(element).prev();
        elementLabelID = $(elementLabel).attr('id');

        //currentQuestion = currentQuestion + 'q';

        // this means it does have a valid ID
        if(typeof elementID != 'undefined')
        {
          // test
          //document.getElementById("test1").innerHTML = 'First element with an id: ' + elementID;

          // test
          //document.getElementById("test2").innerHTML = 'Currently seeked question: ' + currentQuestion;

          // test
          //document.getElementById("test5").innerHTML = 'Current loop iteration: ' + i;

          // this means it is a question input
          if(elementID[0] == 'q')
          {
            // test
            //document.getElementById("test4").innerHTML = 'It was a question :)';

            // 
            if(currentQuestion != elementID)
            {
              // test
              //document.getElementById("test3").innerHTML = 'Element label ID: ' + elementLabelID;

              // I will change the for attr of the label of it, change it's id, and 
              // make a new string with the intended number
              $('#' + elementID).attr('id', currentQuestion);
              $('#' + elementLabelID).attr('for', currentQuestion).text('Question ' + qCounter + ': ');
              //.text('Question ' + qCounter + ': ');

              elementID = element.attr('id');

              // test
              //document.getElementById("test4").innerHTML = elementID;
              //break;

              currentQuestion = currentQuestion + 'q';
            }
            else
            {
              // test
              //document.getElementById("test5").innerHTML = 'It was the question being seeked :)';
              currentQuestion = currentQuestion + 'q';
            }

            qCounter++;
          }
        }
      }
      ////////////////////////////////////////////////////////////////////////////////////////////

      $('html, body').animate({ scrollTop: $(document).height() }, 1);
    });
  }
);

// the function that deletes the current question ///////////////////////////////////////////////
function deleteQuestion(buttonID)
{
  // the delete button as an object
  var deleteQuestionButton = $('#' + buttonID);
  //
  var questionInputElement = $(deleteQuestionButton).prev();
  var questionInputElementID = $(questionInputElement).attr('id');

  var questionLabel = $(questionInputElement).prev();

  // the element vars for the loop
  var nextElement1 = $(deleteQuestionButton).next();
  var nextElement2 = $(nextElement1).next();
  var nextElement3 = $(nextElement2).next();
  var nextElement4 = $(nextElement3).next();
  var nextElement5 = $(nextElement4).next();
  var nextElement6 = $(nextElement5).next();
  var nextElement7 = $(nextElement6).next();
  var nextElement8 = $(nextElement7).next();

  // elements to be removed 
  deleteQuestionButton.remove();
  questionInputElement.remove();
  questionLabel.remove();
  nextElement1.remove();
  nextElement2.remove();
  nextElement3.remove();
  nextElement4.remove();
  nextElement5.remove();
  nextElement6.remove();
  nextElement7.remove();
  nextElement8.remove();

  // rename the questions
  // test
  //document.getElementById("test1").innerHTML = 'Deleted question ID: ' + questionInputElementID;

  const numberOfElements = $('#dynamicForm').children().length;

  // test
  //document.getElementById("test2").innerHTML = 'Number of elements: ' + numberOfElements;

  var element = $('#dynamicForm').children().first();
  var elementID = $(element).attr('id');

  var currentQuestion = 'qq';
  var qCounter = 1;

  // test
  //document.getElementById("test3").innerHTML = element;

  // iterate through every element in the dynamicForm form
  for(var i = 0; i < numberOfElements; i++)
  {
    element = $(element).next();
    elementID = $(element).attr('id');
    elementLabel = $(element).prev();
    elementLabelID = $(elementLabel).attr('id');

    //currentQuestion = currentQuestion + 'q';

    // this means it does have a valid ID
    if(typeof elementID != 'undefined')
    {
      // test
      //document.getElementById("test1").innerHTML = 'First element with an id: ' + elementID;

      // test
      //document.getElementById("test2").innerHTML = 'Currently seeked question: ' + currentQuestion;

      // test
      //document.getElementById("test5").innerHTML = 'Current loop iteration: ' + i;

      // this means it is a question input
      if(elementID[0] == 'q')
      {
        // test
        //document.getElementById("test4").innerHTML = 'It was a question :)';

        // 
        if(currentQuestion != elementID)
        {
          // test
          //document.getElementById("test3").innerHTML = 'Element label ID: ' + elementLabelID;

          // I will change the for attr of the label of it, change it's id, and 
          // make a new string with the intended number
          $('#' + elementID).attr('id', currentQuestion);
          $('#' + elementLabelID).attr('for', currentQuestion).text('Question ' + qCounter + ': ');
          //.text('Question ' + qCounter + ': ');

          elementID = element.attr('id');

          // test
          //document.getElementById("test4").innerHTML = elementID;
          //break;

          currentQuestion = currentQuestion + 'q';
        }
        else
        {
          // test
          //document.getElementById("test5").innerHTML = 'It was the question being seeked :)';
          currentQuestion = currentQuestion + 'q';
        }

        qCounter++;
      }
    }
  }
}
////////////////////////////////////////////////////////////////////////////////////////////////

/*
function rename(elementID)
{

}
*/

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

  // this retrieves the current button as an object /////////////////////////////////////
  const spawnAnswerButton = $('#' + buttonID);

  // this refers to the div before the button
  const answerDiv = $(spawnAnswerButton).prev();
  const answerDivId = $(answerDiv).attr('id');

  // this refers to the line break before the div that gets inputs inserted into it
  const lineBreakBeforeDiv = $(answerDiv).prev();

  // this is the delete button of the previous element
  const firstInputElement = $(lineBreakBeforeDiv).prev();
  const firstInputElementId = $(firstInputElement).attr('id');

  // this is the input before the delete button of the previous input
  const previousInputElement = $(firstInputElement).prev();
  const previousInputElementId = $(firstInputElement).attr('id');

  // this is the line break at the bottom of the div that has inputs inserted into it
  const lineBreakAtBottomOfDiv = $('#' + answerDivId).children().last();

  // this is the final input in the div
  const deleteAtBottom = $(lineBreakAtBottomOfDiv).prev();
  const deleteAtBottomId = $(deleteAtBottom).attr('id');

  // final input in div
  const finalInput = $(deleteAtBottom).prev();
  const finalInputId = $(finalInput).attr('id');

  /*
  const beforePreviousElement = $(previousElement).prev();
  const beforePreviousElementId = $(beforePreviousElement).attr('id');
  const parentElement = $(spawnAnswerButton).parent();
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

  if(typeof deleteAtBottomId === 'undefined')
  {
    aName = previousInputElementId + 'e';
  }
  else
  {
    aName = finalInputId + 'e';
  }

  // new answer input with label to append to the new answer button
  var label = $('<label>').attr({
    for: aName,
    id: 'l' + aName
  }).text('Answer: ');

  var input = $('<input>').attr({
    type: 'text',
    name: aName,
    id: aName
  });

  var lineBreak = $('<br />').attr({
    id: 'b' + aName
  });

  var deleteButton = $('<button>').attr({
    type: 'button',
    id: 'd' + aName,
    class: 'btn btn-danger',
    onClick: 'deleteAnswer(this.id)'
  }).text('Delete answer');

  $('#' + answerDivId).append(label, input, deleteButton, lineBreak);

  // test
  //document.getElementById("test2").innerHTML = finalInputId;
  //$('#test').append(firstPreviousElement, secondPreviousElement);
}

// delete button for new answer inputs /////////////////////////////////////
function deleteAnswer(buttonID)
{
  // this is refering to the input directly before the delete button
  const input = $('#' + buttonID).prev();
  const inputID = $(input).attr('id');

  // this is the label of the input
  const inputLabel = $(input).prev();
  const inputLabelID = $(inputLabel).attr('id');

  // this is the line break before the input label
  const lineBreak = $(inputLabel).prev();
  const lineBreakID = $(lineBreak).attr('id');

  // this is the line break after the delete button
  const lineBreakAfter = $('#' + buttonID).next();
  const lineBreakAfterID = $(lineBreakAfter).attr('id');

  // remove all the inputs and line breaks on the current line of the page
  $('#' + inputID).remove();
  $('#' + inputLabelID).remove();
  $('#' + lineBreakID).remove();
  
  $('#' + buttonID).remove();
}
////////////////////////////////////////////////////////////////////////////
  
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

/////////////////////////
function interceptDelete()
{
  const want = confirm("Are you sure you want to delete this quiz?");

  if(!want) 
  {
    return false; // Prevent form submission
  }
}
////////////////////////