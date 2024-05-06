<?php
$total_money = 0; ?>

<p>Cart : <?php  
if(isset($_SESSION['dangky']))
{
    echo $_SESSION['dangky'];
}
?></p>

<div class="container">
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step current"> <span> <a href="index.php?manage=carts" >Cart</a></span> </div>
    <div class="step"> <span><a href="index.php?manage=shipping" >Shipping</a></span> </div>
    <div class="step"> <span><a href="index.php?manage=payment" >Payment</a><span> </div>
    <div class="step"> <span><a href="index.php?manage=alreadyorder" >History Bill</a><span> </div>  
  </div>
  
</div>
<table class="cart">
    <thead>
        <tr>
            <th class="product-name">Product Name</th>
            <th class="product-price">Price</th>
            <th class="product-qty">Quantity</th>
            <th class="product-total">Total</th>
            <th class="action"></th>
        </tr>
    </thead>
    <?php
    if (isset($_SESSION['cart'])) {
        $thanhtien = 0;

        foreach ($_SESSION['cart'] as $cart_item) {
            $thanhtien = $cart_item['quantity'] * $cart_item['price'];
            $total_money += $thanhtien;
    ?>
            <tbody>
                <tr>
                    <td class="product-name">
                        <div class="product-thumbnail">
                            <img style="width: 150px;" src="admincp/modules/manageproduct/uploads/<?php echo $cart_item['thumbnail'] ?>" alt="">
                        </div>
                        <div class="product-detail" style="margin-top: 70px;">
                            <h3 class="product-title"><?php echo $cart_item['name_product'] ?></h3>
                        </div>
                    </td>
                    <td class="product-price"><?php echo number_format($cart_item['price']) . '₫' ?></td>
                    <td class="product-qty">

                        <a class="btn btn-light" href="pages/main/addtocart.php?plus=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus"></i></a>
                        <?php echo $cart_item['quantity'] ?>
                        <a class="btn btn-light" href="pages/main/addtocart.php?minus=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus"></i></a>

                    </td>
                    <td class="product-total"><?php echo number_format($thanhtien) . 'đ'; ?></td>
                    <td class="action"><a href="pages/main/addtocart.php?delete=<?php echo $cart_item['id'] ?>"><i class="fa fa-times"></i></a></td>
                </tr>
            </tbody>
        <?php }
    } else { ?>
        <tr>
            <td colspan="6">
                <p>Empty</p>
            </td>
        </tr>
    <?php } ?>
</table> <!-- .cart -->


<?php
if ($total_money == 0) {

?>

<?php } else {
?>

    <div class="cart-total" style="float: left; width: 160px;">
        <tr>
            <p><a href="javascript:;" onclick="confirmDelete(1)">Delete all products</a></p>
        </tr>
    </div>

    <div class="cart-total">
        <!-- <p><strong>Subtotal:</strong> $650.00</p>
        <p><strong>Shipment:</strong> $15.00</p> -->
        <p class="total"><strong>Total</strong><span class="num"><?php echo number_format($total_money) . 'đ'; ?></span></p>
        <p>
            <a href="index.php" class="button">Continue Shopping</a>
           
            <?php 
                if(isset($_SESSION['dangky'])){
            ?>
            <a href="index.php?manage=shipping" class="button">Shipping</a>
            <?php } else {?>
                <a href="index.php?manage=login" class="button">Login to order</a>
            <?php } ?>
        </p>


    </div> <!-- .cart-total -->
<?php
}
?>

<!-- Use class="button muted" to muted button -->

<script>
function confirmDelete(productId) {
    var result = confirm("Are you sure you want to delete all product?");
    if (result) {
        window.location = "pages/main/addtocart.php?deleteall=" + productId;
    }
}
</script>