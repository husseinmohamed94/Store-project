
<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>


        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('phoneNumber',$user) ?>><?= $text_label_phoneNumber?></label>
            <input required type="text" name="phoneNumber"  value="<?= $this->ShowValue('phoneNumber',$user) ?>">
        </div>
        <div class="input_wrapper_other n50  select padding">
            <select required name="groupid" >
                <option value=""><?= $text_user_groupid ?></option>
               <?php if (false !== $groups) : foreach ($groups as $group): ?>
               <option value="<?= $group->groupid ?>" <?= $this->selectedIf('GroupId', $group->groupid,$user) ?>><?= $group->GroupName?></option>
            <?php endforeach; endif; ?>
            </select>

        </div>




        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

    </fieldset>


</form>