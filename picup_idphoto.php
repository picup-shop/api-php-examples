<?php
require_once __DIR__.'/config.php';

$path = "/api/v1/idphoto/printLayout";

$url = $API_BASE_URL.$path;

$headers = array();
array_push($headers, "APIKEY:".$API_KEY);
//根据API的要求，定义相对应的Content-Type
array_push($headers, "Content-Type".":"."application/json; charset=UTF-8");
$image_data = file_get_contents(__DIR__."/input/idphoto.jpg") ;


$base64 = base64_encode($image_data);
$requestBody = array(
    "base64"=>$base64,
    "bgColor"=>"438EDB",#证件照背景色，格式为十六进制RGB， 如：3557FF
    "dpi"=>300, #证件照打印dpi, 一般为300
    "mmHeight"=>35, #证件照物理高度，单位为毫米
    "mmWidth"=>25, #证件照物理宽度，单位为毫米
    "printBgColor"=>"FFFFFF", #排版背景色，格式为十六进制RGB， 如：FFFCF9
    "printMmHeight"=>152, #打印的排版尺寸，单位为毫米, 如果为0或小于证件照尺寸则不会进行打印排版，输出单张证件照
    "printMmWidth"=>102, #打印的排版尺寸，单位为毫米, 如果为0或小于证件照尺寸则不会进行打印排版，输出单张证件照
    "dress"=>"man8", #换装参数，非必填项，无参数时不换装，为类型+换装编号格式，比如 man1 男士第一个换装图， woman3 女士第三个换装，child5 儿童第五个换装。换装需额外扣除一个点点数
    "printMarginMm"=>5 #打印的排版的外部预留空间尺寸，非必填项
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