<?php

	if ( !empty($_POST)) {
		$query = $_POST['query'];
  }

  session_start();

  echo "" . !empty($_SESSION['history']) . "<br/>";
  if ( !empty($_SESSION['history'])) {

    $history = $_SESSION['history'];
    print_r($history);

    array_push($history, 'recipeMain.php');

    $_SESSION['history'] = $history; 

  } else {

    $_SESSION['history'] = array('recipeMain.php');
    $history = $_SESSION['history'];
    print_r($history);

  }

  echo '<a href="clearSession.php">Clear Session</a><br/>';  

?>

<html>

  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Menu Creator and Recipe System</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <span class="navbar-brand">Recipes</span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="btn btn-primary" href="create.php" >Create New Recipe</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="recipeMain.php" method="post">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query" value="<?php echo !empty($query)?$query:'';?>">
          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <br />

    <div class="container-md">
      <table class="table table-striped table-bordered">

          <thead>
            <tr>
              <th>Name</th>
              <th>Tags</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            <?php 
              include 'recipeDatabase.php';
              $pdo = Database::connect();

              if (!empty($query)) {
                $sql = "SELECT * FROM recipes WHERE name LIKE '%" . $query . "%' OR tags LIKE '%" . $query . "%' ORDER BY name ASC";
              } else {
                $sql = "SELECT * FROM recipes ORDER BY name ASC";
              }

              $data = $pdo->query($sql);
              if (!empty($data)) {  
                foreach ($data as $row) {
                  echo '<tr>';
                  echo '<td>'. $row['name'] . '</td>';
                  echo '<td>'. $row['tags'] . '</td>';
                  echo '<td width="400">';
                  echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">View</a>';
                  echo '&nbsp;';
                  echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                  echo '&nbsp;';
                  echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                  echo '</td>';
                  echo '</tr>';
                }
              } else {
                echo '<tr>';
                echo '<td>None</td>';
                echo '<td>N/A</td>';
                echo '<td width="400">';
                echo '<a class="btn btn-primary" href="#">View</a>';
                echo '&nbsp;';
                echo '<a class="btn btn-success" href="#">Update</a>';
                echo '&nbsp;';
                echo '<a class="btn btn-danger" href="#">Delete</a>';
                echo '</td>';
                echo '</tr>';
              }
              Database::disconnect();
            ?>
          </tbody>

        </table>
      </div>
    </div> <!-- /container -->
  </body>
</html>
