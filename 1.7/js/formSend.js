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

  $('#formHtml').val(outerHtml);
}

// 
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
/////////////////////////////////////////////////////////////////////////////////////////////////