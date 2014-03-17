<?
if(isset($_GET['action']) == "delete"){
$arquivo = $_GET['id_presskit'];
 $query = "SELECT * FROM presskit
                 WHERE id_presskit = {$arquivo} " ;
    $result = mysql_query($query);

    // percorre e apaga arquivos da pasta
    while ($row = mysql_fetch_assoc($result))
    {
			$nm_arquivo = "../presskit/" .$row['presskit_arquivo'];
			unlink($nm_arquivo);
		
    }
	$query = mysql_query("DELETE FROM presskit WHERE id_presskit = {$arquivo}");
	
	if(!mysql_query($query,$conexao)){

}else{
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Presskit excluído com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=presskit';">
</div>
<?
exit;
}
}
?>

<div id="cmstitulo">
	Contato
</div>



<table id="cmstbl" cellspacing="0" cellpadding="10">
	<thead>
		<tr>			<th width="100">Area</th>
			<th>Texto</th>
			<th width="50"></th>
		</tr>
	<thead>

<?

$query_presskit = mysql_query("SELECT * FROM txt_site ORDER BY id_texto DESC limit 1");


		while($dados_presskit = mysql_fetch_array($query_presskit)) {
?>



<tr>
	<td><?echo $dados_presskit['area_site'];?></td>
	<td><?echo nl2br($dados_presskit['texto']);?></td>
	
	<td align="center">	
		<a href="index.php?pagina=forms/form_texto&titulo=Editar&id_texto=<?echo $dados_presskit['id_texto'];?>"><img src="img/page_white_edit.png" border="0" alt="Editar" title="Editar"></a>		</td>
</tr>
<?}?>
</table>