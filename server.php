<?php
  //include connection file
  include_once("connection.php");
  include 'chromePhp.php';
  //ChromePhp::log('Hello console!');
  //ChromePhp::log($_SERVER);
  //ChromePhp::warn('something went wrong!');

  //define index of column
  $columns = array(
    0 => 'idproducto',
    1 => 'codigo',
    2 => 'nombre',
    3 => 'marca',
    4 => 'precio',
    5 => 'zona',
    6 => 'categoria_completa',
    7 => 'categoria',
    8 => 'pasillo'
  );
  $error = false;
  $colVal = '';
  $colIndex = $rowId = 0;

  $msg = array('status' => !$error, 'msg' => 'No se han podido actualizar los datos');

  if(isset($_POST)){
    // Cogemos el valor a actualizar: VAL
    if(isset($_POST['val']) && !empty($_POST['val']) && !$error) {
      $colVal = $_POST['val'];
    } else {
      $error = true;
    }

    // Miramos dentro de la linea de la tabla CUAL de las COLUMNAS vamos a actualizar ese VAL
    if(isset($_POST['index']) && $_POST['index'] >= 0 && !$error) {
      $colIndex = $_POST['index'];
    } else {
      $error = true;
    }

    // Miramos sobre QUE elemento de la tabla vamos actualizar.
    if(isset($_POST['id']) && $_POST['id'] > 0 && !$error) {
      $rowId = $_POST['id'];
    } else {
      $error = true;
    }

    if(!$error) {
        $sql = "UPDATE producto SET ".$columns[$colIndex]." = '".$colVal."' WHERE id='".$rowId."'";
        $status = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        $msg = array('status' => !$error, 'msg' => 'Los datos se han actualizado correctamente!');
    }
  }

  // send data as json format
  echo json_encode($msg);

?>
