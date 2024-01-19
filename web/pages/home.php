<?php
include_once('../components/header.php')
?>
<section class="row mt-3 gx-3">
  <article class="col-12 col-lg-9">
    <div class="row g-3">
      <div class="col-6">
        <div class="card border-0 shadow-sm">
          <div class="card-body d-flex justify-content-center align-items-center">
            <div class="bg-light-green p-3 me-2 me-md-4 rounded-circle d-flex align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="text-medium-green bi bi-people-fill" viewBox="0 0 16 16">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
              </svg>
            </div>
            <div class="ms-lg-2 d-flex flex-column justify-content-center">
              <p class="m-0 p-0 fs-6 text-secondary fw-light">
                Total number of<br />
                Intore
              </p>
              <p class="m-0 p-0 fs-6 fw-bolder" id="total-number-of-intore">578</p>
            </div>
          </div>
          <div class="card-footer bg-medium-green border-0 p-1"></div>
        </div>
      </div>
      <div class="col-6">
        <div class="card border-0 shadow-sm">
          <div class="card-body d-flex justify-content-center align-items-center">
            <div class="bg-light-blue p-3 me-2 me-md-4 rounded-circle d-flex align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="text-medium-blue bi bi-ui-checks" viewBox="0 0 16 16">
                <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
              </svg>
            </div>
            <div class="ms-lg-2 d-flex flex-column justify-content-center">
              <p class="m-0 p-0 fs-6 text-secondary fw-light">Total number of <br /> Activities</p>
              <p class="m-0 p-0 fs-6 fw-bolder" id="total-number-of-activities">578</p>
            </div>
          </div>
          <div class="card-footer bg-medium-blue border-0 p-1"></div>
        </div>
      </div>
      <!-- Cell Attendance Progressions -->
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header border-0 py-4 bg-white">
            <h5 class="">Cell Attendance Progression</h5>
          </div>
          <div class="card-body">
            <div id="chartForProjectedAttendanceRate"></div>
          </div>
        </div>
      </div>
      <!-- Intore Status -->
      <div class="col-12">
        <div class="card shadow-sm border-0">
          <div class="card-header border-0 py-4 bg-white">
            <h5 class="">Intore Status</h5>
          </div>
          <div class="card-body">
            <div class="col-12 col-lg-9">
              <div id="chartForSectorDataOverview"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
  <article class="col-13 col-lg-3 ps-2 mt-3 mt-lg-0">
    <div class="row g-0">
      <!-- Notifications division -->
      <div class="col-12 mb-3 rounded bg-white">
        <div class="card shadow-sm border-0 pt-2 px-2">
          <div class="card-header bg-white border-4 border-medium-green">
            <div class="text-solid-blue text-center">
              <h5 class="m-0">Notifications</h5>
            </div>
          </div>
          <div class="card-body pb-0 px-0">
            <div class="alert alert-warning alert-dismissible fade show p-1" role="alert">
              <button type="button" class="btn-close btn-sm gs-fs-8 p-1 m-0" data-bs-dismiss="alert" aria-label="Close"></button>
              <span class="gs-fs-7 p-0 m-0">
                <strong>Holy guacamole!</strong> <span>
                  You should check in on some of
                  those fields below.
                </span>
              </span>
            </div>
            <div class="alert alert-primary alert-dismissible fade show p-1" role="alert">
              <button type="button" class="btn-close btn-sm gs-fs-8 p-1 m-0" data-bs-dismiss="alert" aria-label="Close"></button>
              <span class="gs-fs-7 p-0 m-0">
                <strong>Holy guacamole!</strong> <span>
                  You should check in on some of
                  those fields below.
                </span>
              </span>
            </div>
            <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
              <button type="button" class="btn-close btn-sm gs-fs-8 p-1 m-0" data-bs-dismiss="alert" aria-label="Close"></button>
              <span class="gs-fs-7 p-0 m-0">
                <strong>Holy guacamole!</strong> <span>
                  You should check in on some of
                  those fields below.
                </span>
              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- scheduled activities division -->
      <div class="col-12 mb-3 rounded bg-white">
        <div class="card shadow-sm border-0 pt-2 px-2">
          <div class="card-header bg-white border-4 border-medium-green">
            <div class="text-solid-blue text-center">
              <h5 class="m-0">Pending Schedule</h5>
            </div>
          </div>
          <div class="card-body pb-0 px-0">
            <div class="card border-0 shadow-sm p-2 mb-2">
              <div class="card-header bg-white border-0 d-flex justify-content-between p-0">
                <span class="gs-fs-7 text-solid-gray">Title of Activity</span><small class="gs-fs-8 text-solid-pink">Sept 1</small>
              </div>
              <div class="card-body bg-light p-1">
                <p class="gs-fs-7 m-0">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Consequuntur, perferendis!
                </p>
              </div>
            </div>
            <div class="card border-0 shadow-sm p-2 mb-2 mt-3">
              <div class="card-header bg-white border-0 d-flex justify-content-between p-0">
                <span class="gs-fs-7 text-solid-gray">Title of Activity</span><small class="gs-fs-8 text-solid-pink">Sept 1</small>
              </div>
              <div class="card-body bg-light p-1">
                <p class="gs-fs-7 m-0">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Consequuntur, perferendis!
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- done activities division -->
      <div class="col-12 mb-3 bg-white rounded">
        <div class="card shadow-sm border-0 pt-2 px-2">
          <div class="card-header bg-white border-4 border-medium-green">
            <div class="text-solid-blue text-center">
              <h5 class="m-0">Done Activities</h5>
            </div>
          </div>
          <div class="card-body pb-0 ps-3 pe-0">
            <div class="timeline scroll-y position-relative ps-2 pb-0" id="doneActivities-container">
              <!-- done activities -->
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card timeline-item position-relative rounded mb-2 border shadow">
                <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
                  <span class="gs-fs-8">Lorem, ipsum dolor.</span>
                  <span class="gs-fs-8">sept 5</span>
                </div>
                <div class="timeline-activity card-body p-0 position-relative d-none" style="
                          background-image: url(../../depository/activities/WhatsApp\ Image\ 2023-10-19\ at\ 12.29.14.jpeg);
                        ">
                  <div class="text-white h-100 ps-2 d-flex align-items-center">
                    <div class="activity-details">
                      <div class="location mb-2 fs-6 fw-light m-0">
                        <span> At <small>Kamuhoza, Isimbi</small> </span>
                      </div>
                      <div class="participant gs-fs-7 fw-light m-0">
                        By Kamuhoza
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
</section>
<section class="row gx-3 mt-3">
  <!-- recent attendance rate  -->
  <div class="col-12 col-lg-6">
    <div class="card border-0 shadow-sm">
      <div class="card-header border-0 py-4 bg-white">
        <h5 class="">Cell Data Overview</h5>
      </div>
      <div class="card-body p-0">
        <div class="mb-2" id="chartForSectorAttendanceDataOverView"></div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6">
    <div class="card border-0 shadow-sm">
      <div class="card-header border-0 py-4 bg-white">
        <h5 class="">Cell Data Overview</h5>
      </div>
      <div class="card-body p-0">
        <div id="chartForSectorActivitiesDataOverView"></div>
      </div>
    </div>
  </div>
</section>
<?php
include_once('../components/footer.php')
?>