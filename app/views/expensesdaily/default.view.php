
<div class="container">

    <a href="/mvcapp/public/index.php/expensesdaily/create " class="button"><i class="fa fa-plus"></i> <?= $text_new_item?></a>
       <table class="data">
           <thead>
           <tr>
               <th><?= $text_table_Name ?></th>
               <th><?= $text_table_fixed?></th>
               <th><?= $text_table_created?></th>
               <th><?= $text_table_user ?></th>
               <th><?= $text_table_control?></th>


           </tr>
           </thead>
            <tbody>
                <?php if(false !==$dailys) : foreach ($dailys as $daily) : ?>
                   <tr>
                       <td><?= $daily->ExpenseId ?></td>
                       <td><?= $daily->payment ?></td>
                       <td><?= $daily->created ?></td>
                       <td><?= $daily->userid ?></td>


                       <td>
                           <a href="/mvcapp/public/index.php/expensesdaily/edit/<?= $daily->DExpenseId?>"><i class="fa fa-edit"></i> </a>

                           <a href="/mvcapp/public/index.php/expensesdaily/delete/<?= $daily->DExpenseId?>"  onclick="if(!confirm('<?= $text_table_delete ?>')) return false ; "><i class="fa fa-times"></i> </a>

                       </td>

                   </tr>
            <?php endforeach; endif; ?>
            </tbody>

       </table>

</div>
