window.onload = () => {
  if (isLoggedIn()) {
    console.log(document.cookie)
    window.location.href = "home.php";
  }
  isLoggedIn();
  enableFormButtonsFunctionalities();
};
function afterSuccessfulFormSubmissionAction(form, response) {
  if(isLoggedIn()){
    console.log(document.cookie)
    window.location.href ="home.php"
  }
  // isLoggedIn()
}
