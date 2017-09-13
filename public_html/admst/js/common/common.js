/* 20161209 */
// jsLoad("SwiperCore","http://1.227.58.11:1991/foodnote/js/jquery.min.js");
function w_html(target,str,callback){
	var elm = $(document.getElementById(target));
	elm.html(str);
	if(callback != ""){
		var fn = window[callback];
		if (typeof fn === "function") fn();
	}
	
}
