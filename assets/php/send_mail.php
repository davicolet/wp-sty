<?php

// Variaveis de POST, Alterar somente se necessário
//====================================================
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['msg'];


//====================================================

//REMETENTE --> ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
//====================================================
$email_sender = ""; // deve ser um email do dominio
//====================================================


//Configurações do email, ajustar conforme necessidade
//====================================================
$email_receiver = ""; // qualquer email pode receber os dados
$email_reply = "$email";
$email_subject = "";
//====================================================


//Monta o Corpo da Mensagem
//====================================================


$email_content =  "<p>Nome: $name</p>";
$email_content .= "<p>E-mail: $email </p>";
$email_content .= "<p>Telefone: $phone </p>";
$email_content .= "<p>Mensagem: $message </p>";



//Seta os Headers (Alerar somente caso necessario)
//====================================================
$email_headers = implode ( "\n",array( "From: $email_sender", "Reply-To: $email_reply", "Subject: $email_subject","Return-Path:  $email_sender","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=utf-8" ) );
//====================================================


//Enviando o email
//====================================================
mail($email_receiver, $email_subject, utf8_decode($email_content), $email_headers);
// Boolean return
