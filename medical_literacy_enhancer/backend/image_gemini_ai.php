<?php
//error_reporting(0);

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

include('settings.php');


$ai_model = strip_tags($_POST['ai_model']);
$category = strip_tags($_POST['category']);


$file_content = strip_tags($_POST['file_fname']);
	
$timer = time();
$mt = microtime(true);
$mdx = md5($mt);
$uidx = uniqid();
$userid = $uidx.$timer.$mdx;
$tit = $uidx.$timer.$mdx;


if ($file_content == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_image'>Files Upload is empty</div>";
exit();
}


if ($ai_model == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_image'>AI Model is empty</div>";
exit();
}

if ($category == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_image'>Medical Image Category is empty</div>";
exit();
}



$upload_path = "image_uploads/";

$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_image'>File Formats not allowed. Only Images are allowed.<br></div>";
exit();
}


$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];

if ($fsize > 50 * 1024 * 1024) { // allow file of less than 5 mb
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_image'>File greater than 50 mb not allowed<br></div>";
exit();
}



$allowed_types=array(
'image/gif',
'image/jpeg',
'image/png',
'image/jpg',
'image/GIF',
'image/JPEG',
'image/PNG',
'image/JPG'
);

if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {
 echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_image'>Only Images are allowed<br><br></div>";
exit();
}

//validate image using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);


if ( ! ( in_array($mime, $allowed_types) ) ) {
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_image'>Only Images are allowed...<br></div>";
exit();
}
finfo_close($finfo);

$final_filename =$userid.$filename_string;


if($category =='Lab Results'){
$text_prompt ="What is in this image.? Is it a Medical Lab Result. Explained what is in the image in detail";
}


if($category =='Diseases'){
$text_prompt ="What is in this image.? Is it about Sickness or Disease. What kind of diseases. What causes the Diseases. List Preventive Measures.  List modes of treatment and drugs/medication for treatments. Explained what is in the image in detail";
}



if($category =='Medications-Drugs'){
$text_prompt ="What is in this image.? Is it Drugs, Medication or Injection. How to use those drugs. What sickness does it cure. Explained what is in the image in detail";
}


if (move_uploaded_file($ftmp, $upload_path . $final_filename)) {

//Process the Uploaded Image by AI..

// Start Google Gemini Image Analysis
$url ="https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=$google_gimini_apikey";

//$file_path = $_FILES["file_content"]["name"];

$file_path = "image_uploads/$final_filename";
$mime_type = mime_content_type($file_path);

// Get the image and convert into string 
$img = file_get_contents($file_path); 
// Encode the image string data into base64 
$image_base64 = base64_encode($img); 
 
$data_param ='{
"contents":[
    {
      "parts":[
        {"text": "'.$text_prompt.'"},
        {
          "inline_data": {
            "mime_type":"'.$mime_type.'",
            "data": "'.$image_base64.'"
          }
        }
      ]
    }
  ]
}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_param);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($ch); 


if($output == ''){
echo "<div id='alerts_image' style='background:red;color:white;padding:10px;border:none;'>API Call to Google Gemini AI Failed. Ensure there is an Internet  Connections...</div><br>";
exit();
}

$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// catch error message before closing
if (curl_errno($ch)) {
   //echo $error_msg = curl_error($ch);
}

curl_close($ch);



$json = json_decode($output, true);
$id_content = $json['candidates'][0]['content']['parts'][0]['text'];

$mx_error = $json["error"]["message"];
if($mx_error != ''){
echo "<div id='alerts_imagea' style='background:red;color:white;padding:10px;border:none;'>Google Gemini API Error Message: $mx_error.</div><br>";
//exit();
}


if($http_status == 400){
echo "<div id='alerts_image' style='background:red;color:white;padding:10px;border:none;'>Inavlid Argument. Request Body is Malformed. Ensure that Google Gemini API Key is Correct.
 or Also ensures that you Enable billing on your Project in Google AI Studio.</div><br>";
exit();
}

if($http_status == 429){
echo "<div id='alerts_image' style='background:red;color:white;padding:10px;border:none;'>Google Gemini Resource Exhausted. You have Exceeded your Resource Rate Limit</div><br>";
exit();
}

if($http_status == 403){
echo "<div id='alerts_image' style='background:red;color:white;padding:10px;border:none;'>Permission Denied. Your Google Gemini API Key does  not have the required permission</div><br>";
exit();
}

if($http_status == 401){
echo "<div id='alerts_image' style='background:red;color:white;padding:10px;border:none;'> Google Gemini API key or token was invalid, expired, or revoked.</div><br>";
exit();
}

if($http_status == 404){
echo "<div id='alerts_image' style='background:red;color:white;padding:10px;border:none;'>Google Gemini requested resource API Model was not found</div><br>";
exit();
}

if($http_status == 500){
echo "<div id='alerts_image' style='background:red;color:white;padding:10px;border:none;'>An issue occurred on the Google Gemini server side</div><br>";
exit();
}


if($http_status == 200){
//echo "<div style='background:green;color:white;padding:10px;border:none;'>Google Gemini API Call Successful....</div><br>";

if($id_content != ''){
//echo "<div style='background:green;color:white;padding:10px;border:none;'>Google Gemini API Response Successfully Generated....</div><br>";
$content = $json['candidates'][0]['content']['parts'][0]['text'];
       

// remove or unlink uploaded files once analysis is completed
unlink("image_uploads/$final_filename");


echo "<div class='clear_res'> 
<div class='well'> 
<div class='clear_res' style='background:green;color:white;padding:10px;border:none;'>Medical Data Successfully Analyzed by Google Gemini AI....</div><br>
<button class='btn btn-danger clear_btn' style='float:right'>Clear Result</button><br>
<h3>AI Model: $ai_model</h3>
<b>AI Response:</b><br>
$content

<br><button class='btn btn-danger clear_btn' style='float:right'>Clear Result</button><br>
</div></div>";

}
}

// end Google Gemini Image Analysis




}// close file upload

}


?>


















