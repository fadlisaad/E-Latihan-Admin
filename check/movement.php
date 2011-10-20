<!-- AJAX AUTOSUGGEST SCRIPT -->
<script type="text/javascript" src="ajax_movement.js"></script>

<style type="text/css">
/* ---------------------------- */
/* CUSTOMIZE AUTOSUGGEST STYLE	*/
#search-wrap input{width:200px; font-size:12px; color:#999999; padding:6px; border:solid 1px #999999;}
#results{width:260px; border:solid 1px #DEDEDE; display:none;}
#results ul, #results li{padding-left:210px; margin:0; border:0; list-style:none;}
#results li {border-top:solid 1px #DEDEDE;}
#results li a{display:block; padding:4px; text-decoration:none; color:#000000; font-weight:bold;}
#results li a small{display:block; text-decoration:none; color:#999999; font-weight:normal;}
#results li a:hover{background:#FFFFCC;}
#results ul {padding:6px;}
</style>
<div id="search-wrap">
<input name="search-q" id="search-q" type="text" onkeyup="javascript:autosuggest()"/>
<div id="results"></div>
</div>
