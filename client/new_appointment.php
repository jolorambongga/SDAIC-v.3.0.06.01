<?php
$title = "INDEX ITO";
$active_index = "";
$active_profile = "";
$active_your_appointments = "";
$active_new_appointment = "active";
include_once('header.php');
?>  

<div class="my-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h1 class="text-start">Make your new appointment</h1>
      </div>
    </div>
    <!-- start multi-step form -->
    <div class="row justify-content-center bg- p-3 p-md-5">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="wrapper">
          <form id="appointment-form">
            <!-- Step 1: Select Procedure -->
            <div id="step-1" class="form-step">
              <div class="title">Your Procedure</div>
              <div id="box" class="box mb-3">
                <!-- Content will be loaded here by jQuery -->
              </div>
              <button type="button" class="btn btn-warning next-btn float-end mt-3">Next</button>
            </div>
            
            <!-- Step 2: Upload Image -->
            <div id="step-2" class="form-step" style="display:none;">
              <div class="title">Upload Photo of Your Request</div>
              <div class="box mb-3">
                <input type="file" name="procedure_image" id="procedure_image" class="form-control">              
              </div>
              <button type="button" class="btn btn-warning next-btn float-end mt-3">Next</button>
              <button type="button" class="btn btn-danger prev-btn float-end mt-3 me-2">Previous</button>
            </div>
            
            <!-- Step 3: Select Date and Time -->
            <div id="step-3" class="form-step" style="display:none;">
              <div class="title">Select Date and Time</div>
              <div class="box mb-3">
                <input type="datetime-local" name="appointment_datetime" id="appointment_datetime" class="form-control">
              </div>
              <button type="button" class="btn btn-warning next-btn float-end mt-3">Next</button>
              <button type="button" class="btn btn-danger prev-btn float-end mt-3 me-2">Previous</button>
            </div>
            
            <!-- Step 4: Review and Submit -->
            <div id="step-4" class="form-step" style="display:none;">
              <div class="title">Review and Submit</div>
              <div id="review-box" class="box mb-3">
                <!-- Review content will be populated here -->
              </div>
              <button type="submit" class="btn btn-success float-end mt-3">Submit</button>
              <button type="button" class="btn btn-danger prev-btn float-end mt-3 me-2">Previous</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end multi-step form -->
  </div>
</div>

<script>
  $(document).ready(function () {
    // Load procedures on page load
    loadProcedures();
    
    function loadProcedures() {
      $.ajax({
        type: 'GET',
        url: 'handles/read_services.php',
        dataType: 'json',
        success: function(response) {
          $('#box').empty();
          $.each(response.data, function(key, value){
            var increment = key + 1;
            const procedures = `
            <input type="radio" name="select" id="${value.service_id}" value="${value.service_name}">
            <label for="${value.service_id}" class="value-${increment}">
              <div class="select-dots"></div>
              <div class="text">${value.service_name}</div>
            </label>
            `;
            $('#box').append(procedures);
          });
        },
        error: function(error) {
          console.log("ERROR SA LOAD PROCEDURES:", error);
        }
      });
    }

    // Navigation functions
    $('.next-btn').click(function(){
      $(this).closest('.form-step').hide().next('.form-step').show();
    });

    $('.prev-btn').click(function(){
      $(this).closest('.form-step').hide().prev('.form-step').show();
    });

    // Form submit handler
    $('#appointment-form').submit(function(e){
      e.preventDefault();
      // Collect form data and show review
      let selectedProcedure = $('input[name="select"]:checked').val();
      let imageFile = $('#procedure_image').val().split('\\').pop();
      let appointmentDatetime = $('#appointment_datetime').val();

      $('#review-box').html(`
        <p><strong>Procedure:</strong> ${selectedProcedure}</p>
        <p><strong>Image:</strong> ${imageFile}</p>
        <p><strong>Appointment Date and Time:</strong> ${appointmentDatetime}</p>
      `);

      // Optionally, you can also submit the form data via AJAX here
      // $.ajax({
      //   type: 'POST',
      //   url: 'handles/submit_appointment.php',
      //   data: new FormData(this),
      //   contentType: false,
      //   processData: false,
      //   success: function(response) {
      //     alert('Appointment submitted successfully!');
      //   },
      //   error: function(error) {
      //     console.log("ERROR SA SUBMIT APPOINTMENT:", error);
      //   }
      // });
    });
  });
</script>

<?php
include_once('footer.php');
?>
