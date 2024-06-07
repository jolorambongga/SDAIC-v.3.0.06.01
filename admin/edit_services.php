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
          data-bs-target="#mod_addServ">Add Service</button>
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
                <th scope="col">Available Day</th>
                <th scope="col">Available Time</th>
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
      <form id="frm_addServ">
        <div class="modal fade" id="mod_addServ" tabindex="-1" aria-labelledby="mod_addServLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <!-- start modal header -->
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="mod_addServLabel">Add New Service</h1>
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
                  <input type="number" id="cost" class="form-control">
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
      loadServices();

      var scheduleList = [];
      var editScheduleList = [];

      function loadServices() {
        $.ajax({
          type: 'GET',
          url: 'handles/services/read_services.php',
          dataType: 'JSON',
          success: function(response) {
            console.log("SUCCESS READ:", response);
          },
          error: function(error) {
            console.log("ERROR READ:", error);
          }
        });
      }

      // READ DOCTORS
      function populateDoctorOptions() {
        $.ajax({
          url: 'handles/services/get_doctor_option.php',
          method: 'GET',
          dataType: 'json',
          success: function(response) {

            console.log("THE RESPONSE:", response);

            var doctorSelect = $('#doctor');
            doctorSelect.empty(); // Clear existing options
            doctorSelect.append('<option selected>Select Doctor...</option>');

            response.data.forEach(function (doc) {
              const data = `
              <option data-doctor-id="${doc.doctor_id}" value="${doc.doctor_id}">Dr. ${doc.full_name}</option>`

              doctorSelect.append(data);

            });
          },
          error: function(error) {
            console.log('Error fetching doctor options:', error);
          }
        });
      }

      // POPULATE DOCTORS
      $('#mod_addServ').on('show.bs.modal', function () {
        populateDoctorOptions();
      });

      $('#callSetSched').click(function () {
        new bootstrap.Modal($('#mod_addServSched')).show();
      });

      $('#btnGoBack').click(function () {
        $('#mod_addServSched').modal('hide');
        $('#mod_addServSched select').each(function() {
          $(this).prop('selectedIndex', 0);
        });
      });

      // ADD SCHEDULE
      $('#addSched').click(function () {

        var avail_day = $('#avail_day').val();
        var avail_start_time = $('#avail_start_time').val();
        var avail_end_time = $('#avail_end_time').val();
        //<div class="input-group mb-3 w-100 d-flex justify-content-end align-items-center">
        const sched_data = 
        `
        <div class="input-group mx-auto w-100 schedule-item">

        <span class="input-group-text text-warning">Selected Day:</span>
        <span class="input-group-text bg-warning-subtle">${avail_day}</span>

        <span class="input-group-text text-success">Start Time:</span>
        <span class="input-group-text bg-success-subtle">${avail_start_time}</span>

        <span class="input-group-text text-danger">End Time:</span>
        <span class="input-group-text bg-danger-subtle">${avail_end_time}</span>

        <button class="btn btn-danger text-warning remove-sched" type="button" id="removeSched">-</button>

        </div>
        `

        $('#bodySched').append(sched_data);

        scheduleList.push({
          avail_day: avail_day,
          avail_start_time: avail_start_time,
          avail_end_time: avail_end_time
        });

        console.log(scheduleList);
      });


      // REMOVE SCHEDULE
      $('#bodySched').on('click', '.remove-sched', function () {
        var index = $(this).parent().index();
        scheduleList.splice(index, 1);
        $(this).parent().remove();
        console.log(scheduleList);
      });

      // CLEAR SCHEDULE
      $('#btnClear').click(function () {

        $('#mod_addServSched select').each(function() {
          $(this).prop('selectedIndex', 0);
        });
        $('#bodySched').empty();
        scheduleList = [];
      });

      // SAVE SCHEDULE
      $('#btnSaveSched').click(function () {

        $('#mod_addServSched').modal('hide');
        $('#mod_addServSched select').each(function() {
          $(this).prop('selectedIndex', 0);
        });

        var avail_dates = JSON.stringify(scheduleList);
        $('#avail_dates').val(avail_dates);

        console.log('Saved Schedules:', avail_dates);

      });

      // CREATE SERVICE
      $('#frm_addServ').submit(function (e) {

        e.preventDefault();

        var service_name = $('#service_name').val();
        var description = $('#description').val();
        var duration = $('#duration').val();
        var cost = $('#cost').val();
        var avail_dates = $('#avail_dates').val();
        var doctor_id = $('#doctor').find(':selected').data('doctor-id');

        var service_data = {
          service_name: service_name,
          description: description,
          duration: duration,
          cost: cost,
          doctor_id: doctor_id,
          avail_dates: avail_dates
        }

        console.log('click submit', service_data);

        $.ajax({

          type: 'POST',
          url: 'handles/services/create_service.php',
          data: service_data,
          success: function (response) {
            console.log('FUNCTION DATA:', service_data);
            console.log(response);
            // loadServices();
            closeModal();
          },
          error: function (error) {
            console.log('ADD SERVICE ERROR:', error);
            console.log('ERROR: SERVICE DATA:', service_data);
          }
        });
      });

      // CLOSE MODAL FUNCTION
      function closeModal() {
        $('#mod_addServ .btn-close').click();
        $('#mod_editServ .btn-close').click();
        $('#mod_delServ .btn-close').click();
        clearFields();
      } // END CLOSE MODAL FUNCTION

      // CLEAR FIELDS FUNCTION
      function clearFields() {

      } // END CLEAR FIELDS FUNCTION

      // ON CLOSE MODAL
      $('#mod_addServSched').on('hidden.bs.modal', function () {
        $('#mod_addServSched select').each(function() {
          $(this).prop('selectedIndex', 0);
        });
      });

      $('#mod_addServ').on('hidden.bs.modal', function () {
        clearFields();
      });

      $('#mod_editServ').on('hidden.bs.modal', function () {
        clearFields();
      });

      $('#mod_delServ').on('hidden.bs.modal', function () {
        clearFields();
      }); // END ON CLOSE MODAL

    }); // END READY
  </script>
  <!-- end jQuery script -->

  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
</body>

</html>