<?php
/*
 * Plugin name: Appointment Table
 * Description: Plugin for listing appointment database table
 * Author: MrPiece
 */

add_action('admin_menu', 'wp_appointment_table_menu');

function wp_appointment_table_menu() 
{
  add_menu_page(
    'Appointments', 
    'Appointments', 
    'manage_options', 
    'appointment_table', 
    'appointment_table_fn'
  );
}

function appointment_table_fn()
{
  $action = isset($_GET['action']) ? trim($_GET['action']) : '';
  if ($action == 'appointment-edit') {
    global $wpdb;

    $appointment_id = isset($_GET['id']) ? (int) $_GET['id'] : '';

    $data = $wpdb->get_row(
      "SELECT `first-name`, `last-name`, `phone-number`, `meet-time` 
      FROM appointments WHERE `id` = {$appointment_id}", ARRAY_A
    );

    ob_start();

    require_once plugin_dir_path(__FILE__) . 'views/appointment-edit.php';
    $template = ob_get_contents();
  
    ob_end_clean();
  
    echo $template;
  } elseif ($action == 'appointment-delete') {
    global $wpdb;

    try {
      $query = $wpdb->delete('appointments', ['id' => $_GET['id']], ['%d']);

      if (! $query) throw new Exception("Appointment wasn't delete!");
    } catch (Exception $e) {
      $_SESSION['delete-status'] = 'error';
      $_SESSION['messasge'] = $e->getMessage();
    }

    $_SESSION['delete-status'] = 'success';
    $_SESSION['message'] = 'Appointment has been successfuly deleted!';

    wp_redirect($_SERVER['HTTP_REFERER']);
  } else {
    ob_start();

    require_once plugin_dir_path(__FILE__) . 'views/appointment-table.php';
    $template = ob_get_contents();
  
    ob_end_clean();
  
    echo $template;
  }
}