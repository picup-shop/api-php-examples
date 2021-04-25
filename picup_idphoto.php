<?php
require_once __DIR__.'/config.php';

$path = "/api/v1/idphoto/printLayout";

$url = $API_BASE_URL.$path;

$headers = array();
array_push($headers, "APIKEY:".$API_KEY);
//����API��Ҫ�󣬶������Ӧ��Content-Type
array_push($headers, "Content-Type".":"."application/json; charset=UTF-8");
$image_data = file_get_contents(__DIR__."/input/idphoto.jpg") ;


$base64 = base64_encode($image_data);
$requestBody = array(
    "base64"=>$base64,
    "bgColor"=>"438EDB",#֤���ձ���ɫ����ʽΪʮ������RGB�� �磺3557FF
    "dpi"=>300, #֤���մ�ӡdpi, һ��Ϊ300
    "mmHeight"=>35, #֤��������߶ȣ���λΪ����
    "mmWidth"=>25, #֤���������ȣ���λΪ����
    "printBgColor"=>"FFFFFF", #�Ű汳��ɫ����ʽΪʮ������RGB�� �磺FFFCF9
    "printMmHeight"=>152, #��ӡ���Ű�ߴ磬��λΪ����, ���Ϊ0��С��֤���ճߴ��򲻻���д�ӡ�Ű棬�������֤����
    "printMmWidth"=>102, #��ӡ���Ű�ߴ磬��λΪ����, ���Ϊ0��С��֤���ճߴ��򲻻���д�ӡ�Ű棬�������֤����
    "dress"=>"man8", #��װ�������Ǳ�����޲���ʱ����װ��Ϊ����+��װ��Ÿ�ʽ������ man1 ��ʿ��һ����װͼ�� woman3 Ůʿ��������װ��child5 ��ͯ�������װ����װ�����۳�һ�������
    "printMarginMm"=>5 #��ӡ���Ű���ⲿԤ���ռ�ߴ磬�Ǳ�����
);


$bodyStr = json_encode($requestBody);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl , CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl , CURLOPT_POST, 1);

curl_setopt($curl, CURLOPT_POSTFIELDS, $bodyStr);

$result = curl_exec($curl);
var_dump($result) ;
$result = json_decode($result,true);
var_dump($result["data"]["idPhotoImage"]);