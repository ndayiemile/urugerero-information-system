<?php
include_once('../components/header.php');
?>
<section class="mt-3 rounded bg-white">
    <div class="card border-0">
        <div class="card-header border-0 bg-white px-0 pb-0 pt-3">
            <div class="px-3 pb-2 d-flex justify-content-end">
                <button class="btn btn-sm btn-secondary">Save</button>
            </div>
        </div>
        <!-- intore container list-->
        <div class="card-body p-0 mx-3">
            <div class="table-responsive">
                <table class="table table-editable table-bordered">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col">No</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">National ID</th>
                            <th scope="col">Recent School</th>
                            <th scope="col">Combination/Trade</th>
                            <th scope="col">District</th>
                            <th scope="col">Sector</th>
                            <th scope="col">Cell</th>
                            <th scope="col">Village</th>
                        </tr>
                    </thead>
                    <tbody id="editable-table-body">
                        <tr>
                            <td scope="row">1</td>
                            <td>Ndayishimiye Emile</td>
                            <td>1200380194043016</td>
                            <td>Rwamagana Leaders'School</td>
                            <td>Math-Physics-ComputerScience</td>
                            <td>Nyarugenge</td>
                            <td>Kimisagara</td>
                            <td>Kamuhoza</td>
                            <td>Isimbi</td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td>Niyonshuti Innocent</td>
                            <td>1200180194045018</td>
                            <td>GS Kabusunzu</td>
                            <td>Masonary</td>
                            <td>Nyabihu</td>
                            <td>Nyirakigugu</td>
                            <td>Cyamabuye</td>
                            <td>Hesha</td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-info">
                        <tr>
                            <td class="text-center">
                                <button id="btn-add-new-table-row" class="btn btn-outline-dark rounded-circle text-center">
                                    +
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<?php
include_once('../components/footer.php')
?>