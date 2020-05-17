

<div class="container">

    <a href="http://localhost/mvcapp/public/index.php/productcategories/create/" class="button"><i class="fa fa-plus"></i> <?= $text_new_item?></a>
       <table class="data">
           <thead>
           <tr>
               <th><?= $text_table_group_name ?></th>
               <th><?= $text_table_control ?></th>

           </tr>
           </thead>
            <tbody>
                <?php if(false !==$categories) : foreach ($categories as $categorie) : ?>
                   <tr>
                       <td><?= $categorie->Name ?></td>

                        <td>
                            <a href="/mvcapp/public/index.php/productcategories/edit/<?= $categorie->categortyid?>"><i class="fa fa-edit"></i> </a>

                            <a href="/mvcapp/public/index.php/productcategories/delete/<?= $categorie->categortyid?>"  onclick="if(!confirm('<?= $text_table_delete ?>')) return false ; "><i class="fa fa-times"></i> </a>

                        </td>
                   </tr>
            <?php endforeach; endif; ?>
            </tbody>

       </table>

</div>