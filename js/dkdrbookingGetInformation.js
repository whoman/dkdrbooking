var dkdrAjaxInfoPage = (function () {
    
    var dkdrInfoPate = document, dkdrStatusInformation = dkdrInfoPate.getElementById("status"),
        dkdrUrlInsert = dkdrInfoPate.getElementById("dkdrurl").value,
        dkDrGetUserDate = dkdrInfoPate.getElementById("fromDate1"), hh;

    function checkedBrowser() {
        try {
            // Opera 8.0+, Firefox, Safari
            hh = new XMLHttpRequest();
            return hh;
        } catch (e) {
            // Internet Explorer Browsers
            try {
                hh = new ActiveXObject("Msxml2.XMLHTTP");
                return hh;
            } catch (e) {
                try {
                    hh = new ActiveXObject("Microsoft.XMLHTTP");
                    return hh;
                } catch (e) {
                    // Something went wrong
                    alert("Your browser broke!");
                    return false;
                }
            }
        }
    }

//get Date From User
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
        dkDrRturnDate = dkDrRturnDate.gy + "/" + dkDrRturnDate.gm + "/" + dkDrRturnDate.gd;
        return dkDrRturnDate;

    }

//ajaxForSendDataInsert
    var startAjaxInserting = function (dkDrName, dkDrFamily, dkDrTell, dkDrMobile,
                                       dkDrWhereComeFrom, dkDrWhichTimeCome, dkDrSelector) {
        var hr, dkdrDatas, dkDrSendigDate;
        dkDrSendigDate = getUserDate();
        hr = checkedBrowser();

        dkdrDatas = "name=" + dkDrName + "&family=" + dkDrFamily + "&tell=" + dkDrTell
            + "&mobile=" + dkDrMobile + "&come=" + dkDrWhereComeFrom + "&timecome="
            + dkDrWhichTimeCome + "&selector=" + dkDrSelector + "&datetime=" + dkDrSendigDate + "&pdate=" + dkDrGetUserDate.value;

        hr.open("POST", dkdrUrlInsert, true);
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if (hr.readyState == 4 && hr.status == 200) {
                return_data = hr.responseText;

                dkdrStatusInformation.innerHTML = return_data;
            }
        };
        hr.send(dkdrDatas);
        dkdrStatusInformation.innerHTML = "processing...";

    };
    return {startAjaxInserting: startAjaxInserting}
})();
    
