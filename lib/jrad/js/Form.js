// onEdit
// onDelete
// onLoad
// onFilter
// onSort
// JavaScript Document
var Form = {};
Form.onEnterKey = function (e, callback) {
	var key = e.which || e.keyCode;
	if (key == 13) 
		callback();
	else
		return false;
}
Form.togglePassword = function () {
	var obj = document.getElementById('password');
	var value = (obj.type == 'password')? 'text':'password';
	obj.setAttribute('type',value);
}
Form.emptyForm = function (attrib = '[data-ajax]') {
	return attrib;
	var $formControl = document.querySelectorAll($attrib);
	for (var i = 0; i < $formControl.length; i++)
		document.querySelectorAll($attrib)[i].value = '';
}
function $_autofill ($attrib)
{
	if (!$attrib) var $attrib = '[data-ajax]';
	var $formControl = document.querySelectorAll($attrib);
	for (var i = 0; i < $formControl.length; i++)
		$formControl[i].value = 'autofill@placeholder.com';
}
function $_checkAll ($this, $attrib)
{
	var $status = $this.checked, $set;	
	$set = $status == true ? true : false;

	if (!$attrib) var $attrib = '[data-ajax]';
	var $formControl = document.querySelectorAll($attrib);
	for (var i = 0; i < $formControl.length; i++)
		$formControl[i].checked = $set;
}
function $_focusAll ($this, $target) 
{
	var $table = document.getElementById($target);
	var $tr = $table.getElementsByTagName('tr');
	if ($this.checked == true) 
	{
		for (var i = 0; i < $tr.length; i++)
			$tr[i].setAttribute('class','focus');
	}
	else
	{
		for (var i = 0; i < $tr.length; i++)
			$tr[i].removeAttribute('class');
	}
}
function $_focusThis ($this, $target, $n) 
{
	var $table = document.getElementById($target);
	var $tr = $table.getElementsByTagName('tr')[$n];
	if ($this.checked == true) $tr.setAttribute('class','focus');
	else $tr.removeAttribute('class');
}
function $_formctrl ($attrib)
{
	if (!$attrib) var $attrib = '[data-ajax]';
	var $formControl = document.querySelectorAll($attrib);
	var $each, $name, $value, $buffer = "";
	for (var i = 0; i < $formControl.length; i++)
	{
		$each = $formControl[i];
		$name = $each.name;
		$value = $_trim($each.value);
		$buffer += $name +"="+ $value +"&";
	}
	return $buffer = $buffer.slice(0,-1);
}
function $_itemctrl ($attrib)
{
	if (!$attrib) var $attrib = '[data-ajax]';
	var $formControl = document.querySelectorAll($attrib);
	var $each, $name, $value, $buffer = "";
	for (var i = 0; i < $formControl.length; i++)
	{
		$each = $formControl[i];
		if ($each.checked)
		{
			$name = $each.name;
			$value = $_trim($each.value);
			$buffer += $name +"="+ $value +"&";
		}
	}
	return $buffer = $buffer.slice(0,-1);
}
