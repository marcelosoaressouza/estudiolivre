{css only=list,new_tracker,comment_post.css,el-user_msg,comment_item}
<div id="tracker">
	<h1>
		<a class="pagetitle" href="tiki-view_tracker.php?trackerId={$trackerId}">
			{$tracker_info.name}
		</a>
	</h1>

	<h5>
		{* ------- return/next/previous tab --- *}
			{if !$prevmsg}
				<a href="tiki-view_tracker_item.php?trackerId={$trackerId}&amp;itemId={$itemId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}{foreach key=urlkey item=urlval from=$urlquery}&amp;{$urlkey}={$urlval|escape:"url"}{/foreach}&amp;move=prev">
					bug anterior</a>
				{if !$nextmsg}
					&nbsp;|&nbsp;
				{/if}
			{/if}
	
			{if !$nextmsg}
				<a href="tiki-view_tracker_item.php?trackerId={$trackerId}&amp;itemId={$itemId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}{foreach key=urlkey item=urlval from=$urlquery}&amp;{$urlkey}={$urlval|escape:"url"}{/foreach}&amp;move=next">
					próximo bug</a>
			{/if}
			<br/>
			<a href="javascript:flip('JsEdit')">editar bug</a>
	</h5>

	<div id="JsEdit" style="{if (count($err_mandatory) == 0 && count($err_value) == 0)}display:none{/if};">
		{*  Display warnings about incorrect values and missing mandatory fields *}
		{if (count($err_mandatory) > 0 || count($err_value) > 0)}
			<h3 id="JsWarn">
		{/if}
		{if count($err_mandatory) > 0}
				{tr}Following mandatory fields are missing{/tr}:
				<br/>
				<ul>
					{section name=ix loop=$err_mandatory}
						<li>{$err_mandatory[ix].name}</li>
					{/section}
				</ul>
		{/if}
		{if count($err_value) > 0}
				{tr}Following fields are incorrect{/tr}:
				<br/>
				<ul>
					{section name=ix loop=$err_value}
						<li>{$err_value[ix].name}</li>
					{/section}
				</ul>
		{/if}
		{if count($err_mandatory) > 0 || count($err_value) > 0}
			</h3>
		{/if}
		
		{* --------------------------------------------------------------- tab with edit --- *}
		{if $tiki_p_modify_tracker_items eq 'y'}
			<div id="bugForm">
				<h2>{tr}Editar bug{/tr}</h2>
				<form enctype="multipart/form-data" action="tiki-view_tracker_item.php" method="post">
					{if $special}
						<input type="hidden" name="view" value="{$special}" />
					{else}
						<input type="hidden" name="trackerId" value="{$trackerId|escape}" />
						<input type="hidden" name="itemId" value="{$itemId|escape}" />
					{/if}
					{if $from}<input type="hidden" name="from" value="{$from}" />{/if}
					{section name=ix loop=$fields}
						{if $fields[ix].value}
							<input type="hidden" name="{$fields[ix].id|escape}" value="{$fields[ix].value|escape}" />
						{/if}
					{/section}
					{if $tracker_info.showStatus eq 'y' or $tiki_p_admin_trackers eq 'y'}
						<h4>
						{tr}Status{/tr}
						<select name="edstatus">
							{foreach key=st item=stdata from=$status_types}
								<option value="{$st}"{if $item_info.status eq $st} selected="selected"{/if}
								style="background-image:url('{$stdata.image}');background-repeat:no-repeat;padding-left:17px;">{$stdata.label}</option>
							{/foreach}
						</select>
						</h4>
					{/if}
					
					{foreach from=$ins_fields key=ix item=cur_field}
						<h4>
						{if $cur_field.isHidden eq 'n' or $tiki_p_admin_trackers eq 'y'}		
							{if $cur_field.type eq 's' and $cur_field.name eq "Rating" and ($tiki_p_tracker_view_ratings eq 'y' || $tiki_p_tracker_vote_ratings eq 'y')}
								{$cur_field.name}
								{if $tiki_p_tracker_view_ratings eq 'y' and $tiki_p_tracker_vote_ratings neq 'y'}
										{$cur_field.value}
								{elseif $tiki_p_tracker_vote_ratings eq 'y'}
										{section name=i loop=$cur_field.options_array}
											{if $cur_field.options_array[i] eq $my_rate}
												<input name="newItemRate" checked="checked" type="radio" value="{$cur_field.options_array[i]|escape}" />{$cur_field.options_array[i]}</option>
											{else}
												<input name="newItemRate" type="radio" value="{$cur_field.options_array[i]|escape}" />{$cur_field.options_array[i]}</option>
											{/if}
										{/section}
								{/if}
							{/if}
							{if $cur_field.type ne 'x' and $cur_field.type ne 's'}
								{if $cur_field.type eq 'h'}		
									<h2>{$cur_field.name}</h2>
								{else}
									{if ($cur_field.type eq 'c' or $$cur_field.type eq 't' or $$cur_field.type eq 'n') and $$cur_field.options_array[0] eq '1'}
										{$cur_field.name}
										{if $cur_field.isMandatory eq 'y'} *{/if}
									{elseif $stick eq 'y'}
										{$cur_field.name}
										{if $cur_field.isMandatory eq 'y'} *{/if}
									{else}
										{$cur_field.name}
										{if $cur_field.isMandatory eq 'y'} *{/if}
										{if $cur_field.type eq 'a' and $cur_field.options_array[0] eq 1}
											<br />
											{include file=tiki-edit_help_tool.tpl qtnum=$cur_field.id area_name="area_"|cat:$cur_field.id}
										{elseif ($cur_field.type eq 'l' and $tiki_p_create_tracker_items eq 'y')}
											<br />
											<a href="tiki-view_tracker.php?trackerId={$cur_field.options_array[0]}&amp;vals%5B{$cur_field.options_array[1]}%5D=
											{section name=ox loop=$ins_fields}
											{if $ins_fields[ox].fieldId eq $cur_field.options_array[2]}
											{$ins_fields[ox].value}
											{/if}
											{/section}
											">{tr}Insert new item{/tr}<br />
										{/if}
									{/if}
								{/if}
								{if $cur_field.type eq 'u'}
									{if !$cur_field.options or $tiki_p_admin_trackers eq 'y'}
									<select name="ins_{$cur_field.id}">
										<option value="">{tr}None{/tr}</option>
										{foreach key=id item=one from=$users}
											<option value="{$one|escape}" {if $cur_field.value}{if $cur_field.value eq $one}selected="selected"{/if}{/if}>{$one}</option>
										{/foreach}
									</select>
									{elseif $cur_field.options}
										<a href="tiki-user_information.php?user={$cur_field.value|escape:"url"}" class="link">
											{$cur_field.value}
										</a>
									{/if}	
								{elseif $cur_field.type eq 'g'}
									{if !$cur_field.options or $tiki_p_admin_trackers eq 'y'}
										<select name="ins_{$cur_field.id}">
											<option value="">{tr}None{/tr}</option>
											{section name=ux loop=$groups}
												<option value="{$groups[ux]|escape}" {if $cur_field.value|default:$cur_field.pvalue eq $groups[ux]}selected="selected"{/if}>{$groups[ux]}</option>
											{/section}
										</select>
									{elseif $cur_field.options}
										{$cur_field.value}
									{/if}
								{elseif $cur_field.type eq 'l'}
									{foreach key=tid item=tlabel from=$cur_field.links}
										<div>
											<a href="tiki-view_tracker_item.php?trackerId={$cur_field.trackerId}&amp;itemId={$tid}" class="link">
												{$tlabel}
											</a>
										</div>
									{/foreach}
								{elseif $cur_field.type eq 'e'}
									{assign var=fca value=$cur_field.options}
									{cycle name="2_$fca" values="," advance=false print=false}
									{foreach key=ku item=iu from=$cur_field.$fca}
										{assign var=fcat value=$iu.categId }
										<input type="checkbox" name="ins_cat_{$cur_field.fieldId}[]" value="{$fcat}" {if $cur_field.cat.$fcat eq 'y'}checked="checked"{/if}/>
											{$iu.name}
									{cycle name="2_$fca"}
									{/foreach}	
								{elseif $cur_field.type eq 't' || $cur_field.type eq 'm'}
									{if $cur_field.options_array[2]}
										<span class="formunit">{$cur_field.options_array[2]}&nbsp;</span>
									{/if}
									<input type="text" name="ins_{$cur_field.id}" value="{$cur_field.value|escape}" {if $cur_field.options_array[1]}size="{$cur_field.options_array[1]}" maxlength="{$cur_field.options_array[1]}"{/if} />
									{if $cur_field.options_array[3]}
										<span class="formunit">&nbsp;{$cur_field.options_array[3]}</span>
									{/if}
								{elseif $cur_field.type eq 'n'}
									{if $cur_field.options_array[2]}
										<span class="formunit">{$cur_field.options_array[2]}&nbsp;</span>
									{/if}
									<input type="text" name="ins_{$cur_field.id}" value="{$cur_field.value|escape}" {if $cur_field.options_array[1]}size="{$cur_field.options_array[1]}" maxlength="{$cur_field.options_array[1]}"{/if} />
									{if $cur_field.options_array[3]}
										<span class="formunit">&nbsp;{$cur_field.options_array[3]}</span>
									{/if}		
								{elseif $cur_field.type eq 'a'}
									<br/>
									<textarea name="ins_{$cur_field.id}" id="area_{$cur_field.id}" cols="{if $cur_field.options_array[1] gt 1}{$cur_field.options_array[1]}{else}50{/if}"
									rows="{if $cur_field.options_array[2] gt 1}{$cur_field.options_array[2]}{else}4{/if}">{$cur_field.value|escape}</textarea>
								{elseif $cur_field.type eq 'f'}
									{html_select_date prefix="ins_"|cat:$cur_field.id time=$cur_field.value start_year="-4" end_year="+4"}
									{html_select_time prefix="ins_"|cat:$cur_field.id time=$cur_field.value display_seconds=false}				
								{elseif $cur_field.type eq 'r'}
									<select name="ins_{$cur_field.id}">
										{if $cur_field.isMandatory}
											<option value=""></option>
										{/if}
										{foreach key=id item=label from=$cur_field.list}
											<option value="{$label|escape}" {if $cur_field.value eq $label}selected="selected"{/if}>{$label}</option>
										{/foreach}
									</select>
								{elseif $cur_field.type eq 'd'}
									<select name="ins_{$cur_field.id}">
										{if $cur_field.isMandatory}<option value=""></option>{/if}
										{section name=jx loop=$cur_field.options_array}
											<option value="{$cur_field.options_array[jx]|escape}" {if $cur_field.value eq $cur_field.options_array[jx]}selected="selected"{/if}>{$cur_field.options_array[jx]}</option>
										{/section}
									</select>		
								{elseif $cur_field.type eq 'c'}
									<input type="checkbox" name="ins_{$cur_field.id}" {if $cur_field.value eq 'y'}checked="checked"{/if}/>		
								{elseif $cur_field.type eq 'y'}
									<select name="ins_{$cur_field.id}">
										{foreach item=flag from=$cur_field.flags}
											<option value="{$flag|escape}" {if ($cur_field.value ne '' and $cur_field.value eq $flag) or ($cur_field.value eq '' and $flag eq 'None')}selected="selected"{/if}
											style="background-image:url('img/flags/{$flag}.gif');background-repeat:no-repeat;padding-left:25px;padding-bottom:3px;">{tr}{$flag}{/tr}</option>
										{/foreach}
									</select>
								{elseif $cur_field.type eq 'i'}
									<input type="file" name="ins_{$cur_field.id}" /><br />
									{if $cur_field.value ne ''}
										<img src="{$cur_field.value}" alt="n/a" width="{$cur_field.options_array[2]}" height="{$cur_field.options_array[3]}" /><br />
										<a href="tiki-view_tracker_item.php?trackerId={$trackerId}&itemId={$itemId}&fieldId={$cur_field.id}&fieldName={$cur_field.name}&removeImage">{tr}remove image{/tr}</a>
									{else}
										<img border="0" src="img/icons/na_pict.gif" alt="n/a" />
									{/if}
								{elseif $cur_field.type eq 'j'}
									<input type="hidden" name="ins_{$cur_field.id}" value="{$cur_field.value|default:$smarty.now}" id="ins_{$cur_field.id}" />
									<span id="disp_{$cur_field.id}" class="daterow">
										{$cur_field.value|default:$smarty.now|tiki_long_datetime}
									</span>
									<script type="text/javascript">
										{literal}Calendar.setup( { {/literal}
										date        : "{$cur_field.value|default:$smarty.now|date_format:"%B %e, %Y %H:%M"}",      // initial date
										inputField  : "ins_{$cur_field.id}",      // ID of the input field
										ifFormat    : "%s",    // the date format
										displayArea : "disp_{$cur_field.id}",       // ID of the span where the date is to be shown
										daFormat    : "{$long_date_format}",  // format of the displayed date
										showsTime   : true,
										singleClick : true,
										align       : "bR"
										{literal} } );{/literal}
									</script>
								{/if}
								{if (($cur_field.type eq 'c' or $cur_field.type eq 't' or $cur_field.type eq 'n') and $cur_field.options_array[0] eq '1') and $stick ne 'y'}
									{assign var=stick value="y"}
								{else}
									{assign var=stick value="n"}
								{/if}				
							{elseif $cur_field.type eq 'x'}	
								{capture name=trkaction}
									{if $cur_field.options_array[1] eq 'post'}
										<form action="{$cur_field.options_array[2]}" method="post">
									{else}
										<form action="{$cur_field.options_array[2]}" method="get">
									{/if}
										{section name=tl loop=$cur_field.options_array start=3}
											{assign var=valvar value=$cur_field.options_array[tl]|regex_replace:"/^[^:]*:/":""|escape}
											{if $info.$valvar eq ''}
											{assign var=valvar value=$cur_field.options_array[tl]|regex_replace:"/^[^\=]*\=/":""|escape}
											<input type="hidden" name="{$cur_field.options_array[tl]|regex_replace:"/\=.*$/":""|escape}" value="{$valvar|escape}" />
											{else}
											<input type="hidden" name="{$cur_field.options_array[tl]|regex_replace:"/:.*$/":""|escape}" value="{$info.$valvar|escape}" />
											{/if}
										{/section}
										{$cur_field.name}
										<input type="submit" class="submit" name="trck_act" value="{$cur_field.options_array[0]|escape}" />
									</form>
								{/capture}
								{assign var=trkact value=$trkact|cat:$smarty.capture.trkaction}
							{/if}
						{/if}
						</h4>
					{/foreach}
					&nbsp;
					<input type="submit" name="save" value="{tr}save{/tr}" />
					<input type="button" value="{tr}cancel{/tr}" onclick="flip('JsEdit')" />
						<input type="hidden" name="offset" value="{$offset|escape}" />
						<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
						{foreach key=urlkey item=urlval from=$urlquery}
							<input type="hidden" name="{$urlkey}" value="{$urlval|escape}" />
						{/foreach}
				</form>
				{if $trkact}
					<h2>{tr}Special Operations{/tr}</h2>
					{$trkact}
				{/if}
				<br />
				<em>
					{tr}fields marked with a * are mandatory{/tr}
				</em>
			</div>
			{*nohighlight - important comment to delimit the zone not to highlight in a search result*}
		{/if}
	</div>

{***********************************************************}

{* ----------------------------------------------------- tab with view --- *}
<div id="view">
	{if $tracker_info.showStatus eq 'y' and ($tracker_info.showStatusAdminOnly ne 'y' or $tiki_p_admin_trackers eq 'y')}
		{assign var=ustatus value=$info.status|default:"p"}
		{tr}Status{/tr}{$status_types.$ustatus.label}
		{html_image file=$status_types.$ustatus.image title=$status_types.$ustatus.label alt=$status_types.$ustatus.label}
	{/if}
	{foreach from=$ins_fields key=ix item=cur_field}
		{if $cur_field.isHidden ne 'y' or $tiki_p_admin_trackers eq 'y'}
			{if $cur_field.type ne 'x'}	
				{if $cur_field.name eq "Título"}
					<h2>
						<a class="pagetitle" href="tiki-view_tracker_item.php?trackerId={$trackerId}&amp;itemId={$itemId}">
							{$cur_field.value}
						</a>
					</h2>
				{elseif $cur_field.name eq "URL"}
						&nbsp | &nbsp URL: <b><a href="{$cur_field.value}">{$cur_field.value}</a></b>
					</h4>
				{elseif $cur_field.name eq "Versão"}
					<h4 id="sistema">
						Bug no sistema: <b>{$cur_field.value}</b>
						<br/>
						<a href="#comm" onclick="flip('JsComment')">Comentar</a>
						&nbsp | &nbsp
						<a href="#attach" onclick="flip('JsAttach')">Anexar um arquivo</a>
					</h4>
				{elseif $cur_field.name eq "Criador"}
					<h4>
						Criado por: <b>{$cur_field.value|userlink}</b>
				{else}
					<p>
						{$cur_field.value}
					</p>
				{/if}
			{/if}
		{/if}
	{/foreach}
</div>

{* -------------------------------------------------- tab with comments --- *}
{if $tracker_info.useComments eq 'y'}
	<div>
		{if count($comments) > 0}
			<h2 id="big">{tr}Comments{/tr}</h2>
			{section name=ix loop=$comments}
				<div class="comment">
					<div class="commentTitle">
						<a href="/estudiolivre/tiki-view_blog_post.php?postId=239&amp;offset=0&amp;find=&amp;sort_mode=created_desc&amp;blogId=42&amp;comments_parentId=2434&amp;comments_maxComments=1&amp;comments_style=commentStyle_threaded">
							{$comments[ix].title}
					   	</a>
					</div>
			    <div class="uMsgAvatar">
			       	{$comments[ix].user|avatarize}
			    </div>
				<div class="uMsgTxt">
					<div class="uMsgDel">
						<a class="link" href="tiki-view_tracker_item.php?trackerId={$trackerId}&amp;itemId={$itemId}&amp;remove_comment={$comments[ix].commentId}"
							title="{tr}delete{/tr}">
				        	<img alt="" src="styles/{$style|replace:".css":""}/img/iWikiRemove.png">
			        	</a> 
			        	<br>
						<a class="link" href="tiki-view_tracker_item.php?trackerId={$trackerId}&amp;itemId={$itemId}&amp;commentId={$comments[ix].commentId}" title="{tr}edit{/tr}">
							<img src="styles/{$style|replace:".css":""}/img/iWikiEdit.png">
						</a>				
					</div>
				    <div class="uMsgDate">
		   				{$comments[ix].posted|date_format:"%H:%M"}<br />
					    {$comments[ix].posted|date_format:"%d/%m/%Y"}
					</div>
			   		{$comments[ix].parsed}
				</div>
			{/section}
		{/if}
		{if $tiki_p_comment_tracker_items eq 'y'}
			<a name="comm"></a>
			<div id="JsComment" style="display:none">
				<form action="tiki-view_tracker_item.php" method="post">
					<input type="hidden" name="trackerId" value="{$trackerId|escape}" />
					<input type="hidden" name="itemId" value="{$itemId|escape}" />
					<input type="hidden" name="commentId" value="{$commentId|escape}" />
					{tr}Title{/tr}
					<input type="text" name="comment_title" value="{$comment_title|escape}"/>
					<br/>
					{tr}Comment{/tr}
					<br/>
					<textarea rows="4" cols="50" name="comment_data">{$comment_data|escape}</textarea>
					<div id="comButtons">
						<input type="submit" name="save_comment" value="{tr}save{/tr}" />
					</div>
				</form>
			</div>
		{/if}
	</div>
{/if}

{* ---------------------------------------- tab with attachements --- *}
{if $tracker_info.useAttachments eq 'y'}
	<div>
		{if count($atts) > 0}
			<h2 id="big">{tr}Attachments{/tr}</h2>
			<div class="comment">
			{section name=ix loop=$atts}
				{if $tiki_p_wiki_admin_attachments eq 'y' or ($user and ($atts[ix].user eq $user))}
					<a class="link" href="tiki-view_tracker_item.php?trackerId={$trackerId}&amp;itemId={$itemId}&amp;removeattach={$atts[ix].attId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}" title="{tr}delete{/tr}">
						<img alt="" src="styles/{$style|replace:".css":""}/img/iWikiRemove.png">
					</a>
					{*<a class="link" href="tiki-view_tracker_item.php?trackerId={$trackerId}&amp;itemId={$itemId}&amp;editattach={$atts[ix].attId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}" title="{tr}edit{/tr}">
						<img alt="" src="styles/{$style|replace:".css":""}/img/iWikiEdit.png">
					</a>*}
				{/if}
				<a href="tiki-download_item_attachment.php?attId={$atts[ix].attId}" title="{tr}download{/tr}">
					{$atts[ix].filename}
				</a>
				({$atts[ix].filesize|kbsize}) - 
				enviado: {$atts[ix].created|date_format:"%H:%M:%S de %d/%m"}
			<br/>
			{/section}
			</div>
		{/if}
		{if $tiki_p_attach_trackers eq 'y'}
			<br/>
			<a name="attach"></a>
			<div id="JsAttach" style="display:none">
			<form enctype="multipart/form-data" action="tiki-view_tracker_item.php" method="post">
				<input type="hidden" name="trackerId" value="{$trackerId|escape}" />
				<input type="hidden" name="itemId" value="{$itemId|escape}" />
				<input type="hidden" name="attId" value="{$attId|escape}" />
				{if $attach_file}
					{tr}Edit{/tr}:
				{/if}
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
				<input name="userfile1" type="file"  />
				{if $attach_file}
					<br />{$attach_file|escape}
				{/if}
				{*
				{tr}Title{/tr}: <input type="text" name="attach_comment" maxlength="250" value="{$attach_comment|escape}" /><br/>				
				{tr}version{/tr}<input type="text" name="attach_version" size="5" maxlength="10" value="{$attach_version|escape}" />
				{tr}description{/tr}<textarea name="attach_longdesc" style="width:100%;" rows="10" >{$attach_longdesc|escape}</textarea>
				*}
				<input type="submit" name="attach" value={if $attach_file}"{tr}edit{/tr}"{else}"{tr}attach{/tr}"{/if} />
			</form>
			</div>
		{/if}
	</div>
{/if}
</div>