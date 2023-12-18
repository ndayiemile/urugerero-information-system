<?php
include_once('../components/header.php')
?>
<section class="mt-3 rounded bg-white">
    <div class="card border-0">
        <div class="card-header border-0 bg-white pb-2 pt-3 px-3">
            <div class="d-flex align-items-center">
                <!-- number of entries per page -->
                <select name="" class="border border-1 bg-white text-center outline-none select-arrow-none">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="400">400</option>
                </select>
                <!-- by location/group participant filter -->
                <select name="" class="border border-1 bg-white mx-2 text-center outline-none select-arrow-none">
                    <option value="Sector">Sector</option>
                    <option value="Kamuhoza">Kamuhoza</option>
                    <option value="Katabaro">Katabaro</option>
                    <option value="Kimisagara">Kimisagara</option>
                </select>
                <!-- number of available records -->
                <span class="me-3 ms-auto"><small>50</small> of <small>100</small></span>
                <button class="btn btn-outline-secondary">save</button>
            </div>
            <div class="row g-0"></div>
        </div>
        <div class="card-body p-0 mx-3 mb-3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" class="form-check-input fs-4 rounded-0" />
                            </th>
                            <th scope="col">Full name</th>
                            <th scope="col">National ID</th>
                            <th scope="col">Cell</th>
                            <th scope="col">Village</th>
                        </tr>
                    </thead>
                    <tbody>
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
    </div>
</section>
<?php
include_once('../components/footer.php')
?>