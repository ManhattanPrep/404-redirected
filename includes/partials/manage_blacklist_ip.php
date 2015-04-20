<?php
  $query = "SELECT * FROM `" . $wpdb->prefix . "wbz404_ignored_IP_addresses` ORDER BY date_added DESC";
  $results = $wpdb->get_results($query, ARRAY_A);
?>
<div class="redirected_half_box">
  <table class="widefat fixed" cellspacing="0">
    <thead>
      <tr>
        <th id="ua_ip_address" class="manage-column" scope="col">IP Address</th>
        <th id="ua_date_added" class="manage-column column-date-added num" scope="col">Date Added</th>
        <th id="ua_blacklist" class="manage-column column-blacklist" scope="col">remove</th>
      </tr>
    </thead>
    <tbody>

    <?php
      foreach ($results as $row){
        echo '<tr><td>'.$row['IP_address'].' </td>';
        echo '<td>'.date('m/d/Y h:i:s A', $row['date_added']).'</td>';
        echo '<td class="column-blacklist">[<a href="';
        echo wbz404_generate_clear_blacklist_link($row['IP_address'], 'ip');
        echo '">x</a>]</td>';
        echo '</tr>';
      }
    ?>
    </tbody>
  </table>
</div>