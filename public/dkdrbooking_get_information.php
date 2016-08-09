<div xmlns="http://www.w3.org/1999/html">
    <h3>دریافت نوبت</h3>

    <p>لطفا اطلاعات را به صورت صحیح وارد کنید .</p>

    <p id="errorMessage"></p>

    <input type="hidden" name="dkdrUrlinsert" id="dkdrurl"
    value="<?php echo esc_url(plugins_url('../include/dkdrbooking_php_validation.php', __FILE__)); ?>">
    <p>نام : <input type="text" class="registerForm" name="name" id="rflname" required></p>
    <p>نام خانوادگی: <input type="text" class="registerForm" id="rflfamily" name="family" required></p>
    <p> محل سکونت: <input type="radio" class="registerForm" id="mashhadradio" name="comefrom" checked value="مشهد">مشهد
        <input type="radio" class="registerForm" id="other" name="comefrom" value="دیگراستانها"> دیگر استان ها
    </p>
    <p>نوبت :
        <input type="radio" class="registerForm" id="dkdrmorning" name="morornon" checked value="صبح">صبح
        <input type="radio" class="registerForm" id="dkdrnon" name="morornon" value="عصر">عصر
    </p>
    <p>تلفن ثابت :<input type="text" class="registerForm" id="rfltell" name="tell" required></p>
    <p>شماره موبایل: <input type="text" class="registerForm" id="rflmobile" name="mobile" required></p>
    <p>علت مراجعه<select id="rflSelector" name="reason">
            <optgroup label="سینه">
                <option value="زیبایی سینه">زیبایی</option>
                <option value="پروتز سینه">پروتز</option>
            </optgroup>
            <optgroup label="صورت">
                <option value="بینی">بینی</option>
                <option value="گونه">گونه</option>
            </optgroup>
        </select></p>
    <div style="margin-top: 50px; clear: both;"></div>
    <div class="container" style="max-width: 200px;">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click"
                     data-targetselector="#fromDate1" data-groupid="group1" data-fromdate="true"
                     data-enabletimepicker="false" data-placement="left">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
                <input type="text" class="form-control" id="fromDate1" placeholder="از تاریخ"
                       data-mddatetimepicker="true" data-trigger="click" data-targetselector="#fromDate1"
                       data-groupid="group1" data-fromdate="true" data-enabletimepicker="false"
                       data-placement="right" name="pdate" required/>
            </div>
        </div>
    </div>
    <p><input type="submit" value="ثبت" class="registerForm" id="submit" name="submit" onclick="jsValidation.formRButtonSub();"/>
    </p>
    <p id="status">توضیحات</p>
    <!-- </form>-->
    <div>
        <p id="fMassege"></p>
    </div>
    <div id="customerMessage"></div>
</div>
