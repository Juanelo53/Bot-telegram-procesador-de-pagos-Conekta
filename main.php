<?php
//Made with ❤ by Juanelo53
//Hecho con ❤ por Juanelo53


// INGRESA EL TOKEN DE TU BOT OBTENIDO EN BOTFATHER
$botToken = 'AQUI INGRESA EL TOKEN DE TU BOT  '; 

// LLAMAR A LAS VARIABLES DEL BOT
require_once('config/variables.php');
require_once('functions/functions.php');
require_once('CurlX.php');
$WHIS = new CurlX;

// COMIENZO DEL BOT

if (strpos($message, '/start') === 0){
    
  bot('sendMessage',[
    'chat_id' => $chat_id, //Busca el chat id del mensaje
    'message_id' => $message_id, //Busca el Mensaje ID
    'text' => '<b>Hey hola soy un bot que puede procesar pagos con Conekta.

Sigue el ejemplo:

/pay NOMBRE | TARJETA | MES | AÑO | CVC | CORREO | CONCEPTO | MONTO

Ejemplo hecho:

/pay FULANITO | 4000000000000002 | 12 | 2026 | 000 | fulano@conekta.com | PAGO | 25

Hecho con ❤ por Juanelo53
    </b>',
    'reply_to_message_id' => $message_id, //Responde al usuario
    'parse_mode' => 'HTML',
   'reply_markup'=>json_encode(['inline_keyboard' => [
        [
          ['text' => "😀 Ver Codigo o hacer Deploy ", 'url' => "https://github.com/Juanelo53"]
        ],
      ], 'resize_keyboard' => true])
  ]);
  // EJEMPLO DE ENVIO /pay FULANITO | 4000000000000002 | 12 | 2026 | 000 | fulano@conekta.com | PAGO | 25
}

if(strpos($message, '/pay') === 0){
    //Obtenemos lo necesario para procesar el pago
  $extraer  = substr($message, 4);
  $i        = explode(' | ', $extraer); 
  $nombre   = $i[0];
  $cc       = $i[1];
  $mes      = $i[2];
  $year     = $i[3];
  $cvv      = $i[4];
  $correo   = $i[5];
  $concepto = $i[6];
  $monto    = $i[7];
  
 
  bot('sendMessage',[
    'chat_id' => $chat_id, //Busca el chat id del mensaje
    'message_id' => $message_id, //Busca el Mensaje ID
    'text' => '<b>
Tu pago se esta procesando un momento porfavor.....
    </b>',
    'reply_to_message_id' => $message_id, //Responde al usuario
    'parse_mode' => 'HTML',
  ]);
 
 /// Empezamos a crear la api para mandar el pago y extraer los datos de nuestra sitio web
$url = 'https://api.conekta.io/tokens';
$hd = array(
'authority: api.conekta.io',
'accept: ############',
'authorization: #############',
'conekta-client-user-agent: ##################',
'content-type: application/json',
'origin: ################',
'referer: ################',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: cross-site',
'user-agent: #############',
'x-tokenization-source: conekta.js',
    );
    $data = '#######'; /////EJEMPLO {"card":{"name":"'.$nombre.'","number":"'.$cc.'","cvc":"'.$cvv.'","exp_month":"'.$mes.'","exp_year":"'.$year.'","device_fingerprint":"##############"}}

    $req = $WHIS::Post($url, $data, $hd, null, null);
    $kl = $req->body;
    $hj = json_decode($kl);
    $token = $hj->id; //obtenemos el Token de conekta
    
    $url2 = '#################';
    $hd2 = array(
'authority: ##############',
'accept: */*',
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'cookie: ################',
'origin: ###############',
'referer: ####################',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'user-agent: ####################',
'x-requested-with: XMLHttpRequest',
        );
        $data2 = '##########'; ///// EJEMPLO:  conektaTokenId='.$token.'&name='.$nombre.'&card='.$cc.'&email='.$correo.'&description='.$concepto.'&total='.$monto.'
    $req2 = $WHIS::Post($url2, $data2, $hd2, null, null);
    $yt = $req2->body;
    $ui = json_decode($yt);
    
    
    // Mandamos mensaje de exito o fallido
    
    if($ui == 'Pago exitoso'){ // Si la respuesta es exitosa mandara mensaje de pago exitoso
    
     bot('sendMessage',[
    'chat_id' => $chat_id, //Busca el chat id del mensaje
    'message_id' => $message_id, //Busca el Mensaje ID
    'text' => '<b>Tu pago fue procesado de forma exitosa, Gracias por comprar con nosotros!! ✅</b>',
    'reply_to_message_id' => $message_id, //Responde al usuario
    'parse_mode' => 'HTML',
  ]);
    }else { // Si el banco declina o numero incorrecto manda mensaje de decliando
    
             bot('sendMessage',[
    'chat_id' => $chat_id, //Busca el chat id del mensaje
    'message_id' => $message_id, //Busca el Mensaje ID
    'text' => '<b>No se pudo procesar tu pago 😢 intenta denuevo mas tarde o contacta con tu banco!! ❌
    
Respuesta = '.$ui.'
    </b>',
    'reply_to_message_id' => $message_id, //Responde al usuario
    'parse_mode' => 'HTML',
  ]);
    }
    
 
  
 

  
}



