<?php
include('../includes/conecta_bd.php');
if($_GET['acao'] == "alterar_foto"){
 $query = "select * from agenda
                 WHERE id_evento = {$_GET['id_evento']}";
    $result = mysql_query($query);

    // percorre e apaga arquivos da pasta
    while ($row = mysql_fetch_assoc($result))
    {
        $nm_arquivo = "../../agenda/banners/" . $row['id_evento'] ."_". $row['imagem_evento'];
        unlink($nm_arquivo);
    }

mysql_query("UPDATE agenda SET imagem_evento = '{$_FILES['fotocob']['name']}' WHERE id_evento = {$_GET['id_evento']}");
	
$uploaddir = "../../agenda/banners/"; 
$uploadfile = $uploaddir . $_GET['id_evento']."_". basename($_FILES['fotocob']['name']); 
$error = $_FILES['fotocob']['error']; 
$subido = false; 
if($error==UPLOAD_ERR_OK) { $subido = copy($_FILES['fotocob']['tmp_name'], $uploadfile); } 

}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/cms_style.css" type="text/css"/>
</head>
<body style="margin: 0; background-color: #F0F0F0;">


<form id="frm" action="imagem_evento.php?acao=alterar_foto&id_evento=<?echo $_GET['id_evento'];?>" enctype="multipart/form-data" method="POST">
<?$query_img = mysql_query("SELECT * FROM agenda WHERE id_evento = {$_GET[id_evento]}");

while($img_pacote = mysql_fetch_array($query_img)) {

?>
<img src="../../agenda/banners/<?echo $_GET['id_evento']."_".$img_pacote['imagem_evento'];?>" width="1024px" height="257px" style="float: left; margin-right: 10px;">

<?}?>
<br />
<input type="file" name="fotocob" id="fotocob" class="cmscampos" accept="image/*">

	<div style="margin-top: 10px;">
	<input type="submit" class="cmsbutton" value="Visualizar"> <img id="dica_foto_bio" src="../img/information.png" title="Somente imagens .jpg e .png, com altura de 82px e largura 84px." style="vertical-align: middle;">
	</div>
</form>

</body>
</html>