/***server response hundler function ***/
function displayIntoreIdentities(response) {
  //get all field containers on the page
  let fieldsContainers = document.querySelectorAll(".fieldsContainer");
  fieldsContainers.forEach((container) => {
    setFieldsValue(container, response);
  });
}
function displayIntoreResponsibilities(response) {
  let container = ObjectId("intoreResponsibilities-container");
  container.innerHTML = "";
  // console.log(response)
  response.forEach((dataRow) => {
    let tr = document.createElement("li");
    let startDate = new Date(dataRow.startDate);
    const [startYear, startMonth, startDay] = [
      startDate.getFullYear(),
      startDate.toLocaleString("default", { month: "short" }),
      startDate.getDate(),
    ];
    let endDate = new Date(dataRow.endDate);
    const [endYear, endMonth, endDay] = [
      endDate.getFullYear(),
      endDate.toLocaleString("default", { month: "short" }),
      endDate.getDate(),
    ];
    let rowContent = `
      <div class="h6 d-flex flex-column">
          ${dataRow.title} <span class="fw-light">From ${
      startDay + " " + startMonth
    } - ${endDay + " " + endMonth}</span>
      </div>
    `;
    tr.innerHTML = rowContent;
    container.appendChild(tr);
  });
}
function displayIntoreHonors(response) {
  let container = ObjectId("intoreHonors-container");
  container.innerHTML = "";
  // console.log(response)
  response.forEach((dataRow) => {
    let tr = document.createElement("li");
    let dueDate = new Date(dataRow.dueDate);
    const [dueYear, dueMonth, dueDay] = [
      dueDate.getFullYear(),
      dueDate.toLocaleString("default", { month: "short" }),
      dueDate.getDate(),
    ];
    let rowContent = `
      <div class="h6 d-flex flex-column">
          ${dataRow.title} <span class="fw-light">From ${
      dueDay + " " + dueMonth
    }</span>
      </div>
    `;
    tr.innerHTML = rowContent;
    container.appendChild(tr);
  });
}
function displayIntoreMisconducts(response) {
  let container = ObjectId("intoreMisconducts-container");
  container.innerHTML = "";
  // console.log(response)
  response.forEach((dataRow) => {
    let tr = document.createElement("li");
    let dueDate = new Date(dataRow.dueDate);
    const [dueYear, dueMonth, dueDay] = [
      dueDate.getFullYear(),
      dueDate.toLocaleString("default", { month: "short" }),
      dueDate.getDate(),
    ];
    let rowContent = `
      <div class="h6 d-flex flex-column">
          ${dataRow.title} <span class="fw-light">From ${
      dueDay + " " + dueMonth
    }</span>
      </div>
    `;
    tr.innerHTML = rowContent;
    container.appendChild(tr);
  });
}
function displayIntoreStatusBadge(response) {
  let badge = ObjectId("intoreStatusBadge");
  badge.innerText = response[0].status;
}
function displayIntoreAttendanceRateBadge(response) {
  let badge = ObjectId("intoreAttendanceRateBadge");
  badge.innerText = response[0].percentage + "%";
}
function displayIntorePermissions(response) {
  let badge = ObjectId("intorePermissionsCount");
  badge.innerText = response[0].total;
}
function displayIntoreAdditionalInfo(response) {
  let body = ObjectId("intoreAdditionalInfo");
  if (response[0].additionalInfo == "") {
    body.innerText = "No Additional Info Provided";
  } else {
    body.innerText = response[0].additionalInfo;
  }
}
window.onload = () => {
  // get the intoreId
  let intoreId = sessionStorage.getItem("intoreParticularId");

  //lender Page content
  if (intoreId) {
    let formData = new FormData();
    formData.append("id", intoreId);
    server(displayIntoreIdentities, "getIntoreIdentities", formData);
    server(
      displayIntoreResponsibilities,
      "getIntoreResponsibilities",
      formData
    );
    server(displayIntoreHonors, "getIntoreHonors", formData);
    server(displayIntoreMisconducts, "getIntoreMisconducts", formData);
    server(displayIntoreStatusBadge, "getIntoreStatusBadge", formData);
    server(
      displayIntoreAttendanceRateBadge,
      "getIntoreAttendanceRate",
      formData
    );
    server(displayIntorePermissions, "getIntorePermissions", formData);
    server(displayIntoreAdditionalInfo, "getIntoreAdditionalInfo", formData);
  } else {
    window.location.href = "errors.php";
  }
};
