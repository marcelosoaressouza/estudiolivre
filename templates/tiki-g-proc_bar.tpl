<table cellpadding='0' cellspacing='0'><tr><td>
<div style="height:20px; padding-top:2px; padding-bottom:2px;border:1px solid black; background-color:white; color:black; font-size:10px;">
<table  cellpadding='0' cellspacing='0'>
<tr>
	<td><b>{$proc_info.name}:{$proc_info.version}</b>
	{if $proc_info.isValid eq 'y'}
		<img border='0' src='lib/Galaxia/img/icons/green_dot.gif' alt='{tr}valid{/tr}' title='{tr}valid{/tr}' />	
	{else}
		<img border='0' src='lib/Galaxia/img/icons/red_dot.gif' alt='{tr}invalid{/tr}' title='{tr}invalid{/tr}' />
	{/if}
	</td>
	<td align='right'>
		<table cellpadding='0' cellspacing='2'>
		<tr>
			{if $proc_info.isActive eq 'y'}
			<td><a class="link" href="tiki-g-admin_activities.php?pid={$pid}&amp;deactivate_proc={$pid}"><img border='0' src='lib/Galaxia/img/icons/stop.gif' alt='{tr}stop{/tr}' title='{tr}stop{/tr}' /></a></td>						
			{else}
			{if $proc_info.isValid eq 'y'}
			<td><a class="link" href="tiki-g-admin_activities.php?pid={$pid}&amp;activate_proc={$pid}"><img border='0' src='lib/Galaxia/img/icons/refresh2.gif' alt='{tr}activate{/tr}' title='{tr}activate{/tr}' /></a></td>									
			{/if}
			{/if}
			<td><a class="link" href="tiki-g-admin_activities.php?pid={$pid}"><img border='0' src='lib/Galaxia/img/icons/Activity.gif' alt='{tr}activities{/tr}' title='{tr}activities{/tr}' /></a></td>						
			<td><a class="link" href="tiki-g-admin_shared_source.php?pid={$pid}"><img border='0' src='lib/Galaxia/img/icons/book.gif' alt='{tr}code{/tr}' title='{tr}code{/tr}' /></a></td>		
			<td><a class="link" href="tiki-g-admin_graph.php?pid={$pid}"><img border='0' src='lib/Galaxia/img/icons/mode_tree.gif' alt='{tr}graph{/tr} 'title='{tr}graph{/tr}' /></a></td>		
			<td><a class="link" href="tiki-g-admin_roles.php?pid={$pid}"><img border='0' src='lib/Galaxia/img/icons/myinfo.gif' alt='{tr}roles{/tr}' title='{tr}roles{/tr}' /></a></td>		
			<td><a class="link" href="tiki-g-admin_processes.php?pid={$pid}"><img border='0' src='lib/Galaxia/img/icons/change.gif' alt='{tr}edit{/tr}' title='{tr}edit{/tr}' /></a></td>				
			<td><a class="link" href="tiki-g-save_process.php?pid={$pid}"><img border='0' src='lib/Galaxia/img/icons/export.gif' alt='{tr}export{/tr}' title='{tr}export{/tr}' /></a></td>
		</tr>
		</table>
	</td>	
</tr>
</table>
</div>
</td><td >
<div style="height:20px; padding-top:2px; padding-bottom:2px; border:1px solid black; background-color:white; color:black; font-size:10px;">
<table  cellpadding='0' cellspacing='0'>
<tr>
	<td><a class="link" href="tiki-g-monitor_processes.php?filter_process={$pid}"><img border='0' src='lib/Galaxia/img/icons/Process.gif' alt='{tr}monitor{/tr}' title='{tr}monitor processes{/tr}' /></td>	
	<td><a class="link" href="tiki-g-monitor_activities.php?filter_process={$pid}"><img border='0' src='lib/Galaxia/img/icons/Activity.gif' alt='{tr}monitor{/tr}' title='{tr}monitor activities{/tr}' /></td>	
	<td><a class="link" href="tiki-g-monitor_instances.php?filter_process={$pid}"><img border='0' src='lib/Galaxia/img/icons/Instance.gif' alt='{tr}monitor{/tr}' title='{tr}monitor instances{/tr}' /></td>	
</tr>
</table>
</div>
</td></tr></table>
