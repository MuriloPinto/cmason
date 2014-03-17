<?
function getPage($url, $referer='', $timeout=30, $header=''){
		if ($referer=='') $referer='http://'.$_SERVER['HTTP_HOST'];
		if(!isset($timeout)) $timeout=30;
		$curl = curl_init();
		if(strstr($referer,"://")){
			curl_setopt ($curl, CURLOPT_REFERER, $referer);
		}
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt ($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt ($curl, CURLOPT_USERAGENT, sprintf("Mozilla/%d.0",rand(4,5)));
		curl_setopt ($curl, CURLOPT_HEADER, (int)$header);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$html = curl_exec ($curl);
		curl_close ($curl);
		return $html;
    }
	
if(isset($_GET['titulo']) == "Editar"){
	$query = mysql_query("SELECT * FROM videos WHERE id_video = {$_GET['id_video']}");
   
   $cod_video = mysql_result($query, 0, "cod_video");
   $canal = mysql_result($query, 0, "canal_video");
   $titulo = mysql_result($query, 0, "titulo_video");
}

if($_POST['action'] == "Editar"){
$canal = $_POST['canal'];
$cod = $_POST['cod_video'];

if($canal == "vimeo"){
$video = unserialize(getPage("http://vimeo.com/api/v2/video/$cod.php"));
$url_img = $video[0]["thumbnail_large"];
}else if($canal == "youtube"){
$url_img = "http://i1.ytimg.com/vi/" . $cod ."/0.jpg";
}

$cod_html = array("<div>","</div>","&lt;/div&gt;", "&lt;div&gt;");

//Campos com textos
$titulo = str_replace($cod_html, "", addslashes($_POST['tlt_video']));

   $query= "UPDATE videos
        SET  cod_video = '{$_POST['cod_video']}',
			 canal_video = '{$_POST['canal']}',
			 titulo_video = '{$titulo}',
			img_video = '{$url_img}'
		WHERE id_video = {$_POST['id_video']}";

if(!mysql_query($query,$conexao)){
echo "Não foi possível editar o vídeo desejado.";
echo mysql_error();
}else{		
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Vídeo atualizado com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=videos';">
</div>

<?
exit;
}
}

if(isset($_POST['action']) == "Cadastrar"){

$canal = $_POST['canal'];
$cod = $_POST['cod_video'];

if($canal == "vimeo"){
$video = unserialize(getPage("http://vimeo.com/api/v2/video/$cod.php"));
$url_img = $video[0]["thumbnail_large"];
}else if($canal == "youtube"){
$url_img = "http://i1.ytimg.com/vi/" . $cod ."/0.jpg";
}

$cod_html = array("<div>","</div>","&lt;/div&gt;", "&lt;div&gt;");

//Campos com textos
$titulo = str_replace($cod_html, "", addslashes($_POST['tlt_video']));
$query = "INSERT INTO videos (
					 cod_video,
					 canal_video,
					 titulo_video,
					 img_video
             )VALUES(
					 '{$_POST['cod_video']}',
					 '{$_POST['canal']}',
					 '{$titulo}',
					 '{$url_img}'
                     )
";
if(!mysql_query($query,$conexao)){?>
<div id="cmsalerta"><img src="img/error.png" class="img-error" />
Não foi possível cadastrar o video desejado. <br />
<?echo mysql_error();?>
</div>
<input type="button" class="cmsbutton" value="Voltar" onClick="window.history.back();">
<?
exit;
}else{

?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Vídeo cadastrado com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=videos';">
</div>
<?exit;
}
}
?>

<div id="cmstitulo">
     <?echo $_GET['titulo'];?> Vídeo
</div>

<div id="cmsformpainel">

<form name="frm" id="frm" action="index.php?pagina=forms/form_video" enctype="multipart/form-data" method="POST">
<table id="cmstbl" cellspacing="0" cellpadding="10">
    <tbody>		
	

	<tr>

        <td colspan="3">

		

           <font color="red">*</font><label>Tipo:</label><br />		   

           <input type="radio" name="canal" id="canal" value="youtube" class="cmscampos" <?if($canal == "youtube"){echo "checked";}?>> Youtube
		   <input type="radio" name="canal" id="canal" value="vimeo" class="cmscampos" <?if($canal == "vimeo"){echo "checked";}?>> Vimeo

		   

        </td>

    </tr>
	
	<tr>

        <td colspan="3">

		

           <font color="red">*</font><label>ID Video (Youtube ou Vimeo):</label><br />		   

           <input type="text" name="cod_video" id="cod_video" class="cmscampos" value="<?echo $cod_video?>">		   

        </td>

    </tr>
	
		
	<tr>

        <td colspan="3">

		

           <font color="red">*</font><label>Título vídeo:</label><br />		   

           <input type="text" name="tlt_video" id="tlt_video" class="cmscampos" value="<?echo $titulo;?>" size="100">		   

        </td>

    </tr>
	</tbody>
	
	<tfoot>
	<tr class="cmstbl-tr-last">
		<td colspan="5">
			<input type="hidden" name="id_video" id="id_video" value="<?echo $_GET['id_video'];?>">
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