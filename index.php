<?php 

    /* TO-DO: Include header.php
              Hint: header.php is inside the includes folder and already connects to the database
    */

	include("./includes/header.php");

    /*
	 * Retrieve toy information from the database based on the toy ID.
	 * 
	 * @param PDO $pdo       An instance of the PDO class.
	 * @param string $id     The ID of the toy to retrieve.
	 * @return array|null    An associative array containing the toy information, or null if no toy is found.
	 */
	function get_toys(PDO $pdo) {
		                                                    // SQL query to retrieve toy information based on the toy ID
		$sql = "SELECT * 
			FROM toy;";	                        // :id is a placeholder for value provided later 
		                                                    // It's a parameterized query that helps prevent SQL injection attacks and ensures safer interaction with the database

		                                                    // Execute the SQL query using the pdo function and fetch the result
		$toys = pdo($pdo, $sql)->fetchAll();		// Associative array where 'id' is the key and $id is the value. Used to bind the value of $id to the placeholder :id in SQL query.

		return $toys;                                        // Return the toy information (associative array)
	}

	$toys = get_toys($pdo);                          // Retrieve info about toy with ID '0001' from the database using provided PDO connection
?>


<section class="toy-catalog">

	<?php foreach ($toys as $toy) { ?>
		<!-- TOY CARD START -->
		<div class="toy-card">
			<!-- TO-DO: Create a hyperlink to toy.php and pass the toy number as a URL parameter
						Hint: Access the value from the $toy1 array (what is the column name in the database?) -->
			<a href="toy.php?toynum=<?= $toy["toyID"] ?>">

				<!-- TO-DO: Display the toy image and update the alt text to the toy name
							Hint: Access the values from the $toy1 array (what are the column names in the database?) -->
				<img src="<?= $toy["img_src"] ?>" alt="<?= $toy["name"] ?>">
			</a>

			<!-- TO-DO: Display the name of the toy
						Hint: Access the value from the $toy1 array (what is the column name in the database?) -->
			<h2><?= $toy["name"] ?></h2>

			<!-- TO-DO: Display price of toy 
						Hint: Access the value from the $toy1 array (what is the column name in the database?) -->
			<p>$<?= $toy["price"] ?></p>
		</div>
		<!-- TOY CARD END -->

	<?php } ?>

</section>

<?php include 'includes/footer.php'; ?>
