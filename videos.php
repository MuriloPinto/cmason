<?
if(isset($_GET['action']) == "delete"){
$video = $_GET['id_video'];
	$query = mysql_query("DELETE FROM videos WHERE id_video = {$video}");
	
	
	if(!mysql_query($query,$conexao)){

}else{
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Vídeo excluído com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=videos';">
</div>
<?
exit;
}
}
?>

<div id="cmstitulo">
	Vídeos
</div>

<div id="cmslinhabot">
	<a class="cmslink" href="index.php?pagina=forms/form_video&amp;titulo=Cadastrar"><img src="img/add.png" border="0" alt="Novo" title="Novo" style="vertical-align: bottom;"> Cadastrar novo vídeo</a>
</div>

<table id="cmstbl" class="fotos-home" cellspacing="0" cellpadding="10">
	<thead>
		<tr>
			<th width="50">Vídeo</th>
			<th>Titulo</th>
			<th width="50"></th>
		</tr>
	<thead>
<tbody class="content">
<?

$query_portfolio = mysql_query("SELECT * FROM videos ORDER BY id_video DESC");


		while($dados_portfolio = mysql_fetch_array($query_portfolio)) {
?>

<tr id="page_<?echo $dados_portfolio['id_video'];?>">
	<td><img src="<?echo $dados_portfolio['img_video'];?>" height="100"/></td>
	<td><?echo $dados_portfolio['titulo_video'];?></td>
	
	<td align="center">
		<a href="index.php?pagina=forms/form_video&titulo=Editar&id_video=<?echo $dados_portfolio['id_video'];?>"><img src="img/page_white_edit.png" border="0" alt="Editar" title="Editar"></a>
		<a onclick="confirmAcao('Você realmente deseja excluir o vídeo selecionado?','index.php?pagina=videos&action=delete&id_video=<?echo $dados_portfolio['id_video'];?>');"><img src="img/delete.png" border="0" alt="Excluir" title="Excluir"></a>
	</td>
</tr>
<?}?>
</tbody>
</table>