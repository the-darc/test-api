<?php
header("Content-Type: application/xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value
function CallAPI($method, $url, $data = false) {
  $curl = curl_init();

  switch ($method) {
    case "POST":
      curl_setopt($curl, CURLOPT_POST, 1);

      if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      break;
    case "PUT":
      curl_setopt($curl, CURLOPT_PUT, 1);
      break;
    default:
      if ($data)
        $url = sprintf("%s?%s", $url, http_build_query($data));
  }

  // Optional Authentication:
  // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  // curl_setopt($curl, CURLOPT_USERPWD, "username:password");
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    // CURLOPT_POSTFIELDS => "{\"selectiveProcess\": \"5bfc3e6d62edb916bb64c922\"}",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer eyJhbGciOiJIUzUxMiJ9.eyJjb2RlIjoiNWFhYWRiNTQ2MmVkYjk3ZThjYTYxZGNjIiwibG9naW4iOiJzaXRlc3lkbGUiLCJuYW1lIjoiU2l0ZSBkYSBTWURMRSIsImxvY2FsZSI6InB0X0JSIiwiX29yZ0lkIjoiNWFhOTllOWU2MmVkYjk3ZThjYTQ0ODg4IiwiX2NsYXNzIjp7Il9pZCI6IjAwMDAwMDAwMDAwMDAwMDAwMDAwMDA3MCIsIl9jbGFzc0lkIjoiMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwIiwiY2xhc3NQYWNrYWdlSWRlbnRpZmllciI6Il9zeXN0ZW0iLCJjbGFzc0lkZW50aWZpZXIiOiJfYWNsVXNlciJ9LCJfY3JlYXRpb25EYXRlIjoiMjAxOC0wMy0xNVQyMDo0NTowOC4xMzNaIiwiX2xhc3RVcGRhdGVEYXRlIjoiMjAxOC0wMy0xNVQyMDo0NTowOC4xMzNaIiwiX2xhc3RVcGRhdGVVc2VyIjp7Il9pZCI6IjAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwOSIsIl9jbGFzc0lkIjoiMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAyIiwiY2xhc3NQYWNrYWdlSWRlbnRpZmllciI6Il9zeXN0ZW0iLCJjbGFzc0lkZW50aWZpZXIiOiJfdXNlciJ9LCJfY2xhc3NSZXZpc2lvbiI6IjVhOWVkN2I2ZWM4MzJhOWFjODVlZDE4OCIsIl9yZXZpc2lvbiI6Ii0xNjkxMDA0OTkzIiwiYWN0aXZlIjp0cnVlLCJvcmdhbml6YXRpb25JZCI6InN5ZGxlIiwiYXV0aGVudGljYXRpb25DbGFzcyI6Il9zeXN0ZW0uX3VzZXIiLCJpYXQiOjE1MjExNDY3MzMsImlzcyI6Imp3Iiwic3ViIjoiYWNjZXNzVG9rZW4ifQ.NqzgcLr0hMzdnIc3mBtlmQJ_-vj2rSDIlkhKtfqcfdWVVhSZAuoGFFro_OmK_KnlB2QJSUEVSqBCjeG92_oFtg",
      "Content-Type: application/json"
    )
  ));

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  $result = curl_exec($curl);
  if ($result === false) {
    $errorMsg = sprintf('Http request failed with error #%d: %s', curl_errno($curl), curl_error($curl));
    $errorMsg = str_replace("\"", "\\\"", $errorMsg);
    error_log($errorMsg);
    return '{ "xml": "<error>'.$errorMsg.'</error>" }';
  }

  curl_close($curl);
  return $result;
}
?>
<?php 
  $result = CallAPI(
    "POST",
    "https://sydle.sydle.one/api/1/jobportal/com.sydle.hr_recruiter/serviceFacade/joobleXML",
    "{\"jobUrl\": \"https://www.sydle.com/br/carrera/vaga/<jobname>-<jobid>\"}"
  );
  $data = json_decode($result);
  // error_log('result: ' . $result);
  // error_log('Type: ' . gettype($data));
  echo $data->xml;
?>
