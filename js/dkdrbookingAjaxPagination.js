//{^}
//www.darkoobweb.com
var dkdrPagination = (function () {

    var dkdrdoc = document,
        ajaxCheck, requestSearch, cancelUpdate, request_page, ajax_post, startSendingDataUpdate, vars = 0,
        pagination_controls = dkdrdoc.getElementById("pagination_controls"),
        lastNumber = dkdrdoc.getElementById("dkdrLastNumber"),
        showPerPage = dkdrdoc.getElementById("dkdrShowPerPage"),
        return_data, dkdrStatusInformation = dkdrdoc.getElementById("status"),
        divElement = dkdrdoc.getElementById("dkdrFields"),
        results_box = dkdrdoc.getElementById("results_box"),
        seUrl = dkdrdoc.getElementById("dkdrSearch").value,
        delUrl = dkdrdoc.getElementById("dkdrDelet").value,
        upUrl = dkdrdoc.getElementById("dkdrUpdate").value,
        pagUrl = dkdrdoc.getElementById("dkdrPagination").value,
        UpInsert = dkdrdoc.getElementById("dkdrGotoUpInsert").value,
        dkDrGetUserDate = dkdrdoc.getElementById("fromDate1"),
        dkdrInputs = dkdrdoc.getElementsByTagName("input"),
        fieldName = dkdrdoc.getElementById("rflname"),
        fieldFamily = dkdrdoc.getElementById("rflfamily"),
        feildMashhad = dkdrdoc.getElementById("mashhadradio"),
        feildOther = dkdrdoc.getElementById("other"),
        feildSobh = dkdrdoc.getElementById("dkdrmorning"),
        fieldAsr = dkdrdoc.getElementById("dkdrnon"),
        fieldTell = dkdrdoc.getElementById("rfltell"),
        fieldMobile = dkdrdoc.getElementById("rflmobile"),
        fieldDate = dkdrdoc.getElementById("fromDate1"),
        ajaxHttpRequest,
        resultsSearchBox = dkdrdoc.getElementById("searchStatus"),
        trackSearchText = dkdrdoc.getElementById("getTrackId"), varss = 0,
        fieldSelect = dkdrdoc.getElementById("rflSelector"), dataArray = "", itemArray = 0, htmlOutPut = "";
//                                                                  Check AjaxhttpRequest
    function checkedBrowser() {
        try {
            // Opera 8.0+, Firefox, Safari
            ajaxCheck = new XMLHttpRequest();
            return ajaxCheck;
        } catch (e) {

            // Internet Explorer Browsers
            try {
                ajaxCheck = new ActiveXObject("Msxml2.XMLHTTP");
                return ajaxCheck;
            } catch (e) {
                try {
                    ajaxCheck = new ActiveXObject("Microsoft.XMLHTTP");
                    return ajaxCheck;
                } catch (e) {
                    // Something went wrong
                    alert("Your browser broke!");
                    return false;
                }
            }
        }
    }

    function dkDrchangeDate(dkDate) {
        var splitOb, yy, mm, dd, regex = /(<([^>]+)>)/ig,result;
        result = dkDate.replace(regex, "");
        if (result.indexOf("/") != -1) {
            splitOb = result.split("/");
        } else {
            splitOb = result.split("-");
        }
        for (var i = 0; i < splitOb.length; i++) {
            yy = splitOb[0];
            mm = splitOb[1];
            dd = splitOb[2];
        }
        var hui = toJalaali(parseInt(yy), parseInt(mm), parseInt(dd));
        return hui.jy + "/" + hui.jm + "/" + hui.jd;

    }

    //                                                                  get Date From User And Convert it To Gregorian Date
    function getUserDate() {
        var dkDrSplitOb, dkdrY, dkDrM, dkDrD, dkDrRturnDate;
        //convert Numbers Arabic/Persian To English Numbers
        function parseArabic(str) {
            return Number(str.replace(/[٠١٢٣٤٥٦٧٨٩]/g, function (d) {
                return d.charCodeAt(0) - 1632;
            }).replace(/[۰۱۲۳۴۵۶۷۸۹]/g, function (d) {
                return d.charCodeAt(0) - 1776;
            }));
        }

        dkDrSplitOb = dkDrGetUserDate.value.split("/");
        for (var i = 0; i < dkDrSplitOb.length; i++) {
            dkdrY = dkDrSplitOb[0];
            dkDrM = dkDrSplitOb[1];
            dkDrD = dkDrSplitOb[2];
        }
        dkDrRturnDate = toGregorian(parseInt(parseArabic(dkdrY), 10), parseInt(parseArabic(dkDrM), 10), parseInt(parseArabic(dkDrD), 10));
        return dkDrRturnDate.gy + "/" + dkDrRturnDate.gm + "/" + dkDrRturnDate.gd;

    }

    function bodyStructure() {
        return " <table class='widefat'><tr> "
            + "<th></th>"
            + "<th>Name</th>"
            + "<th>Family</th>"
            + "<th>Mobile</th>"
            + "<th>Tell</th>"
            + "<th>ComeFrom</th>"
            + "<th>WhichPart</th>"
            + "<th>Reason</th>"
            + "<th>PersianDate</th>"
            + "<th>TrackingCode</th>"
            + "<th>Turn</th>"
            + "</tr>";
    }

//                                                                                        Ajax
    function getMyAjax(url, inToIf, inToElse, sending, whereShow, doSomeThing, doAfterAll) {

        
        
        if (whereShow != null) {
            whereShow.innerHTML = "loading ...";
        }
        ajaxHttpRequest = checkedBrowser();
        ajaxHttpRequest.open("POST", url, true);
        ajaxHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajaxHttpRequest.onreadystatechange = function () {
            if (ajaxHttpRequest.readyState == 4 && ajaxHttpRequest.status == 200) {
                inToIf();
            } else {
                if (inToElse != null) {
                    inToElse();
                }
                if (doSomeThing != null) {
                    doSomeThing();
                }
            }
        };
        ajaxHttpRequest.send(sending);
        if (doAfterAll != null) {
            doAfterAll();
        }
    }

//paginationFunction
    request_page = function (pn) {
//                                                           Ajax Pagination
        
       
        getMyAjax(pagUrl, function () {
            dataArray = ajaxHttpRequest.responseText.split("||");
            htmlOutPut = bodyStructure();
            for (var i = 0; i < dataArray.length - 1; i++) {
                itemArray = dataArray[i].split("|");

                htmlOutPut += "<tr>" + itemArray[0] + itemArray[1] + " " + itemArray[2] + " " + itemArray[3] + " "
                    + itemArray[4] + " " + itemArray[5] + " " + itemArray[6] + " " + itemArray[7] + " "
                    + itemArray[8] + " " + "<td>" + dkDrchangeDate(itemArray[9]) + "</td>" + " " + itemArray[10] + " " + itemArray[11] + "</tr>";

            }
            results_box.innerHTML = htmlOutPut;
        }, function () {
            results_box.innerHTML = "<p>Cant get values</p>"
        }, "showPerPage=" + showPerPage.value + "&lastNumber=" + lastNumber.value + "&pn=" + pn, results_box, null, null);

        var paginationCtrls = "";
        if (lastNumber.value != 1) {
            if (pn > 1) {
                paginationCtrls += '<button onclick="dkdrPagination.request_page(' + (pn - 1) + ')">&lt;</button>';
            }
            paginationCtrls += ' &nbsp; &nbsp; <b>Page ' + pn + ' of ' + lastNumber.value + '</b> &nbsp; &nbsp; ';
            if (pn != lastNumber.value) {
                paginationCtrls += '<button onclick="dkdrPagination.request_page(' + (pn + 1) + ')">&gt;</button>';
            }
        }
        pagination_controls.innerHTML = paginationCtrls;

    };
//deleteUpdateFunction
    ajax_post = function (whichOne) {

        for (var i = 0; i < dkdrInputs.length; i++) {
            if (dkdrInputs[i].type == "checkbox") {
                if (dkdrInputs[i].checked) {
                    vars = "giveMyId=" + dkdrInputs[i].value;
                }
            }
        }
//                                                                                        Ajax Up
        if (whichOne === "dkUp") {
            divElement.style.display = "block";
            getMyAjax(upUrl, function () {
                dataArray = ajaxHttpRequest.responseText.split("||");
                for (i = 0; i < dataArray.length - 1; i++) {
                    itemArray = dataArray[i].split("|");
                    fieldName.value = itemArray[0];
                    fieldFamily.value = itemArray[1];
                    fieldMobile.value = itemArray[2];
                    fieldTell.value = itemArray[3];
                    if (itemArray[4] === "مشهد") {
                        feildMashhad.checked = true;
                    } else {
                        feildOther.checked = true;
                    }
                    if (itemArray[5] === "صبح") {
                        feildSobh.checked = true;
                    } else {
                        fieldAsr.checked = true;
                    }
                    fieldSelect.value = itemArray[6];
                    fieldDate.value = dkDrchangeDate(itemArray[7]);
                }

            }, null, vars, null, null, null);
//                                                                                        Ajax Delete
        } else if (whichOne === "dkDel") {
            getMyAjax(delUrl, function () {
                    return_data = ajaxHttpRequest.responseText;
                    dkdrStatusInformation.innerHTML = return_data;
                    dkdrPagination.request_page(1);
                }, null, vars, null, null
            )
        }
    };

//SearchFunction
//                                                                                        Ajax Search
    requestSearch = function () {

        resultsSearchBox.style.display = "block";
        varss = "myTrackIdSearch=" + trackSearchText.value;
        getMyAjax(seUrl, function () {
                dataArray = ajaxHttpRequest.responseText.split("||");
                htmlOutPut = bodyStructure();
                for (var i = 0; i < dataArray.length - 1; i++) {
                    itemArray = dataArray[i].split("|");
                    htmlOutPut += "<tr>" + itemArray[0]
                        + itemArray[1] + " " + itemArray[2] +
                        " " + itemArray[3] + " " + itemArray[4] +
                        " " + itemArray[5] + " " + itemArray[6] +
                        " " + itemArray[7] + " " + itemArray[8] +
                        " " + itemArray[9] + " " + itemArray[10] +
                        " " + itemArray[11] + "</tr>";
                }
                resultsSearchBox.innerHTML = htmlOutPut;
            }, function () {
                resultsSearchBox.innerHTML = "<p>Cant get values</p>";
            }, varss, resultsSearchBox, function () {
                if (trackSearchText.value === "") {
                    resultsSearchBox.style.display = "none";
                }
            }, null
        );
    };

//ajaxForSendDataUpdate
    startSendingDataUpdate = function (dkDrName, dkDrFamily, dkDrTell, dkDrMobile,
                                       dkDrWhereComeFrom, dkDrWhichTimeCome, dkDrSelector) {
        var dkdrDatas, dkDrSendigDate;
        dkDrSendigDate = getUserDate();

        dkdrDatas = "name=" + dkDrName + "&family=" + dkDrFamily + "&tell=" + dkDrTell
            + "&mobile=" + dkDrMobile + "&come=" + dkDrWhereComeFrom + "&timecome="
            + dkDrWhichTimeCome + "&selector=" + dkDrSelector + "&datetime=" + dkDrSendigDate +
            "&pdate=" + dkDrGetUserDate.value + "&" + vars;

        getMyAjax(UpInsert, function () {
            return_data = ajaxHttpRequest.responseText;
            dkdrStatusInformation.innerHTML = return_data;
            dkdrPagination.request_page(1);
            divElement.style.display = "none";
        }, null, dkdrDatas, null, null, function () {
            dkdrStatusInformation.innerHTML = "processing...";
        })
    };
    cancelUpdate = function () {
        divElement.style.display = "none";
    };
    return {
        ajax_post: ajax_post,
        request_page: request_page,
        requestSearch: requestSearch,
        startSendingDataUpdate: startSendingDataUpdate,
        cancelUpdate: cancelUpdate
    }
})();