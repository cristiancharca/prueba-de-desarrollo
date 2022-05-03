<?php error_reporting (0);?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
<script>
    function printPantalla()
{
   document.getElementById('cuerpoPagina').style.marginRight  = "0";
   document.getElementById('cuerpoPagina').style.marginTop = "1";
   document.getElementById('cuerpoPagina').style.marginLeft = "1";
   document.getElementById('cuerpoPagina').style.marginBottom = "0"; 
   document.getElementById('botonPrint').style.display = "none"; 
   window.print();
}
</script>
</head>
<body id="cuerpoPagina">
<?php
require_once "../model/Pedido.php";

$objPedido = new Pedido();
$query_cli = $objPedido->GetVenta($_GET["id"]);
$reg_cli = $query_cli->fetch_object();

date_default_timezone_set('America/Lima');

require_once "../model/Configuracion.php";
$objConfiguracion = new Configuracion();
$query_global = $objConfiguracion->Listar();
$reg_igv = $query_global->fetch_object();

?>


<div class="zona_impresion">
        <!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        .::<strong> <?php echo $reg_cli->razon_social; ?></strong>::.<br>
        <?php echo "El Alto - La Paz" ?><br>
        <?php echo "Telefono 7770177" ?> 
        </td>
    </tr>
    <tr>
        <td align="center"><?php echo "Fecha/Hora: ".date("Y-m-d H:i:s"); ?></td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
        <td>Cliente: <?php echo $reg_cli->nombre; ?></td>
    </tr>
    <tr>
        <td>Placa: <?php echo $reg_cli->num_documento; ?></td>
    </tr>
    <tr>
        <td>Nº de Ticket: <?php echo $reg_cli->serie_comprobante." - ".$reg_cli->num_comprobante ; ?></td>
    </tr>    
</table>
<br>
<table border="0" align="center" width="300px">
    <tr>
        
        <td>DESCRIPCIÓN</td>
        <td align="right">IMPORTE POR HORA</td>
    </tr>
    <tr>
      <td colspan="3">==========================================</td>
    </tr>
    <?php
    $query_ped = $objPedido->ImprimirDetallePedido($_GET["id"]);

        while ($reg = $query_ped->fetch_object()) {
        echo "<tr>";
        echo "<td>".$reg->articulo."</td>";
        echo "<td align='right'>". $reg_igv->simbolo_moneda." ".$reg->precio_venta."</td>";
        echo "</tr>";
        $cantidad+=$reg->cantidad;
    }
    $query_total = $objPedido->TotalPedido($_GET["id"]);

    $reg_total = $query_total->fetch_object();
    ?>

    
    
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>      
    <tr>
      <td colspan="3" align="center">¡Gracias por su preferencia!</td>
    </tr>
    <tr>
      <td colspan="3" align="center">6 DE MARZO</td>
    </tr>
    <tr>
      <td colspan="3" align="center">LA PAZ-BOLIVIA</td>
    </tr>
    
</table>
<br>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>
  
<div style="margin-left:245px;"><a href="#" id="botonPrint" onClick="printPantalla();"><img src="../img/printer.png" border="0" style="cursor:pointer" title="Imprimir"></a></div>
</body>
</html>