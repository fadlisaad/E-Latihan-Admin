<html>
<head>
<!-- AJAX AUTOSUGGEST SCRIPT -->
<script type="text/javascript">
/* ---------------------------- */
/* XMLHTTPRequest Enable 		*/
/* ---------------------------- */
function createObject() {
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
	request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		request_type = new XMLHttpRequest();
	}
		return request_type;
}

var http = createObject();

/* -------------------------- */
/* SEARCH					 */
/* -------------------------- */
function autosuggest() {
q = document.getElementById('search-q').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/search.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autosuggestReply;
http.send(null);
}
function autosuggestReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('results');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
</script>
</head>
<body>

<div id="search-wrap">
<h1>Search with Auto Suggest</h1>
<input name="search-q" id="search-q" type="text" onKeyUp="javascript:autosuggest()"/>
<div id="results"></div>
</div>

</body>
</html> 