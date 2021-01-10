<?php

//proxy source url
//https://www.my-proxy.com/free-proxy-list-$i.html

//initialize curl resource
$curl = curl_init();

//curl settings
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,false);
curl_setopt($curl, CURLOPT_USERAGENT,'Chrome/87.0.4280.77');
//curl_setopt($curl,CURLOPT_URL, 'https://www.my-proxy.com/free-proxy-list-1.html');

//echo curl_exec($curl);

$proxies =array();
$start_count =1;
$end_count =10;

curl_setopt($curl,CURLOPT_URL, "http://www.laessigeparty.at/events");
//execute curl url
$result =curl_exec($curl);
//echo $result; die();

/*for($i=$start_count; $i <=$end_count; $i++) {
    //create url
    curl_setopt($curl,CURLOPT_URL, "https://www.my-proxy.com/free-proxy-list-$i.html");

    //execute curl url
    $result =curl_exec($curl);
    //echo $result; die();

    //match proxies - 85.209.151.216:8085
    preg_match_all("!\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}:\d{2,4}!", $result,$matches);
   // print_r($matches); die();

    //save proxies in array
    $proxies = array_merge($proxies, $matches[0]);
}
//close curl resource
curl_close($curl);
print_r($proxies);*/

?>
