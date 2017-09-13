/* 20161209 */
function cssLoad(cssPath){
	//Load CSS File empty
	if (isEmpty(cssPath)) {
		var head = document.getElementsByTagName('head')[0];
		var link = document.createElement('link');
		link.type = "text/css";
		link.rel = "stylesheet";
		link.href = cssPath;
		head.appendChild(link);
	}
}

function jsLoad(js_name, js_src){
	//Load JS File empty
	try {
		var t = eval(js_name);
		eval("window." + js_name + "Import = " + "true;");
		// loadComplete();
	} catch (e) {
		var head    = document.getElementsByTagName("head")[0];
		var script  = document.createElement("script");
		script.type = "text/javascript";
		script.charset = "UTF-8";
		var loaded = false;
		script.onreadystatechange= function () {
			if (this.readyState == "loaded" || this.readyState == "complete") {
				if (loaded)return;
				loaded = true;
				eval("window." + js_name + "Import = " + "true;");
				// loadComplete();
			}
		};
		script.onload = function () {
			if (loaded)return;
			loaded = true;
			eval("window." + js_name + "Import = " + "true;");
			// loadComplete();
		};
		script.src = js_src;

		head.appendChild(script);
	}
}


function isEmpty(value){
	//Check value empty
	return (typeof(value) == 'undefined' || value == null || value == '' || value == 'null') ? true : false;
}


var QueryString = function () {
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
	var pair = vars[i].split("=");
		// If first entry with this name
	if (typeof query_string[pair[0]] === "undefined") {
	  query_string[pair[0]] = decodeURIComponent(pair[1]);
		// If second entry with this name
	} else if (typeof query_string[pair[0]] === "string") {
	  var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
	  query_string[pair[0]] = arr;
		// If third or later entry with this name
	} else {
	  query_string[pair[0]].push(decodeURIComponent(pair[1]));
	}
  } 
  return query_string;
}();

