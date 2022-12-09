<?php
$conn = new mysqli("localhost", "root", "root","messages");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$UserName = strip_tags($_POST["username"]);
$Email = strip_tags($_POST["email"]);
$Homepage = strip_tags($_POST["homepage"]);
$Text = $_POST["message"];

//ip
$ip = $_SERVER['REMOTE_ADDR'];
function getIp() {
  $keys = [
    'HTTP_CLIENT_IP',
    'HTTP_X_FORWARDED_FOR',
    'REMOTE_ADDR'
  ];
  foreach ($keys as $key) {
    if (!empty($_SERVER[$key])) {
      $ip = trim(end(explode(',', $_SERVER[$key])));
      if (filter_var($ip, FILTER_VALIDATE_IP)) {
        return $ip;
      }
    }
  }
}

$ip = getIp();
//Browser
$user_agent = $_SERVER["HTTP_USER_AGENT"];
  if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
  elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
  elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
  elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
  elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
  else $browser = "Неизвестный";
//Дата
$date = date("m.d.y");
//Файл
if($_FILES["file"]["type"]=='image/png' || $_FILES["file"]["type"]=='image/jpeg' || $_FILES["file"]["type"]=='image/gif'){
  require_once  'thumbs.php';

  $image = new Thumbs($_FILES["file"]['tmp_name']);
  $image->reduce(320, 240);
  $image->save();
  
  $filename=time().$_FILES["file"]['name'];
  move_uploaded_file($_FILES["file"]['tmp_name'],'data/'.$filename);
}
else if($_FILES["file"]["type"]=='text/plain' && $_FILES["file"]["size"]<105000){
  $filename=time().$_FILES["file"]['name'];
  move_uploaded_file($_FILES["file"]['tmp_name'],'data/'.$filename);
}
echo($Text);
//Отправляем в таблицу
$result = $conn->query("INSERT INTO `allmess` (`username`, `email`, `homepage`, `text`, `ip`, `browser`, `date`, `filename`) VALUES ('$UserName', '$Email', '$Homepage', '$Text','$ip','$browser','$date','$filename');");
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<h2 style="margin-top:15%; margin-left: 40%; margin-right: auto;  width: 20em">Сообщение отправлено</h2>
<button style="margin-left: 40%; font-size: medium;   width: 21em" type="submit" class="btn btn-sm btn-primary" onClick="location.href='http://myguest.book'">На главную</button>