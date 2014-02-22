<?include('includes/conecta_bd.php');
$login= strip_tags($_POST['login']);
$senha= strip_tags($_POST['senha']);

$query_login = mysql_query("SELECT * FROM cms_usuarios WHERE login = '{$login}' AND senha = '{$senha}'");

 if  (mysql_num_rows($query_login) != 0)
        {
        // Login OK!

        $row = mysql_fetch_array($query_login);
		/* Define o limitador de cache para 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* Define o limite de tempo do cache em 30 minutos */
session_cache_expire(120);
$cache_expire = session_cache_expire();
		session_name('system_cms');
		session_start();
		
		
        $_SESSION['id_usuario'] = $row[id_usuario];
        $_SESSION['nome'] = $row[nome_usuario];
        $_SESSION['login'] = $row[login];
        $_SESSION['senha'] = $row[senha];
		$_SESSION['conta'] = $row[conta];
		$_SESSION['ult_acesso'] = $row[ultimo_acesso];
		
		/*$query_bio = mysql_query("SELECT * FROM colaboradores WHERE id_bio = '{$_SESSION['id_bio']}'");
		$row_bio = mysql_fetch_array($query_bio);
		$_SESSION['foto'] = $row_bio[foto];
		$_SESSION['pt-br'] = $row_bio[pt_br];
		$_SESSION['es'] = $row_bio[es];
		$_SESSION['idioma'] = $row_bio[idioma];*/
		
		
		/*if($row_bio['idioma'] == "es"){
		    //DIV cmsorienta
			$_SESSION['txt_campos_obrigatorios'] = "Campos Obligatorioso";
			
			//Botões cmsbutton
			$_SESSION['btn_voltar'] = "Volver";
			
			//Página Index
			$_SESSION['i_bem_vindo'] = "Bienvenido";
			$_SESSION['i_btn_sair'] = "Salir";
			$_SESSION['i_btn_minha_conta'] = "Mi Cuenta";
			
			//Página Posts (posts.php)
			$_SESSION['p_lnk_cadastrar_novo_post'] = "Registrar Nuevo Post";
			$_SESSION['p_data'] = "FECHA";
			$_SESSION['p_publicar'] = "PUBLICACÍON";
			$_SESSION['p_titulo_es'] = "TITULO ESPAÑOL";	
			$_SESSION['p_titulo_pt'] = "TITULO PORTUGUÉS";	

			//Formulário Posts (form_posts.php)
			$_SESSION['fp_label_link_video'] = "Enlace Vídeo";
			$_SESSION['fp_label_imagens'] = "Imágenes";
			$_SESSION['fp_legenda'] = "Leyenda";
			$_SESSION['fp_imagem_popular'] = "Imagen Popular";
			$_SESSION['fp_imagem_relacionados'] = "Imagen Relacionados";
			$_SESSION['fp_label_texto_da_miniatura'] = "Texto de la Miniatura";
			$_SESSION['fp_linha'] = "línea";
			$_SESSION['fp_label_publicar_no_site'] = "Publicar en el sitio";
			$_SESSION['fp_sim'] = "Sí";
			$_SESSION['fp_nao'] = "No";
		}
		
		if($row_bio['idioma'] == "pt-br"){*/
			//DIV cmsorienta
			$_SESSION['txt_campos_obrigatorios'] = "Campos Obrigatórios";
			
			//Botões cmsbutton
			$_SESSION['btn_voltar'] = "Voltar";
			
			//Página Index
			$_SESSION['i_bem_vindo'] = "Bem vindo";
			$_SESSION['i_btn_sair'] = "Sair";
			$_SESSION['i_btn_minha_conta'] = "Minha Conta";
			
			//Página Posts
			$_SESSION['p_lnk_cadastrar_novo_post'] = "Cadastrar Novo Post";
			$_SESSION['p_data'] = "DATA";
			$_SESSION['p_publicar'] = "PUBLICAR";
			$_SESSION['p_titulo_es'] = "TÍTULO ESPANHOL";	
			$_SESSION['p_titulo_pt'] = "TÍTULO PORTUGUÊS";

			//Formulário Posts (form_posts.php)
			$_SESSION['fp_label_link_video'] = "Link Vídeo";
			$_SESSION['fp_label_imagens'] = "Imagens";
			$_SESSION['fp_legenda'] = "Legenda";
			$_SESSION['fp_imagem_popular'] = "Imagem Popular";
			$_SESSION['fp_imagem_relacionados'] = "Imagem Relacionados";
			$_SESSION['fp_label_texto_da_miniatura'] = "Texto da Miniatura";
			$_SESSION['fp_linha'] = "linha";
			$_SESSION['fp_label_publicar_no_site'] = "Publicar no site";
			$_SESSION['fp_sim'] = "Sim";
			$_SESSION['fp_nao'] = "Não";			
		//}
		
		$dia = date ('Y-m-d H:i:s');
		
		mysql_query("UPDATE cms_usuarios SET ultimo_acesso = '$dia' WHERE id_usuario = {$_SESSION['id_usuario']}");
		//echo mysql_error();
		//exit;
		header("Location:index.php");
		
		}

?>