<?php

//Variaveis de POST, Alterar somente se necessário
//====================================================
$name = $_POST['name'];
$mail = $_POST['email'];

//====================================================

//REMETENTE --> ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
//====================================================
$mail_sender = ""; // deve ser um email do dominio
//====================================================


//Configurações do email, ajustar conforme necessidade
//====================================================
$mail_receiver = ""; // qualquer email pode receber os dados
$mail_reply = "$mail";
$mail_subject = "[...] Newslatter";
//====================================================


//Monta o Corpo da Mensagem
//====================================================


$mail_content .= "<p>Nome: $name</p>";
$mail_content .=  "<p>E-mail: $mail </p>";


//Seta os Headers (Alerar somente caso necessario)
//====================================================
$mail_headers = implode ( "\n",array ( "From: $mail_sender", "Reply-To: $mail_reply", "Subject: $mail_subject","Return-Path:  $mail_sender","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=utf-8" ) );
//====================================================


//Enviando o email
//====================================================
mail($mail_receiver, $mail_subject, utf8_decode($mail_content), $mail_headers);

?>
