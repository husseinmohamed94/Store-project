
<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n40 border">
            <label><?= $text_label_privileges_title?></label>
            <input required type="text" name="privilegeTitle" id="privilegeTitle" maxlength="30">
        </div>
        <div class="input_wrapper n40 border">
            <label><?= $text_label_privileges_url ?></label>
            <input required type="text" name="privilege" id="privilege" maxlength="30">
        </div>


        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

    </fieldset>


</form>