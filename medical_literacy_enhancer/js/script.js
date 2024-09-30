

// PDF Medical Files Uploads and Extractions for Sentiments Analysis starts

$(document).ready(function(){
$('#sentiment_upload_btn').click(function () {
var file_fname = $('#file_content').val();
var chatbot_ai = $(".chatbot_ai4:checked").val();


// start if validate

if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
 else if(file_fname==""){
alert('please Select Medical PDF File to Upload');
}
else{

var fname=  $('#file_content').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["pdf", "PDF"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a valid PDF Documents");
return false;
    }

          var form_data = new FormData();
          form_data.append('file_content', $('#file_content')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('chatbot_ai', chatbot_ai);
                    $('.upload_progress').css('width', '0');

                    $('#loader_pdf').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px"><img src="loader.gif">&nbsp;Please Wait, Medical File is being Uploaded and Processed for Sentiments....</div>');
                    $.ajax({
                        url:'backend/pdf_upload_sentiment.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress').css('width', upload_percent + '%');
                                    $('.upload_progress').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader_pdf').hide();
				$('#result_pdf').html(msg);
				


//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (Successful) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successful/g) || []).length;
//alert(bcount);

if(bcount > 0){
//$('#file_content').val('');
}




                        }
                    });
} // end if validate




                });
            });





// PDF Medical Files Uploads and Extractions for Sentiments Analysis Ends






// ChatGPT/Gemini AI for Sentiments Starts

$(document).ready(function(){
$(".sentiment_btn").click(function(){

var chatbot_ai = $(".chatbot_ai4:checked").val();
var content = $('#content4').val();
if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
if(content ==''){
alert('Text Content to be Analyze for Sentiments cannot be empty');
return false;
}




$("#loader_sentiment").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Analyzing Medical Data for Sentiments Detection....</span>');

        $.ajax({
            url: 'backend/sentiment_text_openai_geminiai.php',
            type: 'post',
            data: {content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_sentiment").hide();
$("#result_sentiment").html(marked.parse(data));
$('#alerts_sentiment').delay(5000).fadeOut('slow');
$('#alerts_sentiment').delay(5000).fadeOut('slow');
$("#content4").val('');
 }
 });

});
});

// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_sentiments').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   $('.clear_res').empty();  
 console.log("modal closed and content cleared");
 });
});

// ChatGPT/Gemini AI for Sentiments Starts









// PDF Medical Files Uploads and Extractions for Summary Analysis starts

$(document).ready(function(){
$('#summary_upload_btn').click(function () {
var file_fname = $('#file_content2').val();
var chatbot_ai = $(".chatbot_ai5:checked").val();
var sentence = $('#sentence2').val();


// start if validate

if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
 else if(file_fname==""){
alert('please Select Medical PDF File to Upload');
}

else if(sentence ==''){
alert(' Content Summary no. of Sentences cannot be empty');
return false;
}


else{

var fname=  $('#file_content2').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["pdf", "PDF"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a valid PDF Documents");
return false;
    }

          var form_data = new FormData();
          form_data.append('file_content', $('#file_content2')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('chatbot_ai', chatbot_ai);
form_data.append('sentence', sentence);
                    $('.upload_progress2').css('width', '0');

                    $('#loader_pdf2').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px"><img src="loader.gif">&nbsp;Please Wait, Medical File is being Uploaded and Processed for Summarization....</div>');
                    $.ajax({
                        url:'backend/pdf_upload_summary.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress2').css('width', upload_percent + '%');
                                    $('.upload_progress2').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader_pdf2').hide();
				$('#result_pdf2').html(msg);
				


//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (Successful) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successful/g) || []).length;
//alert(bcount);

if(bcount > 0){
//$('#file_content2').val('');
}




                        }
                    });
} // end if validate




                });
            });





// PDF Medical Files Uploads and Extractions for Summarize Analysis Ends



// ChatGPT/Gemini AI for summarize Starts

$(document).ready(function(){
$(".summarize_btn").click(function(){

var chatbot_ai = $(".chatbot_ai5:checked").val();
var content = $('#content5').val();
var sentence = $('#sentence').val();
if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
if(content ==''){
alert('Text Content to be Summarize cannot be empty');
return false;
}

if(sentence ==''){
alert('Text Content Summary no. of Sentences cannot be empty');
return false;
}


$("#loader_summarize").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Summarizing Text Contents....</span>');

        $.ajax({
            url: 'backend/summarize_text_openai_geminiai.php',
            type: 'post',
            data: {content:content,chatbot_ai:chatbot_ai, sentence:sentence},
            dataType: 'html',
            success: function(data){
$("#loader_summarize").hide();
$("#result_summarize").html(marked.parse(data));
$('#alerts_summarize').delay(5000).fadeOut('slow');
$('#alerts_summarize').delay(5000).fadeOut('slow');
$("#content5").val('');
 }
 });

});
});

// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_summary').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   $('.clear_res').empty();  
 console.log("modal closed and content cleared");
 });
});

// ChatGPT/Gemini AI for summarize Starts









// PDF Medical Files Uploads and Extractions for Entities Analysis starts

$(document).ready(function(){
$('#entity_upload_btn').click(function () {
var file_fname = $('#file_content3').val();
var chatbot_ai = $(".chatbot_ai7:checked").val();


// start if validate

if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
 else if(file_fname==""){
alert('please Select Medical PDF File to Upload');
}
else{

var fname=  $('#file_content3').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["pdf", "PDF"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a valid PDF Documents");
return false;
    }

          var form_data = new FormData();
          form_data.append('file_content', $('#file_content3')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('chatbot_ai', chatbot_ai);
                    $('.upload_progress3').css('width', '0');

                    $('#loader_pdf3').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px"><img src="loader.gif">&nbsp;Please Wait, Medical File is being Uploaded and Processed for Entity Analysis....</div>');
                    $.ajax({
                        url:'backend/pdf_upload_entity.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress3').css('width', upload_percent + '%');
                                    $('.upload_progress3').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader_pdf3').hide();
				$('#result_pdf3').html(msg);
				


//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (Successful) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successful/g) || []).length;
//alert(bcount);

if(bcount > 0){
//$('#file_content3').val('');
}




                        }
                    });
} // end if validate




                });
            });





// PDF Medical Files Uploads and Extractions for Entity Analysis Ends






// ChatGPT/Gemini AI for Entity Starts

$(document).ready(function(){
$(".entity_btn").click(function(){

var chatbot_ai = $(".chatbot_ai7:checked").val();
var content = $('#content7').val();
if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
if(content ==''){
alert('Text Content to be Analyze for Entitie cannot be empty');
return false;
}




$("#loader_entity").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Analyzing Medical Data for Entities Detection....</span>');

        $.ajax({
            url: 'backend/entity_text_openai_geminiai.php',
            type: 'post',
            data: {content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_entity").hide();
$("#result_entity").html(marked.parse(data));
$('#alerts_entitya').delay(5000).fadeOut('slow');
$('#alerts_entity').delay(5000).fadeOut('slow');
$("#content7").val('');
 }
 });

});
});

// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_entities').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   $('.clear_res').empty();  
 console.log("modal closed and content cleared");
 });
});

// ChatGPT/Gemini AI for entities Starts








// PDF Medical Files Uploads and Extractions for keyword Analysis starts

$(document).ready(function(){
$('#keyword_upload_btn').click(function () {
var file_fname = $('#file_content8').val();
var chatbot_ai = $(".chatbot_ai8:checked").val();


// start if validate

if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
 else if(file_fname==""){
alert('please Select Medical PDF File to Upload');
}
else{

var fname=  $('#file_content8').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["pdf", "PDF"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a valid PDF Documents");
return false;
    }

          var form_data = new FormData();
          form_data.append('file_content', $('#file_content8')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('chatbot_ai', chatbot_ai);
                    $('.upload_progress4').css('width', '0');

                    $('#loader_pdf4').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px"><img src="loader.gif">&nbsp;Please Wait, Medical File is being Uploaded and Processed for Keyword Analysis....</div>');
                    $.ajax({
                        url:'backend/pdf_upload_keyword.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress4').css('width', upload_percent + '%');
                                    $('.upload_progress4').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader_pdf4').hide();
				$('#result_pdf4').html(msg);
				


//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (Successful) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successful/g) || []).length;
//alert(bcount);

if(bcount > 0){
//$('#file_content8').val('');
}




                        }
                    });
} // end if validate




                });
            });





// PDF Medical Files Uploads and Extractions for keyword Analysis Ends






// ChatGPT/Gemini AI for keyword Starts

$(document).ready(function(){
$(".keyword_btn").click(function(){

var chatbot_ai = $(".chatbot_ai8:checked").val();
var content = $('#content8').val();
if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
if(content ==''){
alert('Text Content to be Analyze for Sentiments cannot be empty');
return false;
}




$("#loader_keyword").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Analyzing Medical Data for Keywords Detection....</span>');

        $.ajax({
            url: 'backend/keyword_text_openai_geminiai.php',
            type: 'post',
            data: {content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_keyword").hide();
$("#result_keyword").html(marked.parse(data));
$('#alerts_keyworda').delay(5000).fadeOut('slow');
$('#alerts_keyword').delay(5000).fadeOut('slow');
$("#content8").val('');
 }
 });

});
});

// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_keyword').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   $('.clear_res').empty();  
 console.log("modal closed and content cleared");
 });
});

// ChatGPT/Gemini AI for keyword Starts




$(document).ready(function(){
//$(".clear_btn").click(function(){
$(document).on( 'click', '.clear_btn', function(){ 

$('.clear_res').empty();  
alert('AI Responses Cleared Successfully..');

});
});







// PDF Medical Files Uploads and Extractions forTranslation Analysis starts

$(document).ready(function(){
$('#translate_upload_btn').click(function () {
var file_fname = $('#file_content9').val();
var chatbot_ai = $(".chatbot_ai9:checked").val();
var lang = $('#lang2').val();


// start if validate

if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
 else if(file_fname==""){
alert('please Select Medical PDF File to Upload');
}

else if(lang ==''){
alert('Language Translation cannot be empty');
return false;
}


else{

var fname=  $('#file_content9').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["pdf", "PDF"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a valid PDF Documents");
return false;
    }

          var form_data = new FormData();
          form_data.append('file_content', $('#file_content9')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('chatbot_ai', chatbot_ai);
form_data.append('lang', lang);
                    $('.upload_progress5').css('width', '0');

                    $('#loader_pdf5').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px"><img src="loader.gif">&nbsp;Please Wait, Medical File is being Uploaded and Processed for Translation....</div>');
                    $.ajax({
                        url:'backend/pdf_upload_translate.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress5').css('width', upload_percent + '%');
                                    $('.upload_progress5').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader_pdf5').hide();
				$('#result_pdf5').html(msg);
				


//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (Successful) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successful/g) || []).length;
//alert(bcount);

if(bcount > 0){
//$('#file_content9').val('');
}




                        }
                    });
} // end if validate




                });
            });





// PDF Medical Files Uploads and Extractions for translate Analysis Ends



// ChatGPT/Gemini AI for translate Starts

$(document).ready(function(){
$(".translate_btn").click(function(){

var chatbot_ai = $(".chatbot_ai9:checked").val();
var content = $('#content9').val();
var lang = $('#lang').val();
if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
if(content ==''){
alert('Text Content to be Translated cannot be empty');
return false;
}

if(lang ==''){
alert('Language for Translation cannot be empty');
return false;
}


$("#loader_translate").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Translating Text Contents....</span>');

        $.ajax({
            url: 'backend/translate_text_openai_geminiai.php',
            type: 'post',
            data: {content:content,chatbot_ai:chatbot_ai, lang:lang},
            dataType: 'html',
            success: function(data){
$("#loader_translate").hide();
$("#result_translate").html(marked.parse(data));
$('#alerts_translatea').delay(5000).fadeOut('slow');
$('#alerts_translate').delay(5000).fadeOut('slow');
$("#content9").val('');
 }
 });

});
});

// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_translate').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   $('.clear_res').empty();  
 console.log("modal closed and content cleared");
 });
});

// ChatGPT/Gemini AI for translate ends




// AI ImageAnalysis starts

function imagePreview(e) 
{
 var readImage = new FileReader();
 readImage.onload = function()
 {
  var displayImage = document.getElementById('imageupload_preview');
  displayImage.src = readImage.result;
 }
 readImage.readAsDataURL(e.target.files[0]);
}


            $(function () {
                $('#image_btn').click(function () {
				
                    var file_fname = $('#file_content10').val();
                    var ai_model = $(".ai_model10:checked").val();
                    var category = $(".category:checked").val();

// start if validate
if(file_fname==""){
alert('please Select File to Upload');
}

else if(ai_model==undefined){
alert('please Select Your AI Model..');
}

else if(category==undefined){
alert('please Select Medical Image Category..');
}

else{

var fname=  $('#file_content10').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a Valid image. Only Images Files are allowed");
return false;
    }


          var form_data = new FormData();
          form_data.append('file_content', $('#file_content10')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('ai_model', ai_model);
          form_data.append('category', category);



if(ai_model =='Google Gemini AI'){

                    $('.upload_progress10').css('width', '0');
					$('#loaderx').hide();
                    $('#loader_image').fadeIn(400).html('<br><div class="well" style="color:black"><img src="loader.gif">&nbsp;Please Wait, Your Medical Image Data being Processed By Google Gemini AI.</div>');
                    $.ajax({
                        url: 'backend/image_gemini_ai.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress10').css('width', upload_percent + '%');
                                    $('.upload_progress10').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader_image').hide();
				$('.result_image').fadeIn('slow').prepend(marked.parse(msg));
				$('#alerts_image').delay(5000).fadeOut('slow');
                                $('#alerts_imagea').delay(5000).fadeOut('slow');
                                $('#alerts_imagex').delay(5000).fadeOut('slow');
                              
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_content10').val('');
this.checked = false;  //javascript
$("input:radio").attr("checked", false);
//$(this).prop('checked', false);
}

}
});
}// end gemini AI if Statement








if(ai_model =='OpenAI ChatGPT'){

                    $('.upload_progress10').css('width', '0');
					$('#loaderx').hide();
                    $('#loader_image').fadeIn(400).html('<br><div class="well" style="color:black"><img src="loader.gif">&nbsp;Please Wait, Your Medical Image Data is being Processed By OpenAI chatGPT.</div>');
                    $.ajax({
                        url: 'backend/image_chatgpt_ai.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress10').css('width', upload_percent + '%');
                                    $('.upload_progress10').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader_image').hide();
				$('.result_image').fadeIn('slow').prepend(marked.parse(msg));
				$('#alerts_image').delay(5000).fadeOut('slow');
                                $('#alerts_imagea').delay(5000).fadeOut('slow');
                                $('#alerts_imagex').delay(5000).fadeOut('slow');
                              
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_content10').val('');
this.checked = false;  //javascript
$("input:radio").attr("checked", false);
//$(this).prop('checked', false);
}

}
});
}// end  OpenAI if Statement





} // end if validate




                });
            });

// AI Image Analysis  ends





// ChatGPT/Gemini AI for chat Starts

$(document).ready(function(){
$(".chat_btn").click(function(){

var chatbot_ai = $(".chatbot_ai_chat:checked").val();
var content = $('#chat_msg').val();

if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used for AI Analysis.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}
if(content ==''){
alert('Chat Text Message cannot be empty');
return false;
}



$("#loader_chat").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Sending Chat Message....</span>');

        $.ajax({
            url: 'backend/chat_text_openai_geminiai.php',
            type: 'post',
            data: {content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_chat").hide();
//$("#result_chat").html(marked.parse(data));
$('#result_chat').fadeIn('slow').prepend(marked.parse(data));
$('#alerts_chat').delay(5000).fadeOut('slow');
$('#alerts_chata').delay(5000).fadeOut('slow');
$("#chat_msg").val('');
 }
 });

});
});

// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_chat').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   $('.clear_res').empty();  
 console.log("modal closed and content cleared");
 });
});

// ChatGPT/Gemini AI for Chats Starts


$(document).ready(function(){
//$(".clear_btn").click(function(){
$(document).on( 'click', '.clear_btn', function(){ 

$('.clear_res').empty();  
alert('AI Responses Cleared Successfully..');

});
});

