<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./">Search</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./list-appointment">Appointments List</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./book-appointment">Appointment Booking</a>
    </li>
    <?php
    if (isset($user)) { ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $user->getName() ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="./logout">Log out</a></li>
            </ul>
        </li>
    <?php } ?>
</ul>