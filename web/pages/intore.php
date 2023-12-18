<?php
include_once('../components/header.php');
?>
<section class="mt-3 rounded bg-white">
  <div class="card border-0">
    <div class="card-header border-0 bg-white px-0 pb-0 pt-3">
      <div class="px-3 pb-2 d-flex align-items-center mb-2">
        <!-- number of entries per page -->
        <select name="numberOfEntries" class="sortKey border border-1 bg-white text-center outline-none select-arrow-none">
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="200">200</option>
          <option value="400">400</option>
        </select>
        <!-- by location filter -->
        <div class="border border-1 bg-white ms-3 me-0 text-center rounded-pill">
          <select name="locationSortKeys" class="sortKey border border-start-0 border-bottom-0 border-top-0 border-end-0 text-center select-arrow-none outline-none px-2 h-100 bg-transparent">
          </select>
          <select name="locationSortKeysValue" id="" class="sortKey d-none border-0 text-center select-arrow-none outline-none px-2 h-100 bg-transparent">
          </select>
        </div>
        <!-- other properties Filter-->
        <div class="border border-1 bg-white ms-3 me-0 text-center rounded-pill">
          <select name="propertySortKeys" class="sortKey border border-start-0 border-bottom-0 border-top-0 border-end-0 text-center select-arrow-none outline-none px-2 h-100 bg-transparent">
          </select>
          <!-- <select name="propertySortOperator" class="sortKey border border-start-0 border-bottom-0 border-top-0 text-center select-arrow-none outline-none px-2 border-1 h-100 bg-transparent">
            <option value="=">=</option>
            <option value="<">></option>
            <option value=">">
              << /option>
          </select> -->
          <select name="propertySortKeysValue" class="sortKey d-none border-0 text-center select-arrow-none outline-none px-2 h-100 bg-transparent">
          </select>
        </div>
        <!-- number of available records -->
        <span class="me-3 ms-auto"><small>50</small> of <small>100</small></span>
        <button class="btn btn-sm btn-secondary" onclick="printPageArea('intoreIdentities-card')">Print</button>
      </div> 
      <div id="currentStatusSortKeys" name="currentStatusSortKeys" targetField="currentStatus" class="sortKey p-0 bg-light-gray d-flex align-items-center justify-content-between">
      </div>
      <!-- intore container list-->
      <div class="card-body p-0 mx-3">
        <div class="table-responsive" id="intoreIdentities-card">
          <table class="table" id="intoreIdentities-container">
            <!-- intore default Identities -->
            <tr class="d-none">
              <td>
                <input type="checkbox" class="m-0 form-check-input fs-5 rounded-0" />
                <span class="m-0 p-0 ms-2 fw-medium">Ndayishimiye Emile</span>
              </td>
              <td class="text-secondary">Math-Physics-ComputerScience</td>
              <td class="text-secondary">+250789413183</td>
              <td>
                <div class="float-end">
                  <span class="badge bg-primary-subtle">Active</span>
                  <div class="ms-3 btn-group" role="group" aria-label="btngroup">
                    <button class="btn btn-sm btn-outline-secondary">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                      </svg>
                    </button>
                    <button class="btn btn-sm btn-outline-dark">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z" />
                        <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z" />
                        <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z" />
                      </svg>
                    </button>
                  </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
</section>
<?php
include_once('../components/footer.php')
?>