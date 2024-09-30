<?php 
//error_reporting(0);
include('backend/settings.php');

//Check if OpenAI ChatGPT API Key has been Set
if($chatgpt_accesstoken == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Contact Admin to Set  OpenAi ChatGPT API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}


// Check if Google Gemini API Key has been Set
if($google_gimini_apikey == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Contact Admin to Set Google Gemin API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}


//  check if directory pdfparser exist inside the backend  folder
$dirname = "backend/pdfparser";

if (file_exists($dirname)) {
    //echo "The directory pdfparser exists.";

} else {
    
 echo "<div style='background:red;padding:8px;color:white;border:none;'>Directory <b>pdfpaser</b> does not exist  in <b>(/medical_literacy_enhancer/backend/)</b> Directory of the app.  you will need to 
install pdf parser library that will be used for pdf text content Extraction.<br><br> Please refer to readme.txt at no 4. to see how to download and install
pdf parser library, Thanks</div>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <title>Medical Literacy Enhancer</title>
  <meta name="description" content="" />

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="bootstraps/bootstrap.min.css">
<script src="jquery/jquery.min.js"></script>
<script src="bootstraps/bootstrap.min.js"></script>
 <script src="markdown/marked.min.js"></script>

  <script src="js/script.js"></script>
</head>
<body>
  <nav>
<h2 style='color:white;'>Medical Literacy Enhancer</h2>
 
    <ul style='display:none;'>
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>


<br><br><br><br>

  <div class="containerx">

    <div class="content">

      <h1 style='font-size:36px'>Medical Literacy Enhancer</h1>
      <p style='font-size:20px'>An Interactive System that allows Patients to easily simplifies complex medical information into easy-to-understandable form.<br>


It easily analyze Medical Documents for data <b>Language Translations, Summarizations, Sentiments ,Keywords,
Entity and Medical Images Analysis( Eg. Scanned Lab Results,Image of Diseases etc.) </b> leveraging <span style='color:purple'>ChatGPT/OpenAI and Google Gemini AI</span></b></p>
<br>
It analysis Patients <b>Text Data, PDF Data and Medical Images</b><br>

<div class='row'>

<div class='col-sm-4 data_cssx'>
<b style='font-size:16px'>Medical Documents Summarizer</b><br>


Easily Summarize Medical Documents to <b> Save Time and Energy</b>


<br>
<a style='color:white;background:#800000;border:none;padding:10px;font-size:12px;' class="btn btn-info btn-sm btn_call" data-toggle="modal" data-target="#myModal_summary" 
 title='Summarize' > Summarize </a>
</div>

<div class='col-sm-4 data_cssx'>
<b style='font-size:16px'>Medical Documents Sentiments Analysis</b><br>

 Analyze Medical Documents for sentiments <b>Positivity, negativity or neutrality</b> statements.



<br>

<a style='color:white;background:#800000;border:none;padding:10px;font-size:12px;' class="btn btn-info btn-sm btn_call" data-toggle="modal" data-target="#myModal_sentiments" 
 title='Sentiments'> Sentiments </a>

</div>



<div class='col-sm-4 data_cssx'>
<b style='font-size:16px'>Medical Documents Entities Analysis</b><br>

 Analyze Medical Documents and list all the <b>People, Doctors, Drugs, Medications, Hospital Locations and all the entities</b>in the Medical Documents



<br>

<a style='color:white;background:#800000;border:none;padding:10px;font-size:12px;' class="btn btn-info btn-sm btn_call" data-toggle="modal"
 data-target="#myModal_entities" 
 title='Entities'> Entities </a>

</div>







<div class='col-sm-4 data_cssx'>
<b style='font-size:16px'>Medical Documents Keywords Analysis</b><br>

 Analyze Medical Documents to  pin-point all the <b>Keywords, keyphrases</b> in the Patients Medical Data



<br>


<a style='color:white;background:#800000;border:none;padding:10px;font-size:12px;' class="btn btn-info btn-sm btn_call" data-toggle="modal"
 data-target="#myModal_keyword" 
 title='Keywords' > Keywords</a>

</div>




<div class='col-sm-4 data_cssx'>
<b style='font-size:16px'>Medical Documents Data Translations</b><br>

Easily Translate Patients Medical Data from one Language to another to help break <b>Language barrier</b>

<br>

<a style='color:white;background:#800000;border:none;padding:10px;font-size:12px;' class="btn btn-info btn-sm btn_call" data-toggle="modal" data-target="#myModal_translate" 
 title='Translate'> Translate </a>

</div>






<div class='col-sm-4 data_cssx'>
<b style='font-size:16px'>Medical Image Documents Analysis</b><br>

  Upload and analyze Patients Medical Image Data <b>Eg. Images of Patients Scanned Lab Results,Images of Patients Diseases etc.</b>




<br>

<a style='color:white;background:purple;border:none;padding:10px;font-size:12px;' class="btn btn-info btn-sm btn_call" 
data-toggle="modal" data-target="#myModal_image" 
 title='Image Documents' > Analyze Images Data </a>
</div>




<center>
<div class='col-sm-4'></div>
<div class='col-sm-4 data_cssx'>
<b style='font-size:16px'>AI ChatBot</b><br>

 You still have questions related to <b>health</b>, Chat with AI Bot below




<br>

<a style='color:white;background:fuchsia;border:none;padding:10px;font-size:12px;' class="btn btn-info btn-sm btn_call" 
data-toggle="modal" data-target="#myModal_chat" 
 title='Chat Now' >Chat Now </a>
</div>

<div class='col-sm-4'></div>
</center>






</div><br>






    </div>
  </div>









<!-- AI Sentiments Detection Modal starts here -->


<div class="containerx">

  <div class="modal fade" id="myModal_sentiments" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h3 class="modal-title">Detect and Analyze Sentiments in a Patients Medical Data.</h3>

        </div>
        <div class="modal-body">



<!-- start-->

<h4 style='color:#8B0000'> Analyze Patients Medical Data for Sentiments Positivity, Negativity or Neutrality Statements...</h4>

You can analyze both <b> Text & PDF</b> Patients Medical Data<br>
<br>


<div class="form-group">
<label style="">Select AI to be used for Analysis ..</label><br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai4" name="chatbot_ai4" value="Open_AI" class="chatbot_ai4"/>
ChatGPT/OpenAI<br>
</div>

<div class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai4" name="chatbot_ai4" value="Gemini_AI" class="chatbot_ai4"/>
Google Gemini AI<br>
</div>
<br>

<center>

<h3>Analyze Patients Text Medical Data For Sentiments</h3>
</center>



<div class="form-group">
<label>Enter Text Medical Data. <span style='color:red'>(Copy and Paste Here)</span></label>
<input type='' id='content4' class='form-control col-sm-12' placeholder='Enter Text Content' />
</div>   

</div>

<br><br>
<div class="row">

<div class="col-sm-12">

<div class='' id="loader_sentiment"></div>
<div class='clear_res' id="result_sentiment"></div>
<div class='sentiment_btn btn_css' >Analyze Patients Text Medical Data for Sentiments</div><br>





<center><h1>OR</h1>

<h3>Analyze Patients PDF File Medical Data For Sentiments</h3>
</center>


   <div class="form-group">
<label style="">Select Patients PDF Medical File: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content" name="file_content" accept="pdf/*" />
</div><br>



 <div class="form-group  col-sm-12">
                <div class='clear_res'><div class="upload_progress" style="width:0%">0%</div></div>
                        <div id="loader_pdf" class='clear_res'></div>
                        <div id="result_pdf" class='clear_res'></div>
<br>
                    <input type="button" id="sentiment_upload_btn" class="pull-right btn btn-primary" value="Analyze Patients PDF Medical Data for Sentiments" />
         </div>




</div>
</div>

<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>


<!-- AI Sentiments Detection Modal ends here -->







<!-- AI Summarize Detection Modal starts here -->


<div class="containerx">

  <div class="modal fade" id="myModal_summary" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h3 class="modal-title">Summarize Patients Medical Data..</h3>

        </div>
        <div class="modal-body">



<!-- start-->

<h4 style='color:#8B0000'> Patients Medical Data Content Summarization....</h4>

You can summarize both <b> Text & PDF</b> Patients Medical Data<br>
<br>


<div class="form-group">
<label style="">Select AI to be used for Analysis ..</label><br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai5" name="chatbot_ai5" value="Gemini_AI" class="chatbot_ai5"/>
Google Gemini AI<br>
</div>

<div style='' class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai5" name="chatbot_ai5" value="Open_AI" class="chatbot_ai5"/>
ChatGPT/OpenAI<br>
</div>
<br>

<center>

<h3>Summarize Patients Text Medical Data</h3>
</center>



<br>
<div class="form-group">
<label>Enter Text Content. <span style='color:red'>(Copy and Paste Here)</span></label>
<input type='' id='content5' class='form-control col-sm-12' placeholder='Enter Text Content' />
</div>


<div class="form-group">
<label>Select Summary No. of Sentences </label>
<select id='sentence' class='form-control col-sm-12'>
<option value=''>--Select Summary No. of Sentences--</option>
<option value='one(1)'>Summarize in 1 Sentences</option>
<option value='two(2)'>Summarize in 2 Sentences</option>
<option value='three(3)'>Summarize in 3 Sentences</option>
<option value='four(4)'>Summarize in 4 Sentences</option>
<option value='five(5)'>Summarize in 5 Sentences</option>
</select>
</div>



</div>

<br><br>
<div class="row">

<div class="col-sm-12">

<div class='' id="loader_summarize"></div>
<div class='clear_res' id="result_summarize"></div>
<div class='summarize_btn btn_css' >Summarize Text Contents</div><br>






<center><h1>OR</h1>

<h3>Summarize Patients PDF Medical Data</h3>
</center>


   <div class="form-group">
<label style="">Select Patients PDF Medical File: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content2" name="file_content2" accept="pdf/*" />
</div><br>



<div class="form-group">
<label>Select Summary No. of Sentences </label>
<select id='sentence2' class='form-control col-sm-12'>
<option value=''>--Select Summary No. of Sentences--</option>
<option value='one(1)'>Summarize in 1 Sentences</option>
<option value='two(2)'>Summarize in 2 Sentences</option>
<option value='three(3)'>Summarize in 3 Sentences</option>
<option value='four(4)'>Summarize in 4 Sentences</option>
<option value='five(5)'>Summarize in 5 Sentences</option>
</select>
</div>



 <div class="form-group  col-sm-12">
                <div class='clear_res'><div class="upload_progress2" style="width:0%">0%</div></div>
                        <div id="loader_pdf2" class='clear_res'></div>
                        <div id="result_pdf2" class='clear_res'></div>
<br>
                    <input type="button" id="summary_upload_btn" class="pull-right btn btn-primary" value="Summarize Patients PDF Medical Data" />
         </div>



</div>
</div>

<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>


<!-- AI Summarization Modal ends here -->













<!-- AI Enties Detection Modal starts here -->


<div class="containerx">

  <div class="modal fade" id="myModal_entities" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h3 class="modal-title">Analyze Medical Documents and list all all the Entities in the Medical Documents.</h3>

        </div>
        <div class="modal-body">



<!-- start-->

<h4 style='color:#8B0000'> Analyze Medical Documents and list all the <b>People, Doctors, Drugs, Medications, Hospital Locations and all the entities </b>in the Medical Documents.</h4>

You can analyze both <b> Text & PDF</b> Patients Medical Data<br>
<br>


<div class="form-group">
<label style="">Select AI to be used for Analysis ..</label><br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai7" name="chatbot_ai7" value="Open_AI" class="chatbot_ai7"/>
ChatGPT/OpenAI<br>
</div>

<div class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai7" name="chatbot_ai7" value="Gemini_AI" class="chatbot_ai7"/>
Google Gemini AI<br>
</div>
<br>

<center>

<h3>Run Entities Analysis Patients Text Medical Data</h3>
</center>



<div class="form-group">
<label>Enter Text Medical Data. <span style='color:red'>(Copy and Paste Here)</span></label>
<input type='' id='content7' class='form-control col-sm-12' placeholder='Enter Text Content' />
</div>   

</div>

<br><br>
<div class="row">

<div class="col-sm-12">

<div class='' id="loader_entity"></div>
<div class='clear_res' id="result_entity"></div>
<div class='entity_btn btn_css' >Run Patients Text Medical Data for Entities Analaysis</div><br>





<center><h1>OR</h1>

<h3>Run Entity Analysis of Patients PDF File Medical Data</h3>
</center>


   <div class="form-group">
<label style="">Select Patients PDF Medical File: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content3" name="file_content3" accept="pdf/*" />
</div><br>



 <div class="form-group  col-sm-12">
                <div class='clear_res'><div class="upload_progress3" style="width:0%">0%</div></div>
                        <div id="loader_pdf3" class='clear_res'></div>
                        <div id="result_pdf3" class='clear_res'></div>
<br>
                    <input type="button" id="entity_upload_btn" class="pull-right btn btn-primary" value="Run Patients PDF Medical Data for Entity Analysis" />
         </div>




</div>
</div>

<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>


<!-- AI Entities Detection Modal ends here -->











<!-- AI Keywords Detection Modal starts here -->


<div class="containerx">

  <div class="modal fade" id="myModal_keyword" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h3 class="modal-title">Analyze all Keywords and Keyphrases in the Medical Documents.</h3>

        </div>
        <div class="modal-body">



<!-- start-->

<h4 style='color:#8B0000'> Analyze Medical Documents and list all the <b>Keywords and Keyphrases </b>in the Medical Documents.</h4>

You can analyze both <b> Text & PDF</b> Patients Medical Data<br>
<br>


<div class="form-group">
<label style="">Select AI to be used for Analysis ..</label><br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai8" name="chatbot_ai8" value="Open_AI" class="chatbot_ai8"/>
ChatGPT/OpenAI<br>
</div>

<div class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai8" name="chatbot_ai8" value="Gemini_AI" class="chatbot_ai8"/>
Google Gemini AI<br>
</div>
<br>

<center>

<h3>Keywords Analysis of Patients Text Medical Data</h3>
</center>



<div class="form-group">
<label>Enter Text Medical Data. <span style='color:red'>(Copy and Paste Here)</span></label>
<input type='' id='content8' class='form-control col-sm-12' placeholder='Enter Text Content' />
</div>   

</div>

<br><br>
<div class="row">

<div class="col-sm-12">

<div class='' id="loader_keyword"></div>
<div class='clear_res' id="result_keyword"></div>
<div class='keyword_btn btn_css' >Run Patients Text Medical Data for Keywords Analaysis</div><br>





<center><h1>OR</h1>

<h3>Keywords Analysis of Patients PDF File Medical Data</h3>
</center>


   <div class="form-group">
<label style="">Select Patients PDF Medical File: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content8" name="file_content8" accept="pdf/*" />
</div><br>



 <div class="form-group  col-sm-12">
                <div class='clear_res'><div class="upload_progress4" style="width:0%">0%</div></div>
                        <div id="loader_pdf4" class='clear_res'></div>
                        <div id="result_pdf4" class='clear_res'></div>
<br>
                    <input type="button" id="keyword_upload_btn" class="pull-right btn btn-primary" value="Run Patients PDF Medical Data for Keywords Analysis" />
         </div>




</div>
</div>

<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>


<!-- AI Keywords Detection Modal ends here -->














<!-- AI Translate Detection Modal starts here -->


<div class="containerx">

  <div class="modal fade" id="myModal_translate" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h3 class="modal-title">Translate Patients Medical Data..</h3>

        </div>
        <div class="modal-body">



<!-- start-->

<h4 style='color:#8B0000'> Patients Medical Data Content Language Translations....</h4>

You can Translate both <b> Text & PDF</b> Patients Medical Data<br>
<br>


<div class="form-group">
<label style="">Select AI to be used for Analysis ..</label><br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai9" name="chatbot_ai9" value="Gemini_AI" class="chatbot_ai9"/>
Google Gemini AI<br>
</div>

<div style='' class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai9" name="chatbot_ai9" value="Open_AI" class="chatbot_ai9"/>
ChatGPT/OpenAI<br>
</div>
<br>

<center>

<h3>Translate Patients Text Medical Data</h3>
</center>



<br>
<div class="form-group">
<label>Enter Text Content. <span style='color:red'>(Copy and Paste Here)</span></label>
<input type='' id='content9' class='form-control col-sm-12' placeholder='Enter Text Content' />
</div>


 <div class="form-group col-sm-12">
              <label> Select Language for Translation: </label>


<select class="col-sm-12 form-control" id="lang" name="lang">
    <option value=''>--- Select Languages ----</option>
    <option value="Arabic">Arabic</option>
    <option value="Bengali">Bengali</option>
    <option value="Bosnian">Bosnian</option>
    <option value="Chinese">Chinese</option>
    <option value="Croatian">Croatian</option>
    <option value="Czech">Czech</option>
    <option value="Danish">Danish</option>
    <option value="Dutch - Nederlands">Dutch - Nederlands</option>
    <option value="Estonian">Estonian</option>
    <option value="Finnish">Finnish</option>
    <option value="French">French</option>
    <option value="Galician">Galician</option>
    <option value="Georgian">Georgian</option>
    <option value="German">German</option>
    <option value="Greek">Greek</option>
    <option value="Guarani">Guarani</option>
    <option value="Gujarati">Gujarati</option>
    <option value="Hausa">Hausa</option>
    <option value="Hawaiian">Hawaiian</option>
    <option value="Hindi">Hindi</option>
    <option value="Hebrew">Hebrew</option>
    <option value="Hungarian">Hungarian</option>
    <option value="Icelandic">Icelandic</option>
    <option value="Indonesian">Indonesian</option>
    <option value="Irish">Irish</option>
    <option value="Italian">Italian</option>
    <option value="Japanese">Japanese</option>
    <option value="Kannada">Kannada</option>
    <option value="Korean">Korean</option>
    <option value="Kurdish">Kurdish - Kurdî</option>
    <option value="Kyrgyz">Kyrgyz</option>
    <option value="Lao">Lao</option>
    <option value="latin">Latin</option>
    <option value="Latvian">Latvian</option>
    <option value="Lingala">Lingala</option>
    <option value="Lithuanian">Lithuanian</option>
    <option value="Macedonian">Macedonian</option>
    <option value="Malay">Malay</option>
    <option value="Malayalam">Malayalam</option>
    <option value="Maltese">Maltese</option>
    <option value="Marathi">Marathi</option>
    <option value="Mongolian">Mongolian</option>
    <option value="Nepali">Nepali</option>
    <option value="Norwegian">Norwegian</option>
    <option value="Persian">Persian </option>
    <option value="Polish">Polish</option>
    <option value="Portuguese">Portuguese</option>
    <option value="Punjabi">Punjabi</option>
    <option value="Romanian">Romanian</option>
    <option value="Russian">Russian</option>
    <option value="Scottish">Scottish</option>
    <option value="Serbian">Serbian</option>
    <option value="Serbo-Croatian">Serbo-Croatian</option>
    <option value="Slovenian">Slovenian</option>
    <option value="Somali">Somali</option>
    <option value="Spanish">Spanish</option>
    <option value="Sundanese">Sundanese</option>
    <option value="Swedish">Swedish</option>
    <option value="Tajik">Tajik</option>
    <option value="Tamil">Tamil</option>
    <option value="Telugu">Telugu</option>
    <option value="Turkish">Turkish</option>
    <option value="Turkmen">Turkmen</option>
    <option value="Ukrainian">Ukrainian</option>
    <option value="Urdu">Urdu</option>
    <option value="Vietnamese">Vietnamese</option>
</select>

            </div>



</div>

<br><br>
<div class="row">

<div class="col-sm-12">

<div class='' id="loader_translate"></div>
<div class='clear_res' id="result_translate"></div>
<div class='translate_btn btn_css' >Translate Text Contents</div><br>






<center><h1>OR</h1>

<h3>Translate Patients PDF Medical Data</h3>
</center>


   <div class="form-group">
<label style="">Select Patients PDF Medical File: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content9" name="file_content9" accept="pdf/*" />
</div><br>




 <div class="form-group col-sm-12">
              <label> Select Language for Translation: </label>


<select class="col-sm-12 form-control" id="lang2" name="lang2">
    <option value=''>--- Select Languages ----</option>
    <option value="Arabic">Arabic</option>
    <option value="Bengali">Bengali</option>
    <option value="Bosnian">Bosnian</option>
    <option value="Chinese">Chinese</option>
    <option value="Croatian">Croatian</option>
    <option value="Czech">Czech</option>
    <option value="Danish">Danish</option>
    <option value="Dutch - Nederlands">Dutch - Nederlands</option>
    <option value="Estonian">Estonian</option>
    <option value="Finnish">Finnish</option>
    <option value="French">French</option>
    <option value="Galician">Galician</option>
    <option value="Georgian">Georgian</option>
    <option value="German">German</option>
    <option value="Greek">Greek</option>
    <option value="Guarani">Guarani</option>
    <option value="Gujarati">Gujarati</option>
    <option value="Hausa">Hausa</option>
    <option value="Hawaiian">Hawaiian</option>
    <option value="Hindi">Hindi</option>
    <option value="Hebrew">Hebrew</option>
    <option value="Hungarian">Hungarian</option>
    <option value="Icelandic">Icelandic</option>
    <option value="Indonesian">Indonesian</option>
    <option value="Irish">Irish</option>
    <option value="Italian">Italian</option>
    <option value="Japanese">Japanese</option>
    <option value="Kannada">Kannada</option>
    <option value="Korean">Korean</option>
    <option value="Kurdish">Kurdish - Kurdî</option>
    <option value="Kyrgyz">Kyrgyz</option>
    <option value="Lao">Lao</option>
    <option value="latin">Latin</option>
    <option value="Latvian">Latvian</option>
    <option value="Lingala">Lingala</option>
    <option value="Lithuanian">Lithuanian</option>
    <option value="Macedonian">Macedonian</option>
    <option value="Malay">Malay</option>
    <option value="Malayalam">Malayalam</option>
    <option value="Maltese">Maltese</option>
    <option value="Marathi">Marathi</option>
    <option value="Mongolian">Mongolian</option>
    <option value="Nepali">Nepali</option>
    <option value="Norwegian">Norwegian</option>
    <option value="Persian">Persian </option>
    <option value="Polish">Polish</option>
    <option value="Portuguese">Portuguese</option>
    <option value="Punjabi">Punjabi</option>
    <option value="Romanian">Romanian</option>
    <option value="Russian">Russian</option>
    <option value="Scottish">Scottish</option>
    <option value="Serbian">Serbian</option>
    <option value="Serbo-Croatian">Serbo-Croatian</option>
    <option value="Slovenian">Slovenian</option>
    <option value="Somali">Somali</option>
    <option value="Spanish">Spanish</option>
    <option value="Sundanese">Sundanese</option>
    <option value="Swedish">Swedish</option>
    <option value="Tajik">Tajik</option>
    <option value="Tamil">Tamil</option>
    <option value="Telugu">Telugu</option>
    <option value="Turkish">Turkish</option>
    <option value="Turkmen">Turkmen</option>
    <option value="Ukrainian">Ukrainian</option>
    <option value="Urdu">Urdu</option>
    <option value="Vietnamese">Vietnamese</option>
</select>

            </div>



 <div class="form-group  col-sm-12">
                <div class='clear_res'><div class="upload_progress5" style="width:0%">0%</div></div>
                        <div id="loader_pdf5" class='clear_res'></div>
                        <div id="result_pdf5" class='clear_res'></div>
<br>
                    <input type="button" id="translate_upload_btn" class="pull-right btn btn-primary" value="Translate Patients PDF Medical Data" />
         </div>



</div>
</div>

<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>


<!-- AI Summarization Modal ends here -->












<!-- Image AI  Modal starts -->



<div id="myModal_image" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">

    <div class="modal-content">

      <!-- Modal Header -->
<div class="modal-header" style="color:black;background:#c1c1c1">
        <h4 class="modal-title">Medical Data Image Analysis</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">


<div class="form-group">
<label style="">Select Images <b>(Eg. Images of Patients Scanned Lab Results, Images of Drugs/Medications,Images of Patients Diseases etc.)</b></label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content10" name="file_content10" accept="image/*" onchange="imagePreview(event)" />
 <img id="imageupload_preview"  class="clear_res" />
</div><br>





<div class="form-group col-sm-12">
<label style="">Select Medical Image Category</label><br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="category" name="category" value="Lab Results" class="category"/>
Scanned Lab Results Analysis<br>
</div>

<div class='col-sm-6 ai_css'>
<input type="radio" id="category" name="category" value="Diseases" class="category"/>
Diseases Analysis<br>
</div>


</div>
<br>

<div class="form-group">
<label style="">Pick AI Model to be Used</label><br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="ai_model10" name="ai_model10" value="OpenAI ChatGPT" class="ai_model10"/>
OpenAI ChatGPT<br>
</div>

<div class='col-sm-6 ai_css'>
<input type="radio" id="ai_model10" name="ai_model10" value="Google Gemini AI" class="ai_model10"/>
Google Gemini AI<br>
</div>


</div>


<br>

 <div class="form-group col-sm-12">
                           <div class='clear_res'> <div id="alerts_imagex" class="upload_progress10 clear_res" style="width:0%">0%</div></div>
                        <div class="clear_res" id="loaderx_image"></div>
						<div class="clear_res" id="loader_image"></div>
                        <div class="clear_res result_image"></div>
                    </div>

                    <input type="button" id="image_btn" class="btn_css" value="Analyze Image Data" />


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- Image AI  Modal ends -->










<!-- AI Chat Modal starts here -->


<div class="containerx">

  <div class="modal fade" id="myModal_chat" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h3 class="modal-title">Chat With ChatGPT/OpenAI or Google Gemini AI</h3>

        </div>
        <div class="modal-body">



<!-- start-->

<h4 style='color:#8B0000'>Chat With ChatGPT/OpenAI or Google Gemini AI on Health related Issues...</h4>


<div class="form-group">
<label style="">Select AI to be used for Analysis ..</label><br>

<div class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai_chat" name="chatbot_ai_chat" value="Gemini_AI" class="chatbot_ai_chat"/>
Google Gemini AI<br>
</div>

<div  class='col-sm-6 ai_css'>
<input type="radio" id="chatbot_ai_chat" name="chatbot_ai_chat" value="Open_AI" class="chatbot_ai_chat"/>
ChatGPT/OpenAI<br>
</div>






</div>

<br><br>
<div class="row">

<div class="col-sm-12">


<div class='clear_res' id="result_chat"></div>
<div class='' id="loader_chat"></div>

<br>
<div class="form-group">
<label>Enter Chat Message</label>
<textarea id='chat_msg' cols='3' rows='3' class='form-control col-sm-12' placeholder='Enter Chat Message'></textarea>
</div>


<div class='chat_btn btn_css  col-sm-12' >Chat Now!</div><br>


</div>
</div>

<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>


<!-- AI Chat Modal ends here -->








</body>
</html>