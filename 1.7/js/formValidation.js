// This file has functions involved in the validation of forms before they are commited 
// to the database

//
function changeFormAction()
{
  $('#dynamicForm').attr('action', '/newEvaluation.php');
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

// this function updates the value attribute of an input as it is typed into ///////////////////
function updateValue(element)
{
  $('#' + element.id).attr('value', element.value);
}

// this function will check if there is an input that has no value in it and allow the user to
// either fill it or delete it
function checkForEmptyInputs()
{
  // 
  var element = $('#dynamicForm').children().first();
  var elementID = element.attr('id');
  var elementDelete = element.next();
  var elementDeleteID = elementDelete.attr('id');

  var labelBeforeInput;
  var linebreakBeforeInput;
  var questionDeleteBeforeInput;

  //
  for(var i = 0; i < $('#dynamicForm').children().length; i++)
  {
    // this will check whether an element is, not an input, or a question or answer
    if(typeof elementID != 'undefined')
    {
      // it is a question input
      if(elementID[0] == 'q')
      {
        // when the question input has no value in it
        if(element.val() == '')
        {
          // 
          if(confirm('A question was left empty. Click "Ok" to fill it, otherwise it will be deleted.'))
          {
            // animate the page to center on the empty question to fill in
            
            // this prevents the form being submitted
            return false;
          }
          else
          {
            // 
            deleteQuestion(elementDeleteID);
          }
        }
      }// when it's an answer
      else if(elementID[0] == 'a' && elementID[1] != 'n')
      {
        if(element.val() == '')
        {
          // 
          if(confirm('An answer was left empty. Click "Ok" to fill it, otherwise the question will be deleted.'))
          {
            // animate the page to center on the empty answer to fill in
            
            // this prevents the form being submitted
            return false;
          }
          else
          {
            labelBeforeInput = element.prev();
            linebreakBeforeInput = labelBeforeInput.prev();
            questionDeleteBeforeInput = linebreakBeforeInput.prev();
            questionDeleteBeforeInputID = questionDeleteBeforeInput.attr('id');
  
            //
            deleteQuestion(questionDeleteBeforeInputID);
          }
        }
      }
    }

    // iterate to the next element and get it's id if it exists
    element = element.next();
    elementID = element.attr('id');
    elementDelete = element.next();
    elementDeleteID = elementDelete.attr('id');
  }

  sendFormElements();

  // if the form had no empty inputs just allow it to the submitted
  return true;
}

