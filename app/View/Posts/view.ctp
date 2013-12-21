<!-- app/View/Posts/view.ctp -->
<?php if(isset($post['Post'])) $title_for_layout =  $post['Post']['title'] . " - webSIGHTdesigns"; ?>
<div class="row featurette">
	<div class="col-lg-12">
		<div class="panel">
			<div class="panel-body">
				<?php if(isset($post['Post'])): ?>
					<h2 class="featurette-heading"><?php echo $post['Post']['title']; ?></h2>
					<p><small>Posted on <?php
						if($post['Post']['publish_date'] == "0000-00-00 00:00:00" || !$post['Post']['publish_date']) {
							$date = $post['Post']['created'];
						} else {
							$date = $post['Post']['publish_date'];
						}
						echo date("l, F jS, Y \\a\\t g:i a", strtotime($date));
					?></small></p>
					<?php if ($this->Session->read('Auth.User') && (
						$this->Session->read('Auth.User.role') == "admin" ||
						$this->Session->read('Auth.User.role') == "editor" ||
						$this->Session->read('Auth.User.role') == "author")
					) { ?>
						<p>
							<a href="<?php echo $this->webroot; ?>posts/add/" class="btn btn-primary btn-sm">Add Tutorial</a>
							<a href="<?php echo $this->webroot; ?>posts/edit/<?php echo $post['Post']['slug']; ?>" class="btn btn-warning btn-sm">Edit</a>
						</p>
					<?php } ?>
					<?php if(isset($post['Post']['lead'])) echo $post['Post']['lead']; ?>
					<?php if(isset($post['Post']['body'])) echo $post['Post']['body']; ?>
					<p class="repostlinks">
						<strong>Share This:</strong>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo Router::url($this->here, true); ?>" class="external-img"><img src="<?php echo $this->webroot; ?>img/icons/socialmedia/facebook.png" title="Facebook"></a>
						<a href="https://plus.google.com/share?url=<?php echo Router::url($this->here, true); ?>" class="external-img"><img src="<?php echo $this->webroot; ?>img/icons/socialmedia/googleplus.png" title="Google+"></a>
						<a href="https://twitter.com/intent/tweet?text=<?php echo str_replace(" ", "+", urlencode($post['Post']['title'])); ?>&amp;url=<?php echo urlencode(Router::url($this->here, true)); ?>" class="external-img"><img src="<?php echo $this->webroot; ?>img/icons/socialmedia/twitter.png" title="Twitter"></a>
						<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(Router::url($this->here, true)); ?>&amp;title=<?php echo urlencode($post['Post']['title']); ?>&amp;summary=<?php echo urlencode(str_replace('<p class="lead">', "", str_replace("</p>", "", $post['Post']['lead']))); ?>" class="external-img"><img src="<?php echo $this->webroot; ?>img/icons/socialmedia/linkedin.png" title="LinkedIn"></a>
						<a href="http://reddit.com/submit?url=<?php echo urlencode(Router::url($this->here, true)); ?>&amp;title=<?php echo urlencode($post['Post']['title']); ?>" class="external-img"><img src="<?php echo $this->webroot; ?>img/icons/socialmedia/reddit.png" title="Reddit"></a>
						<a href="http://www.digg.com/submit?url=<?php echo urlencode(Router::url($this->here, true)); ?>&amp;title=<?php echo urlencode($post['Post']['title']); ?>" class="external-img"><img src="<?php echo $this->webroot; ?>img/icons/socialmedia/digg.png" title="Digg"></a>
						<a href="http://www.tumblr.com/share/link?url=<?php echo urlencode(Router::url($this->here, true)); ?>&amp;name=<?php echo urlencode($post['Post']['title']); ?>&amp;description=<?php echo urlencode(str_replace('<p class="lead">', "", str_replace("</p>", "", $post['Post']['lead']))); ?>" class="external-img"><img src="<?php echo $this->webroot; ?>img/icons/socialmedia/tumblr.png" title="Tumblr"></a>
						<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(Router::url($this->here, true)); ?>&amp;description=<?php echo urlencode($post['Post']['title']); ?>&amp;media=<?php echo urlencode('http://www.websightdesigns.com/img/ico/apple-touch-icon-114x114-precomposed.png'); ?>" class="external-img"><img src="<?php echo $this->webroot; ?>img/icons/socialmedia/pinterest.png" title="Pinterest"></a>
						<a href="mailto:?Subject=<?php echo str_replace("+", " ", urlencode($post['Post']['title'])); ?>&amp;Body=<?php echo urlencode(Router::url($this->here, true)); ?>"><img src="<?php echo $this->webroot; ?>img/icons/socialmedia/email.png" target="_blank" title="E-mail"></a>
					</p>
				<?php else: ?>
					<h2 class="featurette-heading">Page Not Found</h2>
					<p>Sorry we could not find that page.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php echo $this->element('Common/triptych'); ?>

<?php echo $this->element('Common/bloglinks'); ?>