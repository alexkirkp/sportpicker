/*! sportpicker 2014-06-13 */
var hasMozTransform,getHasMozTransform=function(){return void 0===hasMozTransform&&(hasMozTransform=void 0!==document.createElement("p").style.MozTransform),hasMozTransform};$.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(a){return a.is("img")?a:a.find("img")}},proto:{initZoom:function(){var a=mfp.st.zoom,b=".zoom";if(a.enabled&&mfp.supportsTransition){var c,d,e=a.duration,f=function(b){var c=b.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),d="all "+a.duration/1e3+"s "+a.easing,e={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},f="transition";return e["-webkit-"+f]=e["-moz-"+f]=e["-o-"+f]=e[f]=d,c.css(e),c},g=function(){mfp.content.css("visibility","visible")};_mfpOn("BuildControls"+b,function(){if(mfp._allowZoom()){if(clearTimeout(c),mfp.content.css("visibility","hidden"),image=mfp._getItemToZoom(),!image)return void g();d=f(image),d.css(mfp._getOffset()),mfp.wrap.append(d),c=setTimeout(function(){d.css(mfp._getOffset(!0)),c=setTimeout(function(){g(),setTimeout(function(){d.remove(),image=d=null,_mfpTrigger("ZoomAnimationEnded")},16)},e)},16)}}),_mfpOn(BEFORE_CLOSE_EVENT+b,function(){if(mfp._allowZoom()){if(clearTimeout(c),mfp.st.removalDelay=e,!image){if(image=mfp._getItemToZoom(),!image)return;d=f(image)}d.css(mfp._getOffset(!0)),mfp.wrap.append(d),mfp.content.css("visibility","hidden"),setTimeout(function(){d.css(mfp._getOffset())},16)}}),_mfpOn(CLOSE_EVENT+b,function(){mfp._allowZoom()&&(g(),d&&d.remove())})}},_allowZoom:function(){return"image"===mfp.currItem.type},_getItemToZoom:function(){return mfp.currItem.hasSize?mfp.currItem.img:!1},_getOffset:function(a){var b;b=a?mfp.currItem.img:mfp.st.zoom.opener(mfp.currItem.el||mfp.currItem);var c=b.offset(),d=parseInt(b.css("padding-top"),10),e=parseInt(b.css("padding-bottom"),10);c.top-=$(window).scrollTop()-d;var f={width:b.width(),height:(_isJQ?b.innerHeight():b[0].offsetHeight)-e-d};return getHasMozTransform()?f["-moz-transform"]=f.transform="translate("+c.left+"px,"+c.top+"px)":(f.left=c.left,f.top=c.top),f}}});