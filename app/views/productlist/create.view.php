
<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
<fieldset>
<legend><?= $text_legend ?></legend>
    <div class="input_wrapper n50 border ">
        <label <?= $this->labelFloat('Name') ?>><?= $text_label_Name ?></label>
        <input required type="text" name="Name" id="Name" maxlength="50" value="<?= $this->ShowValue('Name') ?>">
    </div>
    
    <div class="input_wrapper_other n50  select padding">
            <select required name="categoryid" >
                <option value=""><?= $text_label__categoryid ?></option>
               <?php if (false !== $categories) : foreach ($categories as $categorie): ?>
               <option value="<?= $categorie->categortyid ?>"  <?= $this->selectedIf('categoryid',$categorie->categortyid)?>><?= $categorie->Name?></option>
            <?php endforeach; endif; ?>
            </select>

        </div>

        <div class="input_wrapper n20 border ">
        <label <?= $this->labelFloat('Quantity') ?>><?= $text_label_Quantity?></label>
        <input required type="number" name="Quantity" id="Quantity"  min="1" step="1" value="<?= $this->ShowValue('Quantity') ?>">
    </div>

    <div class="input_wrapper n20 border padding ">
        <label <?= $this->labelFloat('BuyPrice') ?>><?= $text_label_BuyPrice?></label>
        <input required type="number" name="BuyPrice" id="BuyPrice"  min="1" step="1" value="<?= $this->ShowValue('BuyPrice') ?>">
    </div>

    
    <div class="input_wrapper n20 border ">
        <label <?= $this->labelFloat('sallPrice') ?>><?= $text_label_sallPrice?></label>
        <input required type="number" name="sallPrice" id="sallPrice"  min="1" step="1" value="<?= $this->ShowValue('sallPrice') ?>">
    </div>

    <div class="input_wrapper_other n40  select padding">
            <select required name="unit" >
                <option value=""><?= $text_label_Unit ?></option>
                <option value="1" <?= $this->selectedIf('unit',1)?>><?= $text_unit_1?></option>
                <option value="2" <?= $this->selectedIf('unit',2)?>><?= $text_unit_2 ?></option>
                <option value="3" <?= $this->selectedIf('unit',3)?>><?= $text_unit_3 ?></option>
                <option value="4" <?= $this->selectedIf('unit',4)?>><?= $text_unit_4 ?></option>
            </select>

        </div>


    <div class="input_wrapper n100 ">
        <label class="floated"><?= $text_label_Image ?></label>
        <input  type="file" name="Image" accept="image/*" >
    </div>
   

    <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

</fieldset>


</form>