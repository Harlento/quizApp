// Functions responsible for deleting inputs

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

// the function that deletes the current question ///////////////////////////////////////////////
function deleteQuestion(buttonID)
{
  // the delete button as an object
  var deleteQuestionButton = $('#' + buttonID);

  //
  var questionInputElement = $(deleteQuestionButton).prev();

  var questionLabel = $(questionInputElement).prev();
  var br = $(questionLabel).prev();

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
  br.remove();
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

// delete button for new answer inputs /////////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////
function interceptDelete()
{
  const want = confirm("Are you sure you want to delete this quiz?");

  if(!want) 
  {
    return false; // Prevent form submission
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////

