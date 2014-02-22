<?php
  /*------------------------------------------------------------
  Arquivo usado para configurar a conexão com o banco de dados
  ------------------------------------------------------------*/
  $localhost = "localhost"; // local da conexao com o banco
  $user = "root";                  // nome do usuário
  $senha = "";                 // senha para acessar o banco
  $nome_banco = "cmason";            //nome do banco de dados

  $conexao = mysql_connect($localhost,$user,$senha) or die (mysql_error());
  mysql_select_db($nome_banco,$conexao);
?>
