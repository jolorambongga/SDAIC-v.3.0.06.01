<?php
$title = 'Edit Services';
$active_doctors = 'active';
include_once('header.php');
?>

<body>
  <!-- start wrapper -->
  <div class="my-wrapper">
    <!-- start container fluid -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          <h1>Edit Doctors</h1>
        </div>
      </div>
      <!-- add button -->
      <div class="row">
        <div class="col-12">
          <button type="button" class="btn btn-primary mt-3 mb-3 float-end" data-bs-toggle="modal"
          data-bs-target="#modAddDoctor">Add Doctor</button>
        </div>
      </div>
      <!-- end button -->
      <!-- table -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped text-end">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Doctor Name</th>
                <th scope="col">Available Date</th>
                <th scope="col">Available Time</th>
                <th scope="col">Contact</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody id="tbodyDoctors">

            </tbody>
          </table>
        </div>
      </div>
      <!-- end table -->
      <!-- start add doctor modal -->
      <form id="frmAddDoctor" method="POST">
        <div class="modal fade" id="modAddDoctor" tabindex="-1" aria-labelledby="modAddDoctorLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="modAddDoctorLabel">Add New Doctor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- doctor first_name, middle_name, last_name, contact, avail_date, avail_time, action -->
                <!-- start doctor name -->
                <label for="first_name" class="form-label">Doctor's First Name</label>
                <input type="text" id="first_name" class="form-control" required>
                <pre></pre>
                <label for="middle_name" class="form-label">Doctor's Middle Name</label>
                <input type="text" id="middle_name" class="form-control">
                <pre></pre>
                <label for="last_name" class="form-label">Doctor's Last Name</label>
                <input type="text" id="last_name" class="form-control" required>
                <pre></pre>
                <!-- end doctor name -->
                <!-- start doctor contact -->
                <label for="contact" class="form-label">Doctor's Contact</label>
                <input type="number" id="contact" class="form-control" required>
                <pre></pre>
                <!-- end doctor contact -->
                <!-- start doctor sched -->
                <button id="callSetSched" type="button" class="btn btn-warning w-100">Set Schedule</button>
                <!-- end doctor sched -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                
                <button type="submit" class="btn btn-primary">Add Doctor</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- end add doctor modal -->
      <!-- start doctor sched modal -->
      <?php
      include_once('modals/doctor_sched_modal.php');
      ?>
      <!-- end doctor sched modal -->
    </div>
    <!-- end container fluid -->
  </div>
  <!-- end wrapper -->

  <!-- start jQuery script -->
  <script>
    $(document).ready(function () {
      console.log('ready');
      loadDoctors();

      var scheduleList = [];

      // START LOAD DOCTOR FUNCTION
      function loadDoctors() {
        $.ajax({
          type: 'GET',
          url: 'handles/doctors/read_doctors.php',
          dataType: 'json',
          success: function(response) {
            console.log(response);
            $('#tbodyDoctors').empty();

            response.data_doctor.forEach(function(data) {

              const datesWithNewLines = data.concat_date.replace(/,/g, '<hr>');
              const timesWithNewLines = data.concat_time.replace(/,/g, '<hr>');

              const read_doctor_html = `
              <tr>
              <th scope="row">${data.doctor_id}</th>
              <td>${data.full_name}</td>
              <td>${datesWithNewLines}</td>
              <td>${timesWithNewLines}</td>
              <td>${data.contact}</td>
              <td>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end text-center">
              <button id='callEdit' type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#'>${data.doctor_avail_id}</button>
              <button id='callDelete' type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#'>${data.doctor_avail_id}</button>
              </div>
              </td>
              </tr>
              `;
              $('#tbodyDoctors').append(read_doctor_html);
            }); // END EACH FUNCTION
          },
          error: function(error) {
            console.log("READ DOCTOR ERROR:", error);
          }
        });
      } // END LOAD DOCTOR FUNCTION


      $('#callSetSched').click(function () {

        new bootstrap.Modal($('#modDoctorSched')).show();
      });

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

      $('#bodySched').on('click', '.remove-sched', function () {
        var index = $(this).parent().index();
        scheduleList.splice(index, 1);
        $(this).parent().remove();
        console.log(scheduleList);
      });

      $('#btnClear').click(function () {

        $('#modDoctorSched select').each(function() {
          $(this).prop('selectedIndex', 0);
        });
        $('#bodySched').empty();
        scheduleList = [];
      });

      $('#btnSaveSched').click(function () {

        $('#modDoctorSched').modal('hide');
        $('#modDoctorSched select').each(function() {
          $(this).prop('selectedIndex', 0);
        });

        var avail_dates = JSON.stringify(scheduleList);
        $('#avail_dates').val(avail_dates);

        console.log('Saved Schedules:', avail_dates);

      });

      // CREATE DOCTOR
      $('#frmAddDoctor').submit(function (e) {

        e.preventDefault();

        var first_name = $('#first_name').val();
        var middle_name = $('#middle_name').val();
        var last_name = $('#last_name').val();
        var contact = $('#contact').val();
        var avail_dates = $('#avail_dates').val();

        var doctor_data = {
          first_name: first_name,
          middle_name: middle_name,
          last_name: last_name,
          contact: contact,
          avail_dates: avail_dates
        }

        console.log('click submit', doctor_data);

        $.ajax({

          type: 'POST',
          url: 'handles/doctors/create_doctor.php',
          data: doctor_data,
          success: function (response) {
            console.log('FUNCTION DATA:', doctor_data);
            console.log(response);
          },
          error: function (error) {
            console.log('ADD DOCTOR ERROR:', error);
            console.log('ERROR: DOCTOR DATA:', doctor_data);
          }
        });
      });


      // CLOSE MODAL FUNCTION
      function closeModal() {

        $('#modAddDoctor .btn-close').click();
        $('#modEditDoctor .btn-close').click();
        $('#modDeleteDoctor .btn-close').click();
        clearFields();
      } // END CLOSE MODAL FUNCTION

      // CLEAR FIELDS FUNCTION
      function clearFields() {

        $('#first_name').val('');
        $('#middle_name').val('');
        $('#last_name').val('');
        $('#contact').val('');
      } // END CLEAR FIELDS FUNCTION

      // ON CLOSE MODAL
      $('#modAddDoctor').on('hidden.bs.modal', function () {

        clearFields();
      });

      $('#modEditDoctor').on('hidden.bs.modal', function () {

        clearFields();
      });

      $('#modDeleteDoctor').on('hidden.bs.modal', function () {

        clearFields();
      }); // END ON CLOSE MODAL

    }); // END READY
  </script>
  <!-- end jQuery script -->

  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
</body>

</html>
