<?php
  $url = "?page=wbz404_redirected&action=clear_unassigned_links";
  $action = "wbz404clearUnassigned";
  $link = wp_nonce_url($url, $action);
?>

<form method="POST" action="<?php echo $link;?>">
  <p>
    <input name="action" value="clearUnassigned" type="hidden">
    <input value="Clear unassigned entries from Logs" class="button-secondary" type="submit">
  </p>
</form>