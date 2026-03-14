<?php

  /* TO-DO: Create a function called authenticate() that:
      1. Accepts $pdo, username, and password as parameters
      2. Queries the customer table to find a row matching the provided username and password
      3. Executes the SQL query using the pdo() helper function and fetches the result
      4. Returns the matching user row if found
	*/
	function authenticate(PDO $pdo, string $username, string $password) {
		$sql = "SELECT *
				FROM customer
				WHERE username= :uName and password= :uPass;";
				
		return pdo($pdo, $sql, ["uName" => $username, "uPass"=> $password])->fetch();
	}



  if ($_SERVER["REQUEST_METHOD"] == "POST") {         // Check if the form was submitted
    $username = $_POST['username'];                  // Get the username the user sent
    $password = $_POST['password'];                 // Get the password the user sent



    /* TO-DO: Call authenticate() function to verify the username and password
              Pass the appropriate arguments (hint: use variables given above)
              Store the returned value in a variable called $user

              Hint: You defined authenticate() earlier in session.php
    */
    $user = authenticate($pdo, $username, $password);



    if ($user) {                               // If user data returned
      login($user);                           // Call the login function to update session data                                             
      header('Location: profile.php');       // Redirect to profile page
      exit;                                 // Stop further code running 
    }
  }

  /* TO-DO: Include header.php
            Hint: header.php is inside the includes folder and already connects to the database
  */
  include("./includes/header.php");
  
  if ($logged_in) {                                       // If already logged in  
    header('Location: profile.php');                     // Redirect to profile page 
    exit;                                               // Stop further code running
  }
?> 

<div id="content" class="login-container animate-bottom">
    <h1>Log In</h1>
    <hr />

    <form method="POST" action="login.php" class="login-form">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Log In" class="submit-btn">
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>