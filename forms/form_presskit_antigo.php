<?
if(isset($_POST['action']) == "Cadastrar"){

$query = "INSERT INTO presskit (
					 presskit_arquivo
             )VALUES(
					 '{$_FILES['presskit']['name']}'
                     )
";
if(!mysql_query($query,$conexao)){
echo "Não foi possível cadastrar o presskit desejado.";
echo mysql_error();
}else{
$id_presskit = mysql_insert_id();
$uploaddir = "../presskit/"; 
$uploadfile = $uploaddir .  basename($_FILES['presskit']['name']); echo $uploadfile;
$error = $_FILES['presskit']['error']; //copy($_FILES['presskit']['tmp_name'], $uploadfile);
$subido = false; 
if($error==UPLOAD_ERR_OK) { $subido = copy($_FILES['presskit']['tmp_name'], $uploadfile);} 
//if($subido) { echo "El archivo subio con exito"; } else { echo "Se ha producido un error: ".$error; }
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Presskit cadastrado com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=presskit';">
</div>
<?
exit;
/*echo "
<script>
alert('Cliente cadastrado com sucesso!');
location.href='index.php?pagina=cliente';
</script>
";*/
}
}
?>

<div id="cmstitulo">
     <?echo $_GET['titulo'];?> Presskit
</div>

<div id="cmsformpainel">

<form name="frm" id="frm" action="index.php?pagina=forms/form_presskit" enctype="multipart/form-data" method="POST">
<table id="cmstbl" cellspacing="0" cellpadding="10">
    <tbody>		
	<tr>
        <td colspan="3">
		
           <font color="red">*</font><label>Arquivo:</label><br />		   
           <input type="file" name="presskit" id="presskit" class="cmscampos"> 
		   
        </td>
    </tr>
	</tbody>
	
	<tfoot>
	<tr class="cmstbl-tr-last">
		<td colspan="5">
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