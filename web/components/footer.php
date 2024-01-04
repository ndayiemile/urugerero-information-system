</main>
<!-- footer -->
<footer></footer>
</body>
<?php
try {
  foreach ($app->linksAndScripts["foot"] as $url) {
    echo $url;
  }
} catch (Throwable $e) {
  array_push($GLOBALS['debugger'],["message" => $e->getMessage(), "Throwable"=> $e]);
}
?>
<script>
  <?php
  // error output
  if(count($GLOBALS['debugger']) != 0 && $app->debugMode){
      echo "console.error(".json_encode($GLOBALS['debugger']).")";
    }
  ?>
</script>
</html>