
<div class="forumHeader">
	<h2><?php __d('forum', 'User List'); ?></h2>
</div>

<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'listing'))); ?>

<div class="filterBar">
	<?php echo $this->Form->input('username', array('div' => false, 'label' => __d('forum', 'Search Users (Username)', true) .': ')); ?>
	<?php echo $this->Form->submit(__d('forum', 'Search', true), array('div' => false)); ?>
</div>

<?php echo $this->Form->end(); ?>

<div class="forumWrap">
    <?php echo $this->element('pagination'); ?>
    
    <table class="table" cellspacing="0">
    <tr>
        <th><?php echo $this->Paginator->sort(__d('forum', 'Username', true), 'User.'. $config['userMap']['username']); ?></th>
        <th><?php echo $this->Paginator->sort(__d('forum', 'Joined', true), 'Profile.created'); ?></th>
        <th><?php echo $this->Paginator->sort(__d('forum', 'Last Active', true), 'Profile.lastLogin'); ?></th>
        <th><?php echo $this->Paginator->sort(__d('forum', 'Topics', true), 'Profile.totalTopics'); ?></th>
        <th><?php echo $this->Paginator->sort(__d('forum', 'Posts', true), 'Profile.totalPosts'); ?></th>
    </tr>
    
    <?php if (!empty($users)) {
		$counter = 0;
		
		foreach ($users as $user) { ?>
        
		<tr<?php if ($counter % 2) echo ' class="altRow"'; ?>>
			<td><?php echo $this->Html->link($user['User'][$config['userMap']['username']], array('action' => 'profile', $user['User']['id'])); ?></td>
			<td class="ac"><?php echo $this->Time->nice($user['Profile']['created'], $this->Common->timezone()); ?></td>
			<td class="ac">
				<?php if (!empty($user['Profile']['lastLogin'])) {
					echo $this->Time->relativeTime($user['Profile']['lastLogin'], array('userOffset' => $this->Common->timezone()));
				} else {
					echo '<em>'. __d('forum', 'Never', true) .'</em>';
				} ?>
			</td>
			<td class="ac"><?php echo number_format($user['Profile']['totalTopics']); ?></td>
			<td class="ac"><?php echo number_format($user['Profile']['totalPosts']); ?></td>
		</tr>
		
    	<?php ++$counter; 
		}
	} else { ?>
    
		<tr>
			<td colspan="5" class="empty"><?php __d('forum', 'There are no users signed up on this forum.'); ?></td>
		</tr>
		
    <?php } ?>
    
    </table>

	<?php echo $this->element('pagination'); ?>
</div>	