/***********************************************
* Cool DHTML tooltip script II- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var offsetfromcursorX=12; //Customize x offset of tooltip
var offsetfromcursorY=10; //Customize y offset of tooltip

var offsetdivfrompointerX=10; //Customize x offset of tooltip DIV relative to pointer image
var offsetdivfrompointerY=14; //Customize y offset of tooltip DIV relative to pointer image. Tip: Set it to (height_of_pointer_image-1).

document.write('<div id="revInfoTip"><div class="revInfoTipInner"><h4> Information</h4><div id="revInfoTipText">&nbsp;</div></div></div>');
document.write('<div id="revToolTip"></div>'); //write out tooltip DIV
//document.write('<img alt="""" id="revToolTipPointer" src="/images/tooltip.gif" />'); //write out pointer image

var ie=document.all;
var ns6=document.getElementById && !document.all;
var enabletip=false;
var objToShow = '';

if (ie||ns6)
{
    var tipobj=document.all? document.all["revToolTip"] : document.getElementById? document.getElementById("revToolTip") : "";
    var infoObj=document.all? document.all["revInfoTip"] : document.getElementById? document.getElementById("revInfoTip") : "";
    var infoObjText=document.all? document.all["revInfoTipText"] : document.getElementById? document.getElementById("revInfoTipText") : "";

}

//var pointerobj=document.all? document.all["revToolTipPointer"] : document.getElementById? document.getElementById("revToolTipPointer") : "";

function ietruebody()
{
    return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
}

function showRevToolTipSA(thetext,thewidth,top,left,tipStyle)
{
    if (tipStyle == 'INFO')
        objToShow = infoObj;
    else
        objToShow = tipobj
    
    thetext = thetext + '<a href="javascript:hideRevToolTipSA()"><img style="margin-left:120px;" alt="" src="/images/icons/other/FFFFFFonFFFFFF/okButton.gif" /></a><br /><br />'
    
    objToShow = infoObj;
    objToShow.style.width=thewidth+"px"
    objToShow.style.top=top+"px"
    objToShow.style.left=left+"px"
    infoObjText.innerHTML=thetext;
    objToShow.style.visibility="visible";
}

function showRevToolTip(thetext, thewidth, tipStyle)
{
    if (ns6||ie)
    {   
    
        if (tipStyle == 'INFO')
        {
            objToShow = infoObj;
            if ((typeof thewidth!="undefined") && (thewidth != '') && (!isNaN(parseInt(thewidth))) ) objToShow.style.width=thewidth+"px";
            else objToShow.style.width = 'auto';
            infoObjText.innerHTML=thetext;         
        }
        else
        {
            objToShow = tipobj
            if ((typeof thewidth!="undefined") && (thewidth != '') && (!isNaN(parseInt(thewidth)))) objToShow.style.width=thewidth+"px";
            else objToShow.style.width = 'auto';
            objToShow.innerHTML=thetext;

        }
        enabletip=true;
        return false;
    }
}

function positiontip(e)
{
    if (enabletip)
    {   
        var nondefaultpos=false
        var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
        var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
        //Find out how close the mouse is to the corner of the window
        var winwidth=ie&&!window.opera? ietruebody().clientWidth : window.innerWidth-20
        var winheight=ie&&!window.opera? ietruebody().clientHeight : window.innerHeight-20

        var rightedge=ie&&!window.opera? winwidth-event.clientX-offsetfromcursorX : winwidth-e.clientX-offsetfromcursorX
        var bottomedge=ie&&!window.opera? winheight-event.clientY-offsetfromcursorY : winheight-e.clientY-offsetfromcursorY

        var leftedge=(offsetfromcursorX<0)? offsetfromcursorX*(-1) : -1000

        //if the horizontal distance isn't enough to accomodate the width of the context menu
        if (rightedge<objToShow.offsetWidth)
        {
            //move the horizontal position of the menu to the left by it's width
            objToShow.style.left=curX-objToShow.offsetWidth+"px"
            //pointerobj.style.left=curX+offsetfromcursorX-33+"px" // tim change
            nondefaultpos=true
        }
        else if (curX<leftedge)
            objToShow.style.left="5px"
        else
        {
            //position the horizontal position of the menu where the mouse is positioned
            objToShow.style.left=curX+offsetfromcursorX-offsetdivfrompointerX+"px"
            //pointerobj.style.left=curX+offsetfromcursorX+"px"
        }

        //same concept with the vertical position
        if (bottomedge<objToShow.offsetHeight)
        {
            objToShow.style.top=curY-objToShow.offsetHeight-offsetfromcursorY+"px"
            nondefaultpos=true
        }
        else
        {
            objToShow.style.top=curY+offsetfromcursorY+offsetdivfrompointerY+"px"
            //pointerobj.style.top=curY+offsetfromcursorY+"px"
        }

        objToShow.style.visibility="visible"

       // if (!nondefaultpos)
            //pointerobj.style.visibility="visible"
       // else
       //     pointerobj.style.visibility="visible" //  tim change
    }
}

function hideRevToolTip()
{

    if (ns6||ie)
    {
        enabletip=false
        objToShow.style.visibility="hidden";
        //pointerobj.style.visibility="hidden";
        objToShow.style.left="-1000px";
    }
}

function hideRevToolTipSA()
{

    if (ns6||ie)
    {
        objToShow.style.visibility="hidden";
        objToShow.style.left="-1000px";
    }
}

document.onmousemove=positiontip;