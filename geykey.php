<?php
function GetKeywordrank($domain,$keywords){
    $i = 1; $hit = 0;
    $domain = substr($domain, 0, 7) == 'http://' ? substr($domain, 7) : $domain;
    $domain = substr($domain, -1) == '/' ? substr_replace($domain, '', -1) : $domain;
    $keywords = strstr($keywords, ' ') ? str_replace(' ', '+', $keywords) : $keywords;
    $html = new DOMDocument();
    @$html->loadHtmlFile('http://google.com.vn/search?q='.$keywords.'&oq='.$keywords.'&ie=UTF-8&num=100');
    ($xpath = new DOMXPath($html));
    $nodes = $xpath->query('//div[1]/cite');
    $hit = 2;
    foreach ($nodes as $n){
        if (strstr($n->nodeValue, $domain)) {
            $message = $i; $hit = 1;
        }
        else { ++$i;
        }}
    if($hit==1){
        return $message;
    }else{
        return 0;
    }}
echo $e =GetKeywordrank("blogteen.mobi","tai game cun yeu");
?>