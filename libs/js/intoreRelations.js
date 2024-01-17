// removes the top navbar sticky behavior
document.getElementById("top-nav-container").classList.remove("sticky-top")

let intoreRelationVariables = JSON.parse(sessionStorage.getItem(
  "intoreRelationVariables"
))

/***server response hundler function ***/
function displayIntoreIdentities(response) {
  let mainContent = response
  let totalNumberOfParticipants = response.length
  ObjectId("number-of-all-participants").innerHTML = totalNumberOfParticipants
  let container = ObjectId("intoreIdentities-container")
  container.innerHTML = ""
  // console.log(response)
  mainContent.forEach((dataRow) => {
    // console.log(dataRow)
    let tr = document.createElement("tr")
    let rowContent = `
        <td scope="row">
            <input type="checkbox" class="form-check-input fs-4 rounded-0 mt-0" />
        </td>
        <td class="text-secondary">${dataRow.fullName}</td>
        <td class="text-secondary">${dataRow.nationalId}</td>
        <td class="text-secondary">${dataRow.cell}</td>
        <td class="text-secondary">${dataRow.village}</td>
    `
    tr.innerHTML = rowContent
    tr.setAttribute("id", dataRow.id)
    /* check box click behaviors */

    // check the checkBox when other td are clicked twice
    let identitiesTdSet = tr.querySelectorAll("td.text-secondary")
    identitiesTdSet.forEach((td) => {
      td.onclick = () => {
        checkBox.click()
      }
    })

    //updates the number of checked and unchecked participants
    let checkBox = tr.querySelector("input")
    checkBox.onclick = () => {
      let currentCount = Number.parseInt(
        ObjectId("number-of-checked-participants").innerText
      )
      if (checkBox.checked) {
        ObjectId("number-of-checked-participants").innerText = currentCount + 1
      } else {
        ObjectId("number-of-checked-participants").innerText = currentCount - 1
      }

      //
    }
    container.appendChild(tr)
  })

  // select all checkbox actions
  ObjectId("check-all-participants-checkBox").onclick = (e) => {
    let checkBoxes = container.querySelectorAll("input")
    e.target.checked
      ? (ObjectId("number-of-checked-participants").innerText =
          totalNumberOfParticipants)
      : (ObjectId("number-of-checked-participants").innerText = 0)
    checkBoxes.forEach((box) => {
      box.checked = e.target.checked
    })
  }

  //save attendance action
  ObjectId("save-attendance-btn").onclick = () => {
    // if(confirm("Please make sure that all attendees were recorded before you save")){
    let allParticipants = container.querySelectorAll("tr")
    allParticipants.forEach((participant) => {
      let inputBox = participant.querySelector("input")
      if (inputBox.checked) {
        let formData = new FormData()
        formData.append("intoreId", participant.id)
        formData.append("entityName", intoreRelationVariables.entityName)
        formData.append("entryId", intoreRelationVariables.entryId)
        console.log(formData.getAll("intoreId","entityName","entryId"))
        server(afterSavingAction, "saveIntoreRelationForm", formData)
        // console.log(participant.classList)
      }
      function afterSavingAction(response) {

        if (response[0]) {
          participant.classList.add("table-success")
          // console.log(participant.id)
        }else{
          participant.classList.add("table-danger")
          // console.log(response,participant.id)
        }
        inputBox.style.display = "none"
      }
      
    })
    // }
  }
}
window.onload = () => {
  // server request
  let formData = new FormData()
  if((intoreRelationVariables.participants).toLowerCase() != "sector"){
    formData.append("cell",intoreRelationVariables.participants)
  }
  server(displayIntoreIdentities, "getIntoreIdentities", formData)
}
