{css only=list}
<div id="tracker">
	<h1>
		{tooltip text="Total: "|cat:$item_count}
			<a href="tiki-view_tracker.php?trackerId=1&amp;offset=0&amp;sort_mode=created_desc&ampstatus">
				{$tracker_info.name} 
			</a>
		{/tooltip}
	</h1>
	<h5>
		Ver bugs 
		{if $status eq "c"}
			<a href="tiki-view_tracker.php?trackerId={$trackerId}{if $filtervalue}&amp;filtervalue={$filtervalue|escape:"url"}{/if}{if $filterfield}&amp;filterfield={$filterfield|escape:"url"}{/if}{if $sort_mode}&amp;sort_mode={$sort_mode}{/if}&amp;status=o">não resolvidos</a>
		{else}
			<a href="tiki-view_tracker.php?trackerId={$trackerId}{if $filtervalue}&amp;filtervalue={$filtervalue|escape:"url"}{/if}{if $filterfield}&amp;filterfield={$filterfield|escape:"url"}{/if}{if $sort_mode}&amp;sort_mode={$sort_mode}{/if}&amp;status=c">resolvidos</a>			
		{/if}
		<br/>		
		{if $tiki_p_create_tracker_items eq 'y'}
			<a href="javascript:flip('JsInsert')"><h2>Reportar bug</h2></a>

		{else}
			Efetue login para reportar
		{/if}
	</h5>
	{if $tiki_p_create_tracker_items eq 'y'}
		{include file="new_tracker.tpl"}
	{/if}
	
	{if $tiki_p_admin_trackers eq 'y'}
		<b>Admin:</b>&nbsp;&nbsp;
		<a href="tiki-admin_trackers.php?trackerId={$trackerId}" class="linkbut">{tr}Edit this tracker{/tr}</a></span>
		&nbsp; | &nbsp;
		<a href="tiki-admin_tracker_fields.php?trackerId={$trackerId}" class="linkbut">{tr}Edit fields{/tr}</a></span>
		<br/>
		<br/>
	{/if}
	
	{if $rss_tracker eq "y"}
		<a href="tiki-tracker_rss.php?trackerId={$trackerId}" class="linkbut">
			<img src='img/rss.png' border='0' alt='{tr}RSS feed{/tr}' title='{tr}RSS feed{/tr}' />
		</a>
	{/if}
	
	{$tracker_info.description}
	
	{*
		if $mail_msg}
			{$mail_msg}
		{/if
	*}
	
	{if count($err_value) > 0}
		<div class="simplebox highlight">
			{tr}Following fields are incorrect{/tr}&nbsp;:<br/>
			{section name=ix loop=$err_value}
				{$err_value[ix].name}{if !$smarty.section.ix.last},&nbsp;{/if}
			{/section}
		</div>
		<br />
	{/if}
	
			
	{* -------------------------------------------------- tab with list --- *}
	<div id="content1" class="tabcontent">
		{if $tiki_p_view_trackers eq 'y' & $items}
			<table class="normal">
				{*===============
				 ------- list headings --- 
				 ================*}
				<tr>
					{if $tracker_info.showStatus eq 'y' or ($tracker_info.showStatusAdminOnly eq 'y' and $tiki_p_admin_trackers eq 'y')}
						<td class="heading">
							Status
						</td>
					{/if}
					{section name=ix loop=$fields}
						{if $fields[ix].type eq 'l' and $fields[ix].isTblVisible eq 'y'}
							<td class="heading">{$fields[ix].name|default:"&nbsp;"}</td>
						{elseif $fields[ix].type eq 's' and $fields[ix].name eq "Rating" and $fields[ix].isTblVisible eq 'y'}
								<td class="heading"{if $tiki_p_tracker_vote_ratings eq 'y' and $user ne ''} colspan="2"{/if}>
									<a class="tableheading" href="tiki-view_tracker.php?{if $status}status={$status}&amp;{/if}{if $initial}initial={$initial}&amp;{/if}trackerId={$trackerId}&amp;offset={$offset}
								        &amp;sort_mode=f_{if $sort_mode eq 'f_'|cat:$fields[ix].fieldId|cat:'_asc'}
										{$fields[ix].fieldId|escape:"url"}_desc{else}{$fields[ix].fieldId|escape:"url"}_asc{/if}">
											{$fields[ix].name|truncate:255:"..."|default:"&nbsp;"}
									</a>
								</td>
								{assign var=rateFieldId value=$fields[ix].fieldId}
						{elseif $fields[ix].isTblVisible eq 'y' and $fields[ix].type ne 'x' and $fields[ix].type ne 'h'}
							<td class="heading">
								<a class="tableheading" href="tiki-view_tracker.php?{if $status}status={$status}&amp;{/if}{if $initial}initial={$initial}&amp;{/if}trackerId={$trackerId}&amp;offset={$offset}
									{if $filterfield}&amp;filterfield={$filterfield}&amp;filtervalue={$filtervalue}{/if}
									&amp;sort_mode=f_{if $sort_mode eq 'f_'|cat:$fields[ix].fieldId|cat:'_asc'}{$fields[ix].fieldId|escape:"url"}_desc{else}{$fields[ix].fieldId|escape:"url"}_asc{/if}
									">
									{if $sort_mode eq 'f_'|cat:$fields[ix].fieldId|cat:'_asc'}
										<img src="styles/{$style|replace:".css":""}/img/sortArrowDown.png">
									{elseif $sort_mode eq 'f_'|cat:$fields[ix].fieldId|cat:'_desc'}
										<img src="styles/{$style|replace:".css":""}/img/sortArrowUp.png">
									{else}
										<img src="styles/{$style|replace:".css":""}/img/sortGreyArrowDown.png">
									{/if}
									{$fields[ix].name|truncate:255:"..."|default:"&nbsp;"}
								</a>
							</td>
						{/if}
					{/section}
					{if $tracker_info.showCreated eq 'y'}
						<td class="heading">
							<a class="tableheading" href="tiki-view_tracker.php?{if $status}status={$status}&amp;{/if}{if $initial}initial={$initial}&amp;{/if}{if $find}find={$find}&amp;{/if}trackerId={$trackerId}&amp;offset={$offset}&amp;sort_mode={if 
							$sort_mode eq 'created_desc'}created_asc{else}created_desc{/if}">
								<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'created_desc'}ArrowUp{elseif $sort_mode eq 'created_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
								{tr}Created{/tr}
							</a>
						</td>
					{/if}
					{if $tracker_info.showLastModif eq 'y'}
						<td class="heading">
							<a class="tableheading" href="tiki-view_tracker.php?status={$status}&amp;{if $initial}initial={$initial}&amp;{/if}find={$find}&amp;trackerId={$trackerId}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'lastModif_desc'}lastModif_asc{else}lastModif_desc{/if}">
								<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'lastModif_desc'}ArrowUp{elseif $sort_mode eq 'lastModif_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
								{tr}Última modificação{/tr}
							</a>
						</td>
					{/if}
					{if $tracker_info.useComments eq 'y' and $tracker_info.showComments eq 'y'}
						<td class="heading" width="5%">
							{tr}coms{/tr}
						</td>
					{/if}
					{if $tracker_info.useAttachments eq 'y' and  $tracker_info.showAttachments eq 'y'}
						<td class="heading" width="5%">{tr}atts{/tr}</td>
						{if $tiki_p_admin_trackers eq 'y'}
							<td class="heading" width="5%">{tr}dls{/tr}</td>
						{/if}
					{/if}
					
					{if $tiki_p_admin_trackers eq 'y'}
						<td class="heading" width="5%">&nbsp;</td>
					{/if}
				</tr>
				
				{*===============
				 ------- Items loop --- 
				 ===============*}
				{assign var=itemoff value=0}
				{cycle values="odd,even" print=false}
				{section name=user loop=$items}
					<tr class="{cycle}">
					{if $tracker_info.showStatus eq 'y' or ($tracker_info.showStatusAdminOnly eq 'y' and $tiki_p_admin_trackers eq 'y')}
						<td class="auto" style="width:20px;">
							{assign var=ustatus value=$items[user].status|default:"c"}
							{html_image file=$status_types.$ustatus.image title=$status_types.$ustatus.label alt=$status_types.$ustatus.label}
						</td>
					{/if}
			
					{* ------- list values --- *}
					{section name=ix loop=$items[user].field_values}
						{if $items[user].field_values[ix].isTblVisible eq 'y'}
							{if $items[user].field_values[ix].type eq 'l'}
								<td class="auto">
									{foreach key=tid item=tlabel from=$items[user].field_values[ix].links}
										{if $items[user].field_values[ix].options_array[4] eq '1'}
											<div>
												<a href="tiki-view_tracker_item.php?itemId={$tid}&trackerId={$items[user].field_values[ix].options_array[0]}" class="link">{$tlabel|truncate:255:"..."}</a></div>
										{else}
											<div>
												{$tlabel|truncate:255:"..."}
											</div>
										{/if}
									{/foreach}
								</td>
							{elseif $items[user].field_values[ix].isMain eq 'y'}
								<td class="auto">
									{if $tiki_p_view_trackers eq 'y' or $tiki_p_modify_tracker_items eq 'y' or $tiki_p_comment_tracker_items eq 'y' 
									 or ($tracker_info.writerCanModify eq 'y' and $user and $my eq $user) or ($tracker_info.writerCanModify eq 'y' and $group and $ours eq $group)}
										<a class="tablename" href="tiki-view_tracker_item.php?itemId={$items[user].itemId}&amp;show=view&amp;offset={$offset}&amp;reloff={$itemoff}{foreach key=urlkey item=urlval from=$urlquery}{if $urlval}&amp;{$urlkey}={$urlval|escape:"url"}{/if}{/foreach}">
									{/if}		
									{if  ($items[user].field_values[ix].type eq 't' or $items[user].field_values[ix].type eq 'n' or $items[user].field_values[ix].type eq 'c') 
									and $items[user].field_values[ix].options_array[2]}
										<span class="formunit">
											&nbsp;{$items[user].field_values[ix].options_array[2]}
										</span>										{if $items[user].my_rate eq NULL}
												<b class="linkbut highlight">-</b>
											{else}
												<a href="{$smarty.server.PHP_SELF}{if $query_string}?{$query_string}{else}?{/if}
													trackerId={$items[user].trackerId}
													&amp;rateitemId={$items[user].itemId}
													&amp;fieldId={$rateFieldId}
													&amp;rate_{$items[user].trackerId}=NULL"
													class="linkbut">-</a>
											{/if}
									{/if}		
									{if $items[user].field_values[ix].type eq 'f'}
										{if $items[user].field_values[ix].value}
											{$items[user].field_values[ix].value|tiki_short_datetime|truncate:255:"..."|default:"&nbsp;"}
										{else}
											&nbsp;
										{/if}		
									{elseif $items[user].field_values[ix].type eq 'c'}
										{$items[user].field_values[ix].value|replace:"y":"Yes"|replace:"n":"No"|replace:"on":"Yes"}
									{elseif $items[user].field_values[ix].type eq 'a'}
										{if $items[user].field_values[ix].options_array[4] ne ''}
											{$items[user].field_values[ix].pvalue|truncate:$items[user].field_values[ix].options_array[4]:"...":true}
										{else}
											{$items[user].field_values[ix].pvalue}
										{/if}
									{elseif $items[user].field_values[ix].type eq 'i'}
										{assign var=width value=$items[user].field_values[ix].options_array[0]}
										{assign var=height value=$items[user].field_values[ix].options_array[1]}
										{if $items[user].field_values[ix].value ne ''}
											<img border="0" src="{$items[user].field_values[ix].value}"  width="{$width}" height="{$height}" alt="n/a" />
										{else}
										<img border="0" src="img/icons/na_pict.gif" alt="n/a" />
									{/if}
							{elseif $items[user].field_values[ix].type eq 'm'}
								{$items[user].field_values[ix].value|default:"&nbsp;"}
							{elseif $items[user].field_values[ix].type eq 'e'}
								{foreach item=ii from=$items[user].field_values[ix].categs}
									{$ii.name}<br />
								{/foreach}		
							{elseif $items[user].field_values[ix].type eq 'y'}
								{assign var=o_opt value=$items[user].field_values[ix].options_array[0]}
								{if $o_opt ne '1'}
									<img border="0" src="img/flags/{$items[user].field_values[ix].value}.gif" title="{$items[user].field_values[ix].value}" />
								{/if}
								{if $o_opt ne '1' and $o_opt ne '2'}&nbsp;{/if}
								{if $o_opt ne '2'}{tr}{$items[user].field_values[ix].value}{/tr}{/if}		
							{else}
								{$items[user].field_values[ix].value|truncate:255:"..."|default:"&nbsp;"}		
							{/if}
							{if ($items[user].field_values[ix].type eq 't' or $items[user].field_values[ix].type eq 'n' or $items[user].field_values[ix].type eq 'c') 
							and $items[user].field_values[ix].options_array[3]}
								<span class="formunit">
									&nbsp;{$items[user].field_values[ix].options_array[3]}
								</span>
							{/if}
						{if $tiki_p_view_trackers eq 'y' or $tiki_p_modify_tracker_items eq 'y' or $tiki_p_comment_tracker_items eq 'y'}</a>{/if}
							</td>
						{else}
							{if $items[user].field_values[ix].linkId and $items[user].field_values[ix].trackerId}
								<td class="auto">
									{if $items[user].field_values[ix].options_array[2] eq '1'}
										<a href="tiki-view_tracker_item.php?itemId={$items[user].field_values[ix].linkId}&amp;trackerId={$items[user].field_values[ix].trackerId}" class="link">
											{$items[user].field_values[ix].value|truncate:255:"..."|default:"&nbsp;"}
										</a>
									{else}
										{$items[user].field_values[ix].value|truncate:255:"..."|default:"&nbsp;"}
									{/if}
								</td>
							{elseif $items[user].field_values[ix].type eq 'm'}
								<td class="auto">
									{if $items[user].field_values[ix].options_array[0] eq '1' and $items[user].field_values[ix].value}
										{mailto address=$items[user].field_values[ix].value|escape encode="hex"}
									{elseif $items[user].field_values[ix].options_array[0] eq '2' and $items[user].field_values[ix].value}
										{mailto address=$items[user].field_values[ix].value|escape encode="none"}
									{else}
										{$items[user].field_values[ix].value|escape|default:"&nbsp;"}
									{/if}
								</td>
							{elseif $items[user].field_values[ix].type eq 'f' or $items[user].field_values[ix].type eq 'j'}
							<td class="auto">
								{if $items[user].field_values[ix].value}
									{$items[user].field_values[ix].value|tiki_short_datetime|default:"&nbsp;"}
								{else}
									&nbsp;
								{/if}
							</td>
							{elseif $items[user].field_values[ix].type eq 'a'}
								<td class="auto">
									{if $items[user].field_values[ix].options_array[4] ne ''}
										{$items[user].field_values[ix].pvalue|truncate:$items[user].field_values[ix].options_array[4]:"...":true}
									{else}
										{$items[user].field_values[ix].pvalue}
									{/if}
								</td>
							{elseif $items[user].field_values[ix].type eq 'e'}
								<td class="auto">
									{foreach item=ii from=$items[user].field_values[ix].categs}
										{$ii.name}
										<br />
									{/foreach}
								</td>
							{elseif $items[user].field_values[ix].type eq 'i'}
								<td class="auto">
									{assign var=width value=$items[user].field_values[ix].options_array[0]}
									{assign var=height value=$items[user].field_values[ix].options_array[1]}
									{if $items[user].field_values[ix].value ne ''}
										<img border="0" src="{$items[user].field_values[ix].value}" width="{$width}" height="{$height}" alt="n/a" />
									{else}
										<img border="0" src="img/icons/na_pict.gif" alt="n/a" />
									{/if}
								</td>
							{elseif $items[user].field_values[ix].type eq 'y'}
								<td class="auto">
									{assign var=o_opt value=$items[user].field_values[ix].options_array[0]}
									{if $o_opt eq '0' or $o_opt eq 2}
										<img border="0" src="img/flags/{$items[user].field_values[ix].value}.gif"  title="{$items[user].field_values[ix].value}" />
									{/if}
									{if $o_opt eq '0'}
										&nbsp;
									{/if}
									{if $o_opt eq '0' or $o_opt eq 1}
										{tr}{$items[user].field_values[ix].value}{/tr}
									{/if}
								</td>
				
							{elseif $items[user].field_values[ix].type eq 's' and $items[user].field_values[ix].name eq "Rating" and $tiki_p_tracker_view_ratings eq 'y'}
								<td class="auto">
									<b title="{tr}Rating{/tr}: {$items[user].field_values[ix].value|default:"-"}, {tr}Number of voices{/tr}: {$items[user].field_values[ix].numvotes|default:"-"}, {tr}Average{/tr}: {$items[user].field_values[ix].voteavg|default:"-"}">
										&nbsp;{$items[user].field_values[ix].value|default:"-"}&nbsp;
									</b>
								</td>
								{if $tiki_p_tracker_vote_ratings eq 'y'}
									<td class="auto" nowrap="nowrap">
										<span class="button2">
											{if $items[user].my_rate eq NULL}
												<b class="linkbut highlight">-</b>
											{else}
												<a href="{$smarty.server.PHP_SELF}{if $query_string}?{$query_string}{else}?{/if}
													trackerId={$items[user].trackerId}
													&amp;rateitemId={$items[user].itemId}
													&amp;fieldId={$rateFieldId}
													&amp;rate_{$items[user].trackerId}=NULL"
													class="linkbut">-</a>
											{/if}
											{section name=i loop=$items[user].field_values[ix].options_array}
												{if $items[user].field_values[ix].options_array[i] eq $items[user].my_rate}
													<b class="linkbut highlight">{$items[user].field_values[ix].options_array[i]}</b>
												{else}
													<a href="{$smarty.server.PHP_SELF}?
													trackerId={$items[user].trackerId}
													&amp;rateitemId={$items[user].itemId}
													&amp;fieldId={$rateFieldId}
													&amp;rate_{$items[user].trackerId}={$items[user].field_values[ix].options_array[i]}"
													class="linkbut">{$items[user].field_values[ix].options_array[i]}</a>
												{/if}
											{/section}
										</span>
									</td>
								{/if}
			
							{elseif $items[user].field_values[ix].type ne 'x' and $items[user].field_values[ix].type ne 'h'}
								<td class="auto">
									{if  ($items[user].field_values[ix].type eq 't' or $items[user].field_values[ix].type eq 'n' or $items[user].field_values[ix].type eq 'c') 
									 and $items[user].field_values[ix].options_array[2]}
									 	<span class="formunit">
									 		&nbsp;{$items[user].field_values[ix].options_array[2]}&nbsp;
									 	</span>
									{/if}
									{$items[user].field_values[ix].value|truncate:255:"..."|default:"&nbsp;"}
									{if ($items[user].field_values[ix].type eq 't' or $items[user].field_values[ix].type eq 'n' or $items[user].field_values[ix].type eq 'c') 
										 and $items[user].field_values[ix].options_array[3]}
										 <span class="formunit">
										 	&nbsp;{$items[user].field_values[ix].options_array[3]}
										 </span>
									{/if}
								</td>
							{/if}
						{/if}
					{/if}
					{/section}
				
				
					{if $tracker_info.showCreated eq 'y'}
						<td>{$items[user].created|date_format:"%H:%M:%S de %d/%m"}</td>
					{/if}
					{if $tracker_info.showLastModif eq 'y'}
						<td>{$items[user].lastModif|date_format:"%H:%M:%S de %d/%m"}</td>
					{/if}
					{if $tracker_info.useComments eq 'y' and $tracker_info.showComments eq 'y'}
						<td  style="text-align:center;">{$items[user].comments}</td>
					{/if}
					{if $tracker_info.useAttachments eq 'y' and $tracker_info.showAttachments eq 'y'}
						<td  style="text-align:center;">
						<a href="tiki-view_tracker_item.php?itemId={$items[user].itemId}&amp;show=att&amp;offset={$offset}&amp;reloff={$itemoff}{foreach key=urlkey item=urlval from=$urlquery}{if $urlval}&amp;{$urlkey}={$urlval|escape:"url"}{/if}{/foreach}{section name=mix loop=$fields}{if $fields[mix].value}&amp;{$fields[mix].name}={$fields[mix].value}{/if}{/section}" 
						link="{tr}list attachments{/tr}"><img src="img/icons/folderin.gif" border="0" alt="{tr}List Attachments{/tr}" 
						/></a> {$items[user].attachments}
						</td>
						{if $tiki_p_admin_trackers eq 'y'}
							<td  style="text-align:center;">{$items[user].downloads}</td>
						{/if}
					{/if}
					{if $tiki_p_admin_trackers eq 'y'}
						<td><a class="link" href="tiki-view_tracker.php?status={$status}&amp;trackerId={$trackerId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove={$items[user].itemId}" 
						title="{tr}delete{/tr}"><img src="img/icons2/delete.gif" border="0" height="16" width="16" alt='{tr}delete{/tr}' /></a>
						</td>
					{/if}
					</tr>
					{assign var=itemoff value=$itemoff+1}
				{/section}
			</table>
			
			{include file="tiki-pagination.tpl"}
		{else}
			{if $status eq "c"}
				Nenhum bug fechado.
			{else}
				Nenhum bug encontrado!!!
			{/if}
			
		{/if}
	</div>
</div>

<br/><br/>