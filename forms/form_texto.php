<?
if(isset($_GET['titulo']) == "Editar"){

   $query = mysql_query("SELECT * FROM txt_site WHERE id_texto = {$_GET['id_texto']}");
   
   $area = mysql_result($query, 0, "area_site");
   $texto = mysql_result($query, 0, "texto");
   
}

if($_POST['action'] == "Editar"){

$cod_html = array("<div>","</div>","&lt;/div&gt;", "&lt;div&gt;");

//Campos com textos
	$texto = str_replace($cod_html, "", addslashes($_POST['texto_site']));

   $query= "UPDATE txt_site
        SET texto = '{$texto}'	    
		WHERE id_texto = {$_POST['id_texto']}";

if(!mysql_query($query,$conexao)){
echo "Não foi possível editar o texto desejado.";
echo mysql_error();
}else{		
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Texto atualizado com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=contato';">
</div>

<?
exit;
}
}

?>

<div id="cmstitulo">
     <?echo $_GET['titulo'];?> Texto
</div>

<div id="cmsformpainel">

<form name="frm" id="frm" action="index.php?pagina=forms/form_texto" enctype="multipart/form-data" method="POST">
<table id="cmstbl" cellspacing="0" cellpadding="10">
    <tbody>		
	<tr>
        <td colspan="3">
		
           <font color="red">*</font><label>Texto:</label><br />		   
           <textarea name="texto_site" id="texto_site" class="cmscampos" rows="10" cols="100"><?echo $texto;?></textarea> 
		   
        </td>
    </tr>
	</tbody>
	
	<tfoot>
	<tr class="cmstbl-tr-last">
		<td colspan="5">
			<input type="hidden" name="id_texto" id="id_texto" value="<?echo $_GET['id_texto'];?>">
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