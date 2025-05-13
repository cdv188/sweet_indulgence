<?php
    include "../oop.php";

    $oop = new login_page();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="../style/checkout.css">
    <link rel="stylesheet" type="text/css" href="..\style\bootstrap.css">
    <link rel="shortcut icon" href="../logo/logo.png" type="image/x-icon">
</head>
<body>
    <?php
        $fetch_order = $oop->fetch_order();

        $orderIsEmpty = (mysqli_num_rows($fetch_order) === 0);
    ?>
    <header class="nav">
        <img class="logo" style="width: 90px;" src="../logo/logo.png">
        <nav>
            <ul>
                <li><h1><a href="../index.php">Home</a></h1></li>
                <li><h1><a href="products.php">Products</a></h1></li>
                <li><h1><a href="contactUs.php">Inquiry</a></h1></li>
                <li class="profile-nav"><h1><a href="cart.php"><img style="width: 70px; " src="../logo/shopping-cart.png" class="profile-image"></a></h1></li>
            </ul>
        </nav>
    </header>
    <center style="margin: auto;">
        <!-- Your main content, e.g., order summary -->
        <div class="counter-container" id="counterModal">
            <div class="counter-text">
                <span class="close-btn" onclick="closeCounterModal()">&times;</span>
                <p id="counter_text_content">Please proceed to the counter.</p>
            </div>
        </div>
        <section>
            <div class="specials">
                <div class="special-lists">
                    <ul>
<?php
                          $totalSummaryPrice = 0;
                        while ($row = mysqli_fetch_array($fetch_order)) {
                                $id = $row['product_id'];
                                $price = $row['price'];
                                $items = $row['Items'];
                                $total = $price * $items;
?>
                        <li>
                                <p>Price:&nbsp<h2><?php echo number_format($total, 2); ?></h2></p>
                                <p>Product:&nbsp<h5><?php echo $row['product_name'] ?>&nbsp</h5></p>
                                <p>Items:&nbsp<h5><?php echo $row['Items'];?> </h5></p>
                        </li>
<?php
                                $totalSummaryPrice += $total;
                            }
                        
?>
                            <h1 style="margin-bottom: 20px;">Summary</h1>
                        <li>
                            <p>Total: <h2>₱<?php echo $totalSummaryPrice; ?></h2></p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
            <div class="modal-container" id="gcashModal">
                <div class="gcash-container">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <img src="../logo/pay.jpg" id="image" class="gcash" alt="GCash Image"/>
                    <p>Please show reciept on the counter.</p>
                </div>
            </div>
        <section>
            <form method="POST" enctype="multipart/form-data">
                <div class="checkout-form">

                    <label for="payment_method"><b>Payment Method:</b></label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="counter">Over the counter</option>
                        <option value="gcash">Gcash</option>
                    </select>
                   <?php if ($orderIsEmpty): ?>
                        <p style="color: red;">You need to place an order before proceeding to checkout.</p>
                        <button class="add" type="button" onclick="show()" disabled>Submit Order</button>
                    <?php else: ?>
                        <button class="add" type="button" onclick="show()">Submit Order</button>
                    <?php endif; ?>
                   
                </div> 
            <script>
function show() {
    var paymentMethod = document.getElementById('payment_method').value;
    var image = document.getElementById('image');
    var counterText = document.getElementById('counter_text_content');

    if (paymentMethod === 'gcash') {
        // Show the GCash modal
        showModal();
        image.src = "../logo/pay.jpg";
        image.style.display = "block";
        counterText.style.display = "none";
    } else if (paymentMethod === 'counter') {
        // Show the counter text modal
        showCounterModal();
        image.style.display = "none";
        counterText.style.display = "block";
        counterText.innerHTML = "Please show the receipt to the counter.";
    }

    return false; // Prevent form submission
}

    function showCounterModal() {
        var counterModal = document.getElementById('counterModal');
        counterModal.style.display = 'flex';
    }

function closeCounterModal() {
    var counterModal = document.getElementById('counterModal');
    counterModal.style.display = 'none';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_order.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                // Redirect only after AJAX is successful
                window.open('../pdf.php', '_blank');
                window.location.href = '../index.php';
                
            } else {
                console.error('AJAX request failed');
            }
        }
    };
    xhr.send('action=processOrders');
}

    function showModal() {
        var modal = document.getElementById('gcashModal');
        modal.style.display = 'flex';
    }



    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Successful response, handle as needed
                console.log(xhr.responseText);
            } else {
                // Handle error
                console.error('AJAX request failed');
            }
        }
    };

    function closeModal() {
        var modal = document.getElementById('gcashModal');
        modal.style.display = 'none';

        // Send an AJAX request to a PHP script for server-side actions
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process_order.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Successful response, handle as needed
                    console.log(xhr.responseText);
                } else {
                    // Handle error
                    console.error('AJAX request failed');
                }
            }
        };
        xhr.send('action=processOrders');

        window.location.href = '../index.php';

        // Open the link in a new tab
        window.open('../pdf.php', '_blank');
    }
</script>
            </form>
        </section>
    </center>

    <footer>
        <p>&copy; 2023 CDV Developer</p>
    </footer>
</body>
</html>