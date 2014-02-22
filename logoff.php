<?
session_name('system_cms');
session_start();
include('includes/conecta_bd.php');
$data = date('Y-m-d H:i:s');
$query_ult= mysql_query("UPDATE cms_usuarios SET ultimo_acesso = '$data' WHERE id_usuario = {$row['id_usuario']}");

$_SESSION = array();

if (isset($_COOKIE[session_name('system_cms')])) {
    setcookie(session_name('system_cms'), '', time()-42000, '/');
}


session_destroy();
header("Location:index.php");
?>
