
<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n50 border">
            <label <?= $this->labelFloat('Name') ?>><?= $text_label_Name ?></label>
            <input  type="text" name="Name" id="Name" maxlength="40" value="<?= $this->ShowValue('Name') ?>">

        </div>
        
        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('Email') ?>><?= $text_label_Email?></label>
            <input required type="Email" name="Email"  maxlength="40" value="<?= $this->ShowValue('Email') ?>">
        </div>
        
        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('phoneNumber') ?>><?= $text_table_phone_Number?></label>
            <input required type="text" name="phoneNumber"   maxlength="15"  value="<?= $this->ShowValue('phoneNumber') ?>">
        </div>
        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('address') ?>><?= $text_label_Address?></label>
            <input required type="text" name="address"   maxlength="50"  value="<?= $this->ShowValue('address') ?>">
        </div>
        


        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

    </fieldset>


</form>