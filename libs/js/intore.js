/***server response hundler function ***/
function displayIntoreIdentities(response) {
  let mainContent = response;
  let subsidiaryContent = "";
  if (Array.isArray(response[0])) {
    mainContent = response[0];
    subsidiaryContent = response[1];
  }
  let container = ObjectId("intoreIdentities-container");
  container.innerHTML = "";
  // console.log(response)
  mainContent.forEach((dataRow) => {
    // console.log(dataRow);
    let tr = document.createElement("tr");
    let rowContent = `
    <td>
      <input
        type="checkbox"
        class="m-0 form-check-input fs-5 rounded-0"
      />
      <span class="m-0 p-0 ms-2 fw-medium">
        ${dataRow.fullName}
      </span>
    </td>
    <td class="text-secondary">
      ${dataRow.combination}
      </td>
    <td class="text-secondary">${dataRow.firstTel}</td>
    <td>
      <div class="float-end">
        <span class="badge bg-primary-subtle">Active</span>
        <div
          class="ms-3 btn-group"
          role="group"
          aria-label="btngroup"
        >
          <button class="btn btn-sm btn-outline-secondary">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              class="bi bi-pencil-square"
              viewBox="0 0 16 16"
            >
              <path
                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
              />
              <path
                fill-rule="evenodd"
                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"
              />
            </svg>
          </button>
          <button class="btn btn-sm btn-outline-dark">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              class="bi bi-list-task"
              viewBox="0 0 16 16"
            >
              <path
                fill-rule="evenodd"
                d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z"
              />
              <path
                d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z"
              />
              <path
                fill-rule="evenodd"
                d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z"
              />
            </svg>
          </button>
        </div>
      </div>
    </td>
    `;

    tr.setAttribute("id", "dataRow_" + dataRow.id);
    tr.innerHTML = rowContent;
    // redirect to intore particulars page
    tr.onclick = () => {
      sessionStorage.setItem("intoreParticularId", dataRow.id);
      window.location.href = "intoreIdentities.php";
    };
    container.appendChild(tr);
  });
  // get intore status counts
  getIntoreCurrentStatusCounts();
}
window.onload = () => {
  //prepare the sortKey
  prepareSortKeys();
  //get all intore identities
  getAllIntoreIdentities();
};

function getAllIntoreIdentities() {
  // server request
  let formData = new FormData();
  server(displayIntoreIdentities, "getIntoreIdentities", formData);
}

function prepareSortKeys() {
  // server request
  let formData = new FormData();
  //set the function action
  formData.append("action", "getSortKeys");
  //send request to the server
  server(sortKeysManager, "sortKeys", formData);
  // sortKeys initialization handler
  function sortKeysManager(response) {
    // set the sort keys behaviors
    for (let key in response) {
      let sortKey = document.querySelector(`.sortKey[name = '${key}']`);

      // sort keys content and styling setting
      if (key != "currentStatusSortKeys") {
        /*general sort operators*/

        //initialize the sort options to a certain key
        let sortOptionsSet = response[key];
        sortOptionsSet.forEach((keyValue) => {
          let option = document.createElement("option");
          option.setAttribute("value", keyValue);
          option.innerText = keyValue;
          sortKey.appendChild(option);
        });

        // initialize the the sortOption Values
        sortKey.onchange = () => {
          let optionValueKeySelector = sortKey.name + "Value";
          let optionValueKey = document.querySelector(
            `.sortKey[name ='${optionValueKeySelector}']`
          );
          let unworkableSortKeys = ["location", "property"];
          if (!unworkableSortKeys.includes(sortKey.value)) {
            optionValueKey.classList.remove("d-none", "border-end-0");
            sortKey.classList.remove("border-end-0");
            //general sort functionality
            let sortOptionValuesForm = new FormData();
            sortOptionValuesForm.append("action", "getSortOptionValues");
            sortOptionValuesForm.append("optionKey", sortKey.value);
            server(setSortOptionValues, "sortKeys", sortOptionValuesForm);
          } else {
            optionValueKey.classList.add("d-none");
            sortKey.classList.add("border-end-0");
          }

          function setSortOptionValues(response) {
            let optionValues = response;
            optionValueKey.innerHTML = "";
            let defaultOption = document.createElement("option");
            defaultOption.setAttribute("value", "undefined");
            defaultOption.innerText = "All";
            optionValueKey.appendChild(defaultOption);
            optionValues.forEach((sortOptionValue) => {
              let optionValue = Object.values(sortOptionValue)[0];
              let option = document.createElement("option");
              option.setAttribute("value", optionValue);
              option.innerText = optionValue;
              optionValueKey.appendChild(option);

              //sort the values if sort
              optionValueKey.onchange = () => {
                sortDataForm = new FormData();
                sortDataForm.append("action", "performSort");

                // perform sort function
                performSorting();
              };
            });
          }
        };
      } else {
        /* currentStatusSortKey */
        //initialize the sort options to a certain key
        let sortOptionsSet = response[key];
        let content = "";
        sortOptionsSet.forEach((keyValue) => {
          let div = `
            <div class="sortKey cursor-pointer d-flex align-items-center p-3 ${
              keyValue == "all" ? "focused bg-opacity-25 bg-secondary" : ""
            }" name="${
            keyValue == "all" ? "currentStatusSortKeysValue" : ""
          }" value="${keyValue}">
              <input id="${
                keyValue == "all" ? "currentStatusSortKeysSelector" : ""
              }" type="checkbox" class="mt-0 me-2 form-check-input fs-5 rounded-0 ${
            keyValue != "all" ? "invisible" : "visible"
          }" />
              <span class="mx-2 p-0">${keyValue}</span>
              <span class="badge gs-fs-8 text-bg-secondary p-1 bg-opacity-25">0</span>
            </div>
          `;
          content += div;
        });
        //add the content
        sortKey.innerHTML = content;
        //current sort key auto styling
        let currentStatusSortKeySet = sortKey.querySelectorAll(".sortKey");
        currentStatusSortKeySet.forEach((currentStatusSortKey) => {
          currentStatusSortKey.onclick = () => {
            let previouslyFocused = sortKey.querySelector(".focused");
            //change the focused div, it's style...
            previouslyFocused.classList.remove(
              "focused",
              "bg-opacity-25",
              "bg-secondary"
            );
            previouslyFocused.removeAttribute("name");
            currentStatusSortKey.classList.add(
              "focused",
              "bg-opacity-25",
              "bg-secondary"
            );
            currentStatusSortKey.setAttribute(
              "name",
              "currentStatusSortKeysValue"
            );
            //change the currentStatusSortKeysSelector value, and style
            previouslyFocused
              .querySelector("input[type='checkbox']")
              .classList.replace("visible", "invisible");
            currentStatusSortKey
              .querySelector("input[type='checkbox']")
              .classList.replace("invisible", "visible");

            // perform sort function
            performSorting();
          };
        });
      }
    }
  }
}

//sort action
function performSorting() {
  let sortRequestForm = new FormData();
  let numberOfEntries = document.querySelector(
    ".sortKey[name='numberOfEntries']"
  ).value;

  let location = [
    document.querySelector(".sortKey[name='locationSortKeys']").value,
    document.querySelector(".sortKey[name='locationSortKeysValue']").value,
  ];
  let property = [
    document.querySelector(".sortKey[name='propertySortKeys']").value,
    document.querySelector(".sortKey[name='propertySortKeysValue']").value,
  ];
  let currentStatus = [
    document
      .querySelector(".sortKey[name='currentStatusSortKeys']")
      .getAttribute("targetField"),
    document
      .querySelector(".sortKey[name='currentStatusSortKeysValue']")
      .getAttribute("value"),
  ];
  sortRequestForm.append("numberOfEntries", numberOfEntries);
  sortRequestForm.append("locationSortKeys", location);
  sortRequestForm.append("propertySortKeys", property);
  sortRequestForm.append("currentStatusSortKeys", currentStatus);
  sortRequestForm.append("action", "performSorting");
  //send the sort request to the server
  server(displayIntoreIdentities, "sortKeys", sortRequestForm);
}
function getIntoreCurrentStatusCounts(response) {
  // if(response == null )
  let sortRequestForm = new FormData();
  let location = [
    document.querySelector(".sortKey[name='locationSortKeys']").value,
    document.querySelector(".sortKey[name='locationSortKeysValue']").value,
  ];
  let property = [
    document.querySelector(".sortKey[name='propertySortKeys']").value,
    document.querySelector(".sortKey[name='propertySortKeysValue']").value,
  ];
  sortRequestForm.append("locationSortKeys", location);
  sortRequestForm.append("propertySortKeys", property);
  sortRequestForm.append("action", "computeCurrentStatusCounts");
  //send the sort request to the server
  server(displayCurrentStatusCounts, "sortKeys", sortRequestForm)

  function displayCurrentStatusCounts(response){
    let countAll = 0;
    Array.from(response).forEach(stat =>{
      document.querySelector(`.sortKey[value='${stat.currentStatus}'] .badge`).innerText = parseInt(stat.currentStatusCount)
      countAll += parseInt(stat.currentStatusCount)
    })
    // total number of records
    document.querySelector(`.sortKey[value='all'] .badge`).innerText = countAll
  }
}
