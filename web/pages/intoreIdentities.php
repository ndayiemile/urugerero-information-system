<?php
include_once('../components/header.php');
?>
<section class="mt-3">
    <div class="d-flex mb-3 p-2 rounded bg-white fieldsContainer" name="intoreIdentities">
        <div class="w-100 py-2 px-4 rounded-end">
            <h4 class="my-3">Identities</h4>
            <div class="row align-items-baseline">
                <h5 class="col-8 m-0 fieldName" name="fullName">Ndayishimiye Emile</h5>
                <p class="col-4 m-0">
                    <span class="h6">National ID: </span><span class="fieldName" name="nationalId">1200380194043016</span>
                </p>
            </div>
            <div class="row mt-4">
                <!-- Identities -->
                <div class="col-4">
                    <p class="mb-2 fw-bold">Identities</p>
                    <ul class="list-group-flush p-0">
                        <li class="list-group-item fw-normal">
                            Gender: <span class="fw-light fieldName" name="gender">Male</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Mother: <span class="fw-light fieldName" name="mother">Mukabagabo Aurelie</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Father: <span class="fw-light fieldName" name="father">Nzirengera Phocas</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Martial Status: <span class="fw-light fieldName" name="martialStatus">Single</span>
                        </li>
                    </ul>
                </div>
                <!-- address -->
                <div class="col-4">
                    <p class="mb-2 fw-bold">Address</p>
                    <ul class="list-group-flush p-0">
                        <li class="list-group-item fw-normal">
                            District: <span class="fw-light fieldName" name="district">Nyarugenge</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Sector: <span class="fw-light fieldName" name="sector">Kimisagara</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Cell: <span class="fw-light fieldName" name="cell">Kamuhoza</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Village: <span class="fw-light fieldName" name="village">Isimbi</span>
                        </li>
                    </ul>
                </div>
                <!-- Contacts -->
                <div class="col-4">
                    <p class="mb-2 fw-bold">Contacts</p>
                    <ul class="list-group-flush p-0">
                        <li class="list-group-item fw-normal">
                            First Tel: <span class="fw-light fieldName" name="firstTel">+250789413183</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Second Tel: <span class="fw-light fieldName" name="secondTel">+250732255255</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Email:
                            <span class="fw-light fieldName" name="email">ndayishimiyeemile96@gmail.com</span>
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <p class="mb-2 fw-bold">Health and Fitness</p>
                    <ul class="list-group list-group-horizontal p-0">
                        <li class="list-group-item fw-normal">
                            Height: <span class="fw-light fieldName" name="height">23kgs</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Mass: <span class="fw-light fieldName" name="mass">153cm</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            BMI: <span class="fw-light fieldName" name="bmi">1.7</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Blood Pressure: <span class="fw-light fieldName" name="pressure">Normal</span>
                        </li>
                        <li class="list-group-item fw-normal">
                            Vaccination: <span class="fw-light fieldName" name="vaccination">Covid All</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-8">
            <div class="card rounded border-0 px-2 h-100">
                <div class="card-header border-info bg-white pt-3 border-4">
                    <h4 class="card-title">Performance</h4>
                </div>
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionExample">
                        <!-- current status -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Current Status <span class="mx-3 badge rounded-pill bg-primary p-2" id="intoreStatusBadge"></span>
                                </div>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <!-- <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div> -->
                            </div>
                        </div>
                        <!-- attendance -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    attendance <span class="mx-4 p-2 badge rounded-pill text-bg-danger" id="intoreAttendanceRateBadge">70%</span>
                                </div>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <!-- <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div> -->
                            </div>
                        </div>
                        <!-- permission -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Got <span class="mx-4 p-2 badge rounded-pill text-bg-warning" id="intorePermissionsCount">70%</span> Permissions
                                </div>
                            </h2>
                            <!-- <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div> -->
                        </div>
                        <!-- more info -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Additional Info
                                </div>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body" id="intoreAdditionalInfo">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row g-0 gy-3">
                <div class="col-12">
                    <div class="card rounded border-0 px-2">
                        <div class="card-header border-info bg-white pt-3 border-4">
                            <h4 class="card-title">Responsibilities</h4>
                        </div>
                        <div class="card-body">
                            <ol id="intoreResponsibilities-container">
                                <li>
                                    <div class="h6 d-flex flex-column">
                                        Intore Cell Executive <span class="fw-light">From 1 sept - now</span>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded border-0 px-2">
                        <div class="card-header border-info bg-white pt-3 border-4">
                            <h4 class="card-title">Honors</h4>
                        </div>
                        <div class="card-body">
                            <ol id="intoreHonors-container">
                                <li>
                                    <div class="h6 d-flex flex-column">
                                        Reached the training center earlier than others <span class="fw-light">on dec 3</span>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded border-0 px-2">
                        <div class="card-header border-info bg-white pt-3 border-4">
                            <h4 class="card-title">Misconducts</h4>
                        </div>
                        <div class="card-body">
                            <ol id="intoreMisconducts-container">
                                <li>
                                    <div class="h6 d-flex flex-column">
                                        Reached the training center earlier than others <span class="fw-light">on dec 3</span>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once('../components/footer.php')
?>