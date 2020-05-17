
<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n50 border">
            <label <?= $this->labelFloat('Name',$supplier) ?>><?= $text_label_Name ?></label>
            <input  type="text" name="Name" id="Name" maxlength="40" value="<?= $this->ShowValue('Name',$supplier) ?>">

        </div>
        
        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('Email',$supplier) ?>><?= $text_label_Email?></label>
            <input required type="Email" name="Email"  maxlength="40" value="<?= $this->ShowValue('Email',$supplier) ?>">
        </div>
        
        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('phoneNumber',$supplier) ?>><?= $text_table_phone_Number?></label>
            <input required type="text" name="phoneNumber"   maxlength="15"  value="<?= $this->ShowValue('phoneNumber',$supplier) ?>">
        </div>
        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('address',$supplier) ?>><?= $text_label_Address?></label>
            <input required type="text" name="address"   maxlength="50"  value="<?= $this->ShowValue('address',$supplier) ?>">
        </div>
        


        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

    </fieldset>


</form>