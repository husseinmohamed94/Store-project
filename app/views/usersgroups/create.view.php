
<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
<fieldset>
<legend><?= $text_legend ?></legend>
    <div class="input_wrapper n100 border">
        <label><?= $text_label_group_title ?></label>
        <input required type="text" name="GroupName" id="GroupName" maxlength="20">
    </div>
    <label><?= $text_label_privileges ?></label>
    <?php if ($privileges !== false ):foreach ($privileges as $privilege) :?>
        <div class="input_wrapper_other">
            <label class="checkbox block">
                <input type="checkbox" name="privileges[]" id="privileges" value="<?= $privilege->privilegeId?>">
                <div class="checkbox_button"></div>
                <span><?= $privilege->privilegeTitle ?></span>
            </label>

        </div>
    <?php endforeach;  endif;  ?>


    <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

</fieldset>


</form>