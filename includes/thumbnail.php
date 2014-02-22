<?php
// Função que cria thumbnails
function CreateThumb($imagem, $nome_file, $maxwdt, $dest) {


 //print "$imagem -  $nome_file -  $maxwdt -  $dest";


	//Tamanho da thumb, um valor inteiro, que corresponde à porcentagem.
	$Tamanho = 50;
	//Seta a qualidade da Thumb
	$Qualidade = 100;


        //list($owdt,$ohgt)=getimagesize($imagem);
	// obtém a extensão pelo mime-type    $otype= getExt($file);
	$otype = strtolower(end(explode('.', $imagem)));
	$nome_aux = explode('.', $nome_file);
	$nome_tb = strtolower($nome_aux[0]);

        //Aqui tiramos a proporção , o tamanho da thumb em relação à imagem
        list($wi, $he) = getimagesize($imagem);

	//Seta valor da altura da thumb
        $ratio_orig = $wi / $he;
        $x = $maxwdt;
        $y = $x / $ratio_orig;
        





	//Aqui é criada a nova imagem, a thumb
	$img_nova = imagecreatetruecolor($x, $y);


	switch($otype) {
	  case 'gif':   $newimg  = imagecreatefromgif($imagem);  break;
	  case 'jpeg':  $newimg  = imagecreatefromjpeg($imagem); break;
	  case 'pjpeg': $newimg  = imagecreatefromjpeg($imagem); break;
	  case 'jpg':   $newimg  = imagecreatefromjpeg($imagem); break;
	  case 'jpe':   $newimg  = imagecreatefromjpeg($imagem); break;
	  case 'png':   $newimg  = imagecreatefrompng($imagem);  break;
      case 'bmp': exit("<center><font size=3 color=red family=arial>Para poder criar miniaturas das imagens é necessário que você selecione apenas imagens do tipo .jpg ou .gif.<br> <input type=button value=Voltar onClick=document.location=dicas.php></center>");
 }

	if($newimg) {
	  //Agora a nova imagem é redimencionada
	  imagecopyresampled($img_nova, $newimg, 0, 0, 0, 0, $x, $y, $wi, $he);
//	print "<br><br> $x x $y  ===    $wi x $he<br><br>";
	}

	switch($otype) {
	  case 'gif': $nome_tb.= '.gif'; $dest .= $nome_tb; imagegif ($img_nova, $dest, $Qualidade); break;
	  case 'jpeg': $nome_tb.='.jpeg'; $dest .= $nome_tb; imagejpeg($img_nova, $dest, $Qualidade); break;
	  case 'pjpeg': $nome_tb.='.jpg'; $dest .= $nome_tb;imagejpeg($img_nova, $dest, $Qualidade); break;
	  case 'jpg': $nome_tb.='.jpg'; $dest .= $nome_tb;  imagejpeg($img_nova, $dest, $Qualidade); break;
	  case 'jpe': $nome_tb.='.jpg'; $dest .= $nome_tb;  imagejpeg($img_nova, $dest, $Qualidade); break;
	  case 'png': $nome_tb.='.png'; $dest .= $nome_tb;  imagepng ($img_nova, $dest, 9); break;
	}

	//Destruimos o cache da imagem para liberar uma nova thumb
	ImageDestroy($img_nova);
	ImageDestroY($newimg);
	chmod($dest,0777);
	return $nome_tb;

}

?>
