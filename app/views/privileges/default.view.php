

<div class="container">
    <a href="http://localhost/mvcapp/public/index.php/privileges/create " class="button"><i class="fa fa-plus"></i> <?= $text_new_item?></a>
       <table class="data">
           <thead>
           <tr>
               <th><?= $text_table_privileges ?></th>
               <th><?= $text_table_control ?></th>

           </tr>
           </thead>
            <tbody>
                <?php if(false !== $privileges) : foreach ($privileges as $privilege) : ?>
                   <tr>
                       <td><?= $privilege->privilegeTitle ?></td>

                        <td>
                <a href="/mvcapp/public/index.php/privileges/edit/<?= $privilege->privilegeId?>"><i class="fa fa-edit"></i> </a>
                <a href="/mvcapp/public/index.php/privileges/delete/<?= $privilege->privilegeId?>"  onclick="if(!confirm('<?= $text_table_delete ?>')) return false ; "><i class="fa fa-times"></i> </a>

                        </td>
                   </tr>
            <?php endforeach; endif; ?>
            </tbody>

       </table>

</div>