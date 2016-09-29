<?php
//include connection file
include_once("connection.php");
include 'chromePhp.php';
//ChromePhp::log('Hello console!');
//ChromePhp::log($_SERVER);
//ChromePhp::warn('something went wrong!');

$sql = "SELECT * FROM `producto`";
$queryRecords = mysqli_query($conn, $sql) or die("error to fetch employees data");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <title>Supermarket GPS</title>
</head>
<body class="">
<div role="navigation" class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#" class="navbar-brand"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>

          </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!--<div class="container" style="min-height:500px;">-->
    <div class="container">
    <div class=''></div>
    <!--<h1>Demo of Simple Example of Inline Editing with HTML5,PHP and MySQL</h1>-->
    <div id="msg" class="alert"></div>
    <table id="employee_grid" class="table table-condensed table-hover table-bordered table-striped bootgrid-table" width="60%" cellspacing="0">
       <thead>
          <tr>
             <th>ID</th>
             <th>ID Producto</th>
             <th>Código</th>
             <th>Nombre</th>
             <th>Marca</th>
             <th>Precio</th>
             <th>Zona</th>
             <th>Categoria Completa</th>
             <!--<th>Categoria</th>-->
             <th>Pasillo</th>
          </tr>
       </thead>
       <tbody id="_editable_table">
          <?php foreach($queryRecords as $res) :?>
          <tr data-row-id="<?php echo $res['id'];?>">
            <td class="editable-col" contenteditable="false">
              <?php echo $res['id'];?>
            </td>
            <td class="editable-col" contenteditable="true" col-index='0' oldVal ="<?php echo $res['idproducto'];?>">
               <?php echo $res['idproducto'];?>
            </td>
            <td class="editable-col" contenteditable="true" col-index='1' oldVal ="<?php echo $res['codigo'];?>">
               <?php echo $res['codigo'];?>
            </td>
            <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['nombre'];?>">
               <?php echo $res['nombre'];?>
            </td>
            <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['marca'];?>">
               <?php echo $res['marca'];?>
            </td>
            <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['precio'];?>">
               <?php echo $res['precio'];?>
            </td>
            <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['zona'];?>">
               <?php echo $res['zona'];?>
            </td>
            <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['categoria_completa'];?>">
               <?php echo $res['categoria_completa'];?>
            </td>
            <!--<td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['categoria'];?>">
               <?php echo $res['categoria'];?>-->
            </td>
            <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['pasillo'];?>">
               <?php echo $res['pasillo'];?>
            </td>
          </tr>
        <?php endforeach;?>
       </tbody>
    </table>
  </div>
</body></html>


<script type="text/javascript">
$(document).ready(function(){
	$('td.editable-col').on('focusout', function() {
		data = {};
		data['val'] = $(this).text().trim();
		data['id'] = $(this).parent('tr').attr('data-row-id');
		data['index'] = $(this).attr('col-index');

	  if($(this).attr('oldVal') === data['val'])
      {
        return false;
      }

		$.ajax({

					type: "POST",
					url: "server.php",
					cache:false,
					data: data,
					dataType: "json",
					success: function(response)
					{
						if(response.status) {
							$("#msg").removeClass('alert-danger');
							$("#msg").addClass('alert-success').html(response.msg);
						} else {
							$("#msg").removeClass('alert-success');
							$("#msg").addClass('alert-danger').html(response.msg);
						}
					}
				});
	});
});

</script>
