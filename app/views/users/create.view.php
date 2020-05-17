
<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n20 border">
            <label <?= $this->labelFloat('firstName') ?>><?= $text_label_firstName ?></label>
            <input  type="text" name="firstName" id="Username" maxlength="10" value="<?= $this->ShowValue('firstName') ?>">

        </div>
        <div class="input_wrapper n20 ">
            <label <?= $this->labelFloat('lastName') ?>><?= $text_label_lastName?></label>
            <input  type="text" name="lastName" id="lastName" maxlength="10" value="<?= $this->ShowValue('lastName') ?>">

        </div>
        <div class="input_wrapper n20 padding border ">
            <label <?= $this->labelFloat('Username') ?>><?= $text_label_Username?></label>
            <input  type="text" name="Username" id="Username" maxlength="30" value="<?= $this->ShowValue('Username') ?>">

        </div>

        <div class="input_wrapper n20 border padding">
            <label <?= $this->labelFloat('password') ?>><?= $text_label_password?></label>
            <input required type="password" name="password" value="<?= $this->ShowValue('password') ?>" >
        </div>
        <div class="input_wrapper n20 padding">
            <label <?= $this->labelFloat('cpassword') ?>><?= $text_label_cpassword?></label>
            <input required type="password" name="cpassword" value="<?= $this->ShowValue('cpassword') ?>" >
        </div>

        <div class="input_wrapper n30 border">
            <label <?= $this->labelFloat('email') ?>><?= $text_label_email?></label>
            <input required type="email" name="email"  maxlength="40" value="<?= $this->ShowValue('email') ?>">
        </div>
        <div class="input_wrapper n30 padding">
            <label <?= $this->labelFloat('cemail') ?>><?= $text_label_cemail?></label>
            <input required type="email" name="cemail" maxlength="40" value="<?= $this->ShowValue('cemail') ?>">
        </div>
        <div class="input_wrapper n20 padding">
            <label <?= $this->labelFloat('phoneNumber') ?>><?= $text_label_phoneNumber?></label>
            <input required type="text" name="phoneNumber"  value="<?= $this->ShowValue('phoneNumber') ?>">
        </div>
        <div class="input_wrapper_other n20  select padding">
            <select required name="groupid" >
                <option value=""><?= $text_user_groupid ?></option>
               <?php if (false !== $groups) : foreach ($groups as $group): ?>
               <option value="<?= $group->groupid ?>"><?= $group->GroupName?></option>
            <?php endforeach; endif; ?>
            </select>

        </div>




        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

    </fieldset>


</form>