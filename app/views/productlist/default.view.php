

<div class="container">

    <a href="http://localhost/mvcapp/public/index.php/productlist/create/" class="button"><i class="fa fa-plus"></i> <?= $text_new_item?></a>
       <table class="data">
           <thead>
           <tr>
               <th><?= $text_table_name ?></th>
               <th><?= $text_table_category ?></th>
               <th><?= $text_table_buy_Price ?></th>
               <th><?= $text_table_sall_Price ?></th>
               <th><?= $text_table_quantity ?></th>
               <th><?= $text_table_control ?></th>

           </tr>
           </thead>
            <tbody>
                <?php if(false !== $Products) : foreach ($Products as $Product) : ?>
                   <tr>
                       <td><?= $Product->Name ?></td>
                       <td><?= $Product->categortyName ?></td>
                       <td><?= $Product->BuyPrice ?></td>
                       <td><?= $Product->sallPrice ?></td>
                       <td><?= $Product->Quantity ?></td>


                        <td>
                            <a href="/mvcapp/public/index.php/productlist/edit/<?= $Product->productid?>"><i class="fa fa-edit"></i> </a>

                            <a href="/mvcapp/public/index.php/productlist/delete/<?= $Product->productid?>"  onclick="if(!confirm('<?= $text_table_delete ?>')) return false ; "><i class="fa fa-times"></i> </a>

                        </td>
                   </tr>
            <?php endforeach; endif; ?>
            </tbody>

       </table>

</div>