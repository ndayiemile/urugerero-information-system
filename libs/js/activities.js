/***server response hundler function ***/
function displayAllActivitiesParticulars(response) {
  console.log(response);
  // debugger;
  let container = ObjectId("allActivitiesParticulars-container");
  //clear the container
    container.innerHTML = ""
  // append new children to the container
  response.forEach((dataRow) => {
    // pre value formating
    if(dataRow.attendance == "on"){
        dataRow.attendance = 100+"%";
    }
    // console.log(dataRow);
    let div = document.createElement("div");
    div.classList.add("row", "g-0", "border-bottom", "border-1");
    let rowContent = `
        <div class="col-3 p-1 p-md-2">
            <img class="w-100 rounded-start" height="130px" src="../../depository/activities/WhatsApp Image 2023-10-19 at 12.28.59.jpeg" alt="activity image" />
        </div>
        <div class="col-7 col-md-8 p-2">
            <p class="m-0">
                <span class="fw-bolder">Activity</span>
                <small>${dataRow.title}</small>
            </p>
            <p class="m-0">
                <span class="fw-bolder">participant</span>
                <small>${dataRow.participant}</small>
            </p>
            <p class="m-0">
                <span class="fw-bolder">Location</span>
                <small>${dataRow.location}</small>
            </p>
            <p class="m-0">
                <span class="fw-bolder">Attendance</span> <small>${dataRow.attendance}</small>
            </p>
        </div>
        <div class="col-2 col-md-1 p-md-2 d-flex flex-column justify-content-evenly align-items-center">
            <span class="gs-fs-7 d-block"${dataRow.dueDate}</span>
            <div class="btn-group-vertical" role="group" aria-label="Basic">
                <!-- edit activity details data -->
                <button type="button" class="btn btn-sm btn-outline-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>
                </button>
                <!-- delete activity -->
                <button type="button" class="btn btn-sm btn-outline-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                    </svg>
                </button>
            </div>
        </div>
      `;
    div.innerHTML = rowContent;
    // redirect to intore particulars page
    div.onclick = () => {
      sessionStorage.setItem("activityParticularId", dataRow.id);
      window.location.href = "activitiesParticular.php";
    };
    container.appendChild(div);
  });
}
window.onload = () => {
  // server request
  let formData = new FormData();
  server(displayAllActivitiesParticulars, "getActivitiesParticulars", formData);
};

let sortKeys = document.querySelectorAll(".sortKey");
//adds functionalities to all sortKey
sortKeys.forEach((sortKey) => {
  sortKey.onchange = () => {
    //collect the key values
    let formData = new FormData();

    sortKeys.forEach(key =>{
        formData.append(key.name, key.value)
    })
    // send the request to the server
    server(displayAllActivitiesParticulars, "sortActivities", formData)
  }
})