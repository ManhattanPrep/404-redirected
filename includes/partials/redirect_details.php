<?php
  $url = "?page=wbz404_redirected&subpage=wbz404_edit";
  $action = "wbz404editRedirect";
  $link = wp_nonce_url($url, $action);
?>

  <form method="POST" action="<?php echo $link;?>">
  <input type="hidden" name="action" value="editRedirect">
  <input type="hidden" name="id" value="<?php echo $redirect['id'];?>">
  <strong><label for="url"><?php echo wbz404_trans('URL');?> :</label></strong>
  <input id="url" style="width: 200px;" type="text" name="url" value="<?php echo $redirect['url'];?> "> (Required)<br>
  <strong><label for="dest"><?php echo wbz404_trans('Redirect to');?> :</strong>

  <select id="dest" name="dest">
  <?php
    $selected = "";
    if ($redirect['type'] == WBZ404_EXTERNAL) {
      $selected = " selected";
    }
    echo "<option value=\"" . WBZ404_EXTERNAL . "\"" . $selected . ">" . wbz404_trans('External Page') . "</options>";

    $query = "select id from $wpdb->posts where post_status='publish' and post_type='post' order by post_date desc";
    $rows = $wpdb->get_results($query);
    foreach ($rows as $row) {
      $id = $row->id;
      $theTitle = get_the_title($id);
      $thisval = $id . "|" . WBZ404_POST;

      $selected = "";
      if ($redirect['type'] == WBZ404_POST && $redirect['final_dest'] == $id) {
        $selected = " selected";
      }
      echo "<option value=\"" . $thisval . "\"" . $selected . ">" . wbz404_trans('Post') . ": " . $theTitle . "</option>";
    }

    $rows = get_pages();
    foreach ($rows as $row) {
      $id = $row->ID;
      $theTitle = $row->post_title;
      $thisval = $id . "|" . WBZ404_POST;

      $parent = $row->post_parent;
      while ($parent != 0) {
        $query = "select id, post_parent from $wpdb->posts where post_status='publish' and post_type='page' and id = $parent";
        $prow = $wpdb->get_row($query, OBJECT);
        if (! ($prow == NULL)) {
          $theTitle = get_the_title($prow->id) . " &raquo; " . $theTitle;
          $parent = $prow->post_parent;
        } else {
          break;
        }
      }

      $selected = "";
      if ($redirect['type'] == WBZ404_POST && $redirect['final_dest'] == $id) {
        $selected = " selected";
      }
      echo "<option value=\"" . $thisval . "\"" . $selected . ">" . wbz404_trans('Page') . ": " . $theTitle . "</option>\n";
    }

    $cats = get_categories('hierarchical=0');
    foreach ($cats as $cat) {
      $id = $cat->term_id;
      $theTitle = $cat->name;
      $thisval = $id . "|" . WBZ404_CAT;

      $selected = "";
      if ($redirect['type'] == WBZ404_CAT && $redirect['final_dest'] == $id) {
        $selected = " selected";
      }
      echo "<option value=\"" . $thisval . "\"" . $selected . ">" . wbz404_trans('Category') . ": " . $theTitle . "</option>";
    }

    $tags = get_tags('hierarchical=0');
    foreach ($tags as $tag) {
      $id = $tag->term_id;
      $theTitle = $tag->name;
      $thisval = $id . "|" . WBZ404_TAG;

      $selected = "";
      if ($redirect['type'] == WBZ404_TAG && $redirect['final_dest'] == $id) {
        $selected = " selected";
      }
      echo "<option value=\"" . $thisval . "\"" . $selected . ">" . wbz404_trans('Tag') . ": " . $theTitle . "</option>";
    }

  echo "</select><br>";
  $final = "";
  if ($redirect['type'] == WBZ404_EXTERNAL) {
    $final = $redirect['final_dest'];
  }
  echo "<strong><label for=\"external\">" . wbz404_trans('External URL') . ":</label></strong> <input id=\"external\" style=\"width: 200px;\" type=\"text\" name=\"external\" value=\"" . $final . "\"> (" . wbz404_trans('Required if Redirect to is set to External Page') . ")<br>";
  echo "<strong><label for=\"code\">" . wbz404_trans('Redirect Type') . ":</label></strong> <select id=\"code\" name=\"code\">";
    if ($redirect['code'] == "") {
      $codeselected = $options['default_redirect'];
    } else {
      $codeselected = $redirect['code'];
    }
    $codes = array(301,302);
    foreach ($codes as $code) {
      $selected = "";
      if ($code == $codeselected) {
        $selected = " selected";
      }
      if ($code == 301) {
        $title = wbz404_trans('301 Permanent Redirect');
      } else {
        $title = wbz404_trans('302 Temporary Redirect');
      }
      echo "<option value=\"" . $code . "\"" . $selected . ">" . $title . "</option>";
    }
  echo "</select><br>";
  echo "<input type=\"submit\" value=\"" . wbz404_trans('Update Redirect') . "\" class=\"button-secondary\">";
  echo "</form>";
?>
