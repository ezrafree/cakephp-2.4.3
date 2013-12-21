<!-- app/View/Posts/edit.ctp -->
<?php if ($this->Session->read('Auth.User') && (
	$this->Session->read('Auth.User.role') == "admin" ||
	$this->Session->read('Auth.User.role') == "editor" ||
	$this->Session->read('Auth.User.role') == "author")
) { ?>

	<div class="row featurette">
		<div class="col-lg-12">
			<div class="panel">
				<div class="panel-body">
					<div class="posts form">
					<?php echo $this->Form->create('Post'); ?>
						<fieldset>
							<legend><?php echo __('Edit Tutorial'); ?></legend>
							<?php
								echo $this->Form->input('title', array('label' => 'Title', 'size' => '58'));
								echo $this->Form->input('lead', array('label' => 'Introduction', 'class' => 'leadeditor', 'rows' => '4', 'cols' => '62'));
								echo $this->Form->input('body', array('label' => 'Body', 'class' => 'editor', 'rows' => '15', 'cols' => '62'));
								// echo $this->Form->checkbox('published', array('hiddenField' => false)) . ' Published';
								echo $this->Form->checkbox('published', array('value' => 1)) . ' Published';
							?>
						</fieldset>
						<?php
							$options = array(
								'label' => 'Save Tutorial',
								'class' => 'btn btn-primary',
								'div' => array('style' => 'margin-top:1em;', 'class' => 'submit')
							);
							echo $this->Form->end($options);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php echo $this->element('Common/triptych'); ?>

	<?php echo $this->element('Common/bloglinks'); ?>

<?php } ?>