<?
if(isset($_POST['action']) == "Cadastrar"){

$error = $_FILES['presskit']['error'];

if ($error != UPLOAD_ERR_OK){
switch ($error) { 
            case UPLOAD_ERR_INI_SIZE: 
                $message = "O arquivo é maior que o tamanho permitido.";
                break; 
            case UPLOAD_ERR_FORM_SIZE: 
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
                break; 
            case UPLOAD_ERR_PARTIAL: 
                $message = "The uploaded file was only partially uploaded"; 
                break; 
            case UPLOAD_ERR_NO_FILE: 
                $message = "Nenhum arquivo foi selecionado."; 
                break; 
            case UPLOAD_ERR_NO_TMP_DIR: 
                $message = "Missing a temporary folder"; 
                break; 
            case UPLOAD_ERR_CANT_WRITE: 
                $message = "Failed to write file to disk"; 
                break; 
            case UPLOAD_ERR_EXTENSION: 
                $message = "File upload stopped by extension"; 
                break; 

            default: 
                $message = "Unknown upload error"; 
                break; 
        } 
?>
<div id="cmsalerta"><img src="img/error.png" class="img-error" /><?echo $message;?></div>
<input type="button" class="cmsbutton" value="Voltar" onClick="window.history.back();">
<?exit;
}
$query = "INSERT INTO presskit (
					 presskit_arquivo
             )VALUES(
					 '_{$_FILES['presskit']['name']}'
                     )
";
if(!mysql_query($query,$conexao)){
echo "Não foi possível cadastrar o presskit desejado.";
echo mysql_error();
}else{
$id_presskit = mysql_insert_id();
$uploaddir = "../presskit/"; 
$uploadfile = $uploaddir .  $id_presskit ."_". basename($_FILES['presskit']['name']); 
//copy($_FILES['presskit']['tmp_name'], $uploadfile); ou move_uploaded_file...
$subido = move_uploaded_file($_FILES['presskit']['tmp_name'], $uploadfile); 

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
			<input type="submit" class="cmsbutton" value="<?echo $_GET['titulo'];?>">
			
			<input type="button" class="cmsbutton" value="Voltar" onClick="window.history.back();">
		</td>
	</tr>
	</tfoot>
</table>
</form>



<div id="cmsorienta">
	<font color="red">*</font> Campos Obrigatórios
</div>

</div>