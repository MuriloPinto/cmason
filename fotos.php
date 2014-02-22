<?
if(isset($_GET['action']) == "delete"){
$foto = $_GET['id_foto'];
 $query = "SELECT * FROM fotos WHERE id_foto = {$foto}";
    $result = mysql_query($query);

    // percorre e apaga arquivos da pasta
    while ($row = mysql_fetch_assoc($result))
    {
			$nm_arquivo = "../fotos/" . $row['nome_arquivo'];
			unlink($nm_arquivo);
			
			$nm_arquivo = "../fotos/thumbs/" . $row['nome_arquivo'];
			unlink($nm_arquivo);
		
    }
	$query = mysql_query("DELETE FROM fotos WHERE id_foto = {$foto}");
	
	
	if(!mysql_query($query,$conexao)){

}else{
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Foto excluída com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=fotos';">
</div>
<?
exit;
}
}
?>

<div id="cmstitulo">
	Fotos
</div>

<div id="cmslinhabot">
	<a class="cmslink" href="index.php?pagina=forms/form_foto&amp;titulo=Cadastrar"><img src="img/add.png" border="0" alt="Novo" title="Novo" style="vertical-align: bottom;"> Cadastrar nova foto</a>
</div>

<table id="cmstbl" class="fotos-home" cellspacing="0" cellpadding="10">
	<thead>
		<tr>
			<th width="50">FOTO</th>
			<th>DESCRIÇÃO</th>
			<th width="50"></th>
		</tr>
	<thead>
<tbody class="content">
<?

$query_portfolio = mysql_query("SELECT * FROM fotos ORDER BY nr_ordem ASC");


		while($dados_portfolio = mysql_fetch_array($query_portfolio)) {
?>

<tr id="page_<?echo $dados_portfolio['id_foto'];?>">
	<td><img src="../fotos/thumbs/<?echo $dados_portfolio['nome_arquivo'];?>" width="50" height="50"/></td>
	<td><?echo $dados_portfolio['descricao_arquivo'];?></td>
	
	<td align="center"><!--<a href="index.php?pagina=forms/form_foto&titulo=Editar&id_foto=<?echo $dados_portfolio['id_foto'];?>"><img src="img/page_white_edit.png" border="0" alt="Excluir" title="Editar"></a>-->
	
	<a onclick="confirmAcao('Você realmente deseja excluir a foto selecionada?','index.php?pagina=fotos&action=delete&id_foto=<?echo $dados_portfolio['id_foto'];?>');"><img src="img/delete.png" border="0" alt="Excluir" title="Excluir"></a>
	</td>
</tr>
<?}?>
</tbody>
</table>