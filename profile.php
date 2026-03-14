<?php

    /* TO-DO: Include header.php
            Hint: header.php is inside the includes folder and already connects to the database
    */
    include("./includes/header.php");



            
	require_login($logged_in);                              // Redirect user if not logged in
	$username = $_SESSION['username'];                      // Retrieve the username from the session data
    $custID   = $_SESSION['custID'];                        // Retrieve the custID from the session data



    /* TO-DO: Create a function that retrieves ALL order information for the logged-in user 

              Your function should:
                1. Query the appropriate tables to retrieve:
                    - order information
                    - toy name
                    - toy image
                    Make sure to sort the results in descending order (most recent first)
                2. Execute the SQL query using the pdo() helper function and fetch the results
                3. Return orders for the logged-in user only
	*/
    function retrieve_orders(PDO $pdo, $userID){
        $sql = 'SELECT *
                FROM orders, toy
                WHERE orders.toyID = toy.toyID and orders.custID = :userID;';

        return pdo($pdo, $sql, ["userID" => $userID])->fetchAll();
    }



    /* TO-DO: Call function to retrieve orders for the logged-in user */
    $orders = retrieve_orders($pdo, $custID);
?>

<main class="container profile-page">

    <h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>

    <!-- TO-DO: Check if no orders were returned from the database -->
    <?php if (!$orders) { ?>
        <div class="no-orders">
            <p>You have no orders yet.</p>
        </div>

    <!-- TO-DO: Otherwise (order data was returned) -->
    <?php } else { ?>
        <div class="orders-container">

            <!-- TO-DO: Loop through each order returned from the database -->
            <?php foreach($orders as $order) { ?>

                <div class="order-card">

                    <!-- TO-DO: Display the toy image and update the alt text to the toy name -->
                    <img src="<?= $order["img_src"] ?>" alt="<?= $order["name"] ?>">

                    <div class="order-info">

                        <!-- TO-DO: Display the order number -->
                        <p><strong>Order Number:</strong> <?= $order["orderID"] ?></p>

                        <!-- TO-DO: Display the toy name -->
                        <p><strong>Toy:</strong> <?= $order["name"] ?></p>

                        <!-- TO-DO: Display the order quantity -->
                        <p><strong>Quantity:</strong> <?= $order["quantity"] ?></p>

                        <!-- TO-DO: Display the date ordered -->
                        <p><strong>Date Ordered:</strong> <?= $order["date_ordered"] ?></p>

                        <!-- TO-DO: Display the delivery address -->
                        <p><strong>Delivery Address:</strong> <?= $order["deliv_addr"] ?></p>

                        <!-- TO-DO: Display the delivery date
                                    Hint: If the delivery date is NULL, use the null-coalescing operator to display a placeholder message like "Pending"
                         -->
                        <p><strong>Delivery Date:</strong> <?= is_null($order["date_deliv"]) ? "Pending" : $order["date_deliv"] ?></p>
                    </div>
                </div>

            <?php } ?>
        </div>
    <?php } ?>

</main>

<?php include 'includes/footer.php'; ?>