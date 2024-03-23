<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>SchoolYard Exchange</title>
    <link rel="stylesheet" href="home-layout.css">
  </head>
  <body>
    <header class="topnav">
      <a href="home.html" id="mainpage">SchoolYard Exchange</a>
      <input type="text" placeholder="Search the SchoolYard" id="searchbar" />
      <?php
        session_start();

        // Check if user is logged in
        if(isset($_SESSION['Email'])) {
            $fname = $_SESSION['fname'];
            echo "<a href='user.php' id='loginlink'>$fname's Account</a>";
            
        } else {
            // Show login
            echo "<a href='login.html' id='loginlink'>Login</a>";
        }
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        

        ?>

      <a href="favorites.html" id="favlink">Favorites</a>
      <a href="dashboard.html" id="dashlink">Dashboard</a>
    </header>

    
      <nav class="sidenav">
        <strong><u>Sort By:</u></strong>
        <select name="sort" id="sort">
          <option value="recent">Most Recent</option>
          <option value="top">Highest Rated</option>
          <option value="old">Oldest</option>
        </select>
        <br>
        <hr>
        <input type="checkbox" name="oncampus" id="oncampcheck">
        <label for="oncampcheck">On-Campus</label> <br> <br>
        <input type="checkbox" name="offcampus" id="offcampcheck">
        <label for="offcampcheck">Off-Campus</label>
        <br>
        <hr>
        <br>
        <input type="checkbox" name="books" id="bookcheck" checked>
        <label for="bookcheck">Books</label> <br> <br>
        <input type="checkbox" name="furniture" id="furncheck" checked>
        <label for="furncheck">Furniture</label> <br> <br>
        <input type="checkbox" name="home" id="homecheck" checked>
        <label for="homecheck">Home</label> <br> <br>
        <input type="checkbox" name="electronics" id="elecheck" checked>
        <label for="elecheck">Electronics</label> <br> <br>
        <input type="checkbox" name="clothes" id="clothescheck" checked>
        <label for="clothescheck">Clothes</label> <br> <br>
        <input type="checkbox" name="jewel" id="jewelcheck" checked>
        <label for="jewelcheck">Jewelry/Accessories</label> <br> <br>
        <input type="checkbox" name="misc" id="misccheck" checked>
        <label for="misccheck">Miscellaneous</label> <br> <br>
        <button type="button" id="select">select all</button>
        <button type="button" id="deselect">deselect all</button>
      </nav>
    
    <main>
    <!-- item template -->
    <div class="container">
      <div class="listing" id="listID">
        <img class="listimg" src="listimg.png" /> <br />
        <h3 class="price">$Price</h3>
        <p class="itemName">Item Name</p>
      </div>

      <div class="listing" id="listID">
        <img class="listimg" src="listimg.png" /> <br />
        <h3 class="price">$Price</h3>
        <p class="itemName">Item Name</p>
      </div>

      <div class="listing" id="listID">
        <img class="listimg" src="listimg.png" /> <br />
        <h3 class="price">$Price</h3>
        <p class="itemName">Item Name</p>
      </div>
    </div>
  </main>
  </body>
</html>
