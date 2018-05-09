window.histoPeriodWidget = (function (el, apiBaseURL, fsym, tsym, widgetsBaseUrl) {
var embedable = document.createElement("div");

function cccCreateCSSSelector(selector, styleRules) {
var style = document.createElement('style');
style.type = 'text/css';
document.getElementsByTagName('head')[0].appendChild(style);
if (!(style.sheet || {}).insertRule) {
(style.styleSheet || style.sheet).addRule(selector, styleRules);
} else {
style.sheet.insertRule(selector + "{" + styleRules + "}", 0);
}
}


if (typeof cccTheme !== 'undefined') {
for (var key in cccCurrentTheme) {
var group = cccCurrentTheme[key];
for (var prop in group) {
if (!group.hasOwnProperty(prop)) {
continue;
}
if (cccTheme.hasOwnProperty(key) && cccTheme[key].hasOwnProperty(prop)) {
cccCurrentTheme[key][prop] = cccTheme[key][prop];
}
}
}
}

if (typeof cccThemeHistoWeek !== 'undefined') {
for (var key in cccCurrentTheme) {
var group = cccCurrentTheme[key];
for (var prop in group) {
if (!group.hasOwnProperty(prop)) {
continue;
}
if (cccThemeHistoWeek.hasOwnProperty(key) && cccThemeHistoWeek[key].hasOwnProperty(prop)) {
cccCurrentTheme[key][prop] = cccThemeHistoWeek[key][prop];
}
}
}
}

var weekCurrentScript = el;
var histoPeriodDateStart = '';
var histoPeriodDateEnd = '';

function render() {

var cccCurrentTheme = {
General: {
background: '#FFF',
borderWidth: '0px',
borderColor: '#ffcd04',
boxShadow: '0px 0px 10px #ddd',
borderRadius: '0 0 0 0',
textColor: '#000'
},
Rows: {
borderColor: 'rgba(93,93,93,0.4)',
textColor: '#555',
upColor: '#0fc73e',
downColor: '#cf596f'
},
Conversion: {
background: 'transparent',
lineHeight: '20px',
color: '#000',
}
};


var embedablePriceInfo = document.createElement("div");

embedable.className = "ccc-widget ccc-histo-period";

embedablePriceInfo.style.background = cccCurrentTheme.General.background;
embedablePriceInfo.style.border = cccCurrentTheme.General.borderWidth + ' solid ' + cccCurrentTheme.General.borderColor;
embedablePriceInfo.style.borderRadius = cccCurrentTheme.General.borderRadius;
embedablePriceInfo.style.color = cccCurrentTheme.General.textColor;
embedablePriceInfo.style.boxShadow = cccCurrentTheme.General.boxShadow;
embedablePriceInfo.style.paddingBottom = '15px';
cccCreateCSSSelector('div.histoTitle', 'padding:20px; font-size: 18px; font-weight: 400; margin-top: 28px;');
cccCreateCSSSelector('div.histoRow', 'color:#253137; overflow: auto; font-weight:100; font-size: 14px; padding:  5px 15px; ');
cccCreateCSSSelector('@media (max-width: 567px)', 'div.histoRow {color:#253137; overflow: auto; font-weight:100; font-size: 10px; padding:  5px 15px; }');
cccCreateCSSSelector('div.histoRow div', 'text-align: right; float: left; width: 25%;');
cccCreateCSSSelector('div.histoRow div:first-child', 'text-align: right;');
//cccCreateCSSSelector('div.histoRow div:last-child', 'font-weight: 600;');


cccCreateCSSSelector('div.histoRow.striped', 'background: rgba(245,166,35,0.1)');

cccCreateCSSSelector('div.histoRow .positive', 'color: ' + cccCurrentTheme.Rows.upColor);
cccCreateCSSSelector('div.histoRow .positive:before', 'content: \'+\'');
cccCreateCSSSelector('div.histoRow .negative', 'color: ' + cccCurrentTheme.Rows.downColor);
cccCreateCSSSelector('div.histoRow .negative:before', 'content: \'-\'');
embedablePriceInfo.innerHTML = `<div class="histoTitle"></div>
<style type="text/css">

    .histoRow  {
        width: 96%;
        margin: 0 auto;
    }
    div.histoHead {
        border-bottom: 1px solid #AFBDC4;
        margin-bottom:15px;
    }
    .dateRange {
        cursor:pointer;
        display: inline-block;
        user-select: none;


    }
    .dateRange__title:hover, .dateRange__icon:hover {
        opacity: 0.6;
    }
    .dateRange__icon {
        width:16px;
        height:16px;
        background: url(${widgetsBaseUrl}/images/calendar/small-calendar@2x.svg);
        margin-left:20px;
        display: inline-block;
        vertical-align: -2px;

    }
    .dateRange__title {
        display: inline-block;
        margin-left:2px;
        color:#010101;
        font-weight:100;
    }
    .histo-filter {
        display: none;
        margin-left:20px;
        font-weight:100;
        margin-top:10px;
        outline: none;
        position: absolute;

    }
    .histo-filter input {
        outline: none;
        width: 114px;
        padding: 4px 20px;
        margin-left: 4px;
    }
    .histo-filter__inputContainer {
        display: inline-block;
    }
    .histo-filter.active {
        display: block;
    }
    .histo-export {
        position: relative;
    }
    .histo-export .amcharts-export-menu {
        margin-right: 20px;
        margin-top: 40px;
        right: 0;
    }
    .histo-export .amcharts-export-menu:hover {
        opacity:1;
    }
</style>
<div class="dateRange">
    <div class="dateRange__icon"></div>
    <div class="dateRange__title">Date Range</div>
</div>
<div class="histo-filter">
    <div class="histo-filter__inputContainer">From <input type="text" class="histo-filter__from"/>&nbsp;&nbsp;</div>
    <div class="histo-filter__inputContainer">To <input type="text" class="histo-filter__to"/></div>
</div>

<div class="histo-export">
    <div class="amcharts-export-menu amcharts-export-menu-top-right amExportButton ">
        <ul><li class="export-main">
                <a href="#"><span>menu.label.undefined</span></a>
                <ul>
                    <li><a href="#"><span>Save as ...</span></a>
                        <ul>
                            <li><a href="#"><span>CSV</span></a></li>
                            <li><a href="#"><span>XLSX</span></a></li>
                            <li><a href="#"><span>JSON</span></a></li>
                        </ul>
                    </li></ul></li></ul></div>
</div>




<div class="histoRow histoHead" style="font-weight: 400; font-size:14px; margin-top:40px;">
    <div class="histoTime">Date</div>
    <div class="histoPrice">Price</div>
    <div class="histoVolume">Volume</div>
    <div class="histoChange">Change</div>
</div><div id="loadedData"></div>`;

embedable.appendChild(embedablePriceInfo);

weekCurrentScript.appendChild(embedable);
// dateRange


jQuery(".dateRange").click(function () {
if (jQuery(".histo-filter").hasClass("active")) {
jQuery(".histo-filter").removeClass('active')
} else {
jQuery(".histo-filter").addClass('active')
}
})

jQuery(".histo-filter__from").datepicker({
dateFormat: "M d, yy",
maxDate: "-1d",
firstDay: 1,
onSelect: function () {
setDates();
priceWeekLoad(fsym, tsym, histoPeriodDateStart, histoPeriodDateEnd);
setTimeout(function() {
syncDates();
},500);
}
});
jQuery(".histo-filter__from").datepicker("setDate", -7)


jQuery(".histo-filter__to").datepicker({
maxDate: "-1d",
dateFormat: "M d, yy",
firstDay: 1,
onSelect : function() {
setDates();
priceWeekLoad(fsym, tsym, histoPeriodDateStart, histoPeriodDateEnd);
setTimeout(function() {
syncDates();
},500);
}
});
jQuery(".histo-filter__to").datepicker("setDate", new Date())
setDates();

// Save as functionality
jQuery(".histo-export a").click(function() {
let content = jQuery(this).find('span').text();
jQuery( ".ccc-chart-v3 span:contains(" + content + ")" ).click()
return false;
})
}
function syncDates() {
// sync date range chart fields
jQuery(".chart-filter__from").val(jQuery(".histo-filter__from").val());
jQuery(".chart-filter__to").val(jQuery(".histo-filter__to").val());

var inst = jQuery.datepicker._getInst(jQuery(".chart-filter__to")[0]);
jQuery.datepicker._get(inst, 'onSelect').apply(inst.input[0], [jQuery(".chart-filter__to").datepicker('getDate'), inst]);
}

function setDates() {
let timeStart = jQuery.datepicker.formatDate("@", jQuery(".histo-filter__from").datepicker("getDate"));
let timeEnd = jQuery.datepicker.formatDate("@", jQuery(".histo-filter__to").datepicker("getDate"));
if (timeStart > timeEnd) {
jQuery(".histo-filter__from").datepicker("setDate", "-7d");
jQuery(".histo-filter__to").datepicker("setDate", timeStart).blur();

}
histoPeriodDateStart = jQuery.datepicker.formatDate("yy-mm-dd", jQuery(".histo-filter__from").datepicker("getDate"));
histoPeriodDateEnd = jQuery.datepicker.formatDate("yy-mm-dd", jQuery(".histo-filter__to").datepicker("getDate"));



}

var loadedHistory = document.createElement('div');

function loadHistory() {
loadedHistory.innerHTML = '';
for (var i = 0; i < weekData.DISPLAY.length; i++) {
var dayData = weekData.DISPLAY[i];
var formattedDate = jQuery.datepicker.parseDate("dd-mm-yy", dayData.time);
var dayRawData = weekData.RAW[i];
var histoRow1 = document.createElement("div");
var changeClass = weekData.RAW[i].change > 0 ? 'positive' : 'negative';
var change = Math.abs(dayRawData.change);
histoRow1.className = `histoRow ${i % 2 === 0 ? 'striped' : ''}`;

histoRow1.innerHTML = `
<div class="histoTime ">` + jQuery.datepicker.formatDate("M dd, yy", formattedDate) + `</div>
<div class="histoPrice ">` + dayData.price + `</div>
<div class="histoVolume ">` + dayData.volume + `</div>
<div class="histoChange ` + changeClass + `"><span>` + change + `%</span></div>`;
loadedHistory.appendChild(histoRow1);
}
document.getElementById("loadedData").appendChild(loadedHistory);
}


render();

function priceWeekLoad(fsym, tsym, from, to) {
loadedHistory.innerHTML = '<div style="text-align: center;padding-bottom:10px;">Loading data from server...</div>';
var url = apiBaseURL + '/data/priceByPeriod?fsym=' + fsym + '&tsym=' + tsym + '&from=' + from + '&to=' + to;
var xhr = typeof XMLHttpRequest != 'undefined' ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

xhr.open('get', url, true);
xhr.onreadystatechange = function () {
var status;
var data;

if (xhr.readyState == 4) {
status = xhr.status;
if (status == 200) {
data = JSON.parse(xhr.responseText);
weekData = data;
loadHistory();
//originPrices = data;
} else {
// pass
}
}
};
xhr.send();
}

var weekData = [];
priceWeekLoad(fsym, tsym, histoPeriodDateStart, histoPeriodDateEnd);
});
var currentScript = document.currentScript.parentNode;
window.histoPeriodWidget(currentScript, 'https://api.cointrend.club', GLOBAL_SYMBOL, 'USD','https://pricewidgets.cointelegraph.com');