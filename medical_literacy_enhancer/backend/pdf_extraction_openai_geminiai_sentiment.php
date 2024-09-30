
<?php
//error_reporting(0);
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

include('settings.php');

$file_name= strip_tags($_POST['file_name']);
$chatbot_ai = strip_tags($_POST['chatbot_ai']);

// Include Composer autoloader if not already done.
include './pdfparser/vendor/autoload.php';

// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile("pdf_uploads/$file_name");
$text = $pdf->getText();

if($text !=''){

// remove or unlink uploaded files once extraction is completed
unlink("pdf_uploads/$file_name");

echo "<div style='color:white;background:green;padding:10px;'>Step 2.) PDF File Documents Extraction Successful</div>";

$content = $text;


// remove all special characters except space,comma etc.
$content_sanitized = preg_replace('/[^A-Za-z0-9,. ]/', '', $content);



//Check if OpenAI ChatGPT API Key has been Set
if($chatgpt_accesstoken == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_sentiment2'>Contact Admin to Set  OpenAi ChatGPT API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}


// Check if Google Gemini API Key has been Set
if($google_gimini_apikey == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_sentiment2'>Contact Admin to Set Google Gemin API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}


if ($content == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_sentiment2'>AI Content to be Analyzed cannot be empty</div>";
exit();
}

if ($chatbot_ai == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_sentiment2'>Please Select AI Model to be used..</div>";
exit();
}


$text_prompt ="is there any sentiment in this text. Yes there is a sentiment in this Text Content or No there is no sentiment in this Text Content. Classify Sentiments a Positive, Negative or Neutral.  If yes what are your reasons. if No what are your reasons. $content_sanitized";




// Start ChatGPT Text Analysis

if($chatbot_ai=='Open_AI'){


$url ="https://api.openai.com/v1/chat/completions";
$data_param ='{
    "model": "gpt-4o",
    "messages": [
      {
        "role": "user",
        "content": "'.$text_prompt.'"
      }
    ]
  }';



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $chatgpt_accesstoken"));  
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_param);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($ch); 

if($output == ''){
echo "<div id='alerts_sentiment2x' style='background:red;color:white;padding:10px;border:none;'>API Call to Chatgpt AI Failed. Ensure there is an Internet  Connections...</div><br>";
exit();
}

$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// catch error message before closing
if (curl_errno($ch)) {
   //echo $error_msg = curl_error($ch);
}

curl_close($ch);



$json = json_decode($output, true);
$id = $json["id"];

$mx_error = $json["error"]["message"];
if($mx_error != ''){
echo "<div id='alerts_sentiment2a' style='background:red;color:white;padding:10px;border:none;'>Chatgpt API Error Message: $mx_error.</div><br>";
//exit();
}

if($http_status == 400){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT request was malformed or missing some required parameters</div><br>";
exit();
}

if($http_status == 429){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>You have hit your OpenAI/ChatGPT assigned rate limit.</div><br>";
exit();
}

if($http_status == 403){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>You have exceeded the allowed number of tokens in your OpenAI/ChatGPT request.</div><br>";
exit();
}

if($http_status == 401){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'> OpenAI/ChatGPT API key or token was invalid, expired, or revoked.</div><br>";
exit();
}

if($http_status == 404){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT requested resource API Model was not found</div><br>";
exit();
}

if($http_status == 500){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>An issue occurred on the OpenAI/ChatGPT server side</div><br>";
exit();
}

if($http_status == 403){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT API key or token lacks the required permissions</div><br>";
exit();
}

if($http_status == 200){
//echo "<div style='background:green;color:white;padding:10px;border:none;'>Chatgpt API Call Successful....</div><br>";

if($id != ''){
//"<div class='clear_res' style='background:green;color:white;padding:10px;border:none;'>Content Successfully Generated by ChatGPT/OpenAI....</div><br>";
$content_generated = $json["choices"][0]["message"]["content"];

echo "<div class='clear_res'> 
<div class='well'> 
<div class='clear_res' style='background:green;color:white;padding:10px;border:none;'>Content Successfully Generated by ChatGPT/OpenAI....</div><br>
<button class='btn btn-danger clear_btn' style='float:right'>Clear Result</button><br>
<h3>AI Model: $chatbot_ai</h3>
<h4 style='display:none;'>Analyzed Data: $content</h4>
<b>Generated Response:</b><br>
$content_generated 

<br><button class='btn btn-danger clear_btn' style='float:right'>Clear Result</button><br>
</div></div>";


}
}


}

// end ChatGpt Text Analysis




// Start Google Gemini Text Analysis

if($chatbot_ai=='Gemini_AI'){
$url ="https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key=$google_gimini_apikey";


$payload ='{
      "contents": [{
        "parts":[{
          "text":  "'.$text_prompt.'"}]}]}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($ch); 


if($output == ''){
echo "<div id='alerts_sentiment2x' style='background:red;color:white;padding:10px;border:none;'>API Call to Google Gemini AI Failed. Ensure there is an Internet  Connections...</div><br>";
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
echo "<div id='alerts_sentiment2a' style='background:red;color:white;padding:10px;border:none;'>Google Gemini API Error Message: $mx_error.</div><br>";
//exit();
}


if($http_status == 400){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>Inavlid Argument. Request Body is Malformed. Ensure that Google Gemini API Key is Correct.
 or Also ensures that you Enable billing on your Project in Google AI Studio.</div><br>";
exit();
}

if($http_status == 429){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>Google Gemini Resource Exhausted. You have Exceeded your Resource Rate Limit</div><br>";
exit();
}

if($http_status == 403){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>Permission Denied. Your Google Gemini API Key does  not have the required permission</div><br>";
exit();
}

if($http_status == 401){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'> Google Gemini API key or token was invalid, expired, or revoked.</div><br>";
exit();
}

if($http_status == 404){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>Google Gemini requested resource API Model was not found</div><br>";
exit();
}

if($http_status == 500){
echo "<div id='alerts_sentiment2' style='background:red;color:white;padding:10px;border:none;'>An issue occurred on the Google Gemini server side</div><br>";
exit();
}


if($http_status == 200){
//echo "<div style='background:green;color:white;padding:10px;border:none;'>Google Gemini API Call Successful....</div><br>";

if($id_content != ''){
//echo "<div class='clear_res' style='background:green;color:white;padding:10px;border:none;'>Content Successfully Generated by Google Gemini AI</div><br>";
$content_generated = $json['candidates'][0]['content']['parts'][0]['text'];

echo "<div class='clear_res'> 
<div class='well'> 
<div class='clear_res' style='background:green;color:white;padding:10px;border:none;'>Content Successfully Generated by Gemini AI....</div><br>
<button class='btn btn-danger clear_btn' style='float:right'>Clear Result</button><br>
<h3>AI Model: $chatbot_ai</h3>
<h4 style='display:none;'>Analyzed Data: $content</h4>
<b>Generated Response:</b><br>
$content_generated 

<br><button class='btn btn-danger clear_btn' style='float:right'>Clear Result</button><br>
</div></div>";
              
// Remove special characters except comma fullstop and space
//$message = preg_replace('/[^A-Za-z0-9,. ]/', '', $docs_content);
//$val = str_replace(',', ',<br>', $content);
//$val2 = str_replace('.', '<br>', $content);

}
}


}
// end Google Gemini Text Analysis









}
else {
echo "<div style='color:white;background:red;padding:10px;'>PDF File Documents Extraction Failed. Please Check Internet Connections</div>";
}   


}
else{
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}


?>
