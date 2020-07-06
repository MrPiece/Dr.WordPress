<?php
require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php');

class AppointmentTable extends WP_List_Table
{
  public function prepare_items()
  {  
    $orderby = isset($_GET['orderby']) ? trim($_GET['orderby']) : 'id';
    $order = isset($_GET['order']) ? trim($_GET['order']) : 'desc';

    $search_term = isset($_POST['s']) ? trim($_POST['s']) : '';

    $data = $this->getAppointmentsData($order, $orderby, $search_term);

    $this->setPaginatedData($data, 10);

    $columns = $this->get_columns();
    $hidden = $this->get_hidden_columns();
    $sortable = $this->get_sortable_columns();

    $this->_column_headers = [$columns, $hidden, $sortable];
  }

  public function get_hidden_columns()
  {
    return [];
  }

  public function get_sortable_columns()
  {
    return [
      'id' => ['id', true], 
      'first-name' => ['first-name', false],
      'last-name' => ['last-name', false]
    ];
  }

  public function get_columns()
  {
    $columns = [
      'id' => 'Client ID',
      'first-name' => 'Client First Name',
      'last-name' => 'Client Last Name',
      'phone-number' => 'Client Phone',
      'meet-time' => 'Appointment Time',
      'service-type' => 'Service',
      'message' => 'Client Message'
    ];

    return $columns;
  }

  public function column_default($item, $column_name)
  {
    switch($column_name) {
      case 'id':
      case 'first-name':
      case 'last-name':
      case 'phone-number':
      case 'meet-time':
      case 'service-type':
      case 'message':
        return $item[$column_name];
      default:
        return 'no_value';
    }
  }

  private function getAppointmentsData($order, $orderby, $search_term): array
  {
    global $wpdb;
    $order = strtoupper($order) == 'DESC' ? 'DESC' : 'ASC';
    $where = '';

    if (! empty($search_term)) {
      $where = "WHERE
        `id` LIKE '%{$search_term}%' OR
        `first-name` LIKE '%{$search_term}%' OR
        `last-name` LIKE'%{$search_term}%' OR
        `phone-number` LIKE '%{$search_term}%' OR
        `meet-time` LIKE '%{$search_term}%' OR
        `service-type` LIKE '%{$search_term}%' OR
        `message` LIKE '%{$search_term}%'
      ";
    }

    $query = "
      SELECT * FROM appointments
      {$where}
      ORDER BY `{$orderby}` {$order}
    ";

    $items = $wpdb->get_results($query, ARRAY_A);

    foreach ($items as $id => $item)
      $items[$id]['message'] = stripslashes($item['message']);

    return $items;
  }

  public function column_id($item)
  { 
    $action = [
      'edit' => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>', $_GET['page'], 'appointment-edit', $item['id']),
      'delete' => sprintf('<a href="?page=%s&action=%s&id=%s" onclick="event.preventDefault(); if ( confirm(`Do you want to delete this appointment?`) ) window.location.replace(event.target.getAttribute(`href`));">Delete</a>', $_GET['page'], 'appointment-delete', $item['id'])
    ];

    return sprintf('%1$s %2$s', $item['id'], $this->row_actions($action));
  }

  private function setPaginatedData($data, $per_page)
  {
    $current_page = $this->get_pagenum();
    $total_items = count($data);

    $this->set_pagination_args([
      'total_items' => $total_items,
      'per_page' => $per_page
    ]);

    $this->items = array_slice($data, ($current_page - 1) * $per_page, $per_page);
  }
}

function show_appointment_table()
{
  $appointmentTable = new AppointmentTable();

  $appointmentTable->prepare_items();
  
  echo '<h1>Appointments</h1>';
  echo '<div id="delete-alert" style="display: none" class="alert alert-danger medium"></div>';
  echo '<form method="post" name="frm_search_post" action="'.$_SERVER['PHP_SELF'].'?page=appointment_table">';
    $appointmentTable->search_box('Search', 'appointment-search');
  echo '</form>';
  $appointmentTable->display();
}

show_appointment_table();