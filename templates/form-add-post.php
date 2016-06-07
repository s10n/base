<div class="add-post">
  <h1>새 항목 추가</h1>
  <form action method="POST" role="form">
    <div class="form-inline">
      <div class="form-group">
        <label class="sr-only" for="selectCategory">카테고리</label>
        <select class="form-control input-sm" name="post[category_id]" id="selectCategory" required>
          <option value="">카테고리</option>
          <?php foreach( get_terms( 'category' ) as $category ) : ?>
            <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label class="sr-only" for="selectTag">태그</label>
        <select class="form-control input-sm" name="post[tags_input]" id="selectTag" required>
          <option value="">태그</option>
          <?php foreach( get_terms( 'post_tag' ) as $tag ) : ?>
            <option value="<?php echo $tag->name; ?>"><?php echo $tag->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div><!-- .form-inline -->
    <div class="form-group">
      <label class="sr-only" for="inputTitle">제목</label>
      <input type="text" class="form-control input-sm" name="post[title]" id="inputTitle" placeholder="제목" required>
    </div>
    <div class="form-group">
      <label class="sr-only" for="inputUrl">URL</label>
      <input type="url" class="form-control input-sm" name="post[url]" id="inputUrl" placeholder="URL" required>
    </div>
    <div class="form-group form-group-block">
      <label class="sr-only" for="inputExcerpt">요약</label>
      <textarea class="form-control input-sm" name="post[excerpt]" id="inputExcerpt" placeholder="요약" rows="2"></textarea>
    </div>
    <?php wp_nonce_field( 'add-post_'.get_current_user_id(), '_wpnonce' ); ?>
    <?php if ( ! empty( $error ) ) echo '<p class="help-block"><i class="fa fa-fw fa-warning"></i> 오류</p>'; ?>
    <button type="submit" class="btn btn-primary btn-block">제출</button>
  </form>
</div>
