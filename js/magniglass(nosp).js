"use strict";function extend(e,t){for(var s in e)t[s]=e[s]}function magniglass(e){var t={scal:2,speed:1};extend(e,t);var i=document.getElementById(t.ele),l=i.getElementsByClassName("showPic")[0],n=i.getElementsByClassName("bigPic")[0],s=t.imglist,f='<img src="'+s+'" alt="">',o=f+'<div class="cover"></div>';n.innerHTML=f,l.innerHTML=o;var a=l.getElementsByClassName("cover")[0];l.onmouseover=function(){a.style.display="block",n.style.display="block"},l.onmouseout=function(){a.style.display="none",n.style.display="none"};var d=n.getElementsByTagName("img")[0];n.children[0].style.width=l.offsetWidth*t.scal+"px",n.children[0].style.height=l.offsetHeight*t.scal+"px",console.log(s),l.onmousemove=function(e){var t=e.pageX-i.parentNode.offsetLeft-18-a.offsetWidth/2,s=e.pageY-i.parentNode.offsetTop-92-a.offsetWidth/2;t<=0?t=0:t>=l.offsetWidth-a.offsetWidth&&(t=l.offsetWidth-a.offsetWidth),s<=0?s=0:s>=l.offsetHeight-a.offsetHeight&&(s=l.offsetHeight-a.offsetHeight);var f=t/(l.offsetWidth-a.offsetWidth),o=s/(l.offsetHeight-a.offsetHeight);d.style.left=(n.offsetWidth-d.offsetWidth)*f+"px",d.style.top=(n.offsetHeight-d.offsetHeight)*o+"px",a.style.left=t+"px",a.style.top=s+"px"}}