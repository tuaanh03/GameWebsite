<?php
$sql_danhmuc = "SELECT * FROM category ORDER BY category_id DESC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>


<ul class="menu">
    <li class="menu-item home "><a href="index.php"><i class="icon-home"></i></a></li>

    <li class="menu-item drop-down">
        <a class="nav-link" href="index.php?manage=product" id="navbarDropdown" role="button" aria-expanded="false">
            Games
        </a>

        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
            ?>
                <li>
                    <a class="dropdown-item" href="index.php?manage=product&id=<?php echo $row_danhmuc['category_id'] ?>">
                        <label for="" class="psicon">
                            <?php if($row_danhmuc['category_name'] == 'Playstation 5' || $row_danhmuc['category_name'] == 'Playstation 4'){ ?>
                                <img src="images/free-playstation-40-739542.webp" alt="">
                            <?php } elseif($row_danhmuc['category_name'] == 'Nintendo Switch') {?>
                                <img src="images/nintendo_switch_icon_136357.png" alt="">
                            <?php } else{?>
                                <img src="images/microsoft_xbox_icon_136396.png" alt="">
                            <?php } ?>
                        </label>
                        <?php echo $row_danhmuc['category_name'] ?>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>

    </li>

    <li class="menu-item drop-down">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" aria-expanded="false">
            PS5
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Console</a></li>
            <li><a class="dropdown-item" href="#">Games</a></li>
            <li><a class="dropdown-item" href="#">Controllers</a></li>
            <li><a class="dropdown-item" href="#">Headsets</a></li>

        </ul>
    </li>
    <li class="menu-item drop-down">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" aria-expanded="false">
            PS4
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Console</a></li>
            <li><a class="dropdown-item" href="#">Games</a></li>
            <li><a class="dropdown-item" href="#">Controllers</a></li>
            <li><a class="dropdown-item" href="#">Headsets</a></li>

        </ul>
    </li>
    
    <li class="menu-item"><a class="nav-link" href="index.php?manage=news" id="navbarDropdown" role="button" aria-expanded="false">
            News
        </a></li>

</ul> <!-- .menu -->