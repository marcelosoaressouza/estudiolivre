{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-shoutbox.tpl,v 1.24.2.1 2005/02/23 15:42:20 michael_davey Exp $ *}

{if $feature_shoutbox eq 'y' and $tiki_p_view_shoutbox eq 'y'}
{tikimodule title="{tr}Shoutbox{/tr}" name="shoutbox" flip=$module_params.flip decorations=$module_params.decorations}
    {if $tiki_p_post_shoutbox eq 'y'}
      {js_maxlength textarea=shout_msg maxlength=255}
      <form action="{$shout_ownurl}" method="post" onsubmit="return verifyForm(this);">
      <div align="center">
        <textarea rows="3" cols="16" class="tshoutbox" name="shout_msg"></textarea>
	<br />
	<input type="submit" name="shout_send" value="{tr}send{/tr}" />
      </div><br />
      </form>
    {/if}

    {section loop=$shout_msgs name=ix}
      <div class="shoutboxmodmsg">

        {* TODO: IMHO Using 'modifier' is not best solution here
         *       so I forced to hack its result to inject 'title' attribute!
         *}

        {assign var=userlink value=$shout_msgs[ix].user|userlink:"linkmodule"}

        {capture name=date}{strip} {* Print date *}
          {$shout_msgs[ix].timestamp|tiki_short_time}, {$shout_msgs[ix].timestamp|tiki_short_date}
        {/strip}{/capture}

	{* Show user message in style according to 'tooltip' module parameter *}
	{assign var=cdate value=$smarty.capture.date}
	{if $tooltip == 1}
          <b>{strip}{$userlink|replace:" class=":" title='$cdate' class="}{/strip}</b>:
        {else}
          <b>{strip}{$userlink}{/strip}</b>, {$cdate}:
        {/if}
        {$shout_msgs[ix].message}
        {if $tiki_p_admin_shoutbox eq 'y'}
          [<a href="{$shout_ownurl}shout_remove={$shout_msgs[ix].msgId}" class="linkmodule">x</a>|<a href="tiki-shoutbox.php?msgId={$shout_msgs[ix].msgId}" class="linkmodule">e</a>]
        {/if}
      </div>
    {/section}
      <div style="text-align: center">
        <a href="tiki-shoutbox.php" class="linkmodule">{tr}Read More{/tr}&hellip;</a>
      </div>
{/tikimodule}
{/if}
