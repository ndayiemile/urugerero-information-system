<?php
include_once('../components/header.php');
?>
<section class="mt-3 rounded bg-white">
    <div class="card border-0">
        <div class="card-header border-0 bg-white p-3">
            <div class="d-flex align-items-center sortKeySet" name="activities">
                <!-- number of entries per page -->
                <select name="numberOfEntries" class="sortKey border border-1 bg-white text-center outline-none select-arrow-none">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="400">400</option>
                </select>
                <!-- by participant filter -->
                <select name="participant" class="sortKey border border-1 rounded-pill bg-white mx-2 text-center outline-none select-arrow-none px-2">
                    <option value="undefined">participant</option>
                    <option value="sector">Sector</option>
                    <option value="kamuhoza">Kamuhoza</option>
                    <option value="katabaro">Katabaro</option>
                    <option value="kimisagara">Kimisagara</option>
                </select>
                <!-- activity category filters -->
                <select name="category" class="sortKey border border-1 rounded-pill bg-white text-center outline-none select-arrow-none">
                    <option value="undefined">category</option>
                    <option value="survey">survey</option>
                    <option value="parade">parade</option>
                    <option value="physical">physical</option>
                    <option value="training">training</option>
                    <option value="mobilisation">mobilisation</option>
                </select>
                <!-- number of available records -->
                <span class="d-md-block me-3 ms-auto invisible"><small>50</small> of <small>100</small></span>
                <!-- activity due date filters -->
                <div class="border border-1 bg-white mx-2 text-center rounded-pill px-3">
                    <select name="dueDateOperator" class="sortKey border border-start-0 border-bottom-0 border-top-0 text-center select-arrow-none outline-none pe-1 ps-0 border-1 h-100 bg-transparent">
                        <option value="undefined">any</option>
                        <option value="=">On</option>
                        <option value="<">Before</option>
                        <option value=">">After</option>
                    </select>
                    <input type="date" name="dueDate" class="sortKey outline-none border border-0 p-0" />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="border border-1" id="allActivitiesParticulars-container">
                <!-- activity -->
                <div class="row g-0 border-bottom border-1 d-none">
                    <div class="col-3 p-1 p-md-2">
                        <img class="w-100 rounded-start" height="130px" src="../../depository/activities/WhatsApp Image 2023-10-19 at 12.28.59.jpeg" alt="activity image" />
                    </div>
                    <div class="col-7 col-md-8 p-2">
                        <p class="m-0">
                            <span class="fw-bolder">participant</span>
                            <small>kimisagara, Isimbi</small>
                        </p>
                        <p class="m-0">
                            <span class="fw-bolder">Location</span>
                            <small>Kimisagara, Katabaro</small>
                        </p>
                        <p class="m-0">
                            <span class="fw-bolder">Activity</span>
                            <small>Intore zubatse umuhanda ungana na kirometero
                                eshanu</small>
                        </p>
                        <p class="m-0">
                            <span class="fw-bolder">Attendees</span> <small>100</small>
                        </p>
                    </div>
                    <div class="col-2 col-md-1 p-md-2 d-flex flex-column justify-content-evenly align-items-center">
                        <span class="gs-fs-7 d-block">Sept 2</span>
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
                </div>
        </div>
</section>
<?php
include_once('../components/footer.php')
?>