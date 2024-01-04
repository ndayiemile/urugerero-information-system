<?php
include_once('../components/header.php')
?>
<section class="mt-3 rounded">
    <div class="card border-0">
        <div class="card-body border-0 bg-white pb-2 pt-3 px-3">
            <table class="table">
                <thead class="sticky-top table-light">
                    <tr>
                        <th colspan="5" class="px-0">
                            <div class="d-flex align-items-center fw-light">
                                <!-- select all -->
                                <input type="checkbox" class="form-check-input fs-4 mt-0 rounded-0" id="check-all-participants-checkBox" /><span class="ms-2">Select All</span>
                                <!-- number of available records -->
                                <span class="me-3 ms-auto"><small id="number-of-checked-participants">0</small> of <small id="number-of-all-participants">100</small></span>
                                <button class="btn btn-outline-secondary" id="save-attendance-btn">save</button>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full name</th>
                        <th scope="col">National ID</th>
                        <th scope="col">Cell</th>
                        <th scope="col">Village</th>
                    </tr>
                </thead>
                <tbody id="intoreIdentities-container">
                    <tr>
                        <th scope="row" class="text-secondary">
                            <input type="checkbox" class="form-check-input fs-4 rounded-0" />
                        </th>
                        <td class="text-secondary">James Yates</td>
                        <td class="text-secondary">1200381905006432</td>
                        <td class="text-secondary">Kamuhoza</td>
                        <td class="text-secondary">Isimbi</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php
include_once('../components/footer.php')
?>