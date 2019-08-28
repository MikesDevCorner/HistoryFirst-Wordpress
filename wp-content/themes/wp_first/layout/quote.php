<div class="row">
    <div class="col-md-10 col-xl-9">
        <blockquote>
          <div class="blockquote__inner">
            <?php the_sub_field("quote"); ?>
          </div>
          <h4>&mdash; <?php echo str_replace(array('<p>','</p>'),'',get_sub_field("author")); ?></h4>
        </blockquote>
    </div>
</div>