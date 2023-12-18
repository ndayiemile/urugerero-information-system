<?php
include_once('../components/header.php');
?>
<section class="mt-3" id="sample">
  <div class="card border-0">
    <div class="card-body py-3 px-0 bg-light">
      <!-- Nav tabs -->
      <ul class="nav nav-justified gap-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link bg-light-green p-4 rounded shadow-sm btn-click active" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="true">
            <div class="d-flex align-items-center text-black">
              <span class="me-2 p-2 rounded border d-flex navbar-icon text-black">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                  <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                  <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                </svg>
              </span>
              Activity
            </div>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link bg-white p-4 rounded shadow-sm btn-click" id="intore-tab" data-bs-toggle="tab" data-bs-target="#intore" type="button" role="tab" aria-controls="intore" aria-selected="false">
            <div class="d-flex align-items-center text-black">
              <span class="me-2 p-2 rounded border d-flex navbar-icon text-black">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                  <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                  <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                </svg>
              </span>
              Intore
            </div>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link bg-white p-4 rounded shadow-sm btn-click" id="medals-tab" data-bs-toggle="tab" data-bs-target="#medals" type="button" role="tab" aria-controls="medals" aria-selected="false">
            <div class="d-flex align-items-center text-black">
              <span class="me-2 p-2 rounded border d-flex navbar-icon text-black">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                  <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                  <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                </svg>
              </span>
              medals
            </div>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link bg-white p-4 rounded shadow-sm btn-click" id="responsibility-tab" data-bs-toggle="tab" data-bs-target="#responsibility" type="button" role="tab" aria-controls="responsibility" aria-selected="false">
            <div class="d-flex align-items-center text-black">
              <span class="me-2 p-2 rounded border d-flex navbar-icon text-black">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                  <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                  <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                </svg>
              </span>
              Responsibility
            </div>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link bg-white p-4 rounded shadow-sm btn-click" id="permission-tab" data-bs-toggle="tab" data-bs-target="#permission" type="button" role="tab" aria-controls="permission" aria-selected="false">
            <div class="d-flex align-items-center text-black">
              <span class="me-2 p-2 rounded border d-flex navbar-icon text-black">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                  <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                  <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                </svg>
              </span>
              Permission
            </div>
          </button>
        </li>
      </ul>
    </div>
  </div>
  <div class="mt-2 card border-0">
    <div class="tab-content card-body">
      <!-- Tab panes -->
      <!-- activity -->
      <div class="tab-pane active" id="activity" role="tabpanel" aria-labelledby="activity-tab">
        <form class="m-auto col-8" action="" method="post">
          <!-- title -->
          <h4 class="text-center my-3">
            Fill the Activity form accordingly
          </h4>
          <div class="mt-4 mb-3">
            <label for="" class="form-label">Title:</label>
            <input type="" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="" />
          </div>
          <!-- participant -->
          <div class="mb-3">
            <label for="" class="form-label">participant:</label>
            <select class="form-select form-select" name="participant" id="">
              <option value=""></option>
              <option value="sector">sector</option>
              <option value="Kamuhoza">Kamuhoza</option>
              <option value="Katabaro">Katabaro</option>
              <option value="Kimisagara">Kimisagara</option>
            </select>
          </div>
          <!-- activityCategory -->
          <div class="mb-3">
            <label for="" class="form-label">Category:</label>
            <select class="form-select form-select" name="category" id="">
              <option value=""></option>
              <option value="parade">parade</option>
              <option value="survey">survey</option>
              <option value="physical">physical</option>
              <option value="training">training</option>
              <option value="mobilisation">mobilisation</option>
            </select>
          </div>
          <!-- date -->
          <div class="mb-3">
            <label for="" class="form-label">Date:</label>
            <input type="date" class="form-control" name="dueDate" id="" aria-describedby="helpId" required />
          </div>
          <!-- supporters -->
          <div class="mb-3">
            <label for="" class="form-label">Stake holders:</label>
            <input type="text" class="form-control" name="stakeHolders" id="" aria-describedby="helpId" placeholder="comma separated list of attendees other than intore" />
          </div>
          <!-- location -->
          <div class="mb-3">
            <label for="" class="form-label">Location:</label>
            <input type="text" class="form-control" name="location" id="" aria-describedby="helpId" placeholder="District,sector,cell,village" />
          </div>
          <!-- descriptions -->
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="descriptions" id="formId1" placeholder="" />
            <label for="formId1">Descriptions:</label>
          </div>
          <!-- pictures  -->
          <div class="mb-3">
            <label for="" class="form-label">Pictures:</label>
            <input type="file" class="form-control" name="pictures" id="" placeholder="" aria-describedby="fileHelpId" multiple />
            <div id="fileHelpId" class="form-text">
              only JPEG,JPG,PNG and JIF supported
            </div>
          </div>
          <!-- make attenance option-->
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="attendance" id="flexSwitchCheckDefault" checked />
            <label class="form-check-label" for="flexSwitchCheckDefault">Make attendance</label>
          </div>
          <!-- submit or upload file -->
          <div class="d-flex justify-content-evenly mt-5">
            <button type="button" class="file-upload-form-toggler col-3 btn btn-outline-success" serverTargetFunction="saveNewActivity" data-bs-toggle="modal" data-bs-target="#fileUploadModal">
              import a file
            </button>
            <button type="submit" id="btn-save-activity" serverTargetFunction="saveNewActivity" class="col-3 btn btn-primary">
              Save
            </button>
          </div>
        </form>
      </div>
      <!-- intore -->
      <div class="tab-pane" id="intore" role="tabpanel" aria-labelledby="intore-tab">
        <h4 class="text-center my-3">
          Fill Intore Particulars Form accordingly
        </h4>
        <form class="row justify-content-around" action="" method="post" id="intore-register-form">
          <!-- identities -->
          <section class="col-5">
            <h5 class="text-center text-secondary mt-5">Identities</h5>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Full Name:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="fullName" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">National ID:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="nationalId" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Gender:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="gender" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Mother:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="mother" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Father:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="father" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Martial Status:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="martialStatus" id="" aria-describedby="helpId" placeholder="" />
            </div>
          </section>
          <!-- Health & Fitness -->
          <section class="col-5">
            <h5 class="text-center text-secondary mt-5">
              Health & Fitness
            </h5>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Height:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="height" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Mass:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="mass" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">BMI:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="bmi" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Pressure:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="pressure" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Vaccination:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="vaccination" id="" aria-describedby="helpId" placeholder="" />
            </div>
          </section>
          <!-- Addresses -->
          <section class="col-5">
            <h5 class="text-center text-secondary mt-5">Address</h5>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">District:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="district" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Sector:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="sector" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Cell:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="cell" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Village:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="village" id="" aria-describedby="helpId" placeholder="" />
            </div>
          </section>
          <!-- contacts -->
          <section class="col-5">
            <h5 class="text-center text-secondary mt-5">Contacts</h5>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">First Tel:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="firstTel" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Second Tel:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="secondTel" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Email:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="email" id="" aria-describedby="helpId" placeholder="" />
            </div>
          </section>
          <!-- Education -->
          <section class="col-5">
            <h5 class="text-center text-secondary mt-5">Education</h5>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">School:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="school" id="" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mt-3 row g-0">
              <label for="" class="p-0 col-3">Combination:</label>
              <input type="text" class="col-9 p-0 outline-none border-0 border-bottom border-3 rounded-0" name="combination" id="" aria-describedby="helpId" placeholder="" />
            </div>
          </section>
          <!-- more information -->
          <section class="col-10">
            <h5 class="text-center text-secondary mt-5">
              Additional description
            </h5>
            <div class="mb-3 row g-0">
              <label for="" class="form-label"></label>
              <textarea class="form-control" name="additionalInfo" id="" rows="3"></textarea>
            </div>
          </section>
          <div class="d-flex justify-content-evenly mt-5">
            <button type="button" class="file-upload-form-toggler col-3 btn btn-outline-success" serverTargetFunction="registerNewIntore" data-bs-toggle="modal" data-bs-target="#fileUploadModal">
              import a file
            </button>
            <button type="submit" id="btn-register-intore" serverTargetFunction="registerNewIntore" class="col-3 btn btn-primary">
              Register
            </button>
          </div>
        </form>
      </div>
      <!-- Medals -->
      <div class="tab-pane" id="medals" role="tabpanel" aria-labelledby="medals-tab">
        <h4 class="text-center my-3">
          Select the medal and fill it accordingly
        </h4>
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Honor
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <form action="" method="post" class="row">
                  <div class="mb-3 col-12">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="" />
                  </div>
                  <div class="row g-0 col-12">
                    <div class="mb-3 col">
                      <label for="" class="form-label">participant</label>
                      <select class="form-select form-select" name="ownerTeam" id="">
                        <option selected>Sector</option>
                        <option value="">Kimisagara</option>
                        <option value="">Kamuhoza</option>
                        <option value="">Katabaro</option>
                      </select>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="grantToAll" value="" id="" checked />
                      <label class="form-check-label" for="">
                        Grant to specific individuals
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="" />
                      <label class="form-check-label" for="">
                        Grant to the whole Team
                      </label>
                    </div>
                  </div>
                  <div class="mb-3 col-12">
                    <label for="" class="form-label">Due Date</label>
                    <input type="date" class="form-control" name="dueDate" id="" aria-describedby="helpId" placeholder="" required />
                  </div>
                  <div class="mb-3 col-12">
                    <label for="" class="form-label">Descriptions</label>
                    <textarea class="form-control" name="descriptions" id="" rows="3"></textarea>
                  </div>
                  <div class="d-flex justify-content-evenly">
                    <button type="button" class="file-upload-form-toggler col-3 btn btn-outline-success" serverTargetFunction="saveHonor" data-bs-toggle="modal" data-bs-target="#fileUploadModal">
                      import a file
                    </button>
                    <button type="submit" serverTargetFunction="saveHonor" id="btn-save-honor" class="col-3 btn btn-primary">
                      Save
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Misconduct
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <form action="" method="post" class="row">
                  <div class="mb-3 col-12">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="" />
                  </div>
                  <div class="row g-0 col-12">
                    <div class="mb-3 col">
                      <label for="" class="form-label">participant</label>
                      <select class="form-select form-select" name="ownerTeam" id="">
                        <option selected>Sector</option>
                        <option value="">Kimisagara</option>
                        <option value="">Kamuhoza</option>
                        <option value="">Katabaro</option>
                      </select>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="" checked />
                      <label class="form-check-label" for="">
                        Grant to specific individuals
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="" />
                      <label class="form-check-label" for="">
                        Grant to the whole Team
                      </label>
                    </div>
                  </div>
                  <div class="mb-3 col-12">
                    <label for="" class="form-label">Due Date</label>
                    <input type="date" class="form-control" name="dueDate" id="" aria-describedby="helpId" placeholder="" required />
                  </div>
                  <div class="mb-3 col-12">
                    <label for="" class="form-label">Descriptions</label>
                    <textarea class="form-control" name="description" id="" rows="3"></textarea>
                  </div>
                  <div class="d-flex justify-content-evenly">
                    <button type="button" class="file-upload-form-toggler col-3 btn btn-outline-success" serverTargetFunction="saveMisconduct" data-bs-toggle="modal" data-bs-target="#fileUploadModal">
                      import a file
                    </button>
                    <button type="submit" serverTargetFunction="saveMisconduct" id="btn-save-misconduct" class="col-3 btn btn-primary">
                      Save
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- responsibilities -->
      <div class="tab-pane" id="responsibility" role="tabpanel" aria-labelledby="responsibility-tab">
        <h4 class="text-center my-3">
          Fill the responsibility form accordingly
        </h4>
        <form class="col-8 m-auto row" action="" method="post">
          <div class="mb-3">
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="" />
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Owner Full Name</label>
            <input type="text" class="form-control" name="ownerFullName" id="" aria-describedby="helpId" placeholder="" />
          </div>
          <label for="" class="form-label">Start - End date</label>
          <div class="input-group mb-3">
            <input type="date" class="form-control" name="startDate" id="" aria-describedby="helpId" placeholder="" required />
            <input type="date" class="form-control" name="endDate" id="" aria-describedby="helpId" placeholder="" required />
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="" rows="3"></textarea>
          </div>
          <!-- submit or upload file -->
          <div class="d-flex justify-content-evenly mt-5">
            <button type="button" class="file-upload-form-toggler col-3 btn btn-outline-success" serverTargetFunction="saveResponsibility" data-bs-toggle="modal" data-bs-target="#fileUploadModal">
              import a file
            </button>
            <button type="submit" serverTargetFunction="saveResponsibility" id="btn-save-responsibility" class="col-3 btn btn-primary">
              Save
            </button>
          </div>
        </form>
      </div>
      <!-- permissions -->
      <div class="tab-pane" id="permission" role="tabpanel" aria-labelledby="permission-tab">
        <h4 class="text-center my-3">
          Fill the Permission form accordingly
        </h4>
        <form class="col-8 m-auto row" action="" method="post">
          <div class="mb-3">
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="" />
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Owner Full Name</label>
            <input type="text" class="form-control" name="ownerFullName" id="" aria-describedby="helpId" placeholder="" />
          </div>
          <label for="" class="form-label">Start - End date</label>
          <div class="input-group mb-3">
            <input type="date" class="form-control" name="startDate" id="" aria-describedby="helpId" placeholder="" />
            <input type="date" class="form-control" name="endDate" id="" aria-describedby="helpId" placeholder="" />
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="" rows="3"></textarea>
          </div>
          <!-- submit or upload file -->
          <div class="d-flex justify-content-evenly mt-5">
            <button type="button" class="file-upload-form-toggler col-3 btn btn-outline-success" serverTargetFunction="savePermission" data-bs-toggle="modal" data-bs-target="#fileUploadModal">
              import a file
            </button>
            <button type="submit" serverTargetFunction="savePermission" id="btn-save-permissions" class="col-3 btn btn-primary">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
    <!-- File upload modal -->
    <form action="" method="post" class="modal fade" id="fileUploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="fileUploadModalLabel">
              Make use that the file in EXCELL format
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- file upload form -->
            <div class="mb-3">
              <label for="" class="form-label">Choose file</label>
              <input type="file" class="form-control" name="recordFile" accept=".xlsx, .csv" id="" placeholder="" aria-describedby="fileHelpId" />
              <div id="fileHelpId" class="form-text"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" id="cancelFileUploadFormBtn" data-bs-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn btn-sm btn-primary" id="submitFileUploadFormBtn">
              upload
            </button>
          </div>
        </div>
    </form>
  </div>
  </div>
</section>
<?php
include_once('../components/footer.php')
?>