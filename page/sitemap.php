<?php
header("Content-Type: application/xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';

$hoje = date('Y-m-d');

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
      "Content-Type: application/json",
      "Postman-Token: 6ba9f332-f758-4d7b-8939-4ed16a23a133",
      "cache-control: no-cache"
    )
  ));

  // curl_setopt($curl, CURLOPT_HEADEROPT, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  $result = "<custom><![CDATA[";
  $result .= curl_exec($curl);
  $result .= "]]></custom>";

  curl_close($curl);

  // $result = "<custom><!CDATA" . $result;
  return $result;
}

?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
  http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
  <url>
    <loc>http://www.edgarserra.com/</loc>
    <lastmod><?php echo $hoje; ?></lastmod>
    <priority>1.00</priority>
    <changefreq>daily</changefreq>
  </url>
  <url>
    <loc>http://www.edgarserra.com/index.jsp</loc>
    <lastmod><?php echo $hoje; ?></lastmod>
    <priority>0.80</priority>
    <changefreq>daily</changefreq>
  </url>
  <url>
    <loc>http://www.edgarserra.com/quem-somos.jsp</loc>
    <lastmod><?php echo $hoje; ?></lastmod>
    <priority>0.80</priority>
    <changefreq>daily</changefreq>
  </url>
  <url>
    <loc>http://www.edgarserra.com/servicos.jsp</loc>
    <lastmod><?php echo $hoje; ?></lastmod>
    <priority>0.80</priority>
    <changefreq>daily</changefreq>
  </url>
  <url>
    <loc>http://www.edgarserra.com/blog.jsp</loc>
    <lastmod><?php echo $hoje; ?></lastmod>
    <priority>0.80</priority>
    <changefreq>daily</changefreq>
  </url>
  <url>
    <loc>http://www.edgarserra.com/arquivo-do-blog.jsp</loc>
    <lastmod><?php echo $hoje; ?></lastmod>
    <priority>0.80</priority>
    <changefreq>daily</changefreq>
  </url>
  <url>
    <loc>http://www.edgarserra.com/orcamento.jsp</loc>
    <lastmod><?php echo $hoje; ?></lastmod>
    <priority>0.80</priority>
    <changefreq>daily</changefreq>
  </url>
  <url>
    <loc>http://www.edgarserra.com/contato.jsp</loc>
    <lastmod><?php echo $hoje; ?></lastmod>
    <priority>0.80</priority>
    <changefreq>daily</changefreq>
  </url>
  <?php 
    $result = CallAPI(
      "POST",
      "https://sydle.sydle.one/api/1/jobportal/com.sydle.hr_recruiter/serviceFacade/selectiveProcess.jsonld",
      "{\"selectiveProcess\": \"5bfc3e6d62edb916bb64c922\"}"
    );
    echo $result;
  ?>
</urlset>
