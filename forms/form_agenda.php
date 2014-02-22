<?
if($_GET['titulo'] == "Editar"){

   $query = mysql_query("SELECT * FROM agenda WHERE id_evento = {$_GET['id_evento']}");
   
   $dt_evento = mysql_result($query, 0, "dt_evento");
   $cidade = mysql_result($query, 0, "cidade_evento");
   $titulo = mysql_result($query, 0, "titulo_evento");
   $local = mysql_result($query, 0, "local_evento");
   $banner = mysql_result($query, 0, "imagem_evento");
}

if($_POST['action'] == "Editar"){

$cod_html = array("<div>","</div>","&lt;/div&gt;", "&lt;div&gt;");

//Campos com textos
	$dt_evento = str_replace($cod_html, "", addslashes($_POST['dt_evento']));
	$cidade = str_replace($cod_html, "", addslashes($_POST['cidade_evento']));
	$titulo = str_replace($cod_html, "", addslashes($_POST['titulo']));
	$local = str_replace($cod_html, "", addslashes($_POST['local']));

   $query= "UPDATE agenda
        SET dt_evento = '{$dt_evento}',
			cidade_evento = '{$cidade}',
			titulo_evento = '{$titulo}',
			local_evento = '{$local}'		    
		WHERE id_evento = {$_POST['id_evento']}";

if(!mysql_query($query,$conexao)){
echo "Não foi possível editar o evento desejado.";
echo mysql_error();
}else{		
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Evento atualizado com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=agenda';">
</div>

<?
exit;
}
}

if($_POST['action'] == "Cadastrar"){

	$cod_html = array("<div>","</div>","&lt;/div&gt;", "&lt;div&gt;");

	//Campos com textos
	$dt_evento = str_replace($cod_html, "", addslashes($_POST['dt_evento']));
	$cidade = str_replace($cod_html, "", addslashes($_POST['cidade_evento']));
	$titulo = str_replace($cod_html, "", addslashes($_POST['titulo']));
	$local = str_replace($cod_html, "", addslashes($_POST['local']));
	
	
	$query = "INSERT INTO agenda (
                     dt_evento,
					 cidade_evento,
					 titulo_evento,
					 local_evento,
					 imagem_evento
             )VALUES(
					 '$dt_evento',
					 '$cidade',
					 '$titulo',
					 '$local',
					 '{$_FILES['logo']['name']}'
                     )";
if(!mysql_query($query,$conexao)){
echo "Não foi possível cadastrar o evento desejado.";
echo mysql_error();
}else{
$id_evento = mysql_insert_id();

$uploaddir = "../agenda/banners/"; 
$uploadfile = $uploaddir . $id_evento ."_". basename($_FILES['logo']['name']); 
$error = $_FILES['logo']['error']; 
$subido = false; 
if($error==UPLOAD_ERR_OK) { $subido = copy($_FILES['logo']['tmp_name'], $uploadfile); } 
//if($subido) { echo "El archivo subio con exito"; } else { echo "Se ha producido un error: ".$error; }
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Evento cadastrado com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=agenda';">
</div>
<?
exit;

}
}
?>

<div id="cmstitulo">
     <?echo $_GET['titulo'];?> Evento
</div>

<div id="cmsformpainel">

<form name="frm" id="frm" action="index.php?pagina=forms/form_agenda" enctype="multipart/form-data" method="POST">
<table id="cmstbl" cellspacing="0" cellpadding="10">
    <tbody>
	<tr>
        <td>
           <font color="red">*</font><label>Data do evento:</label><br />
           <input type="text" name="dt_evento" id="dt_evento" value="<?echo $dt_evento?>" class="cmscampos">
        </td>
    </tr>
	
	<tr>
        <td>
           <font color="red">*</font><label>Cidade/UF do evento:</label><br />
           <input type="text" name="cidade_evento" id="cidade_evento" value="<?echo $cidade?>" class="cmscampos">
        </td>
    </tr>
	
	<tr>
        <td>
           <font color="red">*</font><label>Titulo:</label><br />
           <input type="text" name="titulo" id="titulo" value="<?echo $titulo?>" class="cmscampos">
        </td>
    </tr>
	
	<tr>
        <td>
           <font color="red">*</font><label>Local:</label><br />
           <input type="text" name="local" id="local" value="<?echo $local?>" class="cmscampos">
        </td>
    </tr>
	
	<tr>
        <td colspan="3">
           <font color="red">*</font><label>Foto:</label><br />
		   <?
			if($_GET['titulo'] == "Editar"){
			?>
			<iframe id="frame_imgs" src="forms/imagem_evento.php?id_evento=<?echo $_GET['id_evento'];?>" frameborder="0" width="100%" height="350px" style="margin-top: 5px;"></iframe>
			<?}else{?>
           <input type="file" name="logo" id="logo" class="cmscampos" accept="image/*"> <img id="dica_foto_bio" src="img/information.png" title="Somente imagens .jpg e .png, com altura de 82px e largura 84px." style="vertical-align: middle;">
		   <?}?>
        </td>
    </tr>
	
	</tbody>
	
	<tfoot>
	<tr class="cmstbl-tr-last">
		<td colspan="5">
			<input type="hidden" name="id_evento" id="id_evento" value="<?echo $_GET['id_evento'];?>">
			<input type="hidden" name="action" id="action" value="<?echo $_GET['titulo'];?>">
			<input type="button" class="cmsbutton" value="Voltar" onClick="window.history.back();">
			<input type="submit" class="cmsbutton" value="<?echo $_GET['titulo'];?>">
		</td>
	</tr>
	</tfoot>
</table>
</form>

<div id="cmsorienta">
	<font color="red">*</font> Campos Obrigatórios
</div>

</div>