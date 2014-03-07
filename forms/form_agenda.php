<?
if($_GET['titulo'] == "Editar"){

   $query = mysql_query("SELECT * FROM agenda WHERE id_evento = {$_GET['id_evento']}");
   
   $dt_evento = mysql_result($query, 0, "dt_evento");
   $cidade = mysql_result($query, 0, "cidade_evento");
   $local = mysql_result($query, 0, "local_evento");
   
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
	$local = str_replace($cod_html, "", addslashes($_POST['local_evento']));
	$cidade = str_replace($cod_html, "", addslashes($_POST['cidade_evento']));
	
	$query = "INSERT INTO agenda (
                     dia_evento,
					 mes_evento,
					 local_evento,
					 cidade_evento,
					 horario_evento
             )VALUES(
					 '{$_POST['dia_evento']}',
					 '{$_POST['mes_evento']}',
					 '{$local}',
					 '{$cidade}',
					 '{$_POST['horario_evento']}'
					 )";
if(!mysql_query($query,$conexao)){
echo "Não foi possível cadastrar o evento desejado.";
echo mysql_error();
}else{
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
           <font color="red">*</font><label>Dia do evento:</label><br />
			<select name="dia_evento" class="cmscampos">
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
		   </select>
        </td>
    </tr>
	
	<tr>
        <td>
           <font color="red">*</font><label>Mês do evento:</label><br />
			   <select name="mes_evento" class="cmscampos">
					<option value="JANEIRO">JANEIRO</option>
					<option value="FEVEREIRO">FEVEREIRO</option>
					<option value="MARÇO">MARÇO</option>
					<option value="ABRIL">ABRIL</option>
					<option value="MAIO">MAIO</option>
					<option value="JUNHO">JUNHO</option>
					<option value="JULHO">JULHO</option>
					<option value="AGOSTO">AGOSTO</option>
					<option value="SETEMBRO">SETEMBRO</option>
					<option value="OUTUBRO">OUTUBRO</option>
					<option value="NOVEMBRO">NOVEMBRO</option>
					<option value="DEZEMBRO">DEZEMBRO</option>
			   </select>
        </td>
    </tr>
	
	<tr>
        <td>
           <font color="red">*</font><label>Local:</label><br />
           <input type="text" name="local_evento" id="local" value="<?echo $local?>" class="cmscampos">
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
           <font color="red">*</font><label>Horário:</label><br />
           <input type="text" name="horario_evento" id="horario" value="<?echo $cidade?>" class="cmscampos">
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