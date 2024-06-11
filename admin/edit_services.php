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
                <input type="text" id="service_name" class="form-control" required>
                <pre></pre>
                <!-- end service name -->
                <!-- start service description -->
                <label for="description" class="form-label">Service Description</label>
                <textarea type="text" id="description" class="form-control" required></textarea>
                <pre></pre>
                <!-- end service description -->
                
                <!-- start doctor sched -->
                <button id="callSetSched" type="button" class="btn btn-warning w-100">Set Schedule</button><pre></pre>
                <!-- end doctor sched -->

                <!-- service duration -->
                <label for="duration" class="form-label">Service Duration</label>
                <input type="number" id="duration" class="form-control" required>
                <pre></pre>
                <!-- end service duration -->
                <!-- service cost -->
                <label for="cost" class="form-label">Service Cost</label>
                <div class="input-group mb-3">
                  <span class="input-group-text bg-warning-">₱</span>
                  <input type="number" id="cost" class="form-control" required>
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

      <!-- start delete service modal -->
      <div class="modal fade" id="mod_delServ" tabindex="-1" aria-labelledby="mod_delServLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="mod_delServLabel">Delete Service</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="del_user_input" class="form-label">Type <b>DELETE</b> to delete the <span id="servName"></span>'s service.</label>
              <input type="text" id="del_user_input" class="form-control" required>            
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

              <button id="btnDel" type="button" data-service-id="" class="btn btn-danger">Delete Record</button>
            </div>
          </div>
        </div>
      </div>
      <!-- end delete service modal -->
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
            $('#tbodyServices').empty();

            response.data.forEach(function(data) {

              const datesWithNewLines = data.concat_date ? data.concat_date.replace(/,/g, '<hr>') : '';
              const timesWithNewLines = data.concat_time ? data.concat_time.replace(/,/g, '<hr>') : '';

              const read_doctor_html = `
              <tr>
              <th scope="row">${data.service_id}</th>
              <td>${data.service_name}</td>
              <td>${data.description}</td>
              <td>${datesWithNewLines}</td>
              <td>${timesWithNewLines}</td>
              <td>${data.duration}</td>
              <td>${data.cost}</td>
              <td>${data.full_name}</td>
              <td data-service-id='${data.service_id}' data-service-name='${data.service_name}'>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end text-center">
              <button id='callEdit' type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#mod_editServ'>Edit</button>
              <button id='callDelete' type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#mod_delServ'>Delete</button>
              </div>
              </td>
              </tr>
              `;
              $('#tbodyServices').append(read_doctor_html);
            }); // END EACH FUNCTION
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
        
        if (!avail_day || !avail_start_time || !avail_end_time) {
          alert('Please complete the schedule details.');
          return;
        }

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

        if (!avail_dates || avail_dates === '[]') {
          alert('Please Select a Schedule...');
          return;
        }

        if(!doctor_id) {
          alert("Please Select a Doctor...");
          return;
        }

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
            clearFields();
            loadServices();
            closeModal();
          },
          error: function (error) {
            console.log('ADD SERVICE ERROR:', error);
            console.log('ERROR: SERVICE DATA:', service_data);
            // alert("Please Ensure All Fields are COMPLETE");
          }
        });
      });

      // DELETE SERVICE
      $(document).on('click', '#callDelete', function() {
        var service_id = $(this).closest("td").data('service-id');
        var service_name = $(this).closest("td").data('service-name');

        console.log("service id:", service_id, "service name:", service_name);
        $('#servName').text(service_name);

        $('#btnDel').data('service-id', service_id);
      });

      $(document).on('click', '#btnDel', function() {
        var service_id = $(this).data('service-id');
        var user_input = $('#del_user_input').val();

        if (user_input !== 'DELETE') {
          alert('Please type DELETE to confirm.');
          return;
        }

        $.ajax({
          type: 'POST',
          url: 'handles/services/delete_service.php',
          data: {service_id: service_id, user_input: user_input},
          dataType: 'JSON',
          success: function(response) {
            console.log("DELETE SERVICE RESPONSE:", response);
            loadServices();
            $('#mod_delServ').modal('hide');
          },
          error: function(error) {
            console.log("DELETE SERVICE ERROR:", error);
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
        $('#service_name').val('');
        $('#description').val('');
        $('#duration').val('');
        $('#cost').val('');

        $('#doctor').prop('selectedIndex', 0);
        $('#bodySched').empty();
        scheduleList = [];
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