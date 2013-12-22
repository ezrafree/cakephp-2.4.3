<!-- app/View/Posts/edit.ctp -->
<?php if ($this->Session->read('Auth.User')) { ?>

	<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('Edit Post'); ?></legend>
		<?php
			echo $this->Form->input('title', array('label' => 'Title', 'size' => '58'));
			echo $this->Form->input('lead', array('label' => 'Introduction', 'class' => 'leadeditor', 'rows' => '4', 'cols' => '62'));
			echo $this->Form->input('body', array('label' => 'Body', 'class' => 'editor', 'rows' => '15', 'cols' => '62'));
			echo $this->Form->checkbox('published', array('value' => 1)) . ' Published';
		?>
	</fieldset>
	<?php
		$options = array(
			'label' => 'Save Post',
			'class' => 'btn btn-primary',
			'div' => array('style' => 'margin-top:1em;', 'class' => 'submit')
		);
		echo $this->Form->end($options);
	?>

<?php } ?>