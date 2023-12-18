</main>
<!-- footer -->
<footer></footer>
</body>
<?php
try {
  foreach ($app->linksAndScripts["foot"] as $url) {
    echo $url;
  }
} catch (Exception $e) {
  echo 'Exception:' . $e->getMessage();
}
?>
<script>
  <?php
  // server internal errors
  if(count($app->errorsMessages) != 0 && $app->debugMode == true){
      echo "console.error(".json_encode($app->errorsMessages).")";
    }
  ?>
</script>
</html>