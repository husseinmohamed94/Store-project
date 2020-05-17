
<div class="container">

    <a href="http://localhost/mvcapp/public/index.php/clients/create " class="button"><i class="fa fa-plus"></i> <?= $text_new_item?></a>
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
                <?php if(false !==$clients) : foreach ($clients as $client) : ?>
                   <tr>
                       <td><?= $client->Name ?></td>
                      
                       <td><?= $client->Email ?></td>
                       <td><?= $client->phoneNumber  ?></td>
                      
                       <td>
                           <a href="/mvcapp/public/index.php/clients/edit/<?= $client->clienId?>"><i class="fa fa-edit"></i> </a>

                           <a href="/mvcapp/public/index.php/clients/delete/<?= $client->clienId?>"  onclick="if(!confirm('<?= $text_table_delete ?>')) return false ; "><i class="fa fa-times"></i> </a>

                       </td>

                   </tr>
            <?php endforeach; endif; ?>
            </tbody>

       </table>

</div>