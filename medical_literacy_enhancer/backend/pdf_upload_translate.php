<?php
error_reporting(0);

include ('settings.php');

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

$file_content = strip_tags($_POST['file_fname']);
$chatbot_ai = strip_tags($_POST['chatbot_ai']);
$lang = strip_tags($_POST['lang']);


$mt_id=rand(0000,9999);
$dt2=date("Y-m-d H:i:s");
$ipaddress = strip_tags($_SERVER['REMOTE_ADDR']);
$timer = time();

$tm ="$mt_id$timer--";




if ($file_content == ''){
echo "<div style='background:red;color:white;padding:8px;border:none;'>Files Upload is empty</div>";
exit();
}


if ($lang == ''){
echo "<div style='background:red;color:white;padding:8px;border:none;'>Language for translation Cannot be Empty</div>";
exit();
}



$upload_path = "pdf_uploads/";


$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("pdf", "PDF");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div style='background:red;color:white;padding:8px;border:none;'> Only PDF Documents are allowed.<br></div>";
exit();
}




$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];
//$file_uploadname = $tm.$filename_string;
$file_uploadname = $filename_string;

if ($fsize > 30 * 1024 * 1024) { // allow file of less than 30 mb
echo "<div id='alertdata' class='alerts alert-danger'>File greater than 30mb not allowed<br></div>";
exit();
}

// Check if file already exists
if (file_exists($upload_path . $file_uploadname)) {
//echo "<div style='background:red;color:white;padding:8px;border:none;'>This uploaded File <b>$file_uploadname</b> already exist<br></div>";
//exit(); 
}


$allowed_types=array(
'application/json',
'application/octet-stream',
'text/plain',
'application/pdf',
'application/x-pdf'

);



if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only PDF allowed..<br><br></div>";
exit();
}



//validate image using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);
if ( ! ( in_array($mime, $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only pdf are allowed...<br></div>";
exit();
}
finfo_close($finfo);


if (move_uploaded_file($ftmp, $upload_path . $file_uploadname)) {

//echo  "<script>alert('File Uploads Successful...');</script>";
echo "<br><div style='background:green;padding:8px;color:white;border:none;'>step 1.) File Uploads Successful...</div><br>";

echo "
<script>
$(document).ready(function(){

var file_name = '$file_uploadname';
var chatbot_ai = '$chatbot_ai';
var lang = '$lang';
if(file_name==''){
alert('File Documents Cannot be Empty');

}
else if(sentence==''){
alert('No. of Sentences for Medical File Summarization Cannot be Empty');

}

else{

$('#loader_translate2').fadeIn(400).html('<br><div style=color:black;background:#ddd;padding:10px;><img src=loader.gif style=font-size:20px> &nbsp;Please Wait! .Extracting Text from the Uploaded Medical Files and Performing translation Analysis</div>');
var datasend = {file_name:file_name,chatbot_ai:chatbot_ai, lang:lang};


$.ajax({
			
			type:'POST',
			url:'backend/pdf_extraction_openai_geminiai_translate.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

                        $('#loader_translate2').hide();
				//$('#result_ex').fadeIn('slow').prepend(msg);
$('#result_translate2').html(marked.parse(msg));
$('#alerts_translate2').delay(5000).fadeOut('slow');
$('#alerts_translate2a').delay(5000).fadeOut('slow');
$('#file_content9').val('');
$('#lang2').val('');			
			}
			
		});
		
		}
		
					
	});


</script>




<br>
<div class=''>
<div id='loader_translate2'></div>
<div id='result_translate2'></div>
</div>

";



}else{
echo "<div style='background:red;padding:8px;color:white;border:none;'>File Uploads Failed...</div>";

}


}
else{
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}


?>



