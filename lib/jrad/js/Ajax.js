// AJAX OBJECT
const Ajax = {};
// METHOD POST
Ajax.onPost = function (url, query, callback) {
	var xhttp = window.XMLHttpRequest? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200)
			callback(this.responseText);
	};
	xhttp.open('POST', url, true);
	xhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhttp.send(query);
}
// METHOD GET
Ajax.onGet = function (url, query, callback) {
	var xhttp = window.XMLHttpRequest? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200)
			callback(this.responseText);
	};
	var request = url+'?'+query;
	xhttp.open('GET', request, true);
	xhttp.send();
}
// METHOD REQUEST
Ajax.onRequest = function (url, callback) {
	var xhttp = window.XMLHttpRequest? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200)
			callback(this.responseText);
	};
	xhttp.open('GET', url, true);
	xhttp.send();
}
Ajax.liveSearch = function (url, $query, $target) {
	//JSON.stringify();
	var xhttp;
	if (window.XMLHttpRequest) {xhttp = new XMLHttpRequest();}
	else {xhttp = new ActiveXObject("Microsoft.XMLHTTP");}
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200)
			document.getElementById($target).innerHTML = this.responseText;
	};
	xhttp.open("GET",$directory+"?utm="+$query,true);
	xhttp.send();
}