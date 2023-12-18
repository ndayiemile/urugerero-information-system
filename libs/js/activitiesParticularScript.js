/***server response hundler function ***/
function lenderPageData(response) {
    //get all field containers on the page
    let fieldsContainers = document.querySelectorAll(".fieldsContainer")
    fieldsContainers.forEach( container => {
      setFieldsValue(container,response)
    })
  }
  window.onload = () => {
    // get the intoreId
    let intoreId = localStorage.getItem("activityParticularId");
  
    //lender Page content
    if (intoreId) {
      let formData = new FormData();
      formData.append("id", intoreId);
      server(lenderPageData, "getActivityParticulars", formData);
    } else {
      window.location.href = "errors.php";
    }
  };
  
  