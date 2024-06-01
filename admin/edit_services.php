<?php
$title = 'Edit Services';
$active_services = 'active';
include_once('header.php');
?>

<body>
  <!-- start wrapper -->
  <div class="my-wrapper">
    <!-- start container fluid -->
    <div class="container-fluid">
      <!-- start label -->
      <div class="row">
        <div class="col-4">
          <h1>Edit Services</h1>
        </div>
      </div>
      <!-- end label -->
      <!-- start add button -->
      <div class="row">
        <div class="col-12">
          <button type="button" class="btn btn-primary mt-3 mb-3 float-end" data-bs-toggle="modal"
          data-bs-target="#modAddService">Add Service</button>
        </div>
      </div>
      <!-- end add button -->
      <!-- start table -->
      <div class="row">
        <div class="col-md-12">

          <table class="table table-striped text-end">
            <!-- start table head -->
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Service Name</th>
                <th scope="col">Description</th>
                <th scope="col">Date Available</th>
                <th scope="col">Time Available</th>
                <th scope="col">Duration</th>
                <th scope="col">Cost</th>
                <th scope="col">Doctor</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <!-- end table head -->
            <!-- start table body -->
            <tbody id="tbodyServices">

            </tbody>
            <!-- end table body -->
          </table>
        </div>
      </div>
      <!-- end table -->
      <!-- add service modal -->
      <form id="frmAddService">
        <div class="modal fade" id="modAddService" tabindex="-1" aria-labelledby="modAddServiceLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <!-- start modal header -->
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="modAddServiceLabel">Add New Service</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <!-- end modal header -->
              <div class="modal-body">
                <!-- start service name -->
                <label for="service_name" class="form-label">Service Name</label>
                <input type="text" id="service_name" class="form-control">
                <pre></pre>
                <!-- end service name -->
                <!-- start service description -->
                <label for="description" class="form-label">Service Description</label>
                <textarea type="text" id="description" class="form-control"></textarea>
                <pre></pre>
                <!-- end service description -->
                
                <!-- start doctor sched -->
                <button id="callSetSched" type="button" class="btn btn-warning w-100">Set Schedule</button><pre></pre>
                <!-- end doctor sched -->

                <!-- service duration -->
                <label for="duration" class="form-label">Service Duration</label>
                <input type="number" id="duration" class="form-control">
                <pre></pre>
                <!-- end service duration -->
                <!-- service cost -->
                <label for="cost" class="form-label">Service Cost</label>
                <div class="input-group mb-3">
                  <span class="input-group-text bg-warning-">₱</span>
                  <input type="number" class="form-control">
                  <span class="input-group-text bg-warning-">.00</span>
                </div>
                <!-- end service cost -->
                <!-- service doctor -->
                <label class="form-label">Choose Doctor</label>
                <div class="input-group mb-3">
                  <label class="input-group-text bg-warning-" for="doctor">Options</label>
                  <select class="form-select" id="doctor">
                    <option selected>Select Doctor...</option>
                    <option value="1">Doctor 1</option>
                    <option value="2">Doctor 2</option>
                    <option value="3">Doctor 3</option>
                  </select>
                </div>
                <!-- end service doctor -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Service</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- end modal -->
      <!-- start service sched modal -->
      <?php
      include_once('modals/service_sched_modal.php');
      ?>
      <!-- end service sched modal -->
    </div>
    <!-- end container fluid -->
  </div>
  <!-- end wrapper -->

  <!-- start jQuery script -->
  <script>
    $(document).ready(function () {
      console.log('ready');

      $('#callSetSched').click(function () {
        new bootstrap.Modal($('#modServiceSched')).show();
      });

      $('#btnGoBack').click(function () {
        $('#modServiceSched').modal('hide');
        $('#modServiceSched select').each(function() {
          $(this).prop('selectedIndex', 0);
        });
      });

      // CLOSE MODAL FUNCTION
      function closeModal() {
        $('#modAddService .btn-close').click();
        $('#modEditService .btn-close').click();
        $('#modDeleteService .btn-close').click();
        clearFields();
      } // END CLOSE MODAL FUNCTION

      // CLEAR FIELDS FUNCTION
      function clearFields() {

      } // END CLEAR FIELDS FUNCTION

      // ON CLOSE MODAL
      $('#modServiceSched').on('hidden.bs.modal', function () {
        $('#modServiceSched select').each(function() {
          $(this).prop('selectedIndex', 0);
        });
      });

      $('#modAddService').on('hidden.bs.modal', function () {
        clearFields();
      });

      $('#modEditService').on('hidden.bs.modal', function () {
        clearFields();
      });

      $('#modDeleteService').on('hidden.bs.modal', function () {
        clearFields();
      }); // END ON CLOSE MODAL

    }); // END READY
  </script>
  <!-- end jQuery script -->

  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
</body>

</html>