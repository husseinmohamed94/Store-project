
<nav class="navbar info-nav text-center  navbar-light main_navigation ">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse info-div-nav navbar-collapse " id="navbarNavDropdown">
        <div class="employee_info">
        <div class="profile_picture">
            <img class="" src="/mvcapp/public/img/user.png" alt="User Profile Picture"/>

        </div>


            <span class="name"><?= $this->session->u->profile->firstName?> <?= $this->session->u->profile->lastName?> </span>
            <span class="privilege"><?= $this->session->u->GroupName ?></span>
        </div>

        <ul class="navbar-nav list-unstyled text-right  app_navigation">
            <li class="<?= $this->matchUrl('/') === true ?  'selected' : '' ?>   "> <a href=""><i class="fa  fa-dashboard "> </i>  <?= $text_general_statidtics ?></a></li>
            <li class="nav-item dropdown">
                <a class="nav-link " href="/mvcapp/public/index.php/transactions" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-credit-card"> </i><?= $text_transactions ?>
                </a>
                <div class="dropdown-menu info-dropdown" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/mvcapp/public/index.php/purcheses"><?= $text_transactions_purchases ?> </a>
                    <a class="dropdown-item" href="/mvcapp/public/index.php/sales"><?= $text_transactions_sales?></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link " href="/mvcapp/public/index.php/expenses" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-money"> </i><?= $text_expenses ?>
                </a>
                <div class="dropdown-menu info-dropdown" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/mvcapp/public/index.php/expensescategories"> <i class="fa fa-scissors"></i> <?= $text_expenses_categories?> </a>
                    <a class="dropdown-item" href="/mvcapp/public/index.php/expensesdaily"><i class="fa fa-expand"></i> <?= $text_expenses_daily?> </a>
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link " href="/mvcapp/public/index.php/store" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">store </i>  <?= $text_store ?>
                </a>
                <div class="dropdown-menu info-dropdown" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/mvcapp/public/index.php/productcategories"><?= $text_store_categories?></a>
                    <a class="dropdown-item" href="/mvcapp/public/index.php/productlist"><?= $text_store_products?> </a>
                </div>
            </li>
            <li> <a href="/mvcapp/public/index.php/clients"><i class="material-icons">contacts </i> <?= $text_clients ?></a></li>
            <li class="<?= $this->matchUrl('/suppliers') === false ?  'selected' : '' ?>  " > <a href="/mvcapp/public/index.php/suppliers"><i class="material-icons">group </i><?= $text_suppliers?></a></li>

            <li class="nav-item dropdown">
                <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">store </i>  <?= $text_users ?>
                </a>
                <div class="dropdown-menu info-dropdown" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/mvcapp/public/index.php/users"><?= $text_users_mneu?></a>
                    <a class="dropdown-item" href="/mvcapp/public/index.php/usersgroups"><?= $text_users_group ?> </a>
                    <a class="dropdown-item" href="/mvcapp/public/index.php/privileges"><?= $text_users_control ?> </a>
                </div>
            </li>

            <li> <a href="/mvcapp/public/index.php/reports "><i class="fa fa-bar-chart"> </i><?= $text_reports ?></a></li>
            <li> <a href="/mvcapp/public/index.php/notification"><i class="fa fa-bell"> </i><?= $text_notification ?></a></li>
            <li><a href= "/mvcapp/public/index.php/auth/logout"><i class="fa fa-sign-out"></i> <?= $text_log_out ?> </a></li>

        </ul>


    </div>

</nav>



<div class="action_view">
    <?php $messages = $this->messenger->getMessages(); if (!empty($messages)) : foreach ($messages as $message) : ?>
    <p class="message t<?= $message[1] ?>"><?= $message[0] ?></p>

    <?php endforeach; endif; ?>