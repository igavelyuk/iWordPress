<?php
if (isset($_POST['products'])&&isset($_POST['total_price'])&&isset($_POST['telephone'])&&isset($_POST['security']))
{
  // echo "test1 " . $_POST['products'] . "<br>";
  // echo "test2 " . $_POST['total_price'] . "<br>";
  // echo "test5 " . $_POST['telephone'] . "<br>";
  // echo "test6 " . $_POST['security'];
  //
  // echo "First part pass";
  // notcall:notcall,
  // input_address:inputAddress,
  // input_city:inputCity,
  // input_state:inputState

  $products = $_POST['products'];
  $total_price = $_POST['total_price'];
  $total_price=explode(",", $total_price);
  $total_price=array_sum($total_price);
  //$total_price=implode(",", $total_price);
  $telephone = $_POST['telephone'];
  $security = $_POST['security'];
  $ugeo = $_POST['ugeo'];
  $notcall=$_POST['notcall'];
  $input_address=$_POST['input_address'];
  $input_city=$_POST['input_city'];
  $input_state=$_POST['input_state'];
  $selfvinos=$_POST['self_vinos'];
  $location_message = get_ip();
  if($security==8){
    send_mail($products, $total_price,$location_message,$telephone,$security,$ugeo,$notcall, $input_address,$input_city,$input_state,$selfvinos);
    viberMessage($products, $total_price,$location_message,$telephone,$security,$ugeo,$notcall, $input_address,$input_city,$input_state,$selfvinos);
  }else{errorOrder();}
} else {
errorOrder();
}

function send_mail($products, $total_price, $location, $telephone,$security,$ugeo,$notcall, $input_address,$input_city,$input_state,$selfvinos){
  $to_email = "order@sushipandabc.com.ua";
  $now = new DateTime();
  $formatted = $now->format('Y-m-d H:i:s');    // MySQL datetime format
  $timestamp = $now->getTimestamp();           // Unix Timestamp -- Since PHP 5.3
  $usergeo = explode(",", $ugeo);
  if($usergeo[0]=="false"){
    $addition = "Користувач вирішив не показувати його місце розташування.";
  }else{
    $addition = 'Користувач дозволив використовувати його місце розташування <a href="https://www.latlong.net/c/?lat='.$usergeo[0].'&long='.$usergeo[1].'"> На карту, в радіусі '.$usergeo[2].' метрів, дата і час:'.$usergeo[4].' </a>';
  }

  $subject = "Нове замовлення ".$formatted;
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  // Create email headers
      $headers .= "From: order@sushipandabc.com.ua"."\r\n".
      'Reply-To: '.$from."\r\n" .
      'X-Mailer: PHP/' . phpversion();
      // Compose a simple HTML email message
      $body= '<html><body><meta http-equiv="Content-Type" content="text/html charset=UTF-8" /><table style="font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:12px" width="100%" cellspacing="0" cellpadding="10" bgcolor="#fe504f">
      <tbody>
      <tr>
      <td valign="top" align="center">
      <table style="padding:20px" width="80%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
      <tbody>
      <tr>
      <td>
      <table style="border-bottom:1px solid #3b6e93" width="100%" cellspacing="0" cellpadding="0">
      <tbody>
      <tr>
      <td style="padding:5px 10px" width="40%" valign="middle" align="left">
      <a href="pandabc.site" style="text-decoration:none; border-radius:75px;" target="_blank" data-saferedirecturl="https://www.sushipandabc.com.ua/">
      <div>
      <div style="height:150px;width:150px; background:#fe504f; color:white; border-radius:75px;">
      <div style="height:65px;">
      </div>
      <div style="width:100%; text-align:center;background:white;font-family:Arial; color:black;">
      Суши Панда
      </div>
      </div>
      </div>
      </a>
      </td>
      <td style="padding:5px 10px" width="60%" valign="middle" align="right">
      <h1 style="font-size:20px;color:#fe504f;margin-top:0px;font-weight:normal">Cуши Панда Біла Церква</h1>
      <div style="color:#666;font-size:11px">Автоматизований сервіс доставки їжі</div>
      </td>
      </tr>
      </tbody>
      </table>';
      //main part
      $body.= '<div style="padding:5px;margin:10px;font-size:2em">Деталі замовлення - '.$timestamp.' - '.$formatted.'/'.$security.'</div>';
      $body.= '<div style="padding:5px;margin:10px;font-size:1.5em">'.$products.'</div>';
      $body.= '<div style="padding:5px;margin:10px;text-align:right;font-size:1.5em"> Загальна сума: '.$total_price.'грн</div><hr>';
      if($selfvinos=="true"){
        $body.= '<div style="padding:5px;margin:10px;text-align:right;font-size:1.5em"> Кліент бажае забрати сам </div><hr>';
      }else{
        $body.= '<div style="padding:5px;margin:10px;text-align:right;font-size:1.5em"> Адреса '.$input_address.' - '.$input_city.' - '.$input_state.'</div><hr>';
      }
      $body.= '<div style="padding:5px;margin:10px;text-align:right;font-size:1.5em"> Телефон заказчика: '.$telephone." ".$notcall.'</div><hr>';
      $body.= '<div style="padding:5px;margin:10px;text-align:center;">'.$addition.' .</div><hr>';
      $body.= '<div style="padding:5px;margin:10px;text-align:center;color:green;">Місцезнаходження, оределенно як: '.$location.'</div><hr>';
      //main part
      $body.= '<hr style="border:0;color:#ccc;background-color:#ccc;height:1px;width:100%;text-align:left">
      <div style="color:#666;font-size:11px;padding:20px 10px 10px">
      З повагою, служба доставки їжі "Суші Панда".<br>
      Даний лист сформовано автоматично, прохання не відповідати на нього по електронній пошті.<br>
      горяча ліния: Kiyvstar (096)41-41-096 и Life Cell (063)41-41-096 <br>
      Також якщо відбулися технічні проблеми напишіть лист <a href="mailto:support@sushipandabc.com.ua" target="_blank" data-saferedirecturl="sushipandabc.com.ua">support@sushipandabc.com.ua</a><br>
      </div>
      </td>
      </tr>
      </tbody>
      </table>
      <div style="text-align:center;color:#666;font-size:11px;padding:20px 50px 10px 50px">
      Copyright © 2006—2019
      <a href="sushipandabc.com.ua" target="_blank" data-saferedirecturl="sushipandabc.com.ua">
      "Бургер Панда"</a>
      </div>
      </td>
      </tr>
      </tbody>
      </table></body></html>';
      if ( mail($to_email, $subject, $body, $headers)) {
        readfile("https://www.sushipandabc.com.ua/contact/200.html");
      } else {
        errorOrder();
      }
}

function get_ip(){
  // set IP address and API access key
  // Function to get the client ip address
  function get_client_ip_env() {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else
      if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';
      return $ipaddress;
  }
  $ip = get_client_ip_env();
  $access_key = '5a9d245a0d7a8992f1dd9e953c4cd7d5';

  // Initialize CURL:
  $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Store the data:
  $json = curl_exec($ch);
  curl_close($ch);

  // Decode JSON response:
  $api_result = json_decode($json, true);

  // Output the "capital" object inside "location"
  // "country_name": "United States",
  //   "region_code": "MA",
  //   "region_name": "Massachusetts",
  //   "city": "Boston",
  //   "zip": "02115",
  //   "latitude": 42.3424,
  //   "longitude": -71.0878,
  return $api_result["city"].'Геокоордінати на <a href="https://www.latlong.net/c/?lat='.$api_result["latitude"].'&long='.$api_result["longitude"].'">Перейти</a>';
}
function viberMessage($products, $total_price,$location_message,$telephone,$security,$ugeo,$notcall, $input_address,$input_city,$input_state,$selfvinos){
  $now = new DateTime();
  $formatted = $now->format('Y-m-d H:i:s');
  $nproducts=str_replace("<br>", "", $products); // outputs Hello Dolly!
  $newproducts = preg_replace('/\s+/', '', $nproducts);
  // =str_replace("&nbsp;", "", $nproducts);
  $url = "https://chatapi.viber.com/pa/broadcast_message";
  $ch = curl_init($url);
  $data = '{"auth_token":"4a7216e26c67d415-ee9b9e0516c17072-8c4d4593f08670fe",
   "receiver": "GoHi3E4bJK5s1Ldhx24eLQ==",
   "min_api_version":1,
   "sender":{
      "name":"sushiPanda",
      "avatar":"https://sushipandabc.com.ua/img/logo.png"
   },
   "broadcast_list":[
      "GoHi3E4bJK5s1Ldhx24eLQ==",
      "R53lvkCxW/FA2N0VpXKbfg==",
      "OrXITjUgTWZueKxjpTy9yA=="
   ],
   "tracking_data":"tracking data",
   "type":"text",';
   if($selfvinos=="true"){
     $data .= '"text":"Замовлення ('.$formatted.') кліент забире сам: '.$newproducts." Загальна сумма:".$total_price."грн. Тел:".$telephone." ".$notcall.'"}';
   }else{
     $data .= '"text":"Замовлення ('.$formatted.') '.$newproducts." Загальна сумма:".$total_price."грн. Тел:".$telephone." ".$notcall.". Доставка :".$input_address." ".$input_city." ".$input_state.'"}';
   }

  // curl_setopt($ch, CURLOPT_URL, $url);
  //$jsonData = json_encode($data);
  curl_setopt($ch, CURLOPT_POST,1);
  //edited
  curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
  curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
  curl_exec($ch);

  //new MessageFormatter
  $data = '{"auth_token":"4a7216e26c67d415-ee9b9e0516c17072-8c4d4593f08670fe",
   "receiver": "GoHi3E4bJK5s1Ldhx24eLQ==",
   "min_api_version":1,
   "sender":{
      "name":"sushiPanda-povar",
      "avatar":"https://sushipandabc.com.ua/img/logo3.png"
   },
   "broadcast_list":[
      "GoHi3E4bJK5s1Ldhx24eLQ==",
      "R53lvkCxW/FA2N0VpXKbfg==",
      "OrXITjUgTWZueKxjpTy9yA==",
      "qmGv//gg452DJGIz1q9siw=="
   ],
   "tracking_data":"tracking data",
   "type":"text",';
   if($selfvinos=="true"){
     $data .= '"text":"Замовлення ('.$formatted.') кліент забире сам: '.$newproducts.'"}';
   }else{
     $data .= '"text":"Замовлення ('.$formatted.') для доставки  '.$newproducts.'. "}';
   }

  // curl_setopt($ch, CURLOPT_URL, $url);
  //$jsonData = json_encode($data);
  curl_setopt($ch, CURLOPT_POST,1);
  //edited
  curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
  curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
  $result = curl_exec($ch);
  // return $result;
}
function errorOrder(){
    readfile("https://www.sushipandabc.com.ua/contact/404.html");
}

?>
