<?php 
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
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/sharelinks.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <title>Menu Creator and Recipe System</title>
  </head>

  <body>

    <div class="container">
    
    		<div class="span10 offset1">

    				<div class="row">
              <h3><?php echo $data['name'];?></h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
              <div class="control-group">
                <label class="control-label">Ingredients</label>
                <div class="controls">
                    <label class="checkbox">
                    <?php 
                      #echo $data['ingredients'];
                      foreach ($ingredients as $ingredient) {
                        echo $ingredient . "<br />"; 
                      } 
                    ?>
                  </label>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Directions</label>
                <div class="controls">
                    <label class="checkbox">
                    <?php echo $data['directions'];?>
                  </label>
                </div>
              </div>
              <div class="form-actions">
                <a class="btn" href="recipeMain.php">Back</a>
					    </div>
					</div>
        </div>

      <!-- Sharingbutton Facebook -->
      <a class="resp-sharing-button__link" href=<?php echo "https://facebook.com/sharer/sharer.php?u=" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])?> target="_blank" rel="noopener" aria-label="">
        <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm3.6 11.5h-2.1v7h-3v-7h-2v-2h2V8.34c0-1.1.35-2.82 2.65-2.82h2.35v2.3h-1.4c-.25 0-.6.13-.6.66V9.5h2.34l-.24 2z"/></svg>
          </div>
        </div>
      </a>

      <!-- Sharingbutton Twitter -->
      <a class="resp-sharing-button__link" href=<?php echo "https://twitter.com/intent/tweet/?text=" . urlencode($data['name']) . ";url=" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])?> target="_blank" rel="noopener" aria-label="">
        <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm5.26 9.38v.34c0 3.48-2.64 7.5-7.48 7.5-1.48 0-2.87-.44-4.03-1.2 1.37.17 2.77-.2 3.9-1.08-1.16-.02-2.13-.78-2.46-1.83.38.1.8.07 1.17-.03-1.2-.24-2.1-1.3-2.1-2.58v-.05c.35.2.75.32 1.18.33-.7-.47-1.17-1.28-1.17-2.2 0-.47.13-.92.36-1.3C7.94 8.85 9.88 9.9 12.06 10c-.04-.2-.06-.4-.06-.6 0-1.46 1.18-2.63 2.63-2.63.76 0 1.44.3 1.92.82.6-.12 1.95-.27 1.95-.27-.35.53-.72 1.66-1.24 2.04z"/></svg>
          </div>
        </div>
      </a>

      <!-- Sharingbutton Tumblr -->
      <a class="resp-sharing-button__link" href=<?php echo "https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=" . urlencode($data['name']) . "&caption=" . urlencode($data['name']) . "&content=" . urlencode($data['name']) . "&canonicalUrl=" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])?> target="_blank" rel="noopener" aria-label="">
        <div class="resp-sharing-button resp-sharing-button--tumblr resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
          <svg version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
              <path d="M12,0C5.383,0,0,5.383,0,12s5.383,12,12,12s12-5.383,12-12S18.617,0,12,0z M15.492,17.616C11.401,19.544,9.5,17,9.5,14.031 V9.5h-2V8.142c0.549-0.178,1.236-0.435,1.627-0.768c0.393-0.334,0.707-0.733,0.943-1.2c0.238-0.467,0.401-0.954,0.49-1.675H12.5v3h2 v2h-2v3.719c0,2.468,1.484,2.692,2.992,1.701V17.616z"/>
           </svg>
          </div>
        </div>
      </a>

      <!-- Sharingbutton E-Mail -->
      <a class="resp-sharing-button__link" href=<?php echo "mailto:?subject=" . urlencode($data['name']) . "&body=" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])?> target="_self" rel="noopener" aria-label="">
        <div class="resp-sharing-button resp-sharing-button--email resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm8 16c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h12c1.1 0 2 .9 2 2v8z"/><path d="M17.9 8.18c-.2-.2-.5-.24-.72-.07L12 12.38 6.82 8.1c-.22-.16-.53-.13-.7.08s-.15.53.06.7l3.62 2.97-3.57 2.23c-.23.14-.3.45-.15.7.1.14.25.22.42.22.1 0 .18-.02.27-.08l3.85-2.4 1.06.87c.1.04.2.1.32.1s.23-.06.32-.1l1.06-.9 3.86 2.4c.08.06.17.1.26.1.17 0 .33-.1.42-.25.15-.24.08-.55-.15-.7l-3.57-2.22 3.62-2.96c.2-.2.24-.5.07-.72z"/></svg>
          </div>
        </div>
      </a>

      <!-- Sharingbutton Pinterest -->
      <a class="resp-sharing-button__link" href=<?php echo "https://pinterest.com/pin/create/button/?url=" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?> target="_blank" rel="noopener" aria-label="">
        <div class="resp-sharing-button resp-sharing-button--pinterest resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm1.4 15.56c-1 0-1.94-.53-2.25-1.14l-.65 2.52c-.4 1.45-1.57 2.9-1.66 3-.06.1-.2.07-.22-.04-.02-.2-.32-2 .03-3.5l1.18-5s-.3-.6-.3-1.46c0-1.36.8-2.37 1.78-2.37.85 0 1.25.62 1.25 1.37 0 .85-.53 2.1-.8 3.27-.24.98.48 1.78 1.44 1.78 1.73 0 2.9-2.24 2.9-4.9 0-2-1.35-3.5-3.82-3.5-2.8 0-4.53 2.07-4.53 4.4 0 .5.1.9.25 1.23l-1.5.82c-.36-.64-.54-1.43-.54-2.28 0-2.6 2.2-5.74 6.57-5.74 3.5 0 5.82 2.54 5.82 5.27 0 3.6-2 6.3-4.96 6.3z"/></svg>
          </div>
        </div>
      </a>

				
    </div> <!-- /container -->

  </body>
</html>
