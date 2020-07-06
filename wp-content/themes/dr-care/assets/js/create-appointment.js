const appointmentForm = document.querySelector('#create-appointment')
const url = appointmentForm.getAttribute('action')
console.log(url);

jQuery(document).ready(function($) {
  if (appointmentForm) {
    $('#create-appointment').submit(e => {
      e.preventDefault();

      const data = {
        first_name: $('#appointment-first-name').val(),
        last_name: $('#appointment-last-name').val(),
        service: $('#appointment-service').val(),
        phone: $('#appointment-phone').val(),
        date: $('#appointment-date').val(),
        time: $('#appointment-time').val(),
        message: $('#appointment-message').val(),
        action: 'create_appointment'
      }

      $.ajax(url, {
        method: 'POST',
        data: data,

        success: function(res) {
          const data = JSON.parse(res);
          
          if (data.type == 'success') {
            $(`#appointment-alert-success`).text(data.message);
            $(`#appointment-alert-success`).fadeIn(300);

            setTimeout(() => {
              $('#appointment-alert-success').fadeOut(300)
            }, 5000);
          } else {
            $(`#appointment-alert-danger`).text(data.message);
            $(`#appointment-alert-danger`).fadeIn(300);

            setTimeout(() => {
              $('#appointment-alert-danger').fadeOut(300)
            }, 5000);
          }
        },

        error: function(res) {
          $('#appointment-alert-warning').text('Something went wrong. Write to ...');
          $('#appointment-alert-warning').fadeIn(300);

          setTimeout(() => {
            $('#appointment-alert-warning').fadeOut(300);
          }, 5000);
        }
      })
    });
  }
});