Medical Literacy Enhancer:

An Interactive System that allows Patients to easily simplifies complex medical information into easy-to-understandable form.
It easily analyze Medical Documents for data Language Translations, Summarizations, Sentiments ,Keywords, Entity and Medical Images Analysis
( Eg. Scanned Lab Results,Image of Diseases etc.) leveraging ChatGPT/OpenAI and Google Gemini AI



How To Test the Application Locally:

This application was written in PHP, Ajax, JQUERY, Bootstraps, Css, Mysql etc.



1.)You will need to Download and  install Xampp Server. After installation, ensure that Apache has been started and Running from 
Xampp Control Panel.

2.) Download and Unzip the main application folder from github eg. medical_literacy_enhancer.zip to xampp htdocs directories e.g  C:\xampp\htdocs.  After unzipping the 
directory will look like  C:\xampp\htdocs\medical_literacy_enhancer

3.) Edit Settings.php at /backend/settings.php to update your ChatGPT/OpenAI API Keys,Google Gemini API Key and other Parameters where appropriates.


4.) Download PDF Parser Library at https://github.com/smalot/pdfparser   . This is used to extract text from the pdf documents.


Then unzip it directly into the main application backend folder. 
eg medical_literacy_enhancer/backend so  that the folder structure will be like medical_literacy_enhancer/backend/pdfparser.

The zipped folder name must be name pdfparser.
 
Ensure that you have composer installed. then in windows open command prompt and cd into application pdfparser directory Eg.

cd medical_literacy_enhancer/backend/pdfparser  press enter  button and next run the command below


composer require smalot/pdfparser



This command above will install the pdfparser


4.) Callup the application on the browser Eg http://localhost/medical_literacy_enhancer/index.php

5.)Thank You





API Used

1.) Open Sourced Html Text Editor Markdown: https://github.com/markedjs/marked

2.) ChatGPT/OpenAI: https://platform.openai.com

To obtain Chatgpt API Keys. Goto this link below and signup https://beta.openai.com/account/api-keys

After that go to this link and get and generate ChatGPT api key and click on View API Keys https://platform.openai.com/account/api-keys

3.) Google Gemini AI :
To get started with Google Gemini AI and to get the API Key, visit https://github.com/google-gemini/cookbook/

4.) Open Source PDF Parser:  <b>PDF parser library(https://github.com/smalot/pdfparser)</b> to extract text from the pdf Medical documents.
