<div class="row featurette">
	<div class="col-lg-12">
		<div class="panel">
			<div class="panel-body">
				<h2 class="featurette-heading">Search <span class="text-muted">Results</span></h2>
				<?php if ($this->Session->read('Auth.User') && (
					$this->Session->read('Auth.User.role') == "admin" ||
					$this->Session->read('Auth.User.role') == "editor" ||
					$this->Session->read('Auth.User.role') == "author")
				) { ?><p><a href="<?php echo $this->webroot; ?>posts/add/" class="pull-right btn btn-primary btn-sm">Add a Tutorial</a></p><?php } ?>
				<div class="list-group">
					<? if($posts) {
						rsort($posts);
						foreach ($posts as $post): ?>
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
										<span class="pull-left media-object glyphicon glyphicon-<?php if($post['Post']['published']) { ?>link<?php } else { ?>paperclip<?php } ?>"></span>
										<div class="media-body">
											<?php if($post['Post']['lead']) echo strip_tags($post['Post']['lead']) . '<br />'; ?>
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
				    <?php } else { ?>
						<div class="list-group-item">
							<p>No search results matched your query.</p>
						</div>
				    <?php } ?>
				</div>
				<?php echo $this->Paginator->numbers(array(
					'first' => 'First page',
					'before' => '<div class="pagination pagination-small pagination-right"><ul>',
					'after' => '</ul></div>',
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