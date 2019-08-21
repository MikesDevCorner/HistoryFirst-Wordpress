<div class="row table-outer my-4">
  <div class="col-md-12">
      <div class="table">
    <?php $table = get_sub_field('table');

    if (!empty ($table)) {
      echo '<table border="0">';

      if (!empty($table['header'])) {
        echo '<thead>';
        echo '<tr>';
        foreach ($table['header'] as $th) {
          echo '<th>';
          echo $th['c'];
          echo '</th>';
        }
        echo '</tr>';
        echo '</thead>';
      }
      echo '<tbody class="tbl-content">';

      foreach ($table['body'] as $tr) {
        echo '<tr>';
        foreach ($tr as $td) {
          echo '<td>';
          echo $td['c'];
          echo '</td>';
        }
        echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
    } ?>
      </div>
    <?php if(get_sub_field("quelle")) : ?>
      <div class="tbl-caption">
        <?php if (!empty($table['caption'])) : ?>
            <?php echo $table['caption']; ?>
        <?php endif; ?>
      </div>
      <div class="source">
        Quelle: <?php echo str_replace(array('<p>','</p>'),'',get_sub_field("quelle")) ?>
      </div>
    <?php endif; ?>
  </div>
</div>