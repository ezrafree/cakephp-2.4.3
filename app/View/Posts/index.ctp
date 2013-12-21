<div class="row featurette">
	<div class="col-lg-12">
		<div class="panel">
			<div class="panel-body">
				<h2 class="featurette-heading">Web Design <span class="text-muted">Tutorials</span>
					<?php if ($this->Session->read('Auth.User') && (
						$this->Session->read('Auth.User.role') == "admin" ||
						$this->Session->read('Auth.User.role') == "editor" ||
						$this->Session->read('Auth.User.role') == "author")
					) { ?>
					<form method="post" action="" style="display:inline;">
						<span id="postfiltertext"><small></small></span>
						<select name="postfilter" id="postfilter">
							<option value=""<?php if(!$this->request->data('postfilter') || $this->request->data('postfilter') == "") { ?> selected="selected"<?php } ?>>View All</option>
							<option value="published"<?php if($this->request->data('postfilter') == "published") { ?> selected="selected"<?php } ?>>Published</option>
							<option value="drafts"<?php if($this->request->data('postfilter') == "drafts") { ?> selected="selected"<?php } ?>>Drafts</option>
						</select>
					</form>
					<span class="pull-right"><a href="<?php echo $this->webroot; ?>posts/add/" class="btn btn-primary btn-sm">Add Tutorial</a></span>
					<?php } ?>
				</h2>
				<div class="list-group">
				    <?php foreach ($posts as $post): ?>
						<a href="<?php echo $this->webroot; ?>posts/view/<?php echo $post['Post']['slug']; ?>" class="list-group-item">
							<h4 class="list-group-item-heading">
								<?php
									if(!$post['Post']['published']) echo '<em>';
									echo $post['Post']['title'];
									if(!$post['Post']['published']) echo '</em>';
								?>
							</h4>
							<div class="list-group-item-text">
								<div class="media">
									<span class="pull-left media-object glyphicon glyphicon-<?php if($post['Post']['published']) { ?>link<?php } else { ?>pencil<?php } ?>"></span>
									<div class="media-body">
										<?php if($post['Post']['lead']) echo strip_tags($post['Post']['lead']); ?>
										<?php if ($this->Session->read('Auth.User') && (
											$this->Session->read('Auth.User.role') == "admin" ||
											$this->Session->read('Auth.User.role') == "editor" ||
											$this->Session->read('Auth.User.role') == "author")
										) { ?><span class="posticons pull-right"><i class="icon-pencil"></i> <i class="icon-trash" data-toggle="modal" data-target="#deleteModal"></i></span><?php } ?>
										<br />
										<small>Posted on <?php
											if($post['Post']['publish_date'] == "0000-00-00 00:00:00" || !$post['Post']['publish_date']) {
												$date = $post['Post']['created'];
											} else {
												$date = $post['Post']['publish_date'];
											}
											echo date("l, F jS, Y \\a\\t g:i a", strtotime($date));
										?></small>
									</div>
								</div>
							</div>
						</a>
				    <?php endforeach; ?>
				</div>
				<?php echo $this->Paginator->numbers(array(
					'first' => '&laquo;',
					'before' => '<ul class="pagination pagination-sm">',
					'after' => '</ul>',
					'separator' => '',
					'tag' => 'li',
					'currentClass' => 'active',
					'currentTag' => 'a'
				)); ?>
			</div>
		</div>
	</div>
</div>

<?php echo $this->element('Common/triptych'); ?>

<?php echo $this->element('Common/bloglinks'); ?>

<div id="deleteModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Post</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you would like to delete this post?</p>
        <p>This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="postid" value="">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="deleteconfirm" type="button" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>