<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
    <div class="backgroundos">    <!--Container abych mohl používat % míst vw/vh-->
        <div class="header-container">
            <a href="index.php"><h1>Obchod</h1></a>
        </div>
        <div class="navbar-container">  <!--Container pro navbar + link na shoplist-->
            <div class="navbar-container-left"> <!--Container pro navbar!!-->
                <ul class="nav" style="color:black;">
                    <li class="nav-item" style="color:black;">
                        <a class="nav-link" id='linkyHore' href="#">O nás</a>
                    </li>
                    <li class="nav-item"style="color:black;">
                        <a class="nav-link" id='linkyHore' href="#">Kdo je David Vinš?!</a>
                    </li>
                    <li class="nav-item"style="color:black;">
                        <a class="nav-link" id='linkyHore' href="#">Linkos</a>
                    </li>
                    <li class="nav-item" style="color:black;">
                        <a class="nav-link" id='linkyHore' href="#">Disabled</a>
                    </li>
                    <li class="nav-item" style="color:black;">
                        <a class="nav-link" id='linkyHore' href="#">Disabled</a>
                    </li>
                </ul> 
            </div>
            <div class="navbar-container-right">    <!--Container pro link na shoplist-->
                <a class="nav-link" href="index.php">
                    <img src="https://img.icons8.com/ios/50/000000/shopping-cart--v1.png"/>
                </a>
            </div>
        </div>
        
        <div class="holder-container">  <!--Container pro držení side + shopu-->
        <div class="side-container">
            <?php
                include 'conn.php';

                $sql = "SELECT DISTINCT kategorie FROM produkty";

                if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_row()) {
                        $category = $row[0];
                        echo "<a href=\"?category=$category\">$category</a><br>";
                    }
                }
            ?>
        </div>
            <div class="shop-container">    <!--Container pro shop-->
                <!--Vypíše všechny produkty do html-->
                <?php
                    if(isset($_GET['category'])){
                        $selectedCategory = $_GET['category'];
                
                        // SQL query with the added category filter
                        $sql = "SELECT id, nazev, cena, obrazek FROM produkty WHERE kategorie = '$selectedCategory'";
                
                        // Execute the query
                        $result = $conn->query($sql);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class=\"item\">";
                                    echo "<image src=\"$row[obrazek]\" alt=\"\">";
                                    echo "<h2>$row[nazev]</h2>";
                                    echo "<p>$row[cena]Kč</p>";
                                    echo '<form action="#">';
                                            echo '<button type="submit" value="' . $row['id'] . '" >Koupit</button>';
                                    echo '</form>';
                                echo "</div>";
                                echo "<br>";
                            }
                        }
                    }
                    else{
                        // SQL query without the category filter
                        $sql = "SELECT id, nazev, cena, obrazek FROM produkty";
                
                        // Execute the query
                        $result = $conn->query($sql);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class=\"item\">";
                                    echo "<image src=\"$row[obrazek]\" alt=\"\">";
                                    echo "<h2>$row[nazev]</h2>";
                                    echo "<p>$row[cena]Kč</p>";
                                    echo '<form action="#">';
                                            echo '<button type="submit" value="' . $row['id'] . '" >Koupit</button>';
                                    echo '</form>';
                                echo "</div>";
                                echo "<br>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="script.js"></script>
</html>

<?php
    $_SESSION["cart"] = array();

    # Adding to session
    function AddToSession($id) {
        array_push($_SESSION["cart"], $id);
        return $_SESSION["cart"];
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $cart = AddToSession($id);
        echo json_encode($cart);
    }
?>