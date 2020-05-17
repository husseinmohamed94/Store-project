
<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n50 border">
            <label <?= $this->labelFloat('ExpenseName',$expense) ?>><?= $text_label_Name ?></label>
            <input  type="text" name="ExpenseName" id="ExpenseName" maxlength="30" value="<?= $this->ShowValue('ExpenseName',$expense) ?>">

        </div>
        
        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('fixedPayment',$expense) ?>><?= $text_label_fixed?></label>
            <input required type="number" step = "0.01" name="fixedPayment"   maxlength="50"  value="<?= $this->ShowValue('fixedPayment',$expense) ?>">
        </div>
        


        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

    </fieldset>


</form>