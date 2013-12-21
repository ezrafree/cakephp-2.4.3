<!-- app/View/Posts/add.ctp -->
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
					<?php echo $this->Form->create('Post', array(
						'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
						),
						'class' => 'well')); ?>
						<fieldset>
							<legend><?php echo __('Add a New Tutorial'); ?></legend>
							<?php
								echo $this->Form->input('title', array('label' => 'Post Title', 'size' => '58', 'placeholder' => 'Title'));
								echo $this->Form->input('lead', array('label' => 'Introduction', 'class' => 'leadeditor', 'rows' => '4', 'cols' => '62'));
								echo $this->Form->input('body', array('class' => 'editor', 'rows' => '15', 'cols' => '62'));
								echo $this->Form->checkbox('published', array('checked' => 'checked', 'hiddenField' => false)) . ' Publish Now';
							?>
						</fieldset>
					<?php
						$options = array(
							'label' => 'Add Tutorial',
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