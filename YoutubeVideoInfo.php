<?php 
/**
*
* @ Package : YoutubeVideoInfo
* @ Gets Video Some Limited Video Information
* @ Author : Rayhan Sardar
* @ Email : rayhan.host@gmail.com
* @ WebSite : https://tubebd24.com
*
**/ 
Class YoutubeVideoInfo { 
/**
*
* @ Initial Start
* @ Package YoutubeVideiInfo
*
**/ 
public function __construct($url) { 
$this->id = $this->setID($url); 
} 
/**
*
* @ Checks Whether Video Is Valid
* @ Returns Boolean
*
**/ 
public function is_valid() { 
if(!empty(self::get_data)) { 
return TRUE; 
} else { 
return FALSE; 
} 
} 
/**
*
* @ This Function Is Gonna Get All Video Info
* @ No Parameters Required
* @ Returns Array
*
**/ 
public function get_data() { 
$content = self::get_content('https://www.youtube.com/get_video_info?video_id='.$this->id); 
parse_str($content,$output); 
$output = array( 
"title" => $output['title'],
"author" => $output['author'],
"runtime" => gmdate('H:i:s',$output['length_seconds']),
"thumbnail" => $output['thumbnail_url'],
"rating" => round($output['avg_rating'],1),
"keywords" => $output['keywords'],
"views" => $output['view_count'] 
); 
return $output; 
}  
/**
*
* @ This Function Extracts The Video ID from URL
* @ Parameters => $url(string)
* @ Return Video ID(string)
*
**/ 
private function setID($url) { 
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match); 
return $match[1]; 
}  
/**
*
* @ This Function Gets the Full Source Code of a WebPage
* @ Parameters => $url(string)
* @ Returns String
*
**/ 
public function get_content($url) { 
if(function_exists('curl_version')) { 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_ENCODING , "gzip");
$output = curl_exec($ch);
curl_close($ch);
return $output; 
} else { 
return file_get_contents($url); 
} 
}  
}
