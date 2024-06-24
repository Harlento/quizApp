// This file contains functions responsible for the creation of new inputs

// This will spawn two inputs at the click of a button /////////////////////////////////////////
function addInputPair()
{
  // 
  if(($('#dynamicForm').children().length + 11) > 3301)
  {
    return;
  }

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

  var deleteAnswerButton = $('<button>').attr(
  {
    id: "deleteAnswer" + (qName.length - 1),
    class: "btn btn-danger",
    type: "button",
    hidden: ""
  }).text("Delete answer");
  
  var newAnswerButton = $('<button>').attr(
  {
    id: "spawnAnswer" + (qName.length - 1), 
    onclick: "spawnNewAnswer(this.id)",
    class: "btn btn-primary",
    type: "button"
  }).text("New answer");

  $('#dynamicForm').append(questionLabel, questionInput, deleteQuestionButton, lineBreak,
    answerLabel, answerInput, deleteAnswerButton, lineBreak, div, newAnswerButton, lineBreak, lineBreak);
  ////////////////////////////////////////////////////////////////////////////////////////////

  // rename the questions
  renameQuestions();
}

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

