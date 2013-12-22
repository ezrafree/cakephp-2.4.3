<!-- app/View/Posts/add.ctp -->
<?php if ($this->Session->read('Auth.User')) { ?>

	<?php echo $this->Form->create('Post', array(
		'inputDefaults' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'class' => 'form-control'
		),
		'class' => 'well')); ?>
	<fieldset>
		<legend><?php echo __('Add a New Post'); ?></legend>
		<?php
			echo $this->Form->input('title', array('label' => 'Post Title', 'size' => '58', 'placeholder' => 'Title'));
			echo $this->Form->input('lead', array('label' => 'Introduction', 'class' => 'leadeditor', 'rows' => '4', 'cols' => '62'));
			echo $this->Form->input('body', array('class' => 'editor', 'rows' => '15', 'cols' => '62'));
			echo $this->Form->checkbox('published', array('checked' => 'checked', 'hiddenField' => false)) . ' Publish Now';
		?>
	</fieldset>

	<?php
		$options = array(
			'label' => 'Add Post',
			'class' => 'btn btn-primary',
			'div' => array('style' => 'margin-top:1em;', 'class' => 'submit')
		);
		echo $this->Form->end($options);
	?>

<?php } ?>