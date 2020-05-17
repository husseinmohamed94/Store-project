
<div class="container">

    <a href="http://localhost/mvcapp/public/index.php/Suppliers/create " class="button"><i class="fa fa-plus"></i> <?= $text_new_item?></a>
       <table class="data">
           <thead>
           <tr>
               <th><?= $text_table_Name ?></th>
               <th><?= $text_table_Email ?></th>
               <th><?= $text_table_phone_Number ?></th>
               <th><?= $text_table_control ?></th>

           </tr>
           </thead>
            <tbody>
                <?php if(false !==$suppliers) : foreach ($suppliers as $supplier) : ?>
                   <tr>
                       <td><?= $supplier->Name ?></td>
                      
                       <td><?= $supplier->Email ?></td>
                       <td><?= $supplier->phoneNumber  ?></td>
                      
                       <td>
                           <a href="/mvcapp/public/index.php/suppliers/edit/<?= $supplier->supplierId?>"><i class="fa fa-edit"></i> </a>

                           <a href="/mvcapp/public/index.php/suppliers/delete/<?= $supplier->supplierId?>"  onclick="if(!confirm('<?= $text_table_delete ?>')) return false ; "><i class="fa fa-times"></i> </a>

                       </td>

                   </tr>
            <?php endforeach; endif; ?>
            </tbody>

       </table>

</div>