<?php 

  session_start();

  //Create session array storing current session history.

  if (isset($_SESSION['history'])) {

    $history = $_SESSION['history'];

    array_push($history, 'read.php');

  } else {

    $_SESSION['history'] = array('read.php');

  }

	require 'recipeDatabase.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: recipeMain.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM recipes where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}

  $ingredients = preg_split('/\r\n|\r|\n/', $data['ingredients']);

?>

<html>

  <head>
    <!-- <link href="./css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./css/sharelinks2.css" rel="stylesheet">
    <title>Menu Creator and Recipe System</title>
  </head>

  <body>

    <div class="container">

      <div class="row justify-content-center" style="background-color: rgb(230, 230, 230); padding-bottom: 10px">

        <div class="col-12 d-flex justify-content-center">
          <h2><?php echo $data['name'];?></h2>
        </div>

      </div>
  
      <br />

      <div class="row mr-auto">
  
        <div class="col-2">

        </div>

        <div class="col-8">

          <h3>Ingredients</h3>
          <p>
            <?php 
              #echo $data['ingredients'];
              foreach ($ingredients as $ingredient) {
                echo $ingredient . "<br />"; 
              } 
            ?>
          </p>

          <h3>Directions</h3>
          <p>
            <?php echo $data['directions'];?>
          </p>

        </div>

        <div class="col-2">
          <div class="share-buttons" data-source="simplesharingbuttons.com">

            <div>
              <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fptserv.ddns.net%2Frecipe%2FrecipeMain.php&quote=" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&quote=' + encodeURIComponent(document.URL)); return false;">
                <img alt="Share on Facebook" src="img/Facebook.svg" />
              </a>
            </div>

            <div>
              <a href="https://twitter.com/intent/tweet?source=https%3A%2F%2Fptserv.ddns.net%2Frecipe%2FrecipeMain.php&text=:%20https%3A%2F%2Fptserv.ddns.net%2Frecipe%2FrecipeMain.php" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;">
                <img alt="Tweet" src="img/Twitter.svg" />
              </a>
            </div>

            <div>
              <a href="http://www.tumblr.com/share?v=3&u=https%3A%2F%2Fptserv.ddns.net%2Frecipe%2FrecipeMain.php&quote=&s=" target="_blank" title="Post to Tumblr" onclick="window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&quote=' +  encodeURIComponent(document.title)); return false;">
                <img alt="Post to Tumblr" src="img/Tumblr.svg" />
              </a>
            </div>

            <div>
              <a href="http://pinterest.com/pin/create/button/?url=https%3A%2F%2Fptserv.ddns.net%2Frecipe%2FrecipeMain.php&description=" target="_blank" title="Pin it" onclick="window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(document.URL) + '&description=' +  encodeURIComponent(document.title)); return false;">
                <img alt="Pin it" src="img/Pinterest.svg" />
              </a>
            </div>

            <div>
              <a href="https://getpocket.com/save?url=https%3A%2F%2Fptserv.ddns.net%2Frecipe%2FrecipeMain.php&title=" target="_blank" title="Add to Pocket" onclick="window.open('https://getpocket.com/save?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;">
                <img alt="Add to Pocket" src="img/Pocket.svg" />
              </a>
            </div>

            <div>
              <a href="http://www.reddit.com/submit?url=https%3A%2F%2Fptserv.ddns.net%2Frecipe%2FrecipeMain.php&title=" target="_blank" title="Submit to Reddit" onclick="window.open('http://www.reddit.com/submit?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;">
                <img alt="Submit to Reddit" src="img/Reddit.svg" />
              </a>
            </div>

            <div>
              <a href="mailto:?subject=&body=:%20https%3A%2F%2Fptserv.ddns.net%2Frecipe%2FrecipeMain.php" target="_blank" title="Send email" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' +  encodeURIComponent(document.URL)); return false;">
                <img alt="Send email" src="img/Email.svg" />
              </a>
            </div>

          </div>

        </div>
      </div>

      <br />

      <div class="row justify-content-center" style="background-color: rgb(230, 230, 230); padding-bottom: 15px; padding-top: 10px">
        <div class="col d-flex justify-content-center">

          <div class="form-actions">
            <a class="btn btn-success" href="recipeMain.php">Back</a>
            <?php  
              echo '<a class="btn btn-primary" href="update.php?id='.$id.'">Update</a>'; 
            ?>
          </div>
       
        </div>
      </div>
            
      <br />

    </div> <!-- /container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
