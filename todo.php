<?php
  /* Template Name: Todo */

  get_header(); ?>

  <section class="todo">
    <div class="wrapper inner-wrapper">
      <form action="#FIXME" class="todo-form" method="post">
        <div class="form-group">
          <input type="text" name="task" class="form-content" placeholder="Task Name" />
        </div>
        <div class="form-group save-button">
          <input type="submit" name="save_task" class="submit-button" value="Save" />
        </div>
      </form>
      <ul class="todo-task"></ul>
    </div>
  </section>

<?php get_footer(); ?>