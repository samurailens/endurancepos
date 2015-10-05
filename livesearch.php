<?php
// Array with names
$a[] = "Mushroom Pepper Fry";
$a[] = "salads";
$a[] = "soups";
$a[] = "seafood";
$a[] = "fingerfood";
$a[] = "canpes";
$a[] = "fish";
$a[] = "savouybaking";
$a[] = "dip";
$a[] = "meat";
$a[] = "Red Lentil Dumplings";
$a[] = "Caramelized Fennel on Herbed Polenta";
$a[] = "Lazy Day Peanut Noodle Salad";
$a[] = "Weekday Vegetable Soup";
$a[] = "Green Curry Dumplings";
$a[] = "Kale Quinoa Bites";
$a[] = "Pomelo Noodles";
$a[] = "Rye Pasta";
$a[] = "Coconut Quinoa Bowl";
$a[] = "Momo Dumplings";
$a[] = "Lentils with Wine-Glazed Vegetable";
$a[] = "Mung Yoga Bowl";
$a[] = "Giant Lemon Fennel Beans";
$a[] = "Green Curry Porridge";
$a[] = "Immunity Soup";
$a[] = "Stuffed Cinnamon Donuts";
$a[] = "Ginger-Peach Shortbread Cobbler";
$a[] = "Buttermilk-Glazed Cherry Sheet Cake";
$a[] = "Orange-and-Basil Macerated Cherries";
$a[] = "Buttermilk-Plum Ice Cream";
$a[] = "Mixed Stone-Fruit Pie";
$a[] = "Fresh Apple Cake";
$a[] = "Free-Form Strawberry Cheesecake";
$a[] = "Nutter Butter®-Banana Pudding Trifle";
$a[] = "Double Apple Pie with Cornmeal Crust";
$a[] = "Mocha Java Cakes";
$a[] = "Blackberry-Apple Upside-Down Cake";
$a[] = "Luscious Lemon Bars";
$a[] = "Praline Pull-Apart Bread";
$a[] = "Strawberry-Buttermilk Sherbet";
$a[] = "So Good Brownies";

$a[] = "Buttermilk Breakfast Cake	";
$a[] = "Peach-and-Toasted Pecan Ice Cream";
$a[] = "Rustic Plum Tart";
$a[] = "Chocolate Marble Sheet Cake";
$a[] = "Caramelized Banana Pudding	";
$a[] = "Apple Stack Cake";
$a[] = "Coca Cola";
$a[] = "Coca Cola Light	";
$a[] = "Fanta";
$a[] = "Sprite";
$a[] = "Nestea Lemon";
$a[] = "Nestea Peach";
$a[] = "Cappy Apple";

$a[] = "Cappy Orange";
$a[] = "Cappy Lemon";

$a[] = "Cappy Grape";
$a[] = "Cappy Cherry";






// get the q parameter from URL
$q = $_GET["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = "<a href='#' onclick='addToCartFromSearch(this);'> $name </a>";
            } else {
                $hint .= "<br> <a href='#' onclick='addToCartFromSearch(this);'> $name </a>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
?>