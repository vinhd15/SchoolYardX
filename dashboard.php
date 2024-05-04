<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>SchoolYard Xchange</title>
  <link rel="stylesheet" href="dashboard1.css">
  <script src="https://kit.fontawesome.com/34c6296155.js" crossorigin="anonymous"></script>
</head>

<body>
  <header class="topnav">
    <a href="index.php" id="mainpage">SchoolYard Xchange</a>
    <input type="text" placeholder="Search the SchoolYard" id="searchbar" />
    <button id="searchButton"><i class="fa-solid fa-magnifying-glass"></i></button>
    <div class="right-items">
    <a href="dashboard.php" id="dashlink"><i class="fa-solid fa-gauge"></i> Dashboard</a>
    <a href="faq.php" id="faqlink"><i class="fa-solid fa-circle-question"></i> FAQ</a>
    <?php
    session_start();

    // Check if user is logged in
    if (isset($_SESSION['Email'])) {
      $fname = $_SESSION['fname'];
      echo "<a href='user.php' id='loginlink'><i class='fa-solid fa-user'></i> Account</a>";

    } else {
      // Show login
      echo "<a href='login.html' id='loginlink'><i class='fa-solid fa-user'></i> Login</a>";
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    ?>
    </div>
  </header>


  <nav class="sidenav">
    <!-- create link to take user to adding item if they are logged in -->
    <?php
    

    if (isset($_SESSION['Email'])) {
      echo "<a href='createitem.php'><button>Create Listing <i class='fa-regular fa-square-plus' id='createicon'></i></button></a>";

    } else {
      // Show login
      echo "<a href='login.html' id='loginlink'><button>Create Listing <i class='fa-regular fa-square-plus' id='createicon'></i></button></a>";
    }

    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);



    ?>
    <br>
    <hr>
    <strong><u>Sort By:</u></strong>
    <form action="filtered.php" method=GET id="filterForm">
    <select name="sort" id="sort">
      <option value="recent">Most Recent</option>
      <option value="old">Oldest</option>
      <option value="high">Price: High to Low</option>
      <option value="low">Price: Low to High</option>
    </select>
    <br>
    <hr>
    <input type="checkbox" class="location-checkbox" name="oncampus" id="oncampcheck" checked>
    <label for="oncampcheck">On-Campus</label> <br> <br>
    <input type="checkbox" class="location-checkbox" name="offcampus" id="offcampcheck" checked>
    <label for="offcampcheck">Off-Campus</label>
    <br>
    <hr>
    <br>
    <input type="checkbox" class="category-checkbox" name="1" id="bookcheck" checked>
    <label for="bookcheck"><i class="fa-solid fa-book"></i> Books</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="2" id="furncheck" checked>
    <label for="furncheck"><i class="fa-solid fa-couch"></i> Furniture</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="3" id="homecheck" checked>
    <label for="homecheck"><i class="fa-solid fa-kitchen-set"></i> Home</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="4" id="elecheck" checked>
    <label for="elecheck"><i class="fa-solid fa-calculator"></i> Electronics</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="5" id="clothescheck" checked>
    <label for="clothescheck"><i class="fa-solid fa-shirt"></i> Clothes</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="6" id="accessoriescheck" checked>
    <label for="accessoriescheck"><i class="fa-regular fa-gem"></i> Jewelry / Accessories</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="7" id="misccheck" checked>
    <label for="misccheck"><i class="fa-solid fa-bars"></i> Miscellaneous</label> <br> <br>
    <button type="button" id="select">Select All</button>
    <button type="button" id="deselect">Deselect All</button>

    <script>
    // Get references to the select/deselect buttons and all checkboxes
    const selectButton = document.getElementById('select');
    const deselectButton = document.getElementById('deselect');
    const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');

    // Function to select all checkboxes
    selectButton.addEventListener('click', function() {
        allCheckboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    });

    // Function to deselect all checkboxes
    deselectButton.addEventListener('click', function() {
        allCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    });
</script>

<!-- Function to Pull Contents of Searchbar into the form -->
<input type="hidden" id="searchInput" name="search" value="">

<script>
// Get references to the form and search input
const form = document.querySelector('form');
const searchInput = document.getElementById('searchbar');

// Add an event listener to the form submission
form.addEventListener('submit', function(event) {
    // Set the value of the hidden input field to the search input value
    document.getElementById('searchInput').value = searchInput.value;
});
</script>

    <button type="submit">Apply Filters</button>
    </form>

    <script>
document.getElementById('searchButton').addEventListener('click', function() {
  // Set the value of the hidden input field to the search input value
  document.getElementById('searchInput').value = document.getElementById('searchbar').value;
    // Submit the form when the search button is clicked
    document.getElementById('filterForm').submit();
});
</script>


  </nav>
    <main>

        <!-- item template -->
<div class="container">
    <?php
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        include 'dbconnect.php';
        
        $sql = "SELECT Items.*, Images.img_dir FROM Items INNER JOIN Images ON Items.imageid = Images.imageid WHERE UserID = '$userid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr>';
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                echo '<td>';
                $listid = "listing" . $row['ListingID'];
                echo '<div class="listing" id="' . $listid . '">';
                echo '<a href="listing_details.php?ListingID=' . $row["ListingID"] . '">';
                echo '<img class="listimg" src="' . $row["img_dir"] . '" /> <br />';
                echo '<h2 class="name">' . $row["prod_name"] . '</h2>';
                echo '<h3 class="category">' . $row["Category"] . '</h3>';
                echo '<p class="delivery">' . $row["DeliveryPreferences"] . '</p>';
                echo '<p class="location">' . $row["Location"] . '</p>';
                echo '<p class="soldstatus">' . $row["SoldStatus"] . '</p>';
                echo '</a>';
                echo '<div style="display: flex; justify-content: space-between;">'; // Style for inline flexbox
                echo '<button style="margin-right: 5px;" onclick="location.href=\'edit_item.php?ListingID=' . $row['ListingID'] . '\'">Edit</button>';
                echo '<form action="delete_listing.php" method="post" style="display:inline;">
                      <input type="hidden" name="id" value="' . $row['ListingID'] . '">
                      <button type="submit" onclick="return confirm(\'Are you sure you want to delete this item?\');">Delete</button>
                      </form>';
                echo '</div>'; // Close flex container
                echo '</div>';
                echo '</td>';

                $count++;
                if ($count % 3 == 0) {
                    echo '</tr><tr>';
                }
            }
            echo '</tr>';
            echo '</table>';
        } else {
            echo "0 results";
        }
        $conn->close();
    } else {
        header('location: login.html');
    }
    ?>
</div>

    </main>
</body>

</html>