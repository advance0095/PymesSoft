	<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Punto de venta</title>

    <!-- Bootstrap core CSS -->
 <link  href="estilo.css" rel="stylesheet"/>
    <link href="res/bootstrap3/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
      <!--<link href="res/select2/select2.css" rel="stylesheet"> -->
      <!-- <link href="res/select2/select2-bootstrap.css" rel="stylesheet">-->
     
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <script src="js/jquery-1.10.2.js"></script>

<?php if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='res/fullcalendar.min.css' rel='stylesheet' />
<link href='res/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='res/js/moment.min.js'></script>
<script src='res/fullcalendar.min.js'></script>
<?php endif; ?>
<script src='res/select2/select2.min.js'></script>




  </head>

  <body>


    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" >
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./?view=monitor">Punto de venta <sup><small></small></sup> </a>


                 </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">






<?php
$u=null;
if(Session::getUID()!=""):
  $u = UserData::getById(Session::getUID());
?>

<section id="format">

     <ul class="nav navbar-nav" id="navbar-left">
          </ul>
          <ul class="nav navbar-nav side-nav" id="formato">
              <li><a></a></li>
          <li class="mfont" ><a href="./?view=home"  id="fontwhite"><i class="fa fa-home"></i> Inicio</a></li>
          <li><a href="./?view=monitor"><i class="fa fa-eye"></i> Monitor</a></li>
          <li><a href="index.php?view=sell"><i class="fa fa-usd"></i> Vender</a></li>
          <li><a href="index.php?view=sells"><i class="fa fa-shopping-cart"></i> Ventas</a></li>
<!--          <li><a href="index.php?view=resume"><i class="fa fa-star"></i> Resumen</a></li>
          <li><a href="index.php?view=spents"><i class="fa fa-download"></i> Gastos</a></li>
-->
          <?php if($u->is_admin):?>
          <li><a href="index.php?view=products"><i class="fa fa-glass"></i> Platillos</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Inventario <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li ><a href="index.php?view=ingredients"><i class="fa fa-circle"></i> Ingredientes</a></li>
                <li><a href="index.php?view=re"><i class="fa fa-refresh"></i> Abastecer</a></li>
                <li><a href="index.php?view=inventary"><i class="fa fa-area-chart"></i> Inventario</a></li>
              </ul>
            </li>



          <li><a href="index.php?view=categories"><i class="fa fa-th-list"></i> Categorias</a></li>

          <li><a href="index.php?view=reports"><i class="fa fa-area-chart"></i> Reportes</a></li>
          <li><a href="index.php?view=users"><i class="fa fa-users"></i> Usuarios </a></li>
        <?php endif;?>
          </ul>
</section>



            <?php endif; ?>


<?php if(Session::getUID()!=""):?>
<?php
$u=null;
if(Session::getUID()!=""){
  $u = UserData::getById(Session::getUID());
  $user = $u->name." ".$u->lastname;

  }?>



                    <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">


        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="btnconf">


        <?php echo $user; ?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="index.php?view=configuration">Configuracion</a></li>
          <li><a href="logout.php">Salir</a></li>
        </ul>



            </li>

                    </ul>


<?php else:?>

<?php endif; ?>



        </div><!-- /.navbar-collapse -->
      </nav>


      <div id="page-wrapper">




<?php
  // puedo cargar otras funciones iniciales
  // dentro de la funcion donde cargo la vista actual
  // como por ejemplo cargar el corte actual
  View::load("login");

?>



      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->

<script src="res/bootstrap3/js/bootstrap.min.js"></script>
<script>
</script>



    <div class="notificaciones" id="wrapper">


        <?php $products = IngredientData::getAll();
        ?>



        <ul class="nav navbar-nav"  >
            <li class="dropdown user-dropdown" >
                <?php

                if(Session::getUID()!=""){
                    echo' <a href="" class="glyphicon glyphicon-bell" data-toggle="dropdown" id="btnAlert"></a>';}
                  ?>
                <?php
                global $contador;
                foreach($products as $product):
                    $contador++;

                $q =Operation2Data::getQYesF($product->id);



                    ?>

                <?php endforeach;   ?>

                <ul class="dropdown-menu">
                    <?php


                    foreach($products as $product):
                        $q =Operation2Data::getQYesF($id=$product->id);




                        if($q==0 || $q<=0){


                        $produ="<li><a href='index.php?view=re&product='>$product->name</a></li>";


echo $produ;




                        }

                        ?>
                    <?php endforeach;
                    ?>



                </ul>



            </li>


        </ul>


    </div>

  </body>
</html>

