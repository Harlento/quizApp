
// 
function chevronDirection()
{
  //$('#sortChev').attr('src', '/assets/downChevronScaledDown.png');
  // check if the value is true or false changing the image source accordingly
  if($('#aSortIn').val() == 'false')
  {
    // upward chevron
    $('#sortChev').attr('d', 'M 567.35,52.36 C 567.35,52.36 51.86,567.85 51.86,567.85 51.86,567.85 148.04,664.03 148.04,664.03 148.04,664.03 568.06,244.00 568.06,244.00 568.06,244.00 986.67,662.61 986.67,662.61 986.67,662.61 1082.14,567.14 1082.14,567.14 1082.14,567.14 567.35,52.36 567.35,52.36 Z');
  }
  else
  {
    // downward chevron
    $('#sortChev').attr('d', 'M 566.65,664.64 C 566.65,664.64 1082.14,149.15 1082.14,149.15 1082.14,149.15 985.96,52.97 985.96,52.97 985.96,52.97 565.94,473.00 565.94,473.00 565.94,473.00 147.33,54.39 147.33,54.39 147.33,54.39 51.86,149.86 51.86,149.86 51.86,149.86 566.65,664.64 566.65,664.64 Z');
  }
}

// 
function batchAddQuestions()
{
  // 
  for(var i = 0; i < $('#questionBatchInput').val(); i++)
  {
    addInputPair();
  }
  // this moves the page down to the new bottom of it with new elements added in
  movePage();
}

//
function forceNumberRange()
{
  // 
  if($('#questionBatchInput').val() < 0)
  {
    $('#questionBatchInput').val('0');
  }
  else if($('#questionBatchInput').val() > 200)
  {
    $('#questionBatchInput').val('200');
  }
}

//
function changeFormAction()
{
  $('#dynamicForm').attr('action', '/newQuiz.php');
}

// function that renames the questions and their labels when one is added or deleted
function renameQuestions()
{
  const numberOfElements = $('#dynamicForm').children().length;

  var element = $('#dynamicForm').children().first();
  var elementID = $(element).attr('id');
  var elementLabel = $(element).prev();
  var elementLabelID = $(elementLabel).attr('id');

  var qCounter = 0;
  //var numberOfQuestions = 0;

  // iterate through every element in the dynamicForm form
  for(var j = 0; j < numberOfElements; j++)
  {
    element = $(element).next();
    elementID = $(element).attr('id');
    elementName = $(element).attr('name');

    elementLabel = $(element).prev();
    elementLabelID = $(elementLabel).attr('id');

    // test
    //console.log(qCounter);

    // this means it does have a valid ID
    if(typeof elementID != 'undefined')
    {
      // this means it is a question input
      if(elementID[0] == 'q')
      {
        qCounter++;
        //
        $('#' + elementLabelID).text('Question ' + qCounter + ': ');
      }
    }
  }
}

// This will spawn two inputs at the click of a button /////////////////////////////////////////
function addInputPair()
{
  var $qCount = 0;
  var qName = 'q';
  var aName = 'a';
  var lName = 'l';
  var lineBreak = '<br />';

  $qCount++;

  const numberOfElements = $('#dynamicForm').children().length;
  var element = $('#dynamicForm').children().last();
  var elementID = $(element).attr('id');
  var elementLabel = $(element).prev();
  var elementLabelID = $(elementLabel).attr('id');

  for(var k = numberOfElements; k > 0; k--)
  {
    element = $(element).prev();
    elementID = $(element).attr('id');
    elementLabel = $(element).prev();
    elementLabelID = $(elementLabel).attr('id');

    // four ahead of the question will be its answer
    element2 = $(element).next();
    element3 = $(element2).next();
    element4 = $(element3).next();
    element5 = $(element4).next();
    element5ID = $(element5).attr('id');

    if(typeof elementID != 'undefined')
    {
      // this means it is a question input
      if(elementID[0] == 'q')
      {
        {
          // set id of current element to qName
          qName = elementID;
          lName = elementLabelID;
          $qCount = elementID.length - 1;

          // not done must be changed !!!!!!!!!!!!!!!!!!!/////////////////////////////////////
          aName = element5ID;
          ///////////////////////////////////////////////////////////////////////////////////
          
          //break;
          //console.log('Element ID of the last question: ' + elementID);
          break;
        }
      }
    }
  }

  qName = qName + 'q';
  aName = aName + 'a';
  lName = lName + 'l';

  var questionLabel = $('<label>').attr(
  {
    for: qName,
    id: lName
  }).text('Question ' + $qCount + ': ');

  //onchange: updateValue(this.value)
  var questionInput = $('<input>').attr({
    type: "text",
    name: qName,
    id: qName,
    value: "",
    oninput: 'updateValue(this)'
  });

  var answerLabel = $('<label>').attr('for', aName).text
  ('Answer: ');

  var answerInput = $('<input>').attr({
    type: "text",
    name: aName,
    id: aName,
    value: "",
    oninput: 'updateValue(this)'
  });

  let divNum = $qCount;

  var div = $('<div>').attr({
    id: "answerDiv" + (qName.length - 1)
  });

  var deleteQuestionButton = $('<button>').attr(
  {
    id: "deleteQuestion" + (qName.length - 1),
    onclick: "deleteQuestion(this.id)",
    class: "btn btn-danger",
    type: "button",
  }).text("Delete question");
  
  var newAnswerButton = $('<button>').attr(
  {
    id: "spawnAnswer" + (qName.length - 1), 
    onclick: "spawnNewAnswer(this.id)",
    class: "btn btn-primary",
    type: "button"
  }).text("New answer");

  $('#dynamicForm').append(questionLabel, questionInput, deleteQuestionButton, lineBreak,
    answerLabel, answerInput, lineBreak, div, newAnswerButton, lineBreak, lineBreak);
  ////////////////////////////////////////////////////////////////////////////////////////////

  // rename the questions
  renameQuestions();
}

// this moves the page down to the bottom //////////////////////////////////////////////////////
function movePage()
{
  $('html, body').animate({ scrollTop: $(document).height() }, 1);
}

//  ////////////////////////////////////////////////////////////////////////////////////////////
/* 
function moveCursorToEnd() 
{
  const input = document.getElementById('quizName');
  input.selectionStart = input.value.length;
  input.selectionEnd = input.value.length;
  input.focus();
}
*/
////////////////////////////////////////////////////////////////////////////////////////////////


// this function updates the value attribute of an input as it is typed into ///////////////////
function updateValue(element)
{
  $('#' + element.id).attr('value', element.value);
}

// the function that deletes the current question ///////////////////////////////////////////////
function deleteQuestion(buttonID)
{
  // the delete button as an object
  var deleteQuestionButton = $('#' + buttonID);

  // test
  //console.log(buttonID);

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
  renameQuestions();
}
////////////////////////////////////////////////////////////////////////////////////////////////

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

  //////////////////////////////////////////////////////////////////////////////////////////

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
    id: aName,
    value: "",
    oninput: 'updateValue(this)'
  });

  var lineBreak = $('<br />').attr({
    id: 'b' + aName
  });

  var deleteButton = $('<button>').attr({
    type: 'button',
    id: 'd' + aName,
    class: 'btn btn-danger',
    onclick: 'deleteAnswer(this.id)'
  }).text('Delete answer');

  $('#' + answerDivId).append(label, input, deleteButton, lineBreak);
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

//////////////////////////////////////////////////////////////////////////
function interceptDelete()
{
  const want = confirm("Are you sure you want to delete this quiz?");

  if(!want) 
  {
    return false; // Prevent form submission
  }
}
///////////////////////////////////////////////////////////////////////////

var outerHtml = "";
var childCounter = 0;

function convertToMarkup(element)
{
  //
  if(childCounter == 0)
  {
    if(element.childElementCount > 0)
    {
      childCounter = childCounter + element.childElementCount;
    }
    outerHtml = outerHtml + $(element).prop("outerHTML");
  }
  else if(childCounter > 0)
  {
    if(element.childElementCount > 0)
    {
      childCounter = childCounter + element.childElementCount;
    }
    childCounter--;
  }

  // test
  //console.log(outerHtml);

  $('#formHtml').val(outerHtml);
}

function sendFormElements()
{
  var dynamicForm = document.getElementById("dynamicForm");
  var dynamicFormDescendants = dynamicForm.querySelectorAll("*");
  var formHtml;

  dynamicFormDescendants.forEach(convertToMarkup);

  //
  formHtml = $('#formHtml').val();
  formHtml = '<form id="dynamicForm" action="/databaseModUpdate.php" method="post">' + formHtml + '</form>';
  formHtml = formHtml + '<button id="spawnButton" onclick="addInputPair()" class="btn btn-primary" type="button"';
  formHtml = formHtml + ' form="dynamicForm">New question</button>';

  $('#formHtml').val(formHtml);
}

//////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////
function fillQuizModForm(qAndAArray)
{
  //
  qAndAArray = JSON.parse(qAndAArray);

  // getting the size of the form to be able to iterate through it
  // and the first element in it to start at
  var numberOfElementsInForm = $('#dynamicForm').children().length;

  var element = $('#dynamicForm').children().first();
  var elementID = $(element).attr('id');
  var tempElement = $('#dynamicForm').children().first();
  var tempElementID = $(element).attr('id');

  var childElement;
  var childElementID;

  // test
  //console.log(element);

  // This will iterate through all the original input values 
  // provided by the user
  for(const key in qAndAArray)
  {
      // test
      //console.log(key);

      if(key == "QuizName")
      {
          //
          $('#quizName').val(qAndAArray[key]);
      }

      // this loop will iterate through all elements of the form
      // finding the valid inputs check if there is a value in them 
      // if there is not the current value will be assigned to it
      for(var i = 0; i < numberOfElementsInForm; i++)
      {
        //

        //
        if(($(element).children().length > 0) && (element != $(element).children().first()))
        {

          element = $(element).children().first();
          element = $(element).next();
          
          // test
          console.log('The element did have children');
          console.log(element);
        }
        else
        {
          element = $(element).next();
          tempElement = element;

          // test
          //console.log(tempElement);
        }

        //console.log($(element).is("input"));
        // when an input element has been found
        if($(element).is("input"))
        {
            //test
            //console.log('it was an input');

            // when it does not have a value assign it the current one
            if(($(element).val().length == 0) && (key != "QuizName"))
            {
                $(element).val(qAndAArray[key]);
                
                //tempElement = $(element).next();

                if($(element).chidren().last() == $(element))
                {
                  element = $tempElement;
                  element = $(element).next();
                }
                else
                {
                  // iterating to the next element and breaking out of the loop
                  element = $(element).next();
                }

                break;
            }
        }
        element = $(element).next();
      }
      // resetting the element to the first in the form for another loop
      element = $('#dynamicForm').children().first();
  }
  /////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////////////////////////