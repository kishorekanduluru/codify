/* New Core JS functions */

// Limit to certain number of characters, including the ellipsis character.
String.prototype.ToLimit = function(a) {
	if (typeof (a) == typeof (1) && this.length > a - 1) {
		return this.substring(0, a - 1).replace(/ $/, '') + '&hellip;';
	} else {
		return this;
	}
}

/* End New Core JS functions */

window.onresize = getOnResizeFunctions;
var autoSuggestTimer;
var SiteLabel = new Object();


/**********************************************************************
IN:
NUM - the number to format
decimalNum - the number of decimal places to format the number to
bolLeadingZero - true / false - display a leading zero for
numbers between -1 and 1
bolParens - true / false - use parenthesis around negative numbers
bolCommas - put commas as number separators.
 
RETVAL:
The formatted number!
**********************************************************************/
function formatNumber(num, decimalNum, bolLeadingZero, bolParens, bolCommas) {

    if (isNaN(parseInt(num))) return "NaN";
    if (typeof (bolCommas) == "undefined") bolCommas = true;

    var tmpNum = num;
    var iSign = num < 0 ? -1 : 1; 	// Get sign of number

    // Adjust number so only the specified number of numbers after
    // the decimal point are shown.
    tmpNum *= Math.pow(10, decimalNum);
    tmpNum = Math.round(Math.abs(tmpNum))
    tmpNum /= Math.pow(10, decimalNum);
    tmpNum *= iSign; 				// Readjust for sign

    // Create a string object to do our formatting on
    var tmpNumStr = new String(tmpNum);

    // See if we need to strip out the leading zero or not.
    if (!bolLeadingZero && num < 1 && num > -1 && num != 0)
        if (num > 0)
        tmpNumStr = tmpNumStr.substring(1, tmpNumStr.length);
    else
        tmpNumStr = "-" + tmpNumStr.substring(2, tmpNumStr.length);

    // See if we need to put in the commas
    if (bolCommas && (num >= 1000 || num <= -1000)) {

        var iStart = tmpNumStr.indexOf(".");
        if (iStart < 0)
            iStart = tmpNumStr.length;

        iStart -= 3;
        while (iStart >= 1) {
            tmpNumStr = tmpNumStr.substring(0, iStart) + "," + tmpNumStr.substring(iStart, tmpNumStr.length)
            iStart -= 3;
        }
    }

    //do we need to add any 0 to end of decimals
    if (decimalNum > 0) {
        var iStart = tmpNumStr.indexOf(".");
        if (iStart < 0) {
            tmpNumStr = tmpNumStr + '.';
            for (i = 0; i < decimalNum; i++)
                tmpNumStr = tmpNumStr + '0';
        }
        else {
            if (tmpNumStr.length - iStart - 1 < decimalNum)
                tmpNumStr = tmpNumStr + '0';
        }
    }

    // See if we need to use parenthesis
    if (bolParens && num < 0)
        tmpNumStr = "(" + tmpNumStr.substring(1, tmpNumStr.length) + ")";

    return tmpNumStr; 	// Return our formatted string!
}

function manipulateItem(imgName, path) {
    var imgItem = document.getElementById(imgName);
    imgItem.src = path + '?ms' + new Date().getTime();
}

function reloadOpenerAndClose() {
    try {
        if (window.opener && !window.opener.closed) {
            if (window.opener.document.forms.nextPage)
                window.opener.document.forms.nextPage.submit();
            else
                window.opener.location.reload();

            window.opener.focus();
        }
        window.close();
    }
    catch(err) {
        window.close();
    }
}


function loadPageExtras() {


}

function showViaLoadingPage(url, xWidth, xHeight) {
    popupMainWindow1('loading.asp', xWidth, xHeight);
    setTimeout("mainWindow1.location.href='" + url + "';", 550);

}

function showFormProcessing() {

    if (document.getElementById('formSubmitButtons')) {

        document.getElementById('formSubmitButtons').style.display = 'none';

        if (document.getElementById('formSubmitProcessing')) {
            document.getElementById('formSubmitProcessing').style.display = 'inline';
        }
    }
}


function Browser() {

    var ua, s, i;

    this.isIE = false;
    this.isNS = false;
    this.version = null;

    ua = navigator.userAgent;

    s = "MSIE";
    if ((i = ua.indexOf(s)) >= 0) {
        this.isIE = true;
        this.version = parseFloat(ua.substr(i + s.length));
        return;
    }

    s = "Netscape6/";
    if ((i = ua.indexOf(s)) >= 0) {
        this.isNS = true;
        this.version = parseFloat(ua.substr(i + s.length));
        return;
    }

    // Treat any other "Gecko" browser as NS 6.1.

    s = "Gecko";
    if ((i = ua.indexOf(s)) >= 0) {
        this.isNS = true;
        this.version = 6.1;
        return;
    }
}

var browser = new Browser();


function getElementLeft(Elem) {

    var elem;
    if (document.getElementById) {
        var elem = document.getElementById(Elem);
    } else if (document.all) {
        var elem = document.all[Elem];
    }
    xPos = elem.offsetLeft;
    tempEl = elem.offsetParent;
    while (tempEl != null) {
        xPos += tempEl.offsetLeft;
        tempEl = tempEl.offsetParent;
    }
    return xPos;

}


function getElementTop(Elem) {

    if (document.getElementById) {
        var elem = document.getElementById(Elem);
    } else if (document.all) {
        var elem = document.all[Elem];
    }

    yPos = elem.offsetTop;
    tempEl = elem.offsetParent;

    while (tempEl != null) {
        yPos += tempEl.offsetTop;
        tempEl = tempEl.offsetParent;

    }
    return yPos;

}

function recordLinkHit(linkID, contentID) {
    // Passing the linkID to executeServerScript to record the link-hit
    executeServerScript('/core/utilities.aspx', 'mode=recordLinkHit&linkID=' + linkID + "&contentID=" + contentID, false);
}

function recordContentHit(contentID) {
    // Passing the linkID to executeServerScript to record the link-hit
    executeServerScript('/core/utilities.aspx', 'mode=recordContentHit&contentID=' + contentID, false);
}

//======================================================
//	popup DHTML searchbox
//======================================================

function showPopUpSearchBox(Elem, xOffset, yOffset, whatBox) {
    var whatBox = document.getElementById(whatBox).style

    var searchBoxWidth = whatBox.width;
    searchBoxWidth = searchBoxWidth.replace('px', '')
    var x = getElementLeft(Elem)
    var y = getElementTop(Elem)
    x = x - Number(searchBoxWidth) + Number(xOffset);
    y = y + Number(yOffset)

    if ((x != '') && (y != '')) {
        whatBox.left = x;
        whatBox.top = y;
    }


    if ((document.all.cSearch) && (cSearch.searchterm))
        cSearch.searchterm.value = '';

    if (whatBox.visibility == 'visible') {
        whatBox.visibility = 'hidden';
        whatBox.left = 0;
        whatBox.top = 0;
    }
    else {
        whatBox.visibility = 'visible';
    }
}

function checkKeyInputForPopUpSearchBox(Elem, xOffset, yOffset, whatBox) {
    if ((event.keyCode == 13) && (document.all.cSearch)) {
        cSearch.submit();
        showPopUpSearchBox(Elem, xOffset, yOffset, whatBox)
    }
}





function popupemailprompt(url) {
    muppetswin = window.open(url, "muppets", 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=300,height=152');
}

function popupComment(url) {
    commentwin = window.open(url, "comment", 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=300,height=300');
}

function popupFundedHead(url) {
    FundedHeadwin = window.open(url, "FundedHead", 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=300,height=300');
}

function popupPrint(url) {
    printwin = window.open(url, "print", 'toolbar=1,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=500,height=500');
}

function popupShowCase(url) {
    showCasewin = window.open(url, "showCase", 'toolbar=1,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=550,height=500');
}

function popupLink(url) {
    showCasewin = window.open(url, "showCase", 'toolbar=1,location=1,directories=0,status=0,menubar=1,scrollbars=1,resizable=1');
}


function centerScreen(xWidth, xHeight) {

    var uAgent = navigator.userAgent;
    if (uAgent.indexOf("Windows NT 5.1") != -1) {
        xHeight = Number(xHeight) + Number(30);
    }

    var wHeight = Number(screen.height) - Number(xHeight);
    var wWidth = Number(screen.width) - Number(xWidth);
    window.moveTo(Number(wWidth) / 2, Number(wHeight) / 2);
    window.resizeTo(xWidth, xHeight);
    window.moveTo(Number(wWidth) / 2, Number(wHeight) / 2);

}

function popupMainWindow(url, height, width) {
    var wHeight = screen.height;
    var wWidth = screen.width;
    var isHeight = Number(height);
    var isWidth = Number(width);
    var wTop = (wHeight - isHeight) / Number(2);
    var wLeft = (wWidth - isWidth) / Number(2);
    //  mainWindow  =   window.open(url,"mainWindow",'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width='+isWidth+',height='+isHeight+',top='+wTop+',left='+wLeft);
    mainWindow = window.open(url, "_blank", 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=' + isWidth + ',height=' + isHeight + ',top=' + wTop + ',left=' + wLeft);
    mainWindow.focus();
}

function popupMainWindow1(url, height, width) {
    var wHeight = screen.height;
    var wWidth = screen.width;
    var isHeight = Number(height);
    var isWidth = Number(width);
    var wTop = (wHeight - isHeight) / 2
    var wLeft = (wWidth - isWidth) / 2
    mainWindow1 = window.open(url, "mainWindow1", 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=' + isWidth + ',height=' + isHeight + ',top=' + wTop + ',left=' + wLeft);
    mainWindow1.focus();
}


function popupPrintWindow(url, height, width) {
    var wHeight = screen.height;
    var wWidth = screen.width;
    var isHeight = Number(height);
    var isWidth = Number(width);
    var wTop = (wHeight - isHeight) / 2
    var wLeft = (wWidth - isWidth) / 2
    printWindow1 = window.open(url, "printWindow1", 'toolbar=1,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=' + isWidth + ',height=' + isHeight + ',top=' + wTop + ',left=' + wLeft);
    printWindow1.focus();
}

function popupExcelWindow(url, height, width) {
    var wHeight = screen.height;
    var wWidth = screen.width;
    var isHeight = Number(height);
    var isWidth = Number(width);
    var wTop = (wHeight - isHeight) / 2
    var wLeft = (wWidth - isWidth) / 2
    excelWindow = window.open(url, "excelWindow", 'toolbar=1,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=' + isWidth + ',height=' + isHeight + ',top=' + wTop + ',left=' + wLeft);
    excelWindow.focus();
}



function isDigits(str) {
    var i
    for (i = 0; i < str.length; i++) {
        mychar = str.charAt(i)

        if ((i == 0) && (mychar == "-"))
        { }
        else if ((mychar < "0" || mychar > "9") && mychar != ".")
            return false;

    }
    return true;
}

function isDigitsNotNegative(str) {
    var i
    for (i = 0; i < str.length; i++) {
        mychar = str.charAt(i)

        if ((mychar < "0" || mychar > "9") && mychar != ".")
            return false;

    }
    return true;
}

function MM_preloadImages() { //v3.0
    var d = document; if (d.images) {
        if (!d.MM_p) d.MM_p = new Array();
        var i, j = d.MM_p.length, a = MM_preloadImages.arguments; for (i = 0; i < a.length; i++)
            if (a[i].indexOf("#") != 0) { d.MM_p[j] = new Image; d.MM_p[j++].src = a[i]; } 
    }
}

function MM_swapImgRestore() { //v3.0
    var i, x, a = document.MM_sr; for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) x.src = x.oSrc;
}

function MM_findObj(n, d) { //v4.01
    var p, i, x; if (!d) d = document; if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
        d = parent.frames[n.substring(p + 1)].document; n = n.substring(0, p);
    }
    if (!(x = d[n]) && d.all) x = d.all[n]; for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
    for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
    if (!x && d.getElementById) x = d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
    var i, j = 0, x, a = MM_swapImage.arguments; document.MM_sr = new Array; for (i = 0; i < (a.length - 2); i += 3)
        if ((x = MM_findObj(a[i])) != null) { document.MM_sr[j++] = x; if (!x.oSrc) x.oSrc = x.src; x.src = a[i + 2]; }
}

function isDate(sDate) {
    var aiDays = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    var iDay;
    var iMonth;
    var iYear;


    if (sDate.substring(1, 2) == '/') {
        iDay = parseInt(sDate.substring(0, 1), 10);
        if (sDate.substring(3, 4) == '/') {
            iMonth = parseInt(sDate.substring(2, 3), 10);
            iYear = parseInt(sDate.substring(4, 8), 10);
        }
        else {
            iMonth = parseInt(sDate.substring(2, 4), 10);
            iYear = parseInt(sDate.substring(5, 9), 10);
        }
    }
    else {
        iDay = parseInt(sDate.substring(0, 2), 10);
        if (sDate.substring(4, 5) == '/') {
            iMonth = parseInt(sDate.substring(3, 4), 10);
            iYear = parseInt(sDate.substring(5, 9), 10);
        }
        else {
            iMonth = parseInt(sDate.substring(3, 5), 10);
            iYear = parseInt(sDate.substring(6, 10), 10);
        }
    }

    if (iDay < 1 || iMonth < 1 || iYear < 0)
        return false;

    if (iMonth > 12)
        return false;

    iYear += iYear < 100 ? iYear > 10 ? 1900 : 2000 : false;
    aiDays[1] += (iYear % 4 ? false : iYear % 100 ? true : iYear % 400 ?
    iYear == 200 ? true : false : true);

    return (iDay <= aiDays[iMonth - 1]);
}

function checkemail(s) {
    var str = s;
    var filter = /^([a-zA-Z0-9_\.\-\'])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/;
    if (filter.test(str))
        testresults = true
    else {
        alert("Please input a valid email address!")
        testresults = false
    }
    return (testresults)
}


function checkPassword(txtField) {

    var error = 0;
    var errorChar = 1;
    var errorNum = 1;
    var validChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWQYZ1234567890";
    var reNum = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWQYZ"
    var reAlph = "1234567890"

    var password = txtField.value;

    // iterate through string and check against allowed character list
    for (x = 0; x < password.length; x++) {
        c = password.charAt(x);
        if (validChars.indexOf(c) == -1) {
            error = 1;
            break;
        }
    }

    // check to make sure contains numbers and characters
    for (x = 0; x < password.length; x++) {
        c = password.charAt(x);
        if (reNum.indexOf(c) != -1) {
            errorChar = 0;
            break;
        }
    }
    // check to make sure contains numbers and characters
    for (x = 0; x < password.length; x++) {
        c = password.charAt(x);
        if (reAlph.indexOf(c) != -1) {
            errorNum = 0;
            break;
        }
    }

    // display appropriate message
    if ((error == 1) || (password.length < 6) || (errorChar == 1) || (errorNum == 1)) {
        alert("The PASSWORD must be a minimum of 6 characters and contain a mixture of letters and numbers")
        txtField.focus();
        return false;
    }
    else {
        return true;
    }
}

function leftTrim(sString) {
    while (sString.substring(0, 1) == ' ') {
        sString = sString.substring(1, sString.length);
    }
    return sString;
}

function rightTrim(sString) {
    while (sString.substring(sString.length - 1, sString.length) == ' ') {
        sString = sString.substring(0, sString.length - 1);
    }
    return sString;
}

function trim(sString) {
    while (sString.substring(0, 1) == ' ') {
        sString = sString.substring(1, sString.length);
    }
    while (sString.substring(sString.length - 1, sString.length) == ' ') {
        sString = sString.substring(0, sString.length - 1);
    }
    return sString;
}


function closeAndFocusOpener() {

    if (window.opener && !window.opener.closed) {
        window.opener.focus();
    }
    window.close();
}


function setHiddenFieldValue(hiddenFieldID, value) {
    if (document.getElementById(hiddenFieldID))
        document.getElementById(hiddenFieldID).value = value;
}

function getHiddenFieldValue(hiddenFieldID) {
    if (document.getElementById(hiddenFieldID))
        return document.getElementById(hiddenfieldID).value;
}


function ShowHideAddNotice(hiddenfieldID, mainDivID, activeDiv, deactiveDiv, txtName, txtMessage, ddlCategory, chkPriority, txtDateOn, txtDateOff) {
    if (document.getElementById(hiddenfieldID).value == 'none'
            || document.getElementById(hiddenfieldID).value == ''
            || document.getElementById(hiddenfieldID).value == null) {
        document.getElementById(hiddenfieldID).value = 'inline';
        document.getElementById(activeDiv).style.display = 'none';
        document.getElementById(deactiveDiv).style.display = 'inline';
    }
    else {
        document.getElementById(hiddenfieldID).value = 'none';
        document.getElementById(activeDiv).style.display = 'inline';
        document.getElementById(deactiveDiv).style.display = 'none';

        document.getElementById(txtName).value = "";
        document.getElementById(txtMessage).value = "";
        document.getElementById(ddlCategory).selectedIndex = 0;
        document.getElementById(chkPriority).checked = false;
        var thetime = new Date();
        var date = thetime.format("dd-MMM-yyyy");
        document.getElementById(txtDateOn).value = date;
        document.getElementById(txtDateOff).value = "";
    }

    document.getElementById(mainDivID).style.display = document.getElementById(hiddenfieldID).value;
}

function ShowHideArchiveNotice(index, hiddenfieldID, siteName) {
    if (document.getElementById(hiddenfieldID).value == 'none'
            || document.getElementById(hiddenfieldID).value == ''
            || document.getElementById(hiddenfieldID).value == null) {
        document.getElementById(hiddenfieldID).value = 'inline';

        document.getElementById('hlnkExpandNotice' + index).style.display = 'none';
        document.getElementById('hlnkCloseNotice' + index).style.display = 'inline';
        document.getElementById('imgExpandClose' + index).src = '/Images/' + siteName + '/icons/minimise.gif';
    }
    else {
        document.getElementById(hiddenfieldID).value = 'none';

        document.getElementById('hlnkExpandNotice' + index).style.display = 'inline';
        document.getElementById('hlnkCloseNotice' + index).style.display = 'none';
        document.getElementById('imgExpandClose' + index).src = '/Images/' + siteName + '/icons/expand.gif';
    }

    document.getElementById('noticeMain' + index).style.display = document.getElementById(hiddenfieldID).value;
}

function forceEventTarget(eventTarget) {
    document.forms.aspnetForm.__EVENTTARGET.value = eventTarget;
}

/*
=================================================================================
Autosuggest Box
=================================================================================
*/

function autoSuggestSelectObject(e, elem, inputName, divName, specialCase, inputID, mode, requiredChars) {
    var elemValue = elem.value;

    // escape  
    if(e.keyCode != 27) {
        elem.style.color = '#ff0000';
        if(specialCase != 'STAFFMULTIPLE')

            document.getElementById(inputID).value = 0;

        if(document.getElementById(inputName).value == '') {
            if(document.getElementById(divName + 'Close'))
                document.getElementById(divName + 'Close').style.visibility = 'hidden';

            document.getElementById(divName).style.visibility = 'hidden';

            if(document.getElementById(divName + 'DeleteAll'))
                document.getElementById(divName + 'DeleteAll').style.visibility = 'visible';
        }
        else {

            if(document.getElementById(divName + 'DeleteAll'))
                document.getElementById(divName + 'DeleteAll').style.visibility = 'hidden';

            document.getElementById(divName).style.visibility = 'visible';

            if(document.getElementById(divName + 'Close'))
                document.getElementById(divName + 'Close').style.visibility = 'visible';
        }

        clearTimeout(autoSuggestTimer);
        elemValue = elemValue.replace(/'/g, "apostrophe");

        autoSuggestTimer = setTimeout("autoSuggestSelectObjectTimer('" + divName + "','" + inputID + "','" + elem.value + "','" + inputName + "','" + mode + "'," + requiredChars + ")", 500);
    }
}

function autoSuggestSelectObjectTimer(divName, inputID, elemValue, inputName, mode, requiredChars) {
    makeHttpRequest("/Core/Utilities.aspx", "putHtml", divName, false, "inputID=" + inputID + "&searchTerm=" + elemValue + "&divName=" + divName + "&inputName=" + inputName + "&mode=" + mode + "&requiredChars=" + requiredChars);
}

function autoSuggestMoveUpDown(elem, e, inputElem, listElem) {

    var elemId = elem.id
    var elemLen = elemId.length
    var elemCur = elemId.substring(listElem.length, elemLen)
    var elemNext = Number(elemCur) + 1
    var elemPrev = Number(elemCur) - 1

    var isListVisible = document.getElementById(listElem).style.display;
    if(isListVisible == 'inline')
        isListVisible = true;
    else
        isListVisible = false;


    // down key
    if(e.keyCode == 40) {
        // is this the select box
        if(elemId == inputElem) {
            if(document.getElementById(listElem + '1')) {

                document.getElementById(inputElem).blur();
                document.getElementById(listElem + '1').focus();
                document.getElementById(listElem + '1').className = 'autoSuggestHightlight';
            }
        }
        else {
            // if not last a element
            if(document.getElementById(listElem + elemNext)) {
                document.getElementById(listElem + elemCur).className = 'autoSuggestUnHightlight';
                document.getElementById(listElem + elemNext).focus();
                document.getElementById(listElem + elemNext).className = 'autoSuggestHightlight';
            }
        }
    }

    // down up
    else if(e.keyCode == 38) {
        if(elemCur) {
            // if there is a previous a element
            if(document.getElementById(listElem + elemPrev)) {
                document.getElementById(listElem + elemCur).className = 'autoSuggestUnHightlight';
                document.getElementById(listElem + elemPrev).focus();
                document.getElementById(listElem + elemPrev).className = 'autoSuggestHightlight';
            }
            // otherwise focus on input box
            else {
                document.getElementById(listElem + elemCur).className = 'autoSuggestUnHightlight';
                document.getElementById(inputElem).focus();
            }
        }
    }

    // escape
    else if(e.keyCode == 27)
        autoSuggestClose(listElem);

    // backspace    
    else if(e.keyCode == 8)
        return false;
}


function autoSuggestSelectObjectAdd(objectID, objectName, inputName, inputID, inputDiv) {

    document.getElementById(inputName).value = objectName;
    document.getElementById(inputID).value = objectID;
    autoSuggestClose(inputDiv);
    document.getElementById(inputName).style.color = '#3d3d3d';


    /* if there is a script to run */
    if(document.getElementById(inputID + 'jScriptEval'))
        eval(document.getElementById(inputID + 'jScriptEval').value);


    __doPostBack(inputID, '');
    // To be removed
    //window.location.reload();
}


function autoSuggestClose(inputDiv) {

    if(document.getElementById(inputDiv))
        document.getElementById(inputDiv).style.visibility = 'hidden';

    if(document.getElementById(inputDiv + 'Close'))
        document.getElementById(inputDiv + 'Close').style.visibility = 'hidden';

    if(document.getElementById(inputDiv + 'DeleteAll'))
        document.getElementById(inputDiv + 'DeleteAll').style.visibility = 'visible';
}

/*
=================================================================================
AJAX
=================================================================================
*/

function putHtml(value, param) {
    if (document.getElementById(param))
        document.getElementById(param).innerHTML = value;
}

function putParentHtml(value, param) {
    if (window.parent.document.getElementById(param))
        window.parent.document.getElementById(param).innerHTML = value;
}

function makeHttpRequest(url, callback_function, param, return_xml, postParams, async) {
    var http_request = false;

    if (typeof async == 'undefined')
        async = true;

    if (window.XMLHttpRequest) { // Mozilla, Safari,... 
        http_request = new XMLHttpRequest();
        if (http_request.overrideMimeType) {
            http_request.overrideMimeType('text/xml');
        }
    } else if (window.ActiveXObject) { // IE 
        try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) { }
        }
    }
    if (!http_request) {
        alert('You browser doesn\'t support this feature.');
        return false;
    }

    // if asynchronous   
    if (async == true) {
        http_request.onreadystatechange = function() {
            if (http_request.readyState == 4) {

                if (http_request.status == 200) {
                    if (return_xml) {
                        eval(callback_function + '(http_request.responseXML,param)');
                    } else {
                        eval(callback_function + '(http_request.responseText,param)');
                    }
                } else {
                    alert('There was a problem with the request.(Code: ' + http_request.status + ')');
                }
            }
        }
    }

    // is this a POST or a GET 
    if ((postParams) && (postParams != '')) {
        postParams = postParams + '&xml=1&ms=' + new Date().getTime();
        postParams = encodeURI(postParams);
        http_request.open('POST', url, async);
        http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http_request.setRequestHeader("Content-length", postParams.length);
        http_request.setRequestHeader('REFERER', document.location);
        http_request.send(postParams);
    }
    else {
        url = url + '&xml=1&ms=' + new Date().getTime();
        http_request.open('GET', url, async);
        http_request.setRequestHeader('REFERER', document.location);
        http_request.send(null);
    }

    // if synchronous       
    if (async == false) {
        if (http_request.readyState == 4) {

            if (http_request.status == 200) {
                if (return_xml) {
                    eval(callback_function + '(http_request.responseXML,param)');
                } else {
                    eval(callback_function + '(http_request.responseText,param)');
                }
            } else {
                alert('There was a problem with the request.(Code: ' + http_request.status + ')');
            }
        }
    }

}

function executeServerScript(url, postParams, async) {
    var http_request = false;

    if (typeof async == 'undefined')
        async = true;

    if (window.XMLHttpRequest) { // Mozilla, Safari,... 
        http_request = new XMLHttpRequest();
        if (http_request.overrideMimeType) {
            http_request.overrideMimeType('text/xml');
        }
    } else if (window.ActiveXObject) { // IE 
        try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) { }
        }
    }

    if (!http_request) {
        alert('You browser doesn\'t support this feature.');
        return false;
    }
    if (async == true) {
        http_request.onreadystatechange = function() { }
    }

    if ((postParams) && (postParams != '')) {

        postParams = postParams + '&xml=1&ms=' + new Date().getTime();

        postParams = encodeURI(postParams);

        http_request.open('POST', url, async);
        http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http_request.setRequestHeader("Content-length", postParams.length);
        http_request.setRequestHeader('REFERER', document.location);
        http_request.send(postParams);

    }
    else {
        url = url + '&xml=1&ms=' + new Date().getTime();
        http_request.open('GET', url, true);
        http_request.setRequestHeader('REFERER', document.location);
        http_request.send(null);
    }

}


/*
=================================================================================
OVERLAY
=================================================================================
*/

function getOnResizeFunctions() {
    if (document.getElementById('overlay')) {
        if (document.getElementById('overlay').style.visibility == 'visible') {
            savingDialogueDisplay('');

        }
    }
}

function savingDialogueDisplay(elem) {
    var elemH, elemW;

    window.scroll(0, 0);
    var myH = 0, myW = 0, d = window.document.documentElement, b = window.document.body;
    myH = b.clientHeight;
    myW = b.clientWidth;

    elemH = d.clientHeight;
    elemW = d.clientWidth;

    if (Number(elemH) > Number(myH))
        myH = elemH;

    var marginTop = (Number(myH) / 2) - 47;

    if (browser.isIE) {
        myW = myW - 22;
    }

    document.getElementsByTagName("html")[0].style.overflowX = 'hidden';
    document.getElementById('overlay').style.height = myH + 'px';
    document.getElementById('overlay').style.width = myW + 'px';
    document.getElementById('overlay').style.visibility = 'visible';


}

function showOverlay(divName) {
    var el;

    el = document.getElementById(divName);

    el.style.display = "inline";

    savingDialogueDisplay('');
}

function closeOverlay(divName) {
    var el;

    el = document.getElementById(divName);

    el.style.display = "none";

    hideOverlay();
}



function hideOverlay() {
    document.getElementsByTagName("html")[0].style.overflowX = 'auto';
    document.getElementById('overlay').style.visibility = 'hidden';
}

function hideOverlayIfOk(elem) {
    alert(document.getElementById(elem).value);
    if (document.getElementById(elem).value == "true") {
        document.getElementsByTagName("html")[0].style.overflowX = 'auto';
        document.getElementById('overlay').style.visibility = 'hidden';
    }
}

/*
=================================================================================
POST ITS
=================================================================================
*/

function viewMessages() {
    document.getElementById('ctl00_ctl00_ContentPlaceHolderPageFrame_MessageNote_pnlMessageNote').style.display = 'inline';
}

function hideMessages() {
    document.getElementById('ctl00_ctl00_ContentPlaceHolderPageFrame_MessageNote_pnlMessageNote').style.display = 'none';
}

function closeNewMessage(divID, textBoxMain, textBoxAutoComplete, hiddenField) {
    if (document.getElementById(textBoxMain))
        document.getElementById(textBoxMain).value = "";

    if (document.getElementById(textBoxAutoComplete))
        document.getElementById(textBoxAutoComplete).value = "";

    if (document.getElementById(hiddenField))
        document.getElementById(hiddenField).value = "";

    // hide the message box if there is one
    if (document.getElementById(divID))
        document.getElementById(divID).style.display = 'none';

    // and hide the overlay (which is always there)
    hideOverlay();
}

function addNewMessage(noteDivID, newMsgDivID) {

    if (document.getElementById(noteDivID))
        document.getElementById(noteDivID).style.display = 'none';
    if (document.getElementById(newMsgDivID))
        document.getElementById(newMsgDivID).style.display = 'inline';
    savingDialogueDisplay('');
}

// Clear text in text box
function clearTextBox(txtBoxID, text) {
    if (document.getElementById(txtBoxID).value == text)
        document.getElementById(txtBoxID).value = '';
}


// Put default text in textbox
function addDefaultText(txtBoxID, text) {
    if (document.getElementById(txtBoxID).value == '')
        document.getElementById(txtBoxID).value = text;
}

/*
=================================================================================
Set session value
=================================================================================
*/

function setSessionValue(sessionName, sessionValue, url) {
    // Setting the specified session object to the specified value.  ContentID required for redirection of page
    executeServerScript('/core/utilities.aspx', 'mode=storeSession&sessionName=' + sessionName + '&sessionValue=' + sessionValue, false);

    if (url != null && url != '') {
        window.location.href = url;
    }
}


/*
=================================================================================
Show / Hide sliding div
=================================================================================
*/

function showElement(divName, divExpand, divShrink, divHeight, log, contentID, multiple) {
    var elHeight
    var el = document.getElementById(divName);
    var openDiv = "hfOpenDiv" + contentID;
    var openDivName;


    if (multiple == 1) {
        //Hide the currently open div
        if (document.getElementById(openDiv).value != "") {
            openDivName = document.getElementById(openDiv).value;
            document.getElementById(openDivName).style.left = "-5000px";
            document.getElementById(openDivName).style.position = "absolute";
        }

        // Record the currently open div if there are potentially multiple sliders for one item
        document.getElementById(openDiv).value = divName;
    }

    // log hit to the current content if flagged
    if (log == 1)
        recordContentHit(contentID);

    // check if the divHeight name contains a value
    if (document.getElementById(divHeight).value == "") {
        // Work out height of div
        elHeight = el.offsetHeight;
        document.getElementById(divHeight).value = elHeight;
    }
    else {
        elHeight = document.getElementById(divHeight).value;
    }

    // Set styles up ready
    el.style.height = "0px";
    el.style.position = "relative";
    el.style.left = "0px";

    // Display div
    resizeElement(divName, 'height', '+', 15, 0, elHeight)

    // Hide expand button
    document.getElementById(divExpand).style.display = "none";

    // Show shrink button
    document.getElementById(divShrink).style.display = "block";
}

function hideElement(divName, divExpand, divShrink, contentID, multiple) {
    var el = document.getElementById(divName);
    var openDiv = "hfOpenDiv" + contentID;

    // If there are multiple sliders from one item, clear the hidden field containing the divName
    if (multiple == 1)
        document.getElementById(openDiv).value = "";

    // Getting initial height
    var elHeight = el.offsetHeight;

    // Hide div
    resizeElement(divName, 'height', '-', 15, elHeight, 0, divExpand, divShrink)

    el.style.height = elHeight + "px";
}


function resizeElement(elem, moveType, direction, moveBy, moveFrom, moveTo, divExpand, divShrink) {
    var el = document.getElementById(elem);
    var posNow = 0;

    if (el.height == '')
        el.style.height = moveFrom + 'px';

    if (el.width == '')
        el.style.width = moveFrom + 'px';

    /*==== height ===*/
    if (moveType == 'height') {
        if (direction == '+') {

            if (Number(moveFrom) < Number(moveTo)) {
                moveFrom = Number(moveFrom) + Number(moveBy);
                posNow = el.style.height;
                posNow = posNow.replace('px', '');

                if ((Number(posNow) + Number(moveBy)) > Number(moveTo))
                    el.style.height = Number(moveTo) + 'px'
                else
                    el.style.height = Number(posNow) + Number(moveBy) + 'px'

                setTimeout("resizeElement('" + elem + "','" + moveType + "','" + direction + "','" + moveBy + "','" + moveFrom + "','" + moveTo + "','" + divExpand + "','" + divShrink + "')", 1);
            }
        }
        else if (direction == '-') {
            if (Number(moveFrom) > Number(moveTo)) {
                moveFrom = Number(moveFrom) - Number(moveBy);
                posNow = el.style.height;
                posNow = posNow.replace('px', '');
                if ((Number(posNow) - Number(moveBy)) <= Number(moveTo))
                    el.style.height = Number(moveTo) + 'px'
                else
                    el.style.height = Number(posNow) - Number(moveBy) + 'px'
                setTimeout("resizeElement('" + elem + "','" + moveType + "','" + direction + "','" + moveBy + "','" + moveFrom + "','" + moveTo + "','" + divExpand + "','" + divShrink + "')", 1);
            }
            else {
                //el.style.height = elHeight + "px";
                el.style.left = "-5000px";
                el.style.position = "absolute";

                // Hide shrink button
                try {
                    document.getElementById(divShrink).style.display = "none";

                    // Show expand button
                    document.getElementById(divExpand).style.display = "block";
                }
                catch (e) { }
            }
        }
    }
    /*==== width ===*/
    if (moveType == 'width') {
        if (direction == '+') {

            if (Number(moveFrom) < Number(moveTo)) {
                moveFrom = Number(moveFrom) + Number(moveBy);
                posNow = el.style.width;
                posNow = posNow.replace('px', '');

                if ((Number(posNow) + Number(moveBy)) > Number(moveTo))
                    el.style.width = Number(moveTo) + 'px'
                else
                    el.style.width = Number(posNow) + Number(moveBy) + 'px'

                setTimeout("resizeElement('" + elem + "','" + moveType + "','" + direction + "','" + moveBy + "','" + moveFrom + "','" + moveTo + "')", 50);
            }
        }
        else if (direction == '-') {
            if (Number(moveFrom) > Number(moveTo)) {
                moveFrom = Number(moveFrom) - Number(moveBy);
                posNow = el.style.width;
                posNow = posNow.replace('px', '');
                if ((Number(posNow) - Number(moveBy)) <= Number(moveTo))
                    el.style.width = Number(moveTo) + 'px'
                else
                    el.style.width = Number(posNow) - Number(moveBy) + 'px'
                setTimeout("resizeElement('" + elem + "','" + moveType + "','" + direction + "','" + moveBy + "','" + moveFrom + "','" + moveTo + "')", 50);
            }
        }
    }
}

function switchShowHide(divName, divExpand, divShrink, divHeight, title, titleID, show, log, contentID, multiple) {
    if (show == 1) {
        showElement(divName, divExpand, divShrink, divHeight, log, contentID, multiple)
        document.getElementById(titleID).innerHTML = "<a href=\"javascript:switchShowHide('" + divName + "','" + divExpand + "','" + divShrink + "','" + divHeight + "','" + title + "','" + titleID + "', 0," + log + "," + contentID + "," + multiple + ")\">" + title + "</a>";
    }
    else {
        hideElement(divName, divExpand, divShrink, contentID, multiple)
        document.getElementById(titleID).innerHTML = "<a href=\"javascript:switchShowHide('" + divName + "','" + divExpand + "','" + divShrink + "','" + divHeight + "','" + title + "','" + titleID + "', 1," + log + "," + contentID + "," + multiple + ")\">" + title + "</a>";
    }
}

function openDiv(divName, divExpand, divShrink, divHeight, title, titleID, show, log, contentID, multiple) {
    showElement(divName, divExpand, divShrink, divHeight, log, contentID, multiple)
    document.getElementById(titleID).innerHTML = "<a href=\"javascript:switchShowHide('" + divName + "','" + divExpand + "','" + divShrink + "','" + divHeight + "','" + title + "','" + titleID + "', 0," + log + "," + contentID + "," + multiple + ")\">" + title + "</a>";
}

function closeDiv(divName, divExpand, divShrink, divHeight, title, titleID, show, log, contentID, multiple) {
    hideElement(divName, divExpand, divShrink, contentID, multiple)

    try {
        document.getElementById(titleID).innerHTML = "<a href=\"javascript:switchShowHide('" + divName + "','" + divExpand + "','" + divShrink + "','" + divHeight + "','" + title + "','" + titleID + "', 1," + log + "," + contentID + "," + multiple + ")\">" + title + "</a>";
    }
    catch (e) { }
}

function setHeightValue(divName, divHeightName) {
    var el = document.getElementById(divName);
    var elHeight;

    // Work out height of div
    elHeight = el.offsetHeight;
    document.getElementById(divHeightName).value = elHeight;
}
/*
=================================================================================
Preview
=================================================================================
*/
function setUpClosePreviewButton(buttonID) {
    try {
        if (window.opener) {
            document.getElementById(buttonID).src = "/Images/Core/previewBar/linkArea_return.png";
            document.getElementById(buttonID).value = "return";
        }
        else {
            document.getElementById(buttonID).src = "/Images/Core/previewBar/linkArea_cancel.png";
            document.getElementById(buttonID).value = "cancel";
        }
    }
    catch (e) {
        document.getElementById(buttonID).src = "/Images/Core/previewBar/linkArea_cancel.png";
        document.getElementById(buttonID).value = "cancel";
    }
}

function cancelPreview(buttonID) {
    if (document.getElementById(buttonID).value == "return") {
        window.close();
    }
}


/*
=================================================================================
FAVOURITES
=================================================================================
*/

function addYourFavourite(contentID, visibleLinkID, notVisibleLinkID) {
    executeServerScript('/core/utilities.aspx', 'mode=addYourFavourite&contentID=' + contentID, false);
    if (document.getElementById(visibleLinkID))
        document.getElementById(visibleLinkID).style.display = 'inline';
    if (document.getElementById(notVisibleLinkID))
        document.getElementById(notVisibleLinkID).style.display = 'none';

}

function deleteYourFavourite(contentID, visibleLinkID, notVisibleLinkID, changeLinks) {
    executeServerScript('/core/utilities.aspx', 'mode=deleteYourFavourite&contentID=' + contentID, false);
    if (changeLinks) {
        if (document.getElementById(visibleLinkID))
            document.getElementById(visibleLinkID).style.display = 'inline';
        if (document.getElementById(notVisibleLinkID))
            document.getElementById(notVisibleLinkID).style.display = 'none';
    }

}


//////////////////////
// BLACKBERRY MENUS //
//////////////////////
function openDropDown(menuId, lvl) {
    if (lvl == "1") {
        // if top level close all open menus
        if ($('#' + menuId).hasClass('lvl1Open')) {
            $('.menut > ul > li').css('position', 'static');
            $('.lvl1Open').css('visibility', 'hidden');
            $('.lvl1Open').removeClass('lvl1Open');
            $('.lvl2Open').css('visibility', 'hidden');
            $('.lvl2Open').removeClass('lvl2Open');
        } else {
            $('.menut > ul > li').css('position', 'static');
            $('.lvl1Open').css('visibility', 'hidden');
            $('.lvl1Open').removeClass('lvl1Open');
            $('.lvl2Open').css('visibility', 'hidden');
            $('.lvl2Open').removeClass('lvl2Open');
            $('#' + menuId).parents('li').css('position', 'relative');
            $('#' + menuId).css('visibility', 'visible');
            $('#' + menuId).addClass('lvl1Open');
        };
    } else {
        // if second level close all 2nd level open menus
        $('.lvl2Open').css('visibility', 'hidden');
        $('.lvl2Open').removeClass('lvl2Open');
        //open target ul
        $('#' + menuId).css('visibility', 'visible');
        $('#' + menuId).addClass('lvl2Open');
    };
};

// set session language
function setSessionLanguage(languageID) {
    executeServerScript('/core/utilities.aspx', 'mode=setSessionLanguage&languageID=' + languageID, false);
}


function getMSIEInline() {
    var bType;
    if (navigator.userAgent.indexOf('MSIE') >= 0)
        bType = 'inline';
    else
        bType = 'table-row';

    return bType;
}