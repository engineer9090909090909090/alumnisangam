<?php include_component('home','leftmenu'); ?>
<?php
// auto-generated by sfPropelCrud
// date: 2009/02/10 08:19:22
?>
<table>
<tbody>
<tr>
<th>Id: </th>
<td><?php echo $userbadge->getId() ?></td>
</tr>
<tr>
<th>User: </th>
<td><?php echo $userbadge->getUserId() ?></td>
</tr>
<tr>
<th>Badge: </th>
<td><?php echo $userbadge->getBadgeId() ?></td>
</tr>
<tr>
<th>Badgeflag: </th>
<td><?php echo $userbadge->getBadgeflag() ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo link_to('edit', 'userbadge/edit?id='.$userbadge->getId()) ?>
&nbsp;<?php echo link_to('list', 'userbadge/list') ?>
