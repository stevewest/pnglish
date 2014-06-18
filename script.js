/**
 * This work is licenced under the Creative Commons
 * Attribution-Non-Commercial-Share Alike 2.0 UK: England & Wales License. To
 * view a copy of this licence, visit
 * http://creativecommons.org/licenses/by-nc-sa/2.0/uk/ or send a letter to
 * Creative Commons, 171 Second Street, Suite 300, San Francisco,
 * California 94105, USA.
 *
 * @@copyright Steve "Uru" West 2010
 * @author Steve "Uru" West
 * @version 2010-01-06
 */

function newWindow( path ){
    window.open(path,'help','width=600,height=600,toolbar=no,directories=no,status=yes,menubar=no,copyhistory=no');
}

function resetText(){
    var to= confirm("Do you really want to clear the script?");
    if (to== true)
    {
        document.main.output.value = "";
        document.main.input.value = "";
    }
}

function downloadFile(file){
    window.open('./download.php?f='+file,'download','width=300,height=100,toolbar=no,directories=no,status=yes,menubar=no,copyhistory=no');
}

function error(){
    alert('This is not currently avaliable');
}

function insertAtCursor(myField, myValue) {
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
    }
    else if (myField.selectionStart || myField.selectionStart == 0) {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value = myField.value.substring(0, startPos)
        + myValue
        + myField.value.substring(endPos, myField.value.length);
    } else {
        myField.value += myValue;
    }
    document.main.input.focus();
}

function createTextAreaWithLines(id)
{
    var el = document.createElement('TEXTAREA');
    var ta = document.getElementById(id);
    var string = '';
    for(var no=1;no<300;no++){
        if(string.length>0)string += '\n';
        string += no;
    }
    el.className      = 'textAreaWithLines';
    el.style.height   = (ta.offsetHeight-3) + "px";
    el.style.width    = "25px";
    el.style.position = "absolute";
    el.style.overflow = 'hidden';
    el.style.textAlign = 'right';
    el.style.paddingRight = '0.2em';
    el.innerHTML      = string;  //Firefox renders \n linebreak
    el.innerText      = string; //IE6 renders \n line break
    el.style.zIndex   = 0;
    ta.style.zIndex   = 1;
    ta.style.position = "relative";
    ta.parentNode.insertBefore(el, ta.nextSibling);
    setLine();
    ta.focus();

    ta.onkeydown    = function() {
        setLine();
    }
    ta.onmousedown  = function() {
        setLine();
    }
    ta.onscroll     = function() {
        setLine();
    }
    ta.onblur       = function() {
        setLine();
    }
    ta.onfocus      = function() {
        setLine();
    }
    ta.onmouseover  = function() {
        setLine();
    }
    ta.onmouseup    = function() {
        setLine();
    }

    function setLine(){
        el.scrollTop   = ta.scrollTop;
        el.style.top   = (ta.offsetTop) + "px";
        el.style.left  = (ta.offsetLeft - 27) + "px";
    }
} 