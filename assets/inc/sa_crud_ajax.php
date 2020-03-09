<?php
// For Data Insert
add_action('wp_ajax_sacrud_entry', 'sacrud_entry_callback');
add_action('wp_ajax_nopriv_sacrud_entry', 'sacrud_entry_callback');

function sacrud_entry_callback() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'persons';
  $wpdb->get_row( "SELECT * FROM {$table_name} WHERE `name` = '".$_POST['name']."' AND `email` = '".$_POST['email']."' AND `age` = '".$_POST['age']."' ORDER BY `id` DESC" );
  if($wpdb->num_rows < 1) {
    $wpdb->insert("{$table_name}", array(
      "name" => $_POST['name'],
      "email" => $_POST['email'],
      "age"  => $_POST['age']
    ));

    $response = array('message'=>'Data Has Inserted Successfully', 'rescode'=>200);
  } else {
    $response = array('message'=>'Data Has Already Exist', 'rescode'=>404);
  }
  echo json_encode($response);
  exit();
  wp_die();
}

//For Data Update
add_action('wp_ajax_sacrud_edit', 'sacrud_edit_callback');
add_action('wp_ajax_nopriv_sacrud_edit', 'sacrud_edite_callback');

function sacrud_edit_callback() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'persons';
  $wpdb->get_row( "SELECT * FROM {$table_name} WHERE `name` = '".$_POST['name']."' AND `email` = '".$_POST['email']."' AND `age` = '".$_POST['age']."' AND `id`!='".$_POST['id']."' ORDER BY `id` DESC" );
  if($wpdb->num_rows < 1) {
    $wpdb->update("{$table_name}", array(
      "name" => $_POST['name'],
      "email" => $_POST['email'],
      "age"  => $_POST['age']
    ),array('id' => $_POST['id']));

    $response = array('message'=>'Data Has Updated Successfully', 'rescode'=>200);
  } else {
    $response = array('message'=>'Data Has Already Exist', 'rescode'=>404);
  }
  echo json_encode($response);
  exit();
  wp_die();
}
