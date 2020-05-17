
<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>

        <div class="input_wrapper n50 padding">
        <select required name="ExpenseId" >
                <option value=""><?= $text_user_ExpenseId ?></option>
               <?php if (false !== $expenses) : foreach ($expenses as $expense): ?>
               <option value="<?= $expense->ExpenseId ?>" <?= $this->selectedIf('ExpenseId', $expense->ExpenseId) ?>><?= $expense->ExpenseName ?></option>
            <?php endforeach; endif; ?>
            </select>
        </div>


        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('payment') ?>><?= $text_label_fixed?></label>
            <input required type="number" step = "0.01" name="payment"    value="<?= $this->ShowValue('payment') ?>">
        </div>


        <div class="input_wrapper n50 padding">
            <label <?= $this->labelFloat('created') ?>><?= $text_label_fixed?></label>
            <input required type="date" name="created"   value="<?= $this->ShowValue('created') ?>">
        </div>

        <div class="input_wrapper n50 ">
        <select required name="UserId" >
                <option value=""><?= $text_user_ExpenseId ?></option>
               <?php if (false !== $users) : foreach ($users as $user): ?>
               <option value="<?= $user->UserId ?>" <?= $this->selectedIf('UserId', $user->UserId) ?>><?= $user->Username ?></option>
            <?php endforeach; endif; ?>
            </select>
        </div>

        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">

    </fieldset>


</form>
