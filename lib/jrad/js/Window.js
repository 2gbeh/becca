// BOM AND DOM OBJECTS
const _isset = (x) => typeof(x) !== 'undefined'? true : false;
const _echo = (ex) => alert(ex);
const _console = (ex) => console.log(ex);
const _print = () => window.print();
// LOCATION
const _redir = (url) => location.assign(url);
const _reload = () => location.reload();
// NAVIGATOR
const _isOnline = () => navigator.onLine();
const _isJava = () => navigator.javaEnabled();
// DOCUMENT
const _getObject = (id) => document.getElementById(id);
const _getClass = (cn) => document.getElementsByClassName(cn);
const _getTag = (tn) => document.getElementsByTagName(tn);
const _setValue = (id, e) => document.getElementById(id).innerHTML = e;
const _getValue = (id) => document.getElementById(id).innerHTML;
const _addValue = (id, e) => document.getElementById(id).innerHTML += e;
const _setAttrib = (id, name, value) => document.getElementById(id).setAttribute(name, value);
const _getAttrib = (id, name) => document.getElementById(id).getAttribute(name);
const _queryOne = (selector) => document.querySelector(selector);
const _queryAll = (selectors) => document.querySelectorAll(selectors);
const _getStyle = (id) => document.getElementById(id).style;
const _addStyle = (id, css) => document.getElementById(id).style = css;
const _getDisplay = (id) => document.getElementById(id).style.display;
const _toggle = (id) => _getDisplay(id) == 'none'? _toBlock(id) : _toNone(id);
const _toNone = (id) => document.getElementById($id).style.display = 'none';
const _toBlock = (id) => document.getElementById($id).style.display = 'block';
const _toInline = (id) => document.getElementById($id).style.display = 'inline-block';
const _turbo = (ex) => isset(ex) == true? _addValue('turbo', ex) : alert(_getValue('turbo'));

