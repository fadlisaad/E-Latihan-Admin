/* XMLHTTPRequest Enable */
function createObject() {
var request_type;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");
} else {
request_type = new XMLHttpRequest();
}
return request_type;
}
var http = createObject();

/* -------------------------- */
/* SAVE TEXT */

var nocache = 0;
var text = '';
function saveText(textId){
textId_n = encodeURI(document.getElementById('textId').value);
textIDGlobal = textId_n;
nocache = Math.random();
http.open('get', 'penyata_pendapatan_edit.php?newText='+textId_n+'&nocache = '+nocache);
http.onreadystatechange = saveTextReply;
http.send(null);
}
function saveTextReply(){
if(http.readyState == 4){
var response = http.responseText;
document.getElementById(textIDGlobal).innerHTML = response;
}