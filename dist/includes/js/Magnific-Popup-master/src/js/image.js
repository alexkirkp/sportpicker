/*! sportpicker 2014-06-13 */
var _imgInterval,_getTitle=function(a){if(a.data&&void 0!==a.data.title)return a.data.title;var b=mfp.st.image.titleSrc;if(b){if($.isFunction(b))return b.call(mfp,a);if(a.el)return a.el.attr(b)||""}return""};$.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><div class="mfp-img"></div><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var a=mfp.st.image,b=".image";mfp.types.push("image"),_mfpOn(OPEN_EVENT+b,function(){"image"===mfp.currItem.type&&a.cursor&&_body.addClass(a.cursor)}),_mfpOn(CLOSE_EVENT+b,function(){a.cursor&&_body.removeClass(a.cursor),_window.off("resize"+EVENT_NS)}),_mfpOn("Resize"+b,mfp.resizeImage),mfp.isLowIE&&_mfpOn("AfterChange",mfp.resizeImage)},resizeImage:function(){var a=mfp.currItem;if(a.img&&mfp.st.image.verticalFit){var b=0;mfp.isLowIE&&(b=parseInt(a.img.css("padding-top"),10)+parseInt(a.img.css("padding-bottom"),10)),a.img.css("max-height",mfp.wH-b)}},_onImageHasSize:function(a){a.img&&(a.hasSize=!0,_imgInterval&&clearInterval(_imgInterval),a.isCheckingImgSize=!1,_mfpTrigger("ImageHasSize",a),a.imgHidden&&(mfp.content&&mfp.content.removeClass("mfp-loading"),a.imgHidden=!1))},findImageSize:function(a){var b=0,c=a.img[0],d=function(e){_imgInterval&&clearInterval(_imgInterval),_imgInterval=setInterval(function(){return c.naturalWidth>0?void mfp._onImageHasSize(a):(b>200&&clearInterval(_imgInterval),b++,void(3===b?d(10):40===b?d(50):100===b&&d(500)))},e)};d(1)},getImage:function(a,b){var c=0,d=function(){a&&(a.img[0].complete?(a.img.off(".mfploader"),a===mfp.currItem&&(mfp._onImageHasSize(a),mfp.updateStatus("ready")),a.hasSize=!0,a.loaded=!0,_mfpTrigger("ImageLoadComplete")):(c++,200>c?setTimeout(d,100):e()))},e=function(){a&&(a.img.off(".mfploader"),a===mfp.currItem&&(mfp._onImageHasSize(a),mfp.updateStatus("error",f.tError.replace("%url%",a.src))),a.hasSize=!0,a.loaded=!0,a.loadError=!0)},f=mfp.st.image,g=b.find(".mfp-img");if(g.length){var h=new Image;h.className="mfp-img",a.img=$(h).on("load.mfploader",d).on("error.mfploader",e),h.src=a.src,g.is("img")&&(a.img=a.img.clone()),a.img[0].naturalWidth>0&&(a.hasSize=!0)}return mfp._parseMarkup(b,{title:_getTitle(a),img_replaceWith:a.img},a),mfp.resizeImage(),a.hasSize?(_imgInterval&&clearInterval(_imgInterval),a.loadError?(b.addClass("mfp-loading"),mfp.updateStatus("error",f.tError.replace("%url%",a.src))):(b.removeClass("mfp-loading"),mfp.updateStatus("ready")),b):(mfp.updateStatus("loading"),a.loading=!0,a.hasSize||(a.imgHidden=!0,b.addClass("mfp-loading"),mfp.findImageSize(a)),b)}}});