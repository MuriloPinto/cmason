<?include('../includes/conecta_bd.php');

session_name('system_cms');

session_start();

 //testa se o usuÃ¡rio validou o login

 if(!isset($_SESSION['nome'])){

 //header("Location:index.php");

 //exit();

 }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" href="../css/cms_style.css" type="text/css"/>
	<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
	<meta name="robots" content="noindex, nofollow">
</head>
<body>
<div id="cmstitulo">
     <?echo $_SESSION['i_btn_minha_conta'];?>
</div>

<div id="cmsformpainel">

<form name="frm" id="frm" action="index.php?pagina=forms/form_foto" enctype="multipart/form-data" method="POST">
<table id="cmstbl" cellspacing="0" cellpadding="10">
    <tbody>
	
	<tr>
        <td colspan="3">
           <font color="red">*</font><label>Foto:</label><br />
		  <table id="myTable_foto" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><input type="file" id="foto" name="foto[]"  style="width:310px;" accept="image/*" class="campo_form" multiple /></td>
                        <td>&nbsp;Legenda: <input name="legenda_inc[]" type="text" class="campo_form" /> <input type="hidden" name="tipo_arquivo[]" value="foto"/></td>
                        <td>&nbsp;<img src="img/add.png" onClick="insRow_foto();" /></td>
                    </tr>
                </table>
        </td>
    </tr>
	
	</tbody>
	
	<tfoot>
	<tr class="cmstbl-tr-last">
		<td colspan="5">
			<input type="hidden" name="action" id="action" value="<?echo $_GET['titulo'];?>">
			<input type="button" class="cmsbutton" value="Voltar" onClick="window.history.back();">
			<!--<input type="button" class="cmsbutton" value="<?echo $_GET['acao'];?>" onClick="enviaCliente();">-->
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
</body>
</html>