window.onload = () => {
  enableFormButtonsFunctionalities();
};

function afterSuccessfulFormSubmissionAction(form, response) {
  // use notice message
  window.alert("action well done");

  // further action
  if (form.id == "fileUploadModal") {
    //close the upload form
    document.getElementById("cancelFileUploadFormBtn").click();
  }
  if (form.id != "intore-register-form") {
    // get the participants group and redirect to the attendance page
    let participants = form.querySelector('.form-select[name="participant"]');
    response["participants"] = participants.value;
    sessionStorage.setItem("intoreRelationVariables", JSON.stringify(response));
    window.location.href = "intoreRelations.php";
  } else {
    sessionStorage.setItem("intoreParticularId", response.entryId);
    window.location.href = "intoreIdentities.php";
  }

  // reset the form values
  // form.reset()
}
