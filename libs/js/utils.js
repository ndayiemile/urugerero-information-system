/*** page variables ***/
let pagePath = window.location.pathname;
let pageNameWithType = pagePath.split("/").pop();
const DEBUGMODE = true;
const PAGENAME = pageNameWithType.split(".").shift();
/***server request hundler function***/
function server(
  responseHandlerFunction,
  serverTargetFunction,
  formData = new FormData()
) {
  // request initialisation and preparation
  let serverRequest = formData;
  // console.log(formData)
  // debugger;
  serverRequest.append("pageName", PAGENAME);
  serverRequest.append("serverTargetFunction", serverTargetFunction);
  serverRequest.append("ajaxRequestIdentifier", true);
  let xhr = new XMLHttpRequest();
  // ajax formData submission/action selector
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let serverResponse = this.responseText;
      // return the response
      try {
        serverResponse = JSON.parse(serverResponse);
        try {
          responseHandlerFunction(serverResponse);
        } catch (error) {
          serverError("check the responseHandlerFunction()", error, serverResponse);
        }
      } catch (error) {
        serverError("check serverResponse JSON compatibility", error, serverResponse);
      }
    }
  };
  xhr.open("POST", "../../core/App.php", true);
  xhr.send(formData);
}
function serverError(debugMessage, error, responseText) {
  if (DEBUGMODE) {
    console.error({
      debugMessage: debugMessage,
      errorMessage: error,
      responseText: responseText,
    });
  }
}
function setFieldsValue(fieldsContainer, serverResponse) {
  serverResponse = Object.entries(serverResponse[0]);
  serverResponse.forEach((cell) => {
    //check if the string is a date and formats it
    let fieldsContainingDate = ["dueDate", "startDate", "endDate", "date"];
    if (fieldsContainingDate.includes(cell[0])) {
      let date = new Date(cell[1]);
      cell[1] =
        date.getDay() +
        "/" +
        date.getMonth() +
        "/" +
        date.getFullYear().toString().slice(2);
    }
    try {
      let field = fieldsContainer.querySelector(
        ".fieldName[name='" + cell[0] + "']"
      );
      field.innerText = cell[1];
    } catch (error) {
      // console.error({ missingField: cell[0], errorMessage: error });
    }
  });
}
/***forms functionality functions***/
function enableFormButtonsFunctionalities() {
  // form buttons functionality to the forms and their buttons
  let forms = document.forms;
  Array.from(forms).forEach((form) => {
    let formButtons = form.getElementsByTagName("button");
    Array.from(formButtons).forEach((btn) => {
      // submit button functionality
      if (btn.type == "submit") {
        btn.onclick = (e) => {
          e.preventDefault();
          serverTargetFunction = btn.getAttribute("serverTargetFunction");
          // form data check up function
          //.....
          // send request to server
          if (serverTargetFunction != null) {
            submitFormToServer(form, serverTargetFunction);
            function submitFormToServer(form, serverTargetFunction) {
              let formData = new FormData();
              //get all input inputFields and their values
              Array.from(form.elements).forEach((input) => {
                //normal input file handle
                if (
                  input.type != "button" &&
                  input.type != "submit" &&
                  input.type != "file"
                ) {
                  formData.append(input.name, input.value);
                }

                // file input handler
                if (input.type == "file" && input.files.length != 0) {
                  form.setAttribute("enctype", "multipart/form-data");
                  formData.append("files[]", input.name);
                  let fileListName = input.name + "[]";
                  for (let i = 0; i < input.files.length; i++) {
                    formData.append(fileListName, input.files[i]);
                  }
                }
              });
              // send the form data to the server and reads the response
              server(serverFormSubmitResponse, serverTargetFunction, formData);

              //form submit response
              function serverFormSubmitResponse(response) {
                if (response[0]) {
                  //form after submission action handler
                  afterSuccessfulFormSubmissionAction(form,response[1])
                } else {
                  window.alert("action Failed");
                  console.error({message:"database error prevented form submission",serverResponse:response});
                }
              }
            }
          } else {
            window.alert("failed to submit the form");
            console.error("the serverTargetFunction is not set");
          }
        };
      }
      // file-upload-form-toggler
      if (btn.className.includes("file-upload-form-toggler")) {
        btn.onclick = () => {
          let uploadFormSubmitBtn = document.getElementById(
            "submitFileUploadFormBtn"
          );
          uploadFormSubmitBtn.setAttribute(
            "serverTargetFunction",
            btn.getAttribute("serverTargetFunction")
          );
        };
      }
    });
  });
}
/*** helper functions ***/
function ObjectId(iDofElement) {
  return document.getElementById(iDofElement);
}

function ObjectQuery(QueryofElement) {
  return document.querySelectorAll(QueryofElement);
}

function ObjectsClass(classOfElements) {
  return document.getElementsByClassName(classOfElements);
}
/*** other function ***/
function printPageArea(areaID) {
  let getFullContent = document.body.innerHTML;
  let printsection = ObjectId(areaID).innerHTML;
  document.body.innerHTML = printsection;
  window.print();
  document.body.innerHTML = getFullContent;
}
