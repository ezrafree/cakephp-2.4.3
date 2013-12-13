<div class="container marketing">
	<div class="row">
		<div class="span8">
			<div class="page-header">
				<h1>Users <small>All Users</small></h1>
				<a href="<?php echo $this->webroot; ?>users/add" class="newbtn btn btn-success">New User</a>
			</div>
			<form class="form">
				<?php
					foreach($teams AS $team) {
						$team_names[$team['Team']['id']] = $team['Team']['name'];
					}
					$selected = array('4', '5');
					echo $this->Form->input('teams', array(
						'options' => $team_names,
						'selected' => $selected,
						'empty' => true,
						'label' => 'Teams',
						'class' => 'chosen',
						'multiple' => true,
						'div' => array('style' => 'width:100%;margin-bottom:2em;')
					));
				?>
			</form>
			<div class="users">
				<?php foreach ($users as $user): ?>
					<div class="media">
						<a class="pull-left" href="<?php echo $this->webroot; ?>users/view/<?php echo $user['User']['id']; ?>">
							<img class="media-object" src="<?php echo $this->webroot; ?>img/user.png" width="18" height="18" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading"><?php echo $user['User']['username']; ?></h4>
						</div>
					</div>
				<?php endforeach; ?>
				<?php echo $this->Paginator->numbers(array(
					'before' => '<div class="pagination pagination-small pagination-right"><ul>',
					'after' => '</ul></div>',
					'separator' => '',
					'tag' => 'li',
					'currentClass' => 'active',
					'currentTag' => 'a'
				)); ?>
			</div>
		</div>
		<div class="span4">
			<div class="selectprojectgroup">
				<select id="projectgroupfilter" data-placeholder="Choose a Project Group..." class="chosen" style="width:386px;" tabindex="3">
					<option value="">All Groups</option>
					<?php
						foreach($projects AS $project) {
							$id = $project['Project']['id'];
							$projectgroups[$id] = $project['Project']['group'];
						}
						$projectgroups = array_unique($projectgroups);
						foreach($projectgroups AS $key => $group) {
							echo '<option value="' . $key . '">' . $group . '</option>';
						}
					?>
				</select>
			</div>
			<div class="selectproject">
				<select id="projectfilter" data-placeholder="Choose a Project..." class="chosen" style="width:386px;" tabindex="3">
					<option value="">All Projects</option>
					<?php foreach($projects AS $project) { ?>
					<option value="<?php echo $project['Project']['id']; ?>"><?php echo $project['Project']['title']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="search">
				<input type="text" class="input span4 search-input search-query" placeholder="Search">
			</div>
		</div>
	</div>
</div>