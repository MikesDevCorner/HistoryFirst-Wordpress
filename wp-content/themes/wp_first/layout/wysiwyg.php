<div class="row">
    <div class="col-md-10 col-xl-9">
        <div class="wysiwyg my-4">
          <?php
          $text = get_sub_field("text");

          $text = str_replace("[fn]","<span class='footnote'>", $text);
          $text = str_replace("[/fn]","</span>", $text);

          $text = str_replace("[info]","<span class='tooltiptext'>", $text);
          $text = str_replace("[/info]","</span>", $text);

          echo $text;

          ?>
        </div>
    </div>
</div>