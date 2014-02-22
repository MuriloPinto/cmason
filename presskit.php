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
	Presskit
</div>

<div id="cmslinhabot">
	<a class="cmslink" href="index.php?pagina=forms/form_presskit&amp;titulo=Cadastrar"><img src="img/add.png" border="0" alt="Novo" title="Novo" style="vertical-align: bottom;"> Cadastrar novo presskit</a>
</div>

<table id="cmstbl" cellspacing="0" cellpadding="10">
	<thead>
		<tr>
			<th>PRESSKIT</th>
			<th width="50"></th>
		</tr>
	<thead>

<?

$query_presskit = mysql_query("SELECT * FROM presskit order by id_presskit desc limit 1");


		while($dados_presskit = mysql_fetch_array($query_presskit)) {
?>



<tr>
	
	<td><?echo $dados_presskit['id_presskit'] . $dados_presskit['presskit_arquivo'];?></td>
	
<td align="center"><a href="index.php?pagina=forms/form_presskit&titulo=Editar&id_projeto=<?echo $dados_presskit['id_presskit'];?>"></a>
	
	<a onclick="confirmAcao('Você realmente deseja excluir o presskit <b><?echo $dados_presskit['presskit_arquivo'];?></b>? <br /><br/> Excluíndo este presskit do sistema todos os arquivos relacionados a ele serão apagados definitivamente do sistema.','index.php?pagina=presskit&action=delete&id_presskit=<?echo $dados_presskit['id_presskit'];?>');"><img src="img/delete.png" border="0" alt="Excluir" title="Excluir"></a>
	</td>
</tr>
<?}?>
</table>