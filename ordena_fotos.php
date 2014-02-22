<?
include('includes/conecta_bd.php');
parse_str($_GET['pages'], $pageOrder);
foreach ($pageOrder['page'] as $key => $value) {
    mysql_query("UPDATE fotos SET nr_ordem = $key WHERE id_foto = $value") or die(mysql_error());
}?>