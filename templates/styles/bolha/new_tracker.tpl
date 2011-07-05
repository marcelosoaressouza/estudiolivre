{css}
<div id="JsInsert" style="{if count($err_mandatory) == 0}display:none{/if};">
{***  Display warnings about incorrect values and missing mandatory fields ***}
	{if count($err_mandatory) > 0}
		<h3 id="JsWarn">
			{tr}Following mandatory fields are missing{/tr}:
			<br/>
			<ul>
				{section name=ix loop=$err_mandatory}
					<li>{$err_mandatory[ix].name}</li>
				{/section}
			</ul>
		</h3>
	{/if}
{***}
	
	<div id="bugForm">
		<form enctype="multipart/form-data" action="tiki-view_tracker.php" method="post">
			<input type="hidden" name="trackerId" value="{$trackerId|escape}" />
			<h2>{tr}Novo bug{/tr}</h2>
				{if $tracker_info.showStatus eq 'y' and $tracker_info.showStatusAdminOnly ne 'y' or $tiki_p_admin_trackers eq 'y'}
					{tr}Status{/tr}
					<select name="status">
						{foreach key=st item=stdata from=$status_types}
							<option value="{$st}"{if $tracker_info.newItemStatus eq $st} selected="selected"{/if} 
							style="background-image:url('{$stdata.image}');background-repeat:no-repeat;padding-left:17px;">{$stdata.label}</option>
						{/foreach}
					</select>
				{/if}
				{section name=ix loop=$fields}
					<h4>
					{assign var=fid value=$fields[ix].fieldId}
					{if $fields[ix].isHidden eq 'n' or $tiki_p_admin_trackers eq 'y'}
						{if $fields[ix].type ne 'x' and $fields[ix].type ne 'l'}
							{if $fields[ix].type eq 'h'}
								<h2>{$fields[ix].name}</h2>
							{else}
								{$fields[ix].name}
								{if ($fields[ix].type eq 'c' or $fields[ix].type eq 't' or $fields[ix].type eq 'n') and $fields[ix].options_array[0] eq '1'}
									{if $fields[ix].isMandatory eq 'y'}
										 *
									{/if}
								{elseif $stick eq 'y'}
									{if $fields[ix].isMandatory eq 'y'}
										 *
									{/if}
								{else}
									{if $fields[ix].isMandatory eq 'y'} *{/if}
									{if $fields[ix].type eq 'a' and $fields[ix].options_array[0] eq 1}
										{include file=tiki-edit_help_tool.tpl qtnum=$fid area_name=$fields[ix].ins_id}	
									{/if}
								{/if}
							{/if}
							{* -------------------- system -------------------- *}
							{if $fields[ix].type eq 's' and $fields[ix].name eq "Rating" and $tiki_p_tracker_vote_ratings eq 'y'}
								{section name=i loop=$fields[ix].options_array}
									<input name="{$fields[ix].ins_id}" type="radio" value="{$fields[ix].options_array[i]|escape}" />{$fields[ix].options_array[i]}
								{/section}
							{/if}
							
							{* -------------------- user selector -------------------- *}
							{if $fields[ix].type eq 'u'}
								{if !$fields[ix].options or ($fields[ix].options eq '1' and $tiki_p_admin_trackers eq 'y')}
									<select name="{$fields[ix].ins_id}">
										<option value="">{tr}None{/tr}</option>
										{foreach key=id item=one from=$users}
											{if $fields[ix].value}
												<option value="{$one|escape}"{if $one eq $fields[ix].value} selected="selected"{/if}>{$one}</option>
											{elseif $user}
												<option value="{$one|escape}"{if $one eq $user} selected="selected"{/if}>{$one}</option>
											{else}
												<option value="{$one|escape}">{$one}</option>
											{/if}
										{/foreach}
									</select>
								{elseif $fields[ix].options eq 1 and $user}
									{$user}
								{/if}		
							{* -------------------- group selector -------------------- *}
							{elseif $fields[ix].type eq 'g'}
								{if !$fields[ix].options or ($fields[ix].options eq '1' and $tiki_p_admin_trackers eq 'y')}
									<select name="{$fields[ix].ins_id}">
										<option value="">{tr}None{/tr}</option>
										{section name=ux loop=$groups}
											<option value="{$groups[ux]|escape}" {if $input_err and $fields[ix].value eq $groups[ux]} selected="selected"{/if}>{$groups[ux]}</option>
										{/section}
									</select>
								{elseif $fields[ix].options eq 1 and $group}
									{$group}
								{/if}
							{* -------------------- category -------------------- *}
							{elseif $fields[ix].type eq 'e'}
								{assign var=fca value=$fields[ix].options}
										{cycle name=2_$fca values=",</tr><tr>" advance=false print=false}
										{foreach key=ku item=iu from=$fields[ix].categories}
											{assign var=fcat value=$iu.categId }
											<td width="50%" nowrap="nowrap"><input type="checkbox" name="ins_cat_{$fields[ix].fieldId}[]" value="{$iu.categId}" id="cat{$iu.categId}" {if $fields[ix].cat.$fcat eq 'y'}checked="checked"{/if}/><label for="cat{$i.categId}">{$iu.name}</label></td>{cycle name=2_$fca}
										{/foreach}
							{* -------------------- image -------------------- *}
							{elseif $fields[ix].type eq 'i'}
								<input type="file" name="{$fields[ix].ins_id}" {if $input_err}value="{$fields[ix].value}"{/if}/>
							{* -------------------- text field / email -------------------- *}
							{elseif $fields[ix].type eq 't' || $fields[ix].type eq 'm'}
								{if $fields[ix].options_array[2]}<span class="formunit">{$fields[ix].options_array[2]}&nbsp;</span>{/if}
								<input type="text" name="{$fields[ix].ins_id}" {if $fields[ix].options_array[1]}size="{$fields[ix].options_array[1]}" maxlength="{$fields[ix].options_array[1]}"{/if} value="{if $input_err}{$fields[ix].value}{else}{$defaultvalues.$fid|escape}{/if}" />
								{if $fields[ix].options_array[3]}<span class="formunit">&nbsp;{$fields[ix].options_array[3]}</span>{/if}
							{* -------------------- numeric field -------------------- *}
							{elseif $fields[ix].type eq 'n'}
								{if $fields[ix].options_array[2]}<span class="formunit">{$fields[ix].options_array[2]}&nbsp;</span>{/if}
								<input type="text" name="{$fields[ix].ins_id}" {if $fields[ix].options_array[1]}size="{$fields[ix].options_array[1]}" maxlength="{$fields[ix].options_array[1]}"{/if} value="{if $input_err}{$fields[ix].value}{else}{$defaultvalues.$fid|escape}{/if}" />
								{if $fields[ix].options_array[3]}<span class="formunit">&nbsp;{$fields[ix].options_array[3]}</span>{/if}
							{* -------------------- textarea -------------------- *}
							{elseif $fields[ix].type eq 'a'}
								<br/>
								<textarea id="{$fields[ix].ins_id}" name="{$fields[ix].ins_id}" cols="{if $fields[ix].options_array[1] gt 1}{$fields[ix].options_array[1]}{else}50{/if}" 
								rows="{if $fields[ix].options_array[2] gt 1}{$fields[ix].options_array[2]}{else}4{/if}">{if $input_err}{$fields[ix].value}{else}{$defaultvalues.$fid|escape}{/if}</textarea>
							{* -------------------- date and time -------------------- *}
							{elseif $fields[ix].type eq 'f'}
								{html_select_date prefix=$fields[ix].ins_id time=$fields[ix].value start_year="-4" end_year="+4"} {tr}at{/tr} {html_select_time prefix=$fields[ix].ins_id time=$fields[ix].value display_seconds=false}
							{* -------------------- drop down -------------------- *}
							{elseif $fields[ix].type eq 'd'}
								<select name="{$fields[ix].ins_id}">
									{if $fields[ix].isMandatory ne 'y'}<option value="" />{/if}
									{section name=jx loop=$fields[ix].options_array}
										<option value="{$fields[ix].options_array[jx]|escape}" {if $input_err}{if $fields[ix].value eq $fields[ix].options_array[jx]}selected="selected"{/if}{elseif $defaultvalues.$fid eq $fields[ix].options_array[jx]}selected="selected"{/if}>{$fields[ix].options_array[jx]}</option>
									{/section}
								</select>
							{* -------------------- checkbox -------------------- *}
							{elseif $fields[ix].type eq 'c'}
								<input type="checkbox" name="{$fields[ix].ins_id}" {if $input_err}{if $fields[ix].value eq 'y'}checked="checked"{/if}{elseif $defaultvalues.$fid eq 'y'}checked="checked"{/if}/>
							{* -------------------- jscalendar ------------------- *}
							{elseif $fields[ix].type eq 'j'}
								<input type="hidden" name="ins_{$fields[ix].ins_id}" value="" id="{$fields[ix].ins_id}" />
								<span id="disp_{$fields[ix].ins_id}" class="daterow">{$fields[ix].value|default:$smarty.now|tiki_long_date}</span>
								<script type="text/javascript">
								{literal}Calendar.setup( { {/literal}
								date        : "{$fields[ix].value|default:$now|date_format:"%B %e, %Y %H:%M"}",      // initial date
								inputField  : "{$fields[ix].ins_id}",      // ID of the input field
								ifFormat    : "%s",    // the date format
								displayArea : "disp_{$fields[ix].ins_id}",       // ID of the span where the date is to be shown
								daFormat    : "{$tiki_long_date}",  // format of the displayed date
								showsTime   : true,
								singleClick : true,
								align       : "bR"
								{literal} } );{/literal}
								</script>
							{* -------------------- item link -------------------- *}
							{elseif $fields[ix].type eq 'r'}
								<select name="{$fields[ix].ins_id}">
									{if $fields[ix].isMandatory ne 'y'}<option value="" />{/if}
									{foreach key=id item=label from=$fields[ix].list}
										<option value="{$label|escape}" {if $input_err}{if $fields[ix].value eq $label}selected="selected"{/if}{elseif $defaultvalue eq $label}selected="selected"{/if}>{$label}</option>
									{/foreach}
								</select>
							{* -------------------- country selector -------------------- *}
							{elseif $fields[ix].type eq 'y'}
								<select name="{$fields[ix].ins_id}">
									{sortlinks}
										{foreach item=flag from=$fields[ix].flags}
											<option value="{$flag|escape}" {if $input_err}{if $fields[ix].value eq $flag}selected="selected"{/if}{elseif $flag eq $fields[ix].defaultvalue}selected="selected"{/if}
											style="background-image:url('img/flags/{$flag}.gif');background-repeat:no-repeat;padding-left:25px;padding-bottom:3px;">{tr}{$flag}{/tr}</option>
										{/foreach}
									{/sortlinks}
								</select>
							
							{/if}
							{if (($fields[ix].type eq 'c' or $fields[ix].type eq 't' or $fields[ix].type eq 'n') and $fields[ix].options_array[0]) eq '1' and $stick ne 'y'}
								{assign var=stick value="y"}
							{else}
								{assign var=stick value="n"}
							{/if}
						{/if}
					{/if}
					</h4>
				{/section}
				<h4 id="save">
					<input type="submit" name="save" value="{tr}save{/tr}" />
					<input type="button" value="{tr}cancel{/tr}" onclick="flip('JsInsert')" />
				</h4>
		</form>
		<br />
		<em>{tr}fields marked with a * are mandatory{/tr}</em>
	</div>
</div>