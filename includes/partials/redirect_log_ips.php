<?php
  $query = "SELECT remote_host, count(*) as hits
            FROM `" . $wpdb->prefix . "wbz404_logs`
            WHERE redirect_id = ".esc_sql($redirect['id'])."
            GROUP BY remote_host
            ORDER BY hits DESC
            LIMIT 500";

  $results = $wpdb->get_results($query, ARRAY_A);
?>

<?php if (count($results) > 0): ?>
  <div class="redirected_half_box">
    <h4>Top Remote Host / IP address hits</h4>
    <table class="widefat fixed" cellspacing="0">
      <thead>
        <tr>
          <th id="ip_hits" class="manage-column column-hits num" scope="col">Hits</th>
          <th id="ip_remote_host" class="manage-column column-ip" scope="col">Remote Host / IP</th>
          <th id="ip_blacklist" class="manage-column column-blacklist" scope="col">Blacklist</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($results as $row){
          echo '<tr><td class="column-hits">'.$row['hits'].'</td><td>'.$row['remote_host'].' </td>';
          echo '<td class="column-blacklist">[<a href="'.wbz404_generate_blacklist_link($row['remote_host'], 'ip').'"><b>x</b></a>]</td>';
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>
  </div>
<?php endif;?>
