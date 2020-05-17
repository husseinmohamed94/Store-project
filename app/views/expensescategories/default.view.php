
<div class="container">

    <a href="/mvcapp/public/index.php/expensescategories/create " class="button"><i class="fa fa-plus"></i> <?= $text_new_item?></a>
       <table class="data">
           <thead>
           <tr>
               <th><?= $text_table_Name ?></th>
               <th><?= $text_table_fixed?></th>
               <th><?= $text_table_control?></th>
               

           </tr>
           </thead>
            <tbody>
                <?php if(false !==$expenses) : foreach ($expenses as $expense) : ?>
                   <tr>
                       <td><?= $expense->ExpenseName ?></td>
                      
                       <td><?= $expense->fixedPayment ?></td>
                
                      
                       <td>
                           <a href="/mvcapp/public/index.php/expensescategories/edit/<?= $expense->ExpenseId?>"><i class="fa fa-edit"></i> </a>

                           <a href="/mvcapp/public/index.php/expensescategories/delete/<?= $expense->ExpenseId?>"  onclick="if(!confirm('<?= $text_table_delete ?>')) return false ; "><i class="fa fa-times"></i> </a>

                       </td>

                   </tr>
            <?php endforeach; endif; ?>
            </tbody>

       </table>

</div>