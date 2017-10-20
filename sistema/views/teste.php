<?php
die('XXX');
	include_once('vendor/phpmailer/phpmailer/class.phpmailer.php');
    //include_once('./phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer();        
    
	// Define os dados do servidor e tipo de conexão
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->CharSet      = 'UTF-8';
    $mail->IsSMTP();    // Define que a mensagem será SMTP
    $mail->SMTPAuth     = TRUE; // Usa autenticação SMTP? (opcional)
    /*
    $mail->Host         = 'smtp.dipsystem.com.br'; // Endereço do servidor SMTP
    $mail->Username     = 'vendas@dipsystem.com.br'; // Usuário do servidor SMTP
    $mail->Password     = 'Mx37020802$$'; // Senha do servidor SMTP
    $mail->Port         = 587; // Senha do servidor SMTP
    */
    
    $mail->Host         = 'smtp.gmail.com'; // Endereço do servidor SMTP
    $mail->Username     = 'expediente.aro@gmail.com'; // Usuário do servidor SMTP
    $mail->Password     = '@udi655'; // Senha do servidor SMTP
    $mail->Port         = 465; // Senha do servidor SMTP
    $mail->SMTPSecure 	= "tls";
    $mail->SMTPDebug    = 2;
	//$mail->SMTPSecure 	= 'SSL';	// SSL REQUERIDO pelo GMail
    // Define o remetente
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = 'vendas@dipsystem.com.br'; // Seu e-mail
    $mail->FromName = 'Envio Dip pay'; // Seu nome
    // Define os destinatário(s)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    
    $mail->AddAddress('andersonrobertobru@gmail.com');    
    
    //$mail->AddAddress('ciclano@site.net');
    //$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
    //$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
    // Define os dados técnicos da Mensagem
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
    // Define a mensagem (Texto e Assunto)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject  = mb_convert_encoding("Teste", "UTF-8", "auto"); // Assunto da mensagem
    $mail->Body = 'Teste';
    //$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n :)";
    // Define os anexos (opcional)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    
    //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
    // Envia o e-mail
    $enviado = $mail->Send();
    // Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();
    // Exibe uma mensagem de resultado
    if ($enviado) {
    	die($enviado);
        //return json_encode(array('sucesso'=>TRUE, 'msg'=>'E-mail enviado com sucesso!'));
    } else {
        //return json_encode(array('erro'=>TRUE, 'msg'=>'ERRO: '.$mail->ErrorInfo));
		echo 'Erro mail: '.$enviado;
		die('a');
    }
	
	die('<br />final');
?>
<div class="container-fluid" style="border: 1px solid #CCCCCC">
	<div class="row">	
		<div class="col-md-6 text-center" style="width: 50%; float: left">
			<img src="#" /> Logo
		</div>
		<div class="col-md-6" style="width: 50%; float: right; text-align: right; padding-right: 10px">
			<p>Data de emissão XX/XX/XXXX</p>
			<p>Data de vencimento XX/XX/XXXX</p>
		</div>
	</div>
	<div class="row">	
		<div class="col-md-12">
			<table style="width: 100%">
				<thead>
					<tr>
						<th style="width: 80%">Descrição</th>
						<th style="width: 80%">Valor R$</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align: left; padding-left: 10px">Item 1</td>
						<td style="text-align: right; padding-right: 10px">110.00</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td style="text-align: right; padding-right: 10px; font-weight: bold">TOTAL</td>
						<td style="text-align: right; padding-right: 10px; font-weight: bold">110.00</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>