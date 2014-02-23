<?
require("includes/thumbnail.php");
require("includes/thumbnail_altura.php");

// -----------------------------------------------------------------
//  upload de arquivos
// -----------------------------------------------------------------
function upload()
{

global $legenda_inc, $tipo_arquivo;


    $fotos = $_FILES['foto'];

    for ($i = 0; $i <= count($_FILES['foto']['name']); $i++)
    {
        $nome     = strtolower($fotos['name'][$i]);
        $tamanho  = $fotos['size'][$i];
        $tipo     = $fotos['type'][$i];
        $tmp_name = $fotos['tmp_name'][$i];

        $nome = str_replace ( " ", "_", $nome );

        $especiais = array("á", "ã", "â", "à", "é", "ê", "í", "ó", "ô", "õ", "ú", "ü", "ç", "Á", "Ã", "Â", "À", "É", "Ê", "Í", "Ó", "Ô", "Õ", "Ú", "Ü", "Ç" );
        $normais   = array("a", "a", "a", "a", "e", "e", "i", "o", "o", "o", "u", "u", "c", "A", "A", "A", "A", "E", "E", "I", "O", "O", "O", "U", "U", "C" );

        $nome = str_replace ( $especiais, $normais, $nome );


        if (($tamanho > 0) && (strlen($nome) > 1))
           {

               $caminho = "../fotos/" . $nome;
			   		   
	
               if ( move_uploaded_file($tmp_name, $caminho) )
               {

                chmod($caminho, 0777);

                if ($nome != "")
                    {
                    // busca nro da ordem
                    $query = "select isnull(max(nr_ordem) + 1) nro1, max(nr_ordem) + 1 nro2 from fotos where tipo_arquivo = '{$_POST['tipo_arquivo'][$i]}' ";
					
                    $sel_dados = mysql_query($query);
                    $row = mysql_fetch_assoc($sel_dados);

                    $nr_ordem = $row['nro1'] == 1 ? 1 : $nr_ordem = $row[nro2];

                    // insere a foto
                    $query = "insert into fotos (nome_arquivo, descricao_arquivo, nr_ordem, tipo_arquivo)
                                    values ( 
                                            '$nome',
                                            '{$_POST['legenda_inc'][$i]}',
                                            $nr_ordem,
                                            '{$_POST['tipo_arquivo'][$i]}')  ";
//                    print "<br>" . $query . "<br>";

                    $ins_dados = mysql_query($query);


                    // cria o thumbnail da imagem:
                    $caminho_img = "../fotos/";
					$caminho_thumb = "../fotos/thumbs/";
					$caminho_expandida = "../fotos/expandida/";
                    $arquivo_tumb =  $nome;

                    if ($_POST['tipo_arquivo'][$i] == "foto")
                    {
                    chmod($caminho_img, 0777);

                         //Aqui tiramos a proporção , o tamanho da thumb em relação à imagem
                         list($wi, $he) = getimagesize($caminho);

						 
                        	if($wi > $he){
                               		$thumbnail= CreateThumb($caminho, $arquivo_tumb, 430, $caminho_img);
									$thumbnail= CreateThumb($caminho, $arquivo_tumb, 138, $caminho_thumb);
									$thumbnail= CreateThumb($caminho, $arquivo_tumb, 600, $caminho_expandida);
                         }
						 

							if($he > $wi){
                        		
								$thumbnail= CreateThumbA($caminho, $arquivo_tumb, 300, $caminho_img);
								$thumbnail= CreateThumbA($caminho, $arquivo_tumb, 150, $caminho_thumb);
								$thumbnail= CreateThumb($caminho, $arquivo_tumb, 400, $caminho_expandida);
							}
							
												

                          if($he == $wi){
                        		$thumbnail= CreateThumbA($caminho, $arquivo_tumb, 300, $caminho_img);
								$thumbnail= CreateThumbA($caminho, $arquivo_tumb, 150, $caminho_thumb);
								$thumbnail= CreateThumb($caminho, $arquivo_tumb, 400, $caminho_expandida);
							}
                    }



                    }
                }
           }
    }

}





if(isset($_POST['action']) == "Cadastrar"){


upload();
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Fotos cadastradas com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=fotos';">
</div>
<?
exit;

/*$data = date('Y-m-d');
$descricao = addslashes($_POST['descricao_arquivo']);

$query = "INSERT INTO fotos (
					 nome_arquivo,
					 descricao_arquivo
             )VALUES(
                     '{$_FILES['logo']['name']}',
					 '{$_POST[descricao_arquivo]}'
                     )
";
if(!mysql_query($query,$conexao)){
echo "Não foi possível cadastrar a foto desejada.";
echo mysql_error();
}else{
$id_cliente = mysql_insert_id();

$uploaddir = "../fotos/"; 
$uploadfile = $uploaddir . $id_cliente ."_". basename($_FILES['logo']['name']); 
$error = $_FILES['logo']['error']; 
$subido = false; 
if($error==UPLOAD_ERR_OK) { $subido = copy($_FILES['logo']['tmp_name'], $uploadfile); } 
//if($subido) { echo "El archivo subio con exito"; } else { echo "Se ha producido un error: ".$error; }
?>
<div id="action">
	<img src="img/ok.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
	<span>Foto cadastrada com sucesso!</span><br /><br />
	<input type="button" class="cmsbutton" value="Ok!" onClick="location.href='index.php?pagina=fotos';">
</div>
<?
exit;
}*/
}
?>

<div id="cmstitulo">
     <?echo $_GET['titulo'];?> Foto
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