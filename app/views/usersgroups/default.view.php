

<div class="container">

    <a href="http://localhost/mvcapp/public/index.php/usersgroups/create/" class="button"><i class="fa fa-plus"></i> <?= $text_new_item?></a>
       <table class="data">
           <thead>
           <tr>
               <th><?= $text_table_group_name ?></th>
               <th><?= $text_table_control ?></th>

           </tr>
           </thead>
            <tbody>
                <?php if(false !==$groups) : foreach ($groups as $group) : ?>
                   <tr>
                       <td><?= $group->GroupName ?></td>

                        <td>
                            <a href="/mvcapp/public/index.php/usersgroups/edit/<?= $group->groupid?>"><i class="fa fa-edit"></i> </a>

                            <a href="/mvcapp/public/index.php/usersgroups/delete/<?= $group->groupid?>"  onclick="if(!confirm('<?= $text_table_delete ?>')) return false ; "><i class="fa fa-times"></i> </a>

                        </td>
                   </tr>
            <?php endforeach; endif; ?>
            </tbody>

       </table>

</div>