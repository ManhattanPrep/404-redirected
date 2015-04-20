<?php
  $query = "SELECT user_agent, count(*) as hits
            FROM `" . $wpdb->prefix . "wbz404_logs`
            WHERE redirect_id = ".esc_sql($redirect['id'])."
            GROUP BY user_agent
            ORDER BY hits DESC
            LIMIT 500";

  $results = $wpdb->get_results($query, ARRAY_A);
?>

<?php if (count($results) > 0): ?>
  <div class="redirected_half_box">
    <h4>Top User Agent hits</h4>
    <table class="widefat fixed" cellspacing="0">
      <thead>
        <tr>
          <th id="ua_hits" class="manage-column column-hits num" scope="col">Hits</th>
          <th id="ua_user_agent" class="manage-column column-user_agent" scope="col">User Agent</th>
          <th id="ua_blacklist" class="manage-column column-blacklist" scope="col">Blacklist</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($results as $row){
          if($row['user_agent'] == ''){
            $row['user_agent'] = '[NO USER AGENT]';
          }
          echo '<tr><td class="column-hits">'.$row['hits'].'</td><td>'.$row['user_agent'].' </td>';
          echo '<td class="column-blacklist">[<a href="';
          echo wbz404_generate_blacklist_link($row['user_agent'], 'user_agent');
          echo '">x</a>]</td>';
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>
  </div>
<?php endif;?>
