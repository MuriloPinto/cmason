<?
if($_GET['action'] == "delete"){
$evento = $_GET['id_evento'];
 $query = "SELECT * FROM agenda
                 WHERE id_evento = {$evento}";
    $result = mysql_query($query);

    // percorre e apaga arquivos da pasta
    while ($row = mysql_fetch_assoc($result))
    {
			$nm_arquivo = "../agenda/banners/" . $row['id_evento']."_".$row['imagem_evento'];
			unlink($nm_arquivo);
		
    }
	$query2 = mysql_query("DELETE FROM agenda WHERE id_evento = {$evento}");
	
	if(!mysql_query($query2,$conexao)){


}else{
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Evento exclu�do com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=agenda';">
</div>
<?
exit;
}
}
?>

<div id="cmstitulo">
	Agenda
</div>

<div id="cmslinhabot">
	<a class="cmslink" href="index.php?pagina=forms/form_agenda&amp;titulo=Cadastrar"><img src="img/add.png" border="0" alt="Novo" title="Novo" style="vertical-align: bottom;"> Cadastrar novo evento na agenda</a>
</div>

<table id="cmstbl" cellspacing="0" cellpadding="10">
	<thead>
		<tr>
			<th width="100px">DATA</th>
			<th>CIDADE</th>
			<th>EVENTO</th>
			<th>LOCAL</th>
			<th>IMAGEM</th>
			<th width="50"></th>
		</tr>
	<thead>

<?

$query_portfolio = mysql_query("SELECT * FROM agenda ORDER BY dt_evento");

		while($dados_portfolio = mysql_fetch_array($query_portfolio)) {
?>

<tr>
	<!--<td><? $date_s = strtotime($dados_users['dt_evento']);
echo $date = date("d/m/Y", $date_s);?></td>-->
	<td><?echo $dados_portfolio['dt_evento'];?></td>
	<td><?echo $dados_portfolio['cidade_evento'];?></td>
	<td><?echo $dados_portfolio['titulo_evento'];?></td>
	<td><?echo $dados_portfolio['local_evento'];?></td>
	<td><img src="../agenda/banners/<?echo $dados_portfolio['id_evento'] . "_" . $dados_portfolio['imagem_evento'];?>" width="200" height="50"/></td>	
	<td align="center">
	<a href="index.php?pagina=forms/form_agenda&titulo=Editar&id_evento=<?echo $dados_portfolio['id_evento'];?>"><img src="img/page_white_edit.png" border="0" alt="Excluir" title="Editar"></a>
	
	<a onclick="confirmAcao('Voc� realmente deseja excluir o evento: <b><?echo $dados_portfolio['titulo_evento'];?></b>?','index.php?pagina=agenda&action=delete&id_evento=<?echo $dados_portfolio['id_evento'];?>');"><img src="img/delete.png" border="0" alt="Excluir" title="Excluir"></a>
	</td>
</tr>
<?}?>
</table>