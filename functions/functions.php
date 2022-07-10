<?php

// FUNCIONES REQUERIDAS
function bot($method,$datas=[]){
  global $botToken;
  $url = "https://api.telegram.org/bot".$botToken."/".$method;
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
  $res = curl_exec($ch);
  if(curl_error($ch)){
      var_dump(curl_error($ch));
  }else{
      return json_decode($res);
  }
}

// ENVIAR MENSAJE 
function sendMessage($chat_id,$text,$keyboard){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'reply_markup'=>$keyboard]);
}

// EDITAR MENSAJE
function editMessage($chat_id,$message_id,$text,$reply_markup){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>$text,
'reply_markup'=>$reply_markup]);
}