<ul class="search_results">
  <?php $current_bm_result_count = 0; ?>
  <?php foreach($bm_json_results->{'response'}->{'resultset'}->{'items'} as $item): ?>
    <!-- Search term matches artist name -->
    <?php if ($item->type == 'artist'): ?>
      <!-- We need to go deeper -->
      <?php foreach ($item->objects as $object): ?>
        <?php $current_bm_result_count++; ?>
        <li>
          <div class="bm_result">
            <a href="<?php echo $object->uri ?>">
              <span class="item_photo" style="background:url('<?php echo $object->{'images'}[0]->thumb_uri ?: 'images/no_image_50px.png' ?>');"></span>
              <span class="result_title"><?php echo $object->title ?: 'Untitled' ?></span>
              <span class="result_subtitle"><?php echo $item->name ?: 'Unknown' ?></span>
            </a>
          </div>
        </li>
      <?php endforeach; ?>
    <!-- Search term matched something in the item's title, description, or tags -->
    <?php else: ?>
      <?php $current_bm_result_count++; ?>
      <li>
        <div class="bm_result">
          <a href="<?php echo $item->uri ?>">
            <span class="item_photo" style="background:url('<?php echo $item->{'images'}->{'0'}->thumb_uri ?: 'images/no_image_50px.png' ?>');"></span>
            <span class="result_title"><?php echo $item->title ?: 'Untitled' ?></span>
            <span class="result_subtitle"><?php echo $item->{'artists'}[0]->name ?: 'Unknown' ?></span>
          </a>
        </div>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>