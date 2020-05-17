<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
<fieldset>
<legend><?= $text_legend ?></legend>
    <div class="input_wrapper n100 border">
        <label <?= $this->labelFloat('Name',$categorie) ?>> <?= $text_label_Name ?></label>
        <input required type="text" name="Name" id="Name" maxlength="20" value="<?= $this->ShowValue('Name',$categorie) ?>" >
    </div>
    
    <div class="input_wrapper n100 ">
        <label class="floated"><?= $text_label_Image ?></label>
        <input  type="file" name="Image" accept="image/*"  >
    </div>
    <?php if($categorie->Image !== '') :?>
        <div class="input_wrapper_other n100 ">
      <img src="/mvcapp/public/uploads/images/<?= $categorie->Image ?>" width="30%" />
    </div>
    <?php endif; ?>

  

    <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

</fieldset>


</form>