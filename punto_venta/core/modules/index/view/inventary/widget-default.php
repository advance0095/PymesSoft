<head><link  href="estilo.css" rel="stylesheet"/></head>
<div class="row">

<!-- Single button -->

<!--<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/inventary-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>-->

        <section id="cOrange">
		<h1 id="onsellContent"><i class="glyphicon glyphicon-stats"></i> Inventario de Ingredientes</h1>
    </section>
		<div class="clearfix"></div>


<?php
$page = 1;
if(isset($_GET["page"])){
	$page=$_GET["page"];
}
$limit=10;
if(isset($_GET["limit"]) && $_GET["limit"]!="" && $_GET["limit"]!=$limit){
	$limit=$_GET["limit"];
}
$products = IngredientData::getAll();
if(count($products)>0){

if($page==1){
$curr_products = IngredientData::getAllByPage($products[0]->id,$limit);
}else{
$curr_products = IngredientData::getAllByPage($products[($page-1)*$limit]->id,$limit);

}
$npaginas = floor(count($products)/$limit);
 $spaginas = count($products)%$limit;

if($spaginas>0){ $npaginas++;}

	?>

	<h3>Página <?php echo $page." de ".$npaginas; ?></h3>
<div class="btn-group pull-right">
<?php
$px=$page-1;
if($px>0):
?>
<a class="btn btn-sm btn-default" href="<?php echo "index.php?view=inventary&limit=$limit&page=".($px); ?>"><i class="glyphicon glyphicon-chevron-left"></i> Atras </a>
<?php endif; ?>

<?php 
$px=$page+1;
if($px<=$npaginas):
?>
<a class="btn btn-sm btn-default" href="<?php echo "index.php?view=inventary&limit=$limit&page=".($px); ?>">Adelante <i class="glyphicon glyphicon-chevron-right"></i></a>
<?php endif; ?>
</div>
<div class="clearfix"></div>
<section id="cDark">
<br><table class="table table-bordered table-hover" id="tbOnsell">
	<thead id="pa1">
		<th>Código</th>
		<th>Nombre</th>
		<th>Unidad</th>
		<th>Disponible</th>
		<th></th>
    </thead>

            <?php foreach($curr_products as $product):
	$q=Operation2Data::getQYesF($product->id);
	?>

	<tr class="<?php if($q<=$product->inventary_min /2){ echo "danger";}else if($q<=$product->inventary_min){ echo "warning";}?>">
		<td style="width:100px;"><?php echo $product->code; ?></td>
		<td><?php echo $product->name; ?></td>
		<td><?php echo $product->unit; ?></td>
		<td>
            <table>

                <td>
                    <?php
                    $q=Operation2Data::getQYesF($product->id);

                    ?>
<?php
                    //echo $product->name;
?>
                </td>
            </table>
            </section>
            <?php echo $q; ?>


		</td>
		<td style="width:93px;">
<!--		<a href="index.php?view=input&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-circle-arrow-up"></i> Alta</a> -->
		<a href="index.php?view=history&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-time"></i> Historial</a>
		</td>
	</tr>
	<?php endforeach;?>
<!--
        <?php
        if($q<=1){
            //  echo"algun producto esta agotado";

            //     $insertar=Notification::add($product->name,$q);
            //$actualizar=Notification::updateOut($product->name);
            //        }else{
            //          echo" no se pudo completar la acción";

            $notficationType="1";
            $status="0";
            $changeStatus = Notification::changeStatusDisable($notficationType,$status);


            echo "agotados";
        }else if($q>="1"){
            // echo"no se ppudo";
            //echo $id;
            $notficationType = 1;
            $status = 1;
            $changeStatus = Notification::changeStatusEnable($notficationType, $status);
            echo "no agotados";

        }else{ echo "no se pudo";}

        ?>-->

</table>
<div class="btn-group pull-right">
<?php

for($i=0;$i<$npaginas;$i++){
	echo "<a href='index.php?view=inventary&limit=$limit&page=".($i+1)."' class='btn btn-default btn-sm'>".($i+1)."</a> ";
}
?>
</div>

<form class="form-inline">
	<label for="limit">Limite</label>
	<input type="hidden" name="view" value="inventary">
	<input type="number" value=<?php echo $limit?> name="limit" style="width:60px;" class="form-control">
</form>

<div class="clearfix"></div>

	<?php
}else{
	?>
	<div class="jumbotron">
		<h2>No hay productos</h2>
		<p>No se han agregado productos a la base de datos, puedes agregar uno dando click en el boton <b>"Agregar Producto"</b>.</p>
	</div>
	<?php
}

?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>