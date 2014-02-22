<?include('includes/conecta_bd.php');
session_name('system_cms');
session_start();
 //testa se o usuário validou o login
 if(!isset($_SESSION['nome'])){
 //header("Location:index.php");
 //exit();
 }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> PAINEL DE CONTROLE :: CMaSon</title>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
<meta name="robots" content="noindex, nofollow">
<link rel="icon" href='favicon.png' type='image/png' />
<link rel="stylesheet" href="css/cms_style.css" type="text/css"/>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js"></script>



<script type="text/javascript">
 $().ready(function() {  
   $('#add').click(function() {  
    return !$('#select1 option:selected').remove().appendTo('#select2');  
   });  
   $('#remove').click(function() {  
    return !$('#select2 option:selected').remove().appendTo('#select1');  
   });  
   
   
$("#cmstbl.fotos-home tbody.content").sortable({
    update: function(event, ui) {
        $.ajax({
			url: "ordena_fotos.php",
			data: { pages: $('#cmstbl.fotos-home tbody.content').sortable('serialize') },
			type: 'get',
			success: function(xhr, ret){
			
			}
		});
    }
});

  });




function insRow_foto(){
    
	var x=document.getElementById("myTable_foto").insertRow(-1);
    var fot=x.insertCell(0);
    var leg=x.insertCell(1);
    var leg2=x.insertCell(2);
    
	
	fot.innerHTML= "<input type='file' name='foto[]'  style='width:310px' class='text' onChange='javascript: verifica_extensao('foto');'>";
    leg.innerHTML= "&nbsp;Legenda: <input name='legenda_inc[]' type='text' class='text'/> <input type='hidden' name='tipo_arquivo[]' value='foto' />";
    leg2.innerHTML="&nbsp;<img src='img/delete.png' onClick='rmvRow_foto(this);' /> <input name='ordem[]' type='hidden' class='text'/>";
    return false;
}

function rmvRow_foto(obj){
var delRow = obj.parentNode.parentNode;
var rIndex = delRow.sectionRowIndex;
document.getElementById('myTable_foto').deleteRow(rIndex);
}

function confirmAcao(msg,url) {

document.getElementById('msg_del').innerHTML=msg;
document.getElementById("btn_del_sim").setAttribute("onClick","location.href='"+url+"'");

    if (document.getElementById('div_escura2').style.display == 'none') {
        document.getElementById('div_escura2').style.display = '';
        document.getElementById('div_confirma').style.display = '';		
 
    }else {
        document.getElementById('div_escura2').style.display = 'none';
		document.getElementById('div_confirma').style.display = 'none';
        
    }
}function editarContaCms(msg,url) {    if (document.getElementById('div_escura2').style.display == 'none') {        document.getElementById('div_escura2').style.display = '';		document.getElementById('painel-admin').style.display = '';     }else {        document.getElementById('div_escura2').style.display = 'none';			document.getElementById('painel-admin').style.display = 'none';            }}function clareiaTela() {    if (document.getElementById('div_escura2').style.display == 'none') {        document.getElementById('div_escura2').style.display = '';		document.getElementById('painel-admin').style.display = '';		     }else {        document.getElementById('div_escura2').style.display = 'none';		document.getElementById('painel-admin').style.display = 'none';		            }}





  


function checkForm(){
<?if($_SESSION['idioma'] == 'pt-br'){?>

if (document.frm.titulo_post.value=="" && document.frm.titulo_post.value.length < 1)
{
document.frm.titulo_post.focus();
document.getElementById("titulo_post").style.border="1px solid red";
 document.getElementById("select2").style.border="1px solid #6F6F6F";
document.getElementById("texto_post").style.border="1px solid #6F6F6F";
document.getElementById("tags").style.border="1px solid #6F6F6F";
return false;
}

if (document.frm.texto_post.value=="" && document.frm.texto_post.value.length < 1)
{
document.frm.texto_post.focus();
document.getElementById("texto_post").style.border="1px solid red";
return false;
}
<?}?>




//verifica se um menu foi selecionado
//function sel(){
var numm = 0;
//for (i=0;i<document.getElementsByTagName('input').length;i++){
//if (document.frm.elements[i].type=="checkbox"){
if(document.frm.id_menu[0].checked==false) { 
numm++;
} 
if(document.frm.id_menu[1].checked==false) { 
numm++;
} 
if(document.frm.id_menu[2].checked==false) { 
numm++;
} 
if(document.frm.id_menu[3].checked==false) { 
numm++;
} 
if(document.frm.id_menu[4].checked==false) { 
numm++;
} 
if(document.frm.id_menu[5].checked==false) { 
numm++;
} 
if(document.frm.id_menu[6].checked==false) { 
numm++;
} 
if(document.frm.id_menu[7].checked==false) { 
numm++;
} 

//}


//}
if(numm == 8){
document.frm.menus.focus();
document.getElementById("select2").style.border="1px solid #6F6F6F";
document.getElementById("tags").style.border="1px solid #6F6F6F";
<?if($_SESSION['idioma'] == 'pt-br'){?>
document.getElementById("titulo_post").style.border="1px solid #6F6F6F";
<?}?>
<?if($_SESSION['idioma'] == 'es'){?>
document.getElementById("titulo_post_es").style.border="1px solid #6F6F6F";
<?}?>
return false;
}
//}

//sel();
	
if (document.frm.select2.value==""){ 
      	 document.frm.select2.focus();
		 document.getElementById("select2").style.border="1px solid red";
		 document.getElementById("tags").style.border="1px solid #6F6F6F";
<?if($_SESSION['idioma'] == 'pt-br'){?>
document.getElementById("titulo_post").style.border="1px solid #6F6F6F";
<?}?>
<?if($_SESSION['idioma'] == 'es'){?>
document.getElementById("titulo_post_es").style.border="1px solid #6F6F6F";
<?}?>		 
      	 return false; 
   	} 
    

if (document.frm.tags.value=="" && document.frm.tags.value.length < 1)
{
document.frm.tags.focus();
document.getElementById("tags").style.border="1px solid red";
document.getElementById("select2").style.border="1px solid #6F6F6F";
<?if($_SESSION['idioma'] == 'pt-br'){?>
document.getElementById("titulo_post").style.border="1px solid #6F6F6F";
<?}?>
<?if($_SESSION['idioma'] == 'es'){?>
document.getElementById("titulo_post_es").style.border="1px solid #6F6F6F";
<?}?>
return false;
}
}


  
 </script>
</head>
<body>

<!-- PAINEL CMaSon --> <?if(isset($_SESSION['nome'])){?>
<div id="topo" style="height:110px; background: url('img/cms_fundo_topo.png') repeat-x; background-position: bottom left;">
     <div style="height: 70px;">
         <div class="logo" style="float:left; padding-left: 10px; padding-top: 10px;">
             <img src="logo.png" height="50">
	     </div>
     <?if(isset($_SESSION['nome'])){?>
	     <div class="cmsuser">
             <table style="float: right;">
                 <tr>
					 <td>
						 <div style="margin-right:10px;">						
						 <div style="margin-bottom: 5px;"><?echo $_SESSION['i_bem_vindo'] . ", " . $_SESSION['nome'];?></div>						 
							<span class="cmsbot"><a onclick="editarContaCms();" class="cmsbotlink" target="cms_painel" href="cms_admin/cms_user_conta.php"><?echo $_SESSION['i_btn_minha_conta'];?></a></span>
							<span class="cmsbot"><a href="logoff.php?acao=sair" style="text-decoration: none;"><?echo $_SESSION['i_btn_sair'];?></a></span>
						 </div>
					 </td>

			         <td>
						<img src="img/kxconfig.png?>" height="65">					 
                     </td>
					 
			     </tr>
             </table>
         </div>
	<?}?>

     </div>

     <div id="navbar">
	 <?if(isset($_SESSION['nome'])){?>
         <ul class="nav">		 
             <li><a id="dica_home" title="Página Inicial" href="index.php?pagina=principal"><img src="img/house.png" border="0" alt="" title=""></a></li>
			 <?if($_SESSION['conta'] == "adm"){?>
				 <li><a href="index.php?pagina=agenda">Agenda</a></li>				 				 <li><a href="index.php?pagina=fotos">Fotos</a></li>
				 <li><a href="index.php?pagina=videos">Vídeos</a></li>
				 <li><a href="index.php?pagina=presskit">Presskit</a></li>
			 <?}?>			 
             <li style="border:0px;"><a id="dica_ajuda" title="Ajuda" href="index.php?pagina=help"><img src="img/help.png" border="0" alt="" title=""></a></li>
         </ul>
	<?}?>
     </div>
</div>
<?}?>
<!-- ##INICIO## FORMULÁRIO DE EDIÇÃO -->

<div id="div_escura" style="-moz-opacity: 0.65; filter: alpha(opacity=65); top: 0pt; left: 0pt; background-color: #000; opacity: 0.75; width: 100%; height: 100%; z-index: 1000; position: fixed; display:none;" onClick="viewPainelDark();">
</div>

<div id="painel-admin" style="z-index: 1100; background-color: white; height: 480px; position: fixed; top: 50%; left: 50%; margin-top: -250px; width: 800px; margin-left: -400px; display: none; padding: 10px;">	 <iframe height="480" width="800" name="cms_painel" frameborder="0"></iframe></div>


<div id="div_escura2" style="-moz-opacity: 0.65; filter: alpha(opacity=65); top: 0pt; left: 0pt; background-color: #000; opacity: 0.75; width: 100%; height: 100%; z-index: 1000; position: fixed; display:none;" onClick="clareiaTela();">
</div>
<div id="div_confirma" class="action" style="display: none; z-index: 1100;">
<img src="img/warning.png" border="0" alt="Ok!" title="Ok!"><br /> <br />
<span id="msg_del"></span><br /><br />

<input type="button" id="btn_del_sim" class="cmsbutton" value="Sim" onClick=""> <input type="button" class="cmsbutton" value="Não" onClick="confirmAcao();">

</div>

<!-- ##FIM## FORMULÁRIO DE EDIÇÃO -->


<? 
if(!isset($_SESSION['nome'])){?>
<div style="min-height: 100%; min-width: 100%; position: relative;">
<div style="border: 1px solid black; margin: 0 auto; min-height: 100%; width:1000px; overflow: hidden;">
<img src="http://www.pyrafilmes.com/img/loguinho.png" height="70" style="float: left;">
<div>
<form action="login.php" method="post">
Login: <input type="text" name="login">
Senha: <input type="password" name="senha">
<input type="submit" value="entrar">
</form>
</div>
<div style="clear:both;"></div>
</div>

</div>

<?}else{
if(isset($_GET['pagina'])) {
            $pag = $_GET['pagina'];
        }else{$pag = "principal";}
?>
<div style="padding: 20px;">
<?
include($pag.'.php');
}
?>
</div>
</body>
</html>