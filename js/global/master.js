// JavaScript Document
// alert(screen.availWidth+' x '+screen.availHeight);
function appLauncher () 
{
	if (i <= 3)
	{				
		dots = document.querySelectorAll('ul li a');
		console.log(i);				
		dots[i].setAttribute('class','active');
		i++;		
	}
	else
	{
		page = document.querySelector('a[href]').getAttribute('href');
		console.log(page);
		clearInterval(splash);
		location.assign(page);
	}
}
function activeLink ()
{
	var p = location.href; // this page url
	p = p.split('#'); // remove hash
	p = p[0].split('?'); // remove request
	var arr = p[0].split('/'); // remove slash
	var file;
	for (var e, i = 0; i < arr.length; i++)
	{
		e = arr[i];
		if (e.search('.') >= 0) // any element with file extension
			file = e;
	}
	// console.log(file);
	var a = document.getElementsByTagName('a'); // all anchor tags
	for (var e, i = 0; i < a.length; i++)
	{
		e = a[i].getAttribute('href'); // href attribute
		if (e == file)
			a[i].setAttribute('class','active');
	}
}
function toggleMenu (id)
{
	var obj = document.getElementById(id);
	var value = (!obj.style.display || obj.style.display == 'none')? 'block':'none';
	obj.style.display = value;
}
function toggleSidebar (args)
{
	// 360x600
	// console.log(screen.availWidth);
	var mq = screen.availWidth < 600? '80%':'290px';
	var cover = document.querySelector('.mantis_aside_cover');
	var wrap = document.querySelector('.mantis_aside_wrap');
	if (args == 1)
	{
		wrap.style.width = mq;
		cover.style.display = 'block';			
	}
	else
	{
		wrap.style.width = '0';		
		cover.style.display = 'none';			
	}
}
function togglePassword ()
{
	var obj = document.getElementById('password');
	var value = (obj.type == 'password')? 'text':'password';
	obj.setAttribute('type',value);
}
function hideNotice ()
{
	document.getElementById('notice').style.display = 'none';
}
function onEnterKey (e, callback) 
{
	var key = e.which || e.keyCode;
	if (key == 13) callback();
	else return false;
}
function onFilter (value)
{
	var request = '?filter='+value;
	location.assign(request);
}
function onEdit (id)
{
	var request = '?edit='+id;
	location.assign(request);
}
function onDelete (id)
{
	if (confirm('Delete Record?') == true)
	{
		var request = '?delete='+id;
		location.assign(request);
	}
}


