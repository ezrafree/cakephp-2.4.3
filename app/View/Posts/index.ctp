<?php foreach ($posts as $post): ?>
	<p>
		<a href="<?php echo $this->webroot; ?>posts/view/<?php echo $post['Post']['slug']; ?>" class="list-group-item">
		<?php if($post['Post']['lead']) echo strip_tags($post['Post']['lead']); ?>
		<?php if ($this->Session->read('Auth.User') && (
			$this->Session->read('Auth.User.role') == "admin" ||
			$this->Session->read('Auth.User.role') == "editor" ||
			$this->Session->read('Auth.User.role') == "author")
		) { ?><span class="posticons pull-right"><i class="icon-pencil"></i> <i class="icon-trash" data-toggle="modal" data-target="#deleteModal"></i></span><?php } ?>
		</a>
		<br />
		<small>Posted on <?php
			if($post['Post']['publish_date'] == "0000-00-00 00:00:00" || !$post['Post']['publish_date']) {
				$date = $post['Post']['created'];
			} else {
				$date = $post['Post']['publish_date'];
			}
			echo date("l, F jS, Y \\a\\t g:i a", strtotime($date));
		?></small>
	</p>
<?php endforeach; ?>

<?php echo $this->Paginator->numbers(array(
	'first' => '&laquo;',
	'before' => '<ul class="pagination pagination-sm">',
	'after' => '</ul>',
	'separator' => '',
	'tag' => 'li',
	'currentClass' => 'active',
	'currentTag' => 'a'
)); ?>