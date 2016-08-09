 var jsValidation=(function () {

     var doc = window.document,
        formName = doc.getElementById("rflname"),
        formFamily = doc.getElementById("rflfamily"),
        formMessage = doc.getElementById("fMassege"),
        formTell = doc.getElementById("rfltell"),
        formMashhad = doc.getElementById("mashhadradio"),
        formOther = doc.getElementById("other"),
        formMorning = doc.getElementById("dkdrmorning"),
        formNun = doc.getElementById("dkdrnon"),
        formMobile = doc.getElementById("rflmobile"),
        formSelector = doc.getElementById("rflSelector"),
        formAdminSubUpdate,formRButtonSub,
        formCleanTextBoxs = doc.getElementsByTagName("input"),
        formWhichTimeCome,formWhereComeFrom;
    /*check Text Box's For Empty Or Number*/
    function checkText() {
        return !(formName.value === "" || !isNaN(formName.value) || formFamily.value === "" || !isNaN(formFamily.value) ||
        formTell.value === "" || isNaN(formTell.value) || formTell.value.length < 5 || formMobile.value === "" || isNaN(formMobile.value) ||
        formMobile.value.length < 11 || formMobile.value.length > 11);
    }

     formAdminSubUpdate = function () {
         if (checkText() === true) {
             if (formMashhad.checked == true) {
                 formWhereComeFrom = formMashhad.value;
             } else {
                 formWhereComeFrom = formOther.value;
             }

             if (formMorning.checked == true) {
                 formWhichTimeCome = formMorning.value;
             } else {
                 formWhichTimeCome = formNun.value;
             }

             formMessage.innerHTML = "";
             dkdrPagination.startSendingDataUpdate(formName.value, formFamily.value, formTell.value, formMobile.value,
                 formWhereComeFrom, formWhichTimeCome, formSelector.value);
             for (var i = 0; i < formCleanTextBoxs.length; i++) {
                 if (formCleanTextBoxs[i].type == 'text') {
                     formCleanTextBoxs[i].value = ""
                 }
             }
         } else {
             formMessage.innerHTML = "اطلاعات وارده صحیح نمی باشد.";
         }
     };
     /*When Done Button Clicked Do This Works*/
    formRButtonSub = function () {

        if (checkText() === true) {
            if (formMashhad.checked == true) {
                formWhereComeFrom = formMashhad.value;
            } else {
                formWhereComeFrom = formOther.value;
            }

            if (formMorning.checked == true) {
                formWhichTimeCome = formMorning.value;
            } else {
                formWhichTimeCome = formNun.value;
            }

            formMessage.innerHTML = "";
            dkdrAjaxInfoPage.startAjaxInserting(formName.value, formFamily.value, formTell.value, formMobile.value,
                formWhereComeFrom, formWhichTimeCome, formSelector.value);
            for (var i = 0; i < formCleanTextBoxs.length; i++) {
                if (formCleanTextBoxs[i].type == 'text') {
                    formCleanTextBoxs[i].value = ""
                }
            }
        } else {
            formMessage.innerHTML = "اطلاعات وارده صحیح نمی باشد.";
        }
    };

     return{
         formAdminSubUpdate : formAdminSubUpdate,
         formRButtonSub :formRButtonSub
     }

})();







