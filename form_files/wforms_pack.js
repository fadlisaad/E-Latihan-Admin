function wHELPERS(){
}
wHELPERS.prototype.addEvent=function(_1,_2,fn){
if(!_1){
return;
}
if(_1.attachEvent){
_1["e"+_2+fn]=fn;
_1[_2+fn]=function(){
_1["e"+_2+fn](window.event);
};
_1.attachEvent("on"+_2,_1[_2+fn]);
}else{
if(_1.addEventListener){
_1.addEventListener(_2,fn,false);
}else{
var _4=_1["on"+_2];
if(_4){
_1["on"+_2]=function(e){
_4(e);
fn(e);
};
}else{
_1["on"+_2]=fn;
}
}
}
};
wHELPERS.prototype.removeEvent=function(_6,_7,fn){
if(_6.detachEvent){
if(_6[_7+fn]){
_6.detachEvent("on"+_7,_6[_7+fn]);
_6[_7+fn]=null;
}
}else{
if(_6.removeEventListener){
_6.removeEventListener(_7,fn,false);
}else{
_6["on"+_7]=null;
}
}
};
wHELPERS.prototype.getSourceElement=function(e){
if(!e){
e=window.event;
}
if(e.target){
var _a=e.target;
}else{
var _a=e.srcElement;
}
if(!_a){
return null;
}
if(_a.nodeType==3){
_a=_a.parentNode;
}
if(_a.tagName.toUpperCase()=="LABEL"&&e.type=="click"){
if(_a.getAttribute("for")){
_a=document.getElementById(_a.getAttribute("for"));
}
}
return _a;
};
wHELPERS.prototype.preventEvent=function(e){
if(!e){
e=window.event;
}
if(e.preventDefault){
e.preventDefault();
}else{
e.returnValue=false;
}
return false;
};
wHELPERS.prototype.stopPropagation=function(e){
if(!e){
var e=window.event;
}
e.cancelBubble=true;
if(e.stopPropagation){
e.stopPropagation();
}
};
wHELPERS.prototype.randomId=function(){
var _d=(new Date()).getTime();
_d=_d.toString().substr(6);
for(var i=0;i<6;i++){
_d+=String.fromCharCode(48+Math.floor((Math.random()*10)));
}
return "id-"+_d;
};
wHELPERS.prototype.activateStylesheet=function(_f){
if(document.getElementsByTagName){
var ss=document.getElementsByTagName("link");
}else{
if(document.styleSheets){
var ss=document.styleSheets;
}
}
for(var i=0;ss[i];i++){
if(ss[i].href.indexOf(_f)!=-1){
ss[i].disabled=true;
ss[i].disabled=false;
}
}
};
wHELPERS.prototype.hasClass=function(_12,_13){
if(_12&&_12.className){
if((" "+_12.className+" ").indexOf(" "+_13+" ")!=-1){
return true;
}
}
return false;
};
wHELPERS.prototype.hasClassPrefix=function(_14,_15){
if(_14&&_14.className){
if((" "+_14.className).indexOf(" "+_15)!=-1){
return true;
}
}
return false;
};
wHELPERS.prototype.hasIdPrefix=function(_16,_17){
if(_16&&_16.id){
if(_16.id.indexOf(_17)!=-1){
return true;
}
}
return false;
};
wHELPERS.prototype.getTop=function(obj){
var cur=0;
if(obj.offsetParent){
while(obj.offsetParent){
if((new wHELPERS()).getComputedStyle(obj,"position")=="relative"){
return cur;
}
cur+=obj.offsetTop;
obj=obj.offsetParent;
}
}
return cur;
};
wHELPERS.prototype.getLeft=function(obj){
var cur=0;
if(obj.offsetParent){
while(obj.offsetParent){
if((new wHELPERS()).getComputedStyle(obj,"position")=="relative"){
return cur;
}
if((new wHELPERS()).getComputedStyle(obj,"position")=="absolute"){
return cur;
}
cur+=obj.offsetLeft;
obj=obj.offsetParent;
}
}
return cur;
};
wHELPERS.prototype.getComputedStyle=function(_1c,_1d){
if(window.getComputedStyle){
return window.getComputedStyle(_1c,"").getPropertyValue(_1d);
}else{
if(_1c.currentStyle){
return _1c.currentStyle[_1d];
}
}
return false;
};
var wHelpers=wHELPERS;
if(!Array.prototype.push){
Array.prototype.push=function(){
for(var i=0;i<arguments.length;++i){
this[this.length]=arguments[i];
}
return this.length;
};
}
if(wHELPERS){
var wFORMS={debugLevel:0,helpers:new wHELPERS(),behaviors:{},onLoadComplete:new Array(),processedForm:null,onLoadHandler:function(){
for(var _1f in wFORMS.behaviors){
wFORMS.debug("wForms/loaded behavior: "+_1f);
}
for(var i=0;i<document.forms.length;i++){
wFORMS.debug("wForms/initialize: "+(document.forms[i].name||document.forms[i].id));
wFORMS.addBehaviors(document.forms[i]);
}
},addBehaviors:function(_21){
if(!_21){
return;
}
if(!_21.nodeType){
_21=document.getElementById(_21);
}
if(!_21||_21.nodeType!=1){
return;
}
deep=(arguments.length>1)?arguments[1]:true;
wFORMS._addBehaviors(_21,deep);
},_addBehaviors:function(_22,_23){
if(_22.getAttribute("rel")=="no-behavior"){
return false;
}
if(_22.nodeType==1){
if(_22.tagName=="FORM"){
wFORMS.processedForm=_22;
}
for(var _24 in wFORMS.behaviors){
wFORMS.behaviors[_24].evaluate(_22);
}
if(_23){
for(var i=0,cn=_22.childNodes,l=cn.length;i<l;i++){
if(cn[i].nodeType==1){
wFORMS._addBehaviors(cn[i],_23);
}
}
}
if(_22.tagName=="FORM"){
for(var i=0;i<wFORMS.onLoadComplete.length;i++){
wFORMS.onLoadComplete[i].func(wFORMS.onLoadComplete[i].form);
}
if(wFORMS.onLoadComplete.length>0){
wFORMS.onLoadComplete=new Array();
}
}
}
},hasBehavior:function(_26){
if(wFORMS.behaviors[_26]){
return true;
}
return false;
},debug:function(txt){
msgLevel=arguments[1]||10;
if(wFORMS.debugLevel>0&&msgLevel>=wFORMS.debugLevel){
if(!wFORMS.debugOutput){
wFORMS.initDebug();
}
if(wFORMS.debugOutput){
wFORMS.debugOutput.innerHTML+="<br />"+txt;
}
}
},initDebug:function(){
var _28=document.getElementById("debugOutput");
if(!_28){
_28=document.createElement("div");
_28.id="debugOutput";
_28.style.position="absolute";
_28.style.right="10px";
_28.style.top="10px";
_28.style.zIndex="300";
_28.style.fontSize="x-small";
_28.style.fontFamily="courier";
_28.style.backgroundColor="#DDD";
_28.style.padding="5px";
if(document.body){
wFORMS.debugOutput=document.body.appendChild(_28);
}
}
if(wFORMS.debugOutput){
wFORMS.debugOutput.ondblclick=function(){
this.innerHTML="";
};
}
}};
wFORMS.NAME="wForms";
wFORMS.VERSION="2.0";
wFORMS.__repr__=function(){
return "["+this.NAME+" "+this.VERSION+"]";
};
wFORMS.toString=function(){
return this.__repr__();
};
wFORMS.utilities=wFORMS.helpers;
var wf=wFORMS;
wf.utilities.getSrcElement=wFORMS.helpers.getSourceElement;
wf.utilities.XBrowserPreventEventDefault=wFORMS.helpers.preventEvent;
wFORMS.helpers.activateStylesheet("wforms-jsonly.css");
wFORMS.helpers.addEvent(window,"load",wFORMS.onLoadHandler);
}
if(wFORMS){
wFORMS.idSuffix_fieldHint="-H";
wFORMS.className_inactiveFieldHint="field-hint-inactive";
wFORMS.className_activeFieldHint="field-hint";
wFORMS.behaviors["hint"]={name:"hint",evaluate:function(_29){
if(_29.id){
if(_29.id.indexOf(wFORMS.idSuffix_fieldHint)>0){
var id=_29.id.replace(wFORMS.idSuffix_fieldHint,"");
var _2b=document.getElementById(id)||wFORMS.processedForm[id];
}
if(_2b){
if(_2b.length>0&&_2b[0].type=="radio"){
var _2c=_2b;
l=_2b.length;
}else{
var _2c=new Array(_2b);
l=1;
}
for(var i=0;i<l;i++){
_2b=_2c[i];
wFORMS.debug("hint/evaluate: "+(_29.id||_29.name));
switch(_2b.tagName.toUpperCase()){
case "SELECT":
case "TEXTAREA":
case "INPUT":
wFORMS.helpers.addEvent(_2b,"focus",wFORMS.behaviors["hint"].run);
wFORMS.helpers.addEvent(_2b,"blur",wFORMS.behaviors["hint"].remove);
break;
default:
wFORMS.helpers.addEvent(_2b,"mouseover",wFORMS.behaviors["hint"].run);
wFORMS.helpers.addEvent(_2b,"mouseout",wFORMS.behaviors["hint"].remove);
break;
}
}
}
}
},run:function(e){
var _2f=wFORMS.helpers.getSourceElement(e);
var _30=document.getElementById(_2f.id+wFORMS.idSuffix_fieldHint);
if(!_30){
_30=document.getElementById(_2f.name+wFORMS.idSuffix_fieldHint);
}
if(_30){
_30.className=_30.className.replace(wFORMS.className_inactiveFieldHint,wFORMS.className_activeFieldHint);
_30.style.top=(wFORMS.helpers.getTop(_2f)+_2f.offsetHeight).toString()+"px";
if(_2f.tagName.toUpperCase()=="SELECT"){
_30.style.left=(wFORMS.helpers.getLeft(_2f)+(_2f.offsetWidth-8)).toString()+"px";
}else{
_30.style.left=(wFORMS.helpers.getLeft(_2f)).toString()+"px";
}
}
},remove:function(e){
var _32=wFORMS.helpers.getSourceElement(e);
var _33=document.getElementById(_32.id+wFORMS.idSuffix_fieldHint);
if(!_33){
_33=document.getElementById(_32.name+wFORMS.idSuffix_fieldHint);
}
if(_33){
_33.className=_33.className.replace(wFORMS.className_activeFieldHint,wFORMS.className_inactiveFieldHint);
}
}};
}
if(wFORMS){
wFORMS.className_paging="wfPage";
wFORMS.className_pagingCurrent="wfCurrentPage";
wFORMS.className_pagingButtons="wfPageButton";
wFORMS.className_hideSubmit="wfHideSubmit";
wFORMS.idPrefix_pageIndex="wfPgIndex-";
wFORMS.runValidationOnPageNext=true;
if(!wFORMS.arrMsg){
wFORMS.arrMsg=new Array();
}
wFORMS.arrMsg[4]="Next Page";
wFORMS.arrMsg[5]="Previous Page";
wFORMS.behaviors["paging"]={idSuffix_buttonsPlaceholder:"-buttons",className_pageNextButton:wFORMS.className_pagingButtons+" wfPageNextButton",className_pagePreviousButton:wFORMS.className_pagingButtons+" wfPagePreviousButton",behaviorInUse:false,allowNestedPages:false,onPageChange:null,evaluate:function(_34){
if(wFORMS.helpers.hasClass(_34,wFORMS.className_paging)){
if(!wFORMS.behaviors["paging"].allowNestedPages&&wFORMS.behaviors["paging"].getPageElement(_34)){
_34.className=_34.className.replace(wFORMS.className_paging,"");
return;
}
wFORMS.behaviors["paging"].behaviorInUse=true;
var _35=wFORMS.behaviors["paging"].getPageIndex(_34);
if(_35>1){
var _36=this.getButtonPlaceholder(_34);
var _37=_36.insertBefore(this.createPreviousPageButton(),_36.firstChild);
wFORMS.helpers.addEvent(_37,"click",wFORMS.behaviors["paging"].pagingPrevious);
}else{
_34.className+=" "+wFORMS.className_pagingCurrent;
var _38=wFORMS.behaviors["paging"].getFormElement(_34);
wFORMS.helpers.addEvent(_38,"submit",function(e){
var _3a=wFORMS.helpers.getSourceElement(e);
if(_3a.type&&_3a.type.toLowerCase()=="text"){
return wFORMS.preventEvent(e);
}
});
wFORMS.preventSubmissionOnEnter=true;
}
if(document.getElementById(wFORMS.idPrefix_pageIndex+(_35+1).toString())){
var _36=this.getButtonPlaceholder(_34);
var _37=_36.appendChild(this.createNextPageButton());
wFORMS.helpers.addEvent(_37,"click",wFORMS.behaviors["paging"].pagingNext);
if(_35==1){
wFORMS.behaviors["paging"].hideSubmitButton(_38);
}
}
}
},getButtonPlaceholder:function(_3b){
var p=document.getElementById(_3b.id+this.idSuffix_buttonsPlaceholder);
if(!p){
var _3d=document.createElement("div");
_3d=_3b.appendChild(_3d);
_3d.className="actions";
_3d.id=_3b.id+this.idSuffix_buttonsPlaceholder;
return _3d;
}
return p;
},createNextPageButton:function(){
var _3e=document.createElement("input");
_3e.setAttribute("value",wFORMS.arrMsg[4]);
_3e.setAttribute("type","button");
_3e.className=this.className_pageNextButton;
return _3e;
},createPreviousPageButton:function(){
var _3f=document.createElement("input");
_3f.setAttribute("value",wFORMS.arrMsg[5]);
_3f.setAttribute("type","button");
_3f.className=this.className_pagePreviousButton;
return _3f;
},pagingNext:function(e){
var _41=wFORMS.helpers.getSourceElement(e);
if(!_41){
_41=e;
}
var _42=wFORMS.behaviors["paging"].getPageElement(_41);
var _43=wFORMS.behaviors["paging"].getPageIndex(_42)+1;
var _44=document.getElementById(wFORMS.idPrefix_pageIndex+_43.toString());
if(_44){
if(!wFORMS.hasBehavior("validation")||(wFORMS.hasBehavior("validation")&&!wFORMS.runValidationOnPageNext)||(wFORMS.hasBehavior("validation")&&wFORMS.runValidationOnPageNext&&wFORMS.functionName_formValidation(e,true))){
_42.className=_42.className.replace(new RegExp(wFORMS.className_pagingCurrent,"g"),"");
_44.className+=" "+wFORMS.className_pagingCurrent;
if(wFORMS.behaviors["paging"].isLastPage(_43)){
var _45=wFORMS.behaviors["paging"].getFormElement(_44);
wFORMS.behaviors["paging"].showSubmitButton(_45);
}
if(wFORMS.behaviors["paging"].onPageChange){
wFORMS.behaviors["paging"].onPageChange(_44);
}
window.scroll(0,0);
}
}
},pagingPrevious:function(e){
var _47=wFORMS.helpers.getSourceElement(e);
if(!_47){
_47=e;
}
var _48=wFORMS.behaviors["paging"].getPageElement(_47);
var _49=wFORMS.behaviors["paging"].getPageIndex(_48)-1;
var _4a=document.getElementById(wFORMS.idPrefix_pageIndex+_49.toString());
if(_4a){
_48.className=_48.className.replace(new RegExp(wFORMS.className_pagingCurrent,"g"),"");
_4a.className+=" "+wFORMS.className_pagingCurrent;
var _4b=wFORMS.behaviors["paging"].getFormElement(_4a);
wFORMS.behaviors["paging"].hideSubmitButton(_4b);
if(wFORMS.behaviors["paging"].onPageChange){
wFORMS.behaviors["paging"].onPageChange(_4a);
}
window.scroll(0,0);
}
},showSubmitButton:function(_4c){
var _4d=_4c.getElementsByTagName("input");
for(var i=0;i<_4d.length;i++){
if(_4d[i].type&&_4d[i].type.toLowerCase()=="submit"){
_4d[i].className=_4d[i].className.replace(wFORMS.className_hideSubmit,"");
}
}
},hideSubmitButton:function(_4f){
var _50=_4f.getElementsByTagName("input");
for(var i=0;i<_50.length;i++){
if(_50[i].type&&_50[i].type.toLowerCase()=="submit"&&!wFORMS.helpers.hasClass(_50[i],wFORMS.className_hideSubmit)){
_50[i].className+=" "+wFORMS.className_hideSubmit;
}
}
},isLastPage:function(_52){
if(isNaN(_52)){
_52=parseInt(_52.replace(/[\D]*/,""));
}
_52++;
var _53=document.getElementById(wFORMS.idPrefix_pageIndex+_52.toString());
if(!_53){
return true;
}
return false;
},gotoPage:function(_54){
if(isNaN(_54)){
var _55=document.getElementById(_54);
}else{
var _55=document.getElementById(wFORMS.idPrefix_pageIndex+_54.toString());
}
if(!_55){
return false;
}
var _56=wFORMS.behaviors["paging"].getFormElement(_55);
var _57=_56.getElementsByTagName("*");
for(var i=0;i<_57.length;i++){
var n=_57[i];
if(wFORMS.helpers.hasClass(_57[i],wFORMS.className_pagingCurrent)){
n.className=n.className.replace(new RegExp(wFORMS.className_pagingCurrent,"g"),"");
break;
}
}
if(wFORMS.behaviors["paging"].isLastPage(_54)){
wFORMS.behaviors["paging"].showSubmitButton(_56);
}else{
wFORMS.behaviors["paging"].hideSubmitButton(_56);
}
_55.className+=" "+wFORMS.className_pagingCurrent;
if(wFORMS.behaviors["paging"].onPageChange){
wFORMS.behaviors["paging"].onPageChange(_55);
}
},getFormElement:function(_5a){
var _5b=_5a.parentNode;
while(_5b&&_5b.tagName!="FORM"){
_5b=_5b.parentNode;
}
return _5b;
},getPageElement:function(_5c){
var n=_5c.parentNode;
while(n&&n.tagName!="FORM"&&(!n.className||!wFORMS.helpers.hasClass(n,wFORMS.className_paging))){
n=n.parentNode;
}
if(n&&wFORMS.helpers.hasClass(n,wFORMS.className_paging)){
return n;
}else{
return null;
}
},getPageIndex:function(_5e){
if(_5e&&_5e.id){
return parseInt(_5e.id.replace(/[\D]*/,""));
}else{
return null;
}
}};
}
if(wFORMS){
wFORMS.className_repeat="repeat";
wFORMS.className_delete="removeable";
wFORMS.className_duplicateLink="duplicateLink";
wFORMS.className_removeLink="removeLink";
wFORMS.className_preserveRadioName="preserveRadioName";
wFORMS.idSuffix_repeatCounter="-RC";
wFORMS.idSuffix_duplicateLink="-wfDL";
wFORMS.preserveRadioName=false;
wFORMS.limitSwitchScope=true;
if(!wFORMS.arrMsg){
wFORMS.arrMsg=new Array();
}
wFORMS.arrMsg[0]="Add another response";
wFORMS.arrMsg[1]="Will duplicate this question or section.";
wFORMS.arrMsg[2]="Remove";
wFORMS.arrMsg[3]="Will remove this question or section.";
wFORMS.behaviors["repeat"]={onRepeat:null,onRemove:null,allowRepeat:null,evaluate:function(_5f){
if(wFORMS.helpers.hasClass(_5f,wFORMS.className_repeat)){
if(!_5f.id){
_5f.id=wFORMS.helpers.randomId();
}
var _60=document.getElementById(_5f.id+wFORMS.idSuffix_duplicateLink);
if(!_60){
_60=wFORMS.behaviors["repeat"].createRepeatLink(_5f.id);
if(_5f.tagName.toUpperCase()=="TR"){
var n=_5f.lastChild;
while(n&&n.nodeType!=1){
n=n.previousSibling;
}
if(n&&n.nodeType==1){
n.appendChild(_60);
}
}else{
_5f.appendChild(_60);
}
}
var _62=document.getElementById(_5f.id+wFORMS.idSuffix_repeatCounter);
if(!_62){
if(document.all&&!window.opera){
var _63=_5f.id+wFORMS.idSuffix_repeatCounter;
if(navigator.appVersion.indexOf("MSIE")!=-1&&navigator.appVersion.indexOf("Windows")==-1){
_62=document.createElement("INPUT NAME=\""+_63+"\"");
}else{
_62=document.createElement("<INPUT NAME=\""+_63+"\"></INPUT>");
}
_62.type="hidden";
_62.id=_63;
_62.value="1";
}else{
_62=document.createElement("INPUT");
_62.setAttribute("type","hidden");
_62.setAttribute("value","1");
_62.setAttribute("name",_5f.id+wFORMS.idSuffix_repeatCounter);
_62.setAttribute("id",_5f.id+wFORMS.idSuffix_repeatCounter);
}
var _64=_5f.parentNode;
while(_64&&_64.tagName.toUpperCase()!="FORM"){
_64=_64.parentNode;
}
_64.appendChild(_62);
}
wFORMS.helpers.addEvent(_60,"click",wFORMS.behaviors["repeat"].duplicateFieldGroup);
}
if(wFORMS.helpers.hasClass(_5f,wFORMS.className_delete)){
var _65=wFORMS.behaviors["repeat"].createRemoveLink();
if(_5f.tagName.toUpperCase()=="TR"){
var n=_5f.lastChild;
while(n&&n.nodeType!=1){
n=n.previousSibling;
}
if(n&&n.nodeType==1){
n.appendChild(_65);
}
}else{
_5f.appendChild(_65);
}
}
},createRepeatLink:function(id){
var _67=document.createElement("a");
var _68=document.createElement("span");
var _69=document.createTextNode(wFORMS.arrMsg[0]);
_67.id=id+wFORMS.idSuffix_duplicateLink;
_67.setAttribute("href","#");
_67.className=wFORMS.className_duplicateLink;
_67.setAttribute("title",wFORMS.arrMsg[1]);
_68.appendChild(_69);
_67.appendChild(_68);
return _67;
},createRemoveLink:function(){
var _6a=document.createElement("a");
var _6b=document.createElement("span");
var _6c=document.createTextNode(wFORMS.arrMsg[2]);
_6a.setAttribute("href","#");
_6a.className=wFORMS.className_removeLink;
_6a.setAttribute("title",wFORMS.arrMsg[3]);
_6b.appendChild(_6c);
_6a.appendChild(_6b);
wFORMS.helpers.addEvent(_6a,"click",wFORMS.behaviors["repeat"].removeFieldGroup);
return _6a;
},duplicateFieldGroup:function(e){
var _6e=wFORMS.helpers.getSourceElement(e);
if(!_6e){
_6e=e;
}
var _6f=wFORMS.helpers.hasClass(_6e,wFORMS.className_preserveRadioName)?true:wFORMS.preserveRadioName;
while(_6e&&!wFORMS.helpers.hasClass(_6e,wFORMS.className_duplicateLink)){
_6e=_6e.parentNode;
}
var _70=_6e.id.replace(wFORMS.idSuffix_duplicateLink,"");
var _6e=document.getElementById(_70);
if(_6e){
var _71=wFORMS.behaviors["repeat"];
if(_71.allowRepeat){
if(!_71.allowRepeat(_6e)){
return false;
}
}
counterField=document.getElementById(_6e.id+wFORMS.idSuffix_repeatCounter);
if(!counterField){
return;
}
var _72=parseInt(counterField.value)+1;
var _73="-"+_72.toString();
var _74=_71.replicateTree(_6e,null,_73,_6f);
var _75=_6e.nextSibling;
while(_75&&(_75.nodeType==3||wFORMS.helpers.hasClass(_75,wFORMS.className_delete))){
_75=_75.nextSibling;
}
_6e.parentNode.insertBefore(_74,_75);
_74.className=_6e.className.replace(wFORMS.className_repeat,wFORMS.className_delete);
document.getElementById(_6e.id+wFORMS.idSuffix_repeatCounter).value=_72;
wFORMS.addBehaviors(_74);
if(_71.onRepeat){
_71.onRepeat(_6e,_74);
}
}
return wFORMS.helpers.preventEvent(e);
},removeFieldGroup:function(e){
var _77=wFORMS.helpers.getSourceElement(e);
if(!_77){
_77=e;
}
var _77=_77.parentNode;
while(_77&&!wFORMS.helpers.hasClass(_77,wFORMS.className_delete)){
_77=_77.parentNode;
}
_77.parentNode.removeChild(_77);
if(wFORMS.behaviors["repeat"].onRemove){
wFORMS.behaviors["repeat"].onRemove(_77);
}
return wFORMS.helpers.preventEvent(e);
},removeRepeatCountSuffix:function(str){
return str.replace(/-\d+$/,"");
},replicateTree:function(_79,_7a,_7b,_7c){
if(_79.nodeType==3){
if(_79.parentNode.tagName.toUpperCase()!="TEXTAREA"){
var _7d=document.createTextNode(_79.data);
}
}else{
if(_79.nodeType==1){
if(wFORMS.helpers.hasClass(_79,wFORMS.className_duplicateLink)||wFORMS.helpers.hasClass(_79,wFORMS.className_removeLink)){
return null;
}
if(wFORMS.helpers.hasClass(_79,wFORMS.className_delete)){
return null;
}
if(wFORMS.helpers.hasClass(_79,wFORMS.className_repeat)&&_7a!=null){
_7b=_7b.replace("-","__");
}
if(!document.all||window.opera){
var _7d=document.createElement(_79.tagName);
}else{
var _7e=_79.tagName;
if(_79.name){
if(_79.tagName.toUpperCase()=="INPUT"&&_79.type.toLowerCase()=="radio"&&_7c){
_7e+=" NAME='"+_79.name+"' ";
}else{
_7e+=" NAME='"+wFORMS.behaviors["repeat"].removeRepeatCountSuffix(_79.name)+_7b+"' ";
}
}
if(_79.type){
_7e+=" TYPE='"+_79.type+"' ";
}
if(navigator.appVersion.indexOf("MSIE")!=-1&&navigator.appVersion.indexOf("Windows")==-1){
var _7d=document.createElement(_7e);
}else{
var _7d=document.createElement("<"+_7e+"></"+_79.tagName+">");
}
try{
_7d.type=_79.type;
}
catch(e){
}
}
for(var i=0;i<_79.attributes.length;i++){
var _80=_79.attributes[i];
if(_80.specified||_80.nodeName.toLowerCase()=="value"){
if(_80.nodeName.toLowerCase()=="id"||_80.nodeName.toLowerCase()=="name"||_80.nodeName.toLowerCase()=="for"){
if(wFORMS.hasBehavior("hint")&&_80.nodeValue.indexOf(wFORMS.idSuffix_fieldHint)!=-1){
var _81=_80.nodeValue;
_81=wFORMS.behaviors["repeat"].removeRepeatCountSuffix(_81.substr(0,_81.indexOf(wFORMS.idSuffix_fieldHint)))+_7b+wFORMS.idSuffix_fieldHint;
}else{
if(_79.tagName.toUpperCase()=="INPUT"&&_79.getAttribute("type",false).toLowerCase()=="radio"&&_80.nodeName.toLowerCase()=="name"&&_7c){
var _81=_80.nodeValue;
}else{
var _81=_80.nodeValue+_7b;
}
}
}else{
if(_80.nodeName.toLowerCase()=="value"&&_79.tagName.toUpperCase()=="INPUT"&&(_79.type.toLowerCase()=="text"||_79.type.toLowerCase()=="password"||_79.type.toLowerCase()=="hidden"||_79.type.toLowerCase()=="file")){
var _81="";
}else{
if(_80.nodeName.toLowerCase()=="rel"&&_80.nodeValue.indexOf("wfHandled")!=-1){
var _81=_80.nodeValue.replace("wfHandled","");
}else{
var _81=_80.nodeValue;
}
}
}
switch(_80.nodeName.toLowerCase()){
case "checked":
_7d.checked=false;
break;
case "selected":
_7d.selected=false;
break;
case "class":
_7d.className=_81;
break;
case "style":
if(_79.style&&_79.style.cssText){
_7d.style.cssText=_79.style.cssText;
}
break;
case "onclick":
_7d.onclick=_79.onclick;
break;
case "onchange":
_7d.onchange=_79.onchange;
break;
case "onsubmit":
_7d.onsubmit=_79.onsubmit;
break;
case "onmouseover":
_7d.onmouseover=_79.onmouseover;
break;
case "onmouseout":
_7d.onmouseout=_79.onmouseout;
break;
case "onmousedown":
_7d.onmousedown=_79.onmousedown;
break;
case "onmouseup":
_7d.onmouseup=_79.onmouseup;
break;
case "ondblclick":
_7d.ondblclick=_79.ondblclick;
break;
case "onkeydown":
_7d.onkeydown=_79.onkeydown;
break;
case "onkeyup":
_7d.onkeyup=_79.onkeyup;
break;
case "onblur":
_7d.onblur=_79.onblur;
break;
case "onfocus":
_7d.onfocus=_79.onfocus;
break;
default:
_7d.setAttribute(_80.name,_81,0);
}
}
}
}
}
if(_7a&&_7d){
_7a.appendChild(_7d);
}
for(var i=0;i<_79.childNodes.length;i++){
wFORMS.behaviors["repeat"].replicateTree(_79.childNodes[i],_7d,_7b,_7c);
}
return _7d;
}};
}
if(wFORMS){
wFORMS.classNamePrefix_switch="switch";
wFORMS.className_switchIsOn="swtchIsOn";
wFORMS.className_switchIsOff="swtchIsOff";
wFORMS.classNamePrefix_offState="offstate";
wFORMS.classNamePrefix_onState="onstate";
wFORMS.switchScopeRootTag="";
wFORMS.switchTriggers=[];
wFORMS.switchTargets=[];
wFORMS.behaviors["switch"]={evaluate:function(_82){
if(wFORMS.helpers.hasClassPrefix(_82,wFORMS.classNamePrefix_switch)){
if(!_82.id){
_82.id=wFORMS.helpers.randomId();
}
if(!wFORMS.processedForm||!wFORMS.processedForm.id){
var _83="undefined";
}else{
var _83=wFORMS.processedForm.id;
}
var _84=wFORMS.behaviors["switch"].getSwitchNames(_82);
for(var i=0;i<_84.length;i++){
if(!wFORMS.switchTriggers[_83]){
wFORMS.switchTriggers[_83]=new Array();
}
if(!wFORMS.switchTriggers[_83][_84[i]]){
wFORMS.switchTriggers[_83][_84[i]]=new Array();
}
if(!wFORMS.switchTriggers[_83][_84[i]][_82.id]){
wFORMS.switchTriggers[_83][_84[i]].push(_82.id);
}
}
switch(_82.tagName.toUpperCase()){
case "OPTION":
var _86=_82.parentNode;
while(_86&&_86.tagName.toUpperCase()!="SELECT"){
var _86=_86.parentNode;
}
if(!_86){
alert("Error: invalid markup in SELECT field ?");
return false;
}
if(!_86.id){
_86.id=wFORMS.helpers.randomId();
}
if(!_86.getAttribute("rel")||_86.getAttribute("rel").indexOf("wfHandled")==-1){
_86.setAttribute("rel",(_86.getAttribute("rel")||"")+" wfHandled");
wFORMS.helpers.addEvent(_86,"change",wFORMS.behaviors["switch"].run);
}
break;
case "INPUT":
if(_82.type&&_82.type.toLowerCase()=="radio"){
var _87=_82.form;
for(var j=0;j<_87[_82.name].length;j++){
var _89=_87[_82.name][j];
if(_89.type.toLowerCase()=="radio"){
if(!_89.getAttribute("rel")||_89.getAttribute("rel").indexOf("wfHandled")==-1){
wFORMS.helpers.addEvent(_89,"click",wFORMS.behaviors["switch"].run);
_89.setAttribute("rel",(_89.getAttribute("rel")||"")+" wfHandled");
}
}
}
}else{
wFORMS.helpers.addEvent(_82,"click",wFORMS.behaviors["switch"].run);
}
break;
default:
wFORMS.helpers.addEvent(_82,"click",wFORMS.behaviors["switch"].run);
break;
}
}
if(wFORMS.helpers.hasClassPrefix(_82,wFORMS.classNamePrefix_offState)||wFORMS.helpers.hasClassPrefix(_82,wFORMS.classNamePrefix_onState)){
if(!_82.id){
_82.id=wFORMS.helpers.randomId();
}
if(!wFORMS.processedForm||!wFORMS.processedForm.id){
var _83="undefined";
}else{
var _83=wFORMS.processedForm.id;
}
var _84=wFORMS.behaviors["switch"].getSwitchNames(_82);
for(var i=0;i<_84.length;i++){
if(!wFORMS.switchTargets[_83]){
wFORMS.switchTargets[_83]=new Array();
}
if(!wFORMS.switchTargets[_83][_84[i]]){
wFORMS.switchTargets[_83][_84[i]]=new Array();
}
if(!wFORMS.switchTargets[_83][_84[i]][_82.id]){
wFORMS.switchTargets[_83][_84[i]].push(_82.id);
}
}
}
if(_82.tagName&&_82.tagName.toUpperCase()=="FORM"){
wFORMS.onLoadComplete.push({form:_82,func:wFORMS.behaviors["switch"].init});
wFORMS.behaviors["switch"].clear(_82.id);
}
},init:function(_8a){
if(!_8a||!_8a.id){
var _8b="undefined";
}else{
var _8b=_8a.id;
}
for(var _8c in wFORMS.switchTriggers[_8b]){
for(var i=0;i<wFORMS.switchTriggers[_8b][_8c].length;i++){
var _8e=document.getElementById(wFORMS.switchTriggers[_8b][_8c][i]);
if(wFORMS.behaviors["switch"].isTriggerOn(_8e,_8c)){
if(_8e.tagName.toUpperCase()=="OPTION"){
var _8e=_8e.parentNode;
while(_8e&&_8e.tagName.toUpperCase()!="SELECT"){
var _8e=_8e.parentNode;
}
}
wFORMS.behaviors["switch"].run(_8e);
}
}
}
},run:function(e){
var _90=wFORMS.helpers.getSourceElement(e);
if(!_90){
_90=e;
}
var _91=false;
if(_90.form){
var _92=_90.form;
}else{
var _92=_90.parentNode;
while(_92&&_92.tagName!="FORM"){
_92=_92.parentNode;
}
}
if(!_92||!_92.id){
var _93="undefined";
}else{
var _93=_92.id;
}
var _94=new Array();
var _95=new Array();
switch(_90.tagName.toUpperCase()){
case "SELECT":
for(var i=0;i<_90.options.length;i++){
if(i==_90.selectedIndex){
_94=_94.concat(wFORMS.behaviors["switch"].getSwitchNames(_90.options[i]));
}else{
_95=_95.concat(wFORMS.behaviors["switch"].getSwitchNames(_90.options[i]));
}
}
break;
case "INPUT":
if(_90.type.toLowerCase()=="radio"){
for(var i=0;i<_90.form[_90.name].length;i++){
var _97=_90.form[_90.name][i];
if(_97.checked){
_94=_94.concat(wFORMS.behaviors["switch"].getSwitchNames(_97));
}else{
_95=_95.concat(wFORMS.behaviors["switch"].getSwitchNames(_97));
}
}
}else{
if(_90.checked||wFORMS.helpers.hasClass(_90,wFORMS.className_switchIsOn)){
_94=_94.concat(wFORMS.behaviors["switch"].getSwitchNames(_90));
}else{
_95=_95.concat(wFORMS.behaviors["switch"].getSwitchNames(_90));
}
}
break;
default:
if(!wFORMS.behaviors["switch"].isTriggerOn(_90)){
_94=_94.concat(wFORMS.behaviors["switch"].getSwitchNames(_90));
}else{
_95=_95.concat(wFORMS.behaviors["switch"].getSwitchNames(_90));
}
if(wFORMS.helpers.hasClass(_90,wFORMS.className_switchIsOff)){
_90.className=_90.className.replace(wFORMS.className_switchIsOff,wFORMS.className_switchIsOn);
}else{
if(wFORMS.helpers.hasClass(_90,wFORMS.className_switchIsOn)){
_90.className=_90.className.replace(wFORMS.className_switchIsOn,wFORMS.className_switchIsOff);
}
}
_91=true;
break;
}
for(var i=0;i<_95.length;i++){
var _98=wFORMS.behaviors["switch"].getElementsBySwitchName(_95[i],_93);
for(var j=0;j<_98.length;j++){
var _9a=wFORMS.switchTriggers[_93][_95[i]];
var _9b=true;
for(var k=0;k<_9a.length;k++){
var _9d=document.getElementById(_9a[k]);
if(wFORMS.behaviors["switch"].isTriggerOn(_9d,_95[i])){
if(wFORMS.behaviors["switch"].isWithinSwitchScope(_9d,_98[j])){
_9b=false;
}
}
}
if(_9b){
wFORMS.behaviors["switch"].switchState(_98[j],wFORMS.classNamePrefix_onState,wFORMS.classNamePrefix_offState);
}
}
}
for(var i=0;i<_94.length;i++){
var _98=wFORMS.behaviors["switch"].getElementsBySwitchName(_94[i],_93);
for(var j=0;j<_98.length;j++){
if(wFORMS.behaviors["switch"].isWithinSwitchScope(_90,_98[j])){
wFORMS.behaviors["switch"].switchState(_98[j],wFORMS.classNamePrefix_offState,wFORMS.classNamePrefix_onState);
}
}
}
if(_91){
return wFORMS.helpers.preventEvent(e);
}
},clear:function(_9e){
if(_9e){
wFORMS.switchTriggers[_9e]=[];
wFORMS.switchTargets[_9e]=[];
}else{
wFORMS.switchTriggers=[];
wFORMS.switchTargets=[];
}
},getSwitchNames:function(_9f){
var _a0=new Array();
var _a1=_9f.className.split(" ");
for(var i=0;i<_a1.length;i++){
if(_a1[i].indexOf(wFORMS.classNamePrefix_switch)==0){
_a0.push(_a1[i].substr(wFORMS.classNamePrefix_switch.length+1));
}
if(_a1[i].indexOf(wFORMS.classNamePrefix_onState)==0){
_a0.push(_a1[i].substr(wFORMS.classNamePrefix_onState.length+1));
}else{
if(_a1[i].indexOf(wFORMS.classNamePrefix_offState)==0){
_a0.push(_a1[i].substr(wFORMS.classNamePrefix_offState.length+1));
}
}
}
return _a0;
},switchState:function(_a3,_a4,_a5){
if(!_a3||_a3.nodeType!=1){
return;
}
if(_a3.className){
_a3.className=_a3.className.replace(_a4,_a5);
}
},getElementsBySwitchName:function(_a6,_a7){
var _a8=new Array();
if(wFORMS.switchTargets[_a7][_a6]){
for(var i=0;i<wFORMS.switchTargets[_a7][_a6].length;i++){
var _aa=document.getElementById(wFORMS.switchTargets[_a7][_a6][i]);
if(_aa){
_a8.push(_aa);
}
}
}
return _a8;
},isTriggerOn:function(_ab,_ac){
if(!_ab){
return false;
}
if(_ab.tagName.toUpperCase()=="OPTION"){
var _ad=_ab.parentNode;
while(_ad&&_ad.tagName.toUpperCase()!="SELECT"){
var _ad=_ad.parentNode;
}
if(!_ad){
return false;
}
if(_ad.selectedIndex==-1){
return false;
}
if(wFORMS.helpers.hasClass(_ad.options[_ad.selectedIndex],wFORMS.classNamePrefix_switch+"-"+_ac)){
return true;
}
}else{
if(_ab.checked||wFORMS.helpers.hasClass(_ab,wFORMS.className_switchIsOn)){
return true;
}
}
return false;
},isWithinSwitchScope:function(_ae,_af){
if(wFORMS.hasBehavior("repeat")&&wFORMS.limitSwitchScope==true){
var _b0=_ae;
while(_b0&&_b0.tagName&&_b0.tagName.toUpperCase()!="FORM"&&!wFORMS.helpers.hasClass(_b0,wFORMS.className_repeat)&&!wFORMS.helpers.hasClass(_b0,wFORMS.className_delete)){
_b0=_b0.parentNode;
}
if(wFORMS.helpers.hasClass(_b0,wFORMS.className_repeat)||wFORMS.helpers.hasClass(_b0,wFORMS.className_delete)){
var _b1=_af;
while(_b1&&_b1.tagName&&_b1.tagName.toUpperCase()!="FORM"&&!wFORMS.helpers.hasClass(_b1,wFORMS.className_repeat)&&!wFORMS.helpers.hasClass(_b1,wFORMS.className_delete)){
_b1=_b1.parentNode;
}
if(_b0==_b1){
return true;
}else{
return false;
}
}else{
return true;
}
}else{
return true;
}
}};
}
if(wFORMS){
wFORMS.preventSubmissionOnEnter=true;
wFORMS.showAlertOnError=true;
wFORMS.className_required="required";
wFORMS.className_validationError_msg="errMsg";
wFORMS.className_validationError_fld="errFld";
wFORMS.classNamePrefix_validation="validate";
wFORMS.idSuffix_fieldError="-E";
wFORMS.behaviors["validation"]={errMsg_required:"This field is required. ",errMsg_alpha:"The text must use alphabetic characters only (a-z, A-Z). Numbers are not allowed.",errMsg_email:"This does not appear to be a valid email address.",errMsg_integer:"Please enter an integer.",errMsg_float:"Please enter a number (ex. 1.9).",errMsg_password:"Unsafe password. Your password should be between 4 and 12 characters long and use a combinaison of upper-case and lower-case letters.",errMsg_alphanum:"Please use alpha-numeric characters only [a-z 0-9].",errMsg_date:"This does not appear to be a valid date.",errMsg_notification:"%% error(s) detected. Your form has not been submitted yet.\nPlease check the information you provided.",errMsg_custom:"Please enter a valid value.",className_allRequired:"allrequired",jumpToErrorOnPage:null,currentPageIndex:-1,submitSwitchedOffFields:false,switchedOffFields:[],evaluate:function(_b2){
if(_b2.tagName=="FORM"){
if(wFORMS.functionName_formValidation.toString()==wFORMS.functionName_formValidation){
wFORMS.functionName_formValidation=eval(wFORMS.functionName_formValidation);
}
wFORMS.helpers.addEvent(_b2,"submit",wFORMS.functionName_formValidation);
}
if(wFORMS.preventSubmissionOnEnter){
if(_b2.tagName=="INPUT"){
if(!_b2.type||_b2.type.toLowerCase()=="text"||_b2.type.toLowerCase()=="password"||_b2.type.toLowerCase()=="file"){
wFORMS.helpers.addEvent(_b2,"keydown",function(e){
var evt=(e)?e:window.event;
if(evt.keyCode==13){
return wFORMS.helpers.preventEvent(evt);
}
});
}
}
}
},init:function(){
},run:function(e){
var _b6=wFORMS.helpers.getSourceElement(e);
if(!_b6){
_b6=e;
}
var _b7=arguments.length>1?arguments[1]:false;
wFORMS.behaviors["validation"].switchedOffFields=[];
wFORMS.behaviors["validation"].jumpToErrorOnPage=null;
while(_b6&&_b6.tagName!="FORM"){
_b6=_b6.parentNode;
}
var _b8=wFORMS.behaviors["validation"].validateElement(_b6,_b7,true);
wFORMS.behaviors["validation"].errorCount=_b8;
if(_b8>0){
if(wFORMS.behaviors["validation"].jumpToErrorOnPage){
wFORMS.behaviors["paging"].gotoPage(wFORMS.behaviors["validation"].jumpToErrorOnPage);
}
if(wFORMS.showAlertOnError){
wFORMS.behaviors["validation"].showAlert(_b8);
}
return wFORMS.helpers.preventEvent(e);
}
if(!wFORMS.behaviors["validation"].submitSwitchedOffFields&&!_b7){
for(var i=0;i<wFORMS.behaviors["validation"].switchedOffFields.length;i++){
var _b6=wFORMS.behaviors["validation"].switchedOffFields[i];
while(_b6.childNodes[0]){
_b6.removeChild(_b6.childNodes[0]);
}
}
}
return true;
},remove:function(){
},validateElement:function(_ba){
if(!_ba){
return;
}
var _bb=arguments.length>2?arguments[2]:true;
var _bc=arguments[1]?arguments[1]:false;
var _bd=wFORMS.behaviors["validation"];
if(wFORMS.hasBehavior("switch")&&wFORMS.helpers.hasClassPrefix(_ba,wFORMS.classNamePrefix_offState)){
if(!_bd.submitSwitchedOffFields){
_bd.switchedOffFields.push(_ba);
}
return 0;
}
if(wFORMS.hasBehavior("paging")&&wFORMS.helpers.hasClass(_ba,wFORMS.className_paging)){
if(!wFORMS.helpers.hasClass(_ba,wFORMS.className_pagingCurrent)&&_bc){
return 0;
}
_bd.currentPageIndex=wFORMS.behaviors["paging"].getPageIndex(_ba);
}
var _be=0;
if(!_bd.checkRequired(_ba)){
_bd.showError(_ba,_bd.errMsg_required);
_be++;
}else{
if(wFORMS.helpers.hasClassPrefix(_ba,wFORMS.classNamePrefix_validation)){
var _bf=_ba.className.split(" ");
for(j=0;j<_bf.length;j++){
switch(_bf[j]){
case "validate-alpha":
if(!_bd.isAlpha(_ba.value)){
_bd.showError(_ba,_bd.errMsg_alpha);
_be++;
}
break;
case "validate-alphanum":
if(!_bd.isAlphaNum(_ba.value)){
_bd.showError(_ba,_bd.errMsg_alphanum);
_be++;
}
break;
case "validate-date":
if(!_bd.isDate(_ba.value)){
_bd.showError(_ba,_bd.errMsg_date);
_be++;
}
break;
case "validate-time":
break;
case "validate-email":
if(!_bd.isEmail(_ba.value)){
_bd.showError(_ba,_bd.errMsg_email);
_be++;
}
break;
case "validate-integer":
if(!_bd.isInteger(_ba.value)){
_bd.showError(_ba,_bd.errMsg_integer);
_be++;
}
break;
case "validate-float":
if(!_bd.isFloat(_ba.value)){
_bd.showError(_ba,_bd.errMsg_float);
_be++;
}
break;
case "validate-strongpassword":
if(!_bd.isPassword(_ba.value)){
_bd.showError(_ba,_bd.errMsg_password);
_be++;
}
break;
case "validate-custom":
var _c0=new RegExp("/([^/]*)/([gi]*)");
var _c1=_ba.className.match(_c0);
if(_c1[0]){
var _c2=new RegExp(_c1[1],_c1[2]);
if(!_ba.value.match(_c2)){
_bd.showError(_ba,_bd.errMsg_custom);
_be++;
}
}
break;
}
}
}
}
if(_be==0){
_bd.removeErrorMessage(_ba);
}else{
if(_bd.currentPageIndex>0&&!_bd.jumpToErrorOnPage){
_bd.jumpToErrorOnPage=_bd.currentPageIndex;
}
}
if(_bb){
for(var i=0;i<_ba.childNodes.length;i++){
if(_ba.childNodes[i].nodeType==1){
_be+=_bd.validateElement(_ba.childNodes[i],_bc,_bb);
}
}
}
return _be;
},checkRequired:function(_c4){
var _c5=wFORMS.behaviors["validation"];
if(wFORMS.helpers.hasClass(_c4,wFORMS.className_required)){
switch(_c4.tagName.toUpperCase()){
case "INPUT":
var _c6=_c4.getAttribute("type");
if(!_c6){
_c6="text";
}
switch(_c6.toLowerCase()){
case "checkbox":
return _c4.checked;
break;
case "radio":
return _c4.checked;
break;
default:
return !_c5.isEmpty(_c4.value);
}
break;
case "SELECT":
if(_c4.selectedIndex==-1){
return false;
}else{
return !_c5.isEmpty(_c4.options[_c4.selectedIndex].value);
}
break;
case "TEXTAREA":
return !_c5.isEmpty(_c4.value);
break;
default:
return _c5.checkOneRequired(_c4);
break;
}
}else{
if(wFORMS.helpers.hasClass(_c4,_c5.className_allRequired)){
return _c5.checkAllRequired(_c4);
}
}
return true;
},checkOneRequired:function(_c7){
if(_c7.nodeType!=1){
return false;
}
var _c8=_c7.tagName.toUpperCase();
var _c9=wFORMS.behaviors["validation"];
if(_c8=="INPUT"||_c8=="SELECT"||_c8=="TEXTAREA"){
var _ca=_c9.getFieldValue(_c7);
if(!_c9.isEmpty(_ca)){
return true;
}
}
for(var i=0;i<_c7.childNodes.length;i++){
if(_c9.checkOneRequired(_c7.childNodes[i])){
return true;
}
}
return false;
},checkAllRequired:function(_cc){
if(_cc.nodeType!=1){
return true;
}
var _cd=_cc.tagName.toUpperCase();
var _ce=wFORMS.behaviors["validation"];
if(_cd=="INPUT"||_cd=="SELECT"||_cd=="TEXTAREA"){
var _cf=_ce.getFieldValue(_cc);
if(_ce.isEmpty(_cf)){
return false;
}
}
for(var i=0;i<_cc.childNodes.length;i++){
if(!_ce.checkAllRequired(_cc.childNodes[i])){
return false;
}
}
return true;
},getFieldValue:function(_d1){
var _d2=null;
if(_d1&&_d1.tagName){
if(_d1.tagName.toUpperCase()=="INPUT"){
var _d3=_d1.getAttribute("type");
if(!_d3){
_d3="text";
}
switch(_d3.toLowerCase()){
case "checkbox":
_d2=_d1.checked?_d1.value:null;
break;
case "radio":
var _d4=_d1.form[_d1.name];
for(var i=0;i<_d4.length;i++){
if(_d4[i].checked){
if(!_d2){
_d2=new Array();
}
_d2[_d2.length]=_d4[i].value;
}
}
break;
default:
_d2=_d1.value;
}
}else{
if(_d1.tagName.toUpperCase()=="SELECT"){
if(_d1.selectedIndex!=-1){
_d2=_d1.options[_d1.selectedIndex].value;
}else{
_d2=null;
}
}else{
if(_d1.tagName.toUpperCase()=="TEXTAREA"){
_d2=_d1.value;
}
}
}
}
return _d2;
},isEmpty:function(s){
var _d7=/^\s+$/;
return ((s==null)||(s.length==0)||_d7.test(s));
},isAlpha:function(s){
var _d9=/^[a-zA-Z\s]+$/;
return wFORMS.behaviors["validation"].isEmpty(s)||_d9.test(s);
},isAlphaNum:function(s){
var _db=/^[\w\s]+$/;
return wFORMS.behaviors["validation"].isEmpty(s)||_db.test(s);
},isDate:function(s){
var _dd=new Date(s);
return wFORMS.behaviors["validation"].isEmpty(s)||!isNaN(_dd);
},isEmail:function(s){
var _df=/\w{1,}[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/;
return wFORMS.behaviors["validation"].isEmpty(s)||_df.test(s);
},isInteger:function(s){
var _e1=/^[+]?\d+$/;
return wFORMS.behaviors["validation"].isEmpty(s)||_e1.test(s);
},isFloat:function(s){
return wFORMS.behaviors["validation"].isEmpty(s)||!isNaN(parseFloat(s));
},isPassword:function(s){
return wFORMS.behaviors["validation"].isEmpty(s);
},showError:function(_e4,_e5){
wFORMS.behaviors["validation"].removeErrorMessage(_e4);
if(!_e4.id){
_e4.id=wFORMS.helpers.randomId();
}
_e4.className+=" "+wFORMS.className_validationError_fld;
var _e6=document.createTextNode(" "+_e5);
var fe=document.getElementById(_e4.id+wFORMS.idSuffix_fieldError);
if(!fe){
fe=document.createElement("div");
fe.setAttribute("id",_e4.id+wFORMS.idSuffix_fieldError);
var fl=document.getElementById(_e4.id+wFORMS.idSuffix_fieldLabel);
if(fl){
fl.parentNode.insertBefore(fe,fl.nextSibling);
}else{
_e4.parentNode.insertBefore(fe,_e4.nextSibling);
}
}
fe.appendChild(_e6);
fe.className+=" "+wFORMS.className_validationError_msg;
},showAlert:function(_e9){
alert(wFORMS.behaviors["validation"].errMsg_notification.replace("%%",_e9));
},removeErrorMessage:function(_ea){
if(wFORMS.helpers.hasClass(_ea,wFORMS.className_validationError_fld)){
var _eb=new RegExp(wFORMS.className_validationError_fld,"gi");
_ea.className=_ea.className.replace(_eb,"");
var _ec=document.getElementById(_ea.id+wFORMS.idSuffix_fieldError);
if(_ec){
_ec.innerHTML="";
}
}
}};
wFORMS.functionName_formValidation=wFORMS.behaviors["validation"].run;
wFORMS.formValidation=wFORMS.behaviors["validation"].run;
wFORMS.arrErrorMsg=new Array();
wFORMS.arrErrorMsg[0]=wFORMS.behaviors["validation"].errMsg_required;
wFORMS.arrErrorMsg[1]=wFORMS.behaviors["validation"].errMsg_alpha;
wFORMS.arrErrorMsg[2]=wFORMS.behaviors["validation"].errMsg_email;
wFORMS.arrErrorMsg[3]=wFORMS.behaviors["validation"].errMsg_integer;
wFORMS.arrErrorMsg[4]=wFORMS.behaviors["validation"].errMsg_float;
wFORMS.arrErrorMsg[5]=wFORMS.behaviors["validation"].errMsg_password;
wFORMS.arrErrorMsg[6]=wFORMS.behaviors["validation"].errMsg_alphanum;
wFORMS.arrErrorMsg[7]=wFORMS.behaviors["validation"].errMsg_date;
wFORMS.arrErrorMsg[8]=wFORMS.behaviors["validation"].errMsg_notification;
}

