<?
if(isset($_GET['titulo']) == "Editar"){

   $query = mysql_query("SELECT * FROM agenda WHERE id_evento = {$_GET['id_evento']}");
   
   $dt_evento = mysql_result($query, 0, "data_evento");
   $dia_evento = mysql_result($query, 0, "dia_evento");
   $mes_evento = mysql_result($query, 0, "mes_evento");
   $cidade = mysql_result($query, 0, "cidade_evento");
   $local = mysql_result($query, 0, "local_evento");
   $horario = mysql_result($query, 0, "horario_evento");
   
}

if($_POST['action'] == "Editar"){

$cod_html = array("<div>","</div>","&lt;/div&gt;", "&lt;div&gt;");

//Campos com textos
	$cidade = str_replace($cod_html, "", addslashes($_POST['cidade_evento']));
	$local = str_replace($cod_html, "", addslashes($_POST['local_evento']));

   $query= "UPDATE agenda
        SET data_evento = '{$_POST['dt_evento']}',
		    dia_evento = '{$_POST['dia_evento']}',
			mes_evento = '{$_POST['mes_evento']}',
			local_evento = '{$local}',
			cidade_evento = '{$cidade}',
			horario_evento =  '{$_POST['horario_evento']}'    
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
	$cidade = str_replace($cod_html, "", addslashes($_POST['cidade_evento']));
	$local = str_replace($cod_html, "", addslashes($_POST['local_evento']));	
	
	$query = "INSERT INTO agenda (
					 data_evento,
                     dia_evento,
					 mes_evento,
					 local_evento,
					 cidade_evento,
					 horario_evento
             )VALUES(
					 '{$_POST['dt_evento']}',
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
			<font color="red">*</font><label>Data do evento:</label><br />
			<input type="varchar" name="dt_evento" class="cmscampos" value="<?echo $dt_evento;?>"> ex: 09/07/2014
		</td>
	</tr>
	<tr>
        <td>
           <font color="red">*</font><label>Dia do evento (exibido no site):</label><br />
			<select name="dia_evento" class="cmscampos">
				<option>Selecione...</option>
				<option value="01" <?if($dia_evento == "01"){echo "selected";}?>>01</option>
				<option value="02" <?if($dia_evento == "02"){echo "selected";}?>>02</option>
				<option value="03" <?if($dia_evento == "03"){echo "selected";}?>>03</option>
				<option value="04" <?if($dia_evento == "04"){echo "selected";}?>>04</option>
				<option value="05" <?if($dia_evento == "05"){echo "selected";}?>>05</option>
				<option value="06" <?if($dia_evento == "06"){echo "selected";}?>>06</option>
				<option value="07" <?if($dia_evento == "07"){echo "selected";}?>>07</option>
				<option value="08" <?if($dia_evento == "08"){echo "selected";}?>>08</option>
				<option value="09" <?if($dia_evento == "09"){echo "selected";}?>>09</option>
				<option value="10" <?if($dia_evento == "10"){echo "selected";}?>>10</option>
				<option value="11" <?if($dia_evento == "11"){echo "selected";}?>>11</option>
				<option value="12" <?if($dia_evento == "12"){echo "selected";}?>>12</option>
				<option value="13 <?if($dia_evento == "13"){echo "selected";}?>">13</option>
				<option value="14" <?if($dia_evento == "14"){echo "selected";}?>>14</option>
				<option value="15" <?if($dia_evento == "15"){echo "selected";}?>>15</option>
				<option value="16" <?if($dia_evento == "16"){echo "selected";}?>>16</option>
				<option value="17 <?if($dia_evento == "17"){echo "selected";}?>">17</option>
				<option value="18" <?if($dia_evento == "18"){echo "selected";}?>>18</option>
				<option value="19" <?if($dia_evento == "19"){echo "selected";}?>>19</option>
				<option value="20" <?if($dia_evento == "20"){echo "selected";}?>>20</option>
				<option value="21" <?if($dia_evento == "21"){echo "selected";}?>>21</option>
				<option value="22" <?if($dia_evento == "22"){echo "selected";}?>>22</option>
				<option value="23" <?if($dia_evento == "23"){echo "selected";}?>>23</option>
				<option value="24" <?if($dia_evento == "24"){echo "selected";}?>>24</option>
				<option value="25" <?if($dia_evento == "25"){echo "selected";}?>>25</option>
				<option value="26" <?if($dia_evento == "26"){echo "selected";}?>>26</option>
				<option value="27" <?if($dia_evento == "27"){echo "selected";}?>>27</option>
				<option value="28" <?if($dia_evento == "28"){echo "selected";}?>>28</option>
				<option value="29" <?if($dia_evento == "29"){echo "selected";}?>>29</option>
				<option value="30" <?if($dia_evento == "30"){echo "selected";}?>>30</option>
				<option value="31" <?if($dia_evento == "31"){echo "selected";}?>>31</option>
		   </select>
        </td>
    </tr>
	
	<tr>
        <td>
           <font color="red">*</font><label>Mês do evento (exibido no site):</label><br />
			   <select name="mes_evento" class="cmscampos">
					<option>Selecione...</option>
					<option value="JANEIRO" <?if($mes_evento == "JANEIRO"){echo "selected";}?>>JANEIRO</option>
					<option value="FEVEREIRO" <?if($mes_evento == "FEVEREIRO"){echo "selected";}?>>FEVEREIRO</option>
					<option value="MARÇO" <?if($mes_evento == "MARÇO"){echo "selected";}?>>MARÇO</option>
					<option value="ABRIL" <?if($mes_evento == "ABRIL"){echo "selected";}?>>ABRIL</option>
					<option value="MAIO" <?if($mes_evento == "MAIO"){echo "selected";}?>>MAIO</option>
					<option value="JUNHO" <?if($mes_evento == "JUNHO"){echo "selected";}?>>JUNHO</option>
					<option value="JULHO" <?if($mes_evento == "JULHO"){echo "selected";}?>>JULHO</option>
					<option value="AGOSTO" <?if($mes_evento == "AGOSTO"){echo "selected";}?>>AGOSTO</option>
					<option value="SETEMBRO" <?if($mes_evento == "SETEMBRO"){echo "selected";}?>>SETEMBRO</option>
					<option value="OUTUBRO" <?if($mes_evento == "OUTUBRO"){echo "selected";}?>>OUTUBRO</option>
					<option value="NOVEMBRO" <?if($mes_evento == "NOVEMBRO"){echo "selected";}?>>NOVEMBRO</option>
					<option value="DEZEMBRO" <?if($mes_evento == "DEZEMBRO"){echo "selected";}?>>DEZEMBRO</option>
			   </select>
        </td>
    </tr>
	
	<tr>
        <td>
           <font color="red">*</font><label>Local:</label><br />
           <input type="text" name="local_evento" id="local_evento" value="<?echo $local?>" class="cmscampos">
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
           <input type="text" name="horario_evento" id="horario_evento" value="<?echo $horario?>" class="cmscampos">
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