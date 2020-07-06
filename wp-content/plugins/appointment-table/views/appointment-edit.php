<?php
//add_action('admin_print_scripts', 'my_action_javascript'); // такое подключение будет работать не всегда
add_action('admin_print_footer_scripts', 'my_action_javascript', 99);
function my_action_javascript() {
	?>
	<script>
	jQuery(document).ready(function($) {
    const form = $('#appointment-edit');

    $(form).submit(e => {
      e.preventDefault();

      let data = {
        action: 'edit_appointment',
        firstName: $(form).find('#first-name').val(),
        lastName: $(form).find('#last-name').val(),
        phoneNumber: $(form).find('#phone').val(),
        meetTime: $(form).find('#time').val(),
        id: <?= $_GET['id'] ?>
      };

      console.log(data);

      $.post( ajaxurl, data, function(response) {
        console.log('Получено с сервера: ' + response);
        response = JSON.parse(response);

        $('.alert').text(response.message);

        if (response.type == 'success')
          $('.alert').addClass('alert-success');
        else
          $('.alert').addClass('alert-danger');

        $('.alert').fadeIn(300);
        setTimeout(() => {
          $('.alert').fadeOut(300)

          setTimeout(() => {
            if ( $('.alert').hasClass('alert-success') )
              $('.alert').removeClass('alert-success')
            else 
              $('.alert').removeClass('alert-danger')
          }, 300);
        }, 3000);
      });
    })
	});
	</script>
	<?php
}
?>

<h1>Appointment Edit</h1>

<div class="alert mb medium" style="display: none"></div>

<form action="<?= get_admin_url(null, 'admin-ajax.php') ?>" method="POST" id="appointment-edit">
  <div>
    <label for="first-name">First Name</label>
    <input type="text" id="first-name" value="<?= $data['first-name'] ?>">
  </div>

  <div>
    <label for="last-name">Last Name</label>
    <input type="text" id="last-name" value="<?= $data['last-name'] ?>">
  </div>

  <div>
    <label for="phone">Phone</label>
    <input type="text" id="phone" value="<?= $data['phone-number'] ?>">
  </div>

  <div>
    <label for="time">Time</label>
    <input type="text" id="time"  value="<?= $data['meet-time'] ?>">
  </div>
  <br>

  <button type="submit">Save</button>
</form>