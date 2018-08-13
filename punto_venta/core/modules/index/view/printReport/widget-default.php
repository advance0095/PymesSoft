<!DOCTYPE html>
<html>

<head>

   
 <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ticket</title>

 <link  href=".\core\modules\index\view\printReport\style.css" rel="stylesheet"/>
<link  href="" rel="stylesheet"/>
  <script src=".\core\modules\index\view\printReport\script.js"></script>
 <script>
      $(document).ready(function()
      {
         $("#mostrarmodal").modal("show");
      });
    </script>
</head>
<body>
<?php if(isset($_GET["id"]) && $_GET["id"]!=""):?>

<section id="tickets">



  <div class="ticket" id="Cdark">
    <img src="./img/menu.jpg" class="img" width="100" height="100" alt="Logotipo">
    <p class="centrado" id="textWhite">TICKET DE VENTA
      <br>Canc&uacuten
     
    



<table class="tablas" id="cDark" >
	<thead class="precio" id="textWhite" >
		<th >Cantidad</th>
		<th >Producto</th>
		<th >P.Unitario</th>
		
    <th></th>

	</thead>	

<?php

$operations = OperationData::getAllProductsBySellId($_GET["id"]);
	foreach($operations as $operation){
		$product  = $operation->getProduct();
?>


	
<tr id="textWhite" >

 <?php


static $tootal;
static $total;
$tootal=$total+=$operation->q*$product->price_out;?>
	
	<td><?php echo $operation->q ;?></td>
	<td ><?php echo $product->name ;?></td>
	<td ><?php echo $product->price_out ;?></td>

 
    
 <?php } ?>
<?php endif ?>
</table>

    <p class="centrado" id="textWhite">GRACIAS POR SU COMPRA! </p>
Total: $ <?php echo $tootal; ?>
 </div>



</section>



  <button name="print" class="btn btn btn-success" onclick="imprimir()" >Imprimir</button>



   <!--   <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
          <button type="button" class="close" onclick="cerrar()" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3>Cabecera de la ventana</h3>
           </div>
           <div class="modal-body">
              <h4>Texto de la ventana</h4>
              Mas texto en la ventana.    
       </div>
 <div class="modal-body">
     <input type="text" name="total">
       </div>
           <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
      </div>
   </div>
</div>
    -->




</body>





</html>