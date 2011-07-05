{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki.tpl,v 1.12.4.11 2007/12/21 22:00:47 mose Exp $ *}
{include file="header.tpl"}
{* Index we display a wiki page here *}
{if $feature_bidi eq 'y'}
<div dir="rtl">
{/if}
<div id="tiki-main">
  {if $feature_top_bar eq 'y'}
  <div id="tiki-top">
    {include file="tiki-top_bar.tpl"}
  </div>
  {/if}
  <div id="tiki-mid">
  {if $feature_left_column eq 'user' or $feature_right_column eq 'user'}
			<div>
      {if $feature_left_column eq 'user'}
        <span style="float: left"><a class="flip" href="javascript:icntoggle('leftcolumn');">
        <img  align="left" name="leftcolumnicn" class="colflip" src="img/icons/ofo.gif" border="0" alt="+/-" />&nbsp;{tr}Show/Hide Left Menus{/tr}&nbsp;</a>
        </span>
      {/if}
      {if $feature_right_column eq 'user'}
        <span style="float: right"><a class="flip" href="javascript:icntoggle('rightcolumn');">
        <img align="left" name="rightcolumnicn" class="colflip" src="img/icons/ofo.gif" border="0" alt="+/-" />&nbsp;{tr}Show/Hide Right Menus{/tr}&nbsp;</a>
        </span>
      {/if}
      <br clear="both" />
			</div>
  {/if}
  <table id="tiki-midtbl" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      {if $feature_left_column ne 'n'}
      <td id="leftcolumn" valign="top">
      {section name=homeix loop=$left_modules}
      {$left_modules[homeix].data}
      {/section}
          {if $feature_left_column eq 'user'}
            <img src="images/none.gif" width="100%" height="0" />
            {literal}
              <script type="text/javascript">
                setfolderstate("leftcolumn");
              </script>
            {/literal}
          {/if}
      </td>
      {/if}
      <td width="100%" id="centercolumn" valign="top"><div id="tiki-center">
      
      {* note: $mid is replaced by templates/tiki-show_page.tpl  *}
      {include file=$mid}
      
      {if $show_page_bar eq 'y'}
      {include file="tiki-page_bar.tpl"}
      {/if}
      </div>
      </td>
      {if $feature_right_column ne 'n'}
      <td id="rightcolumn" valign="top">
      {section name=homeix loop=$right_modules}
      {$right_modules[homeix].data}
      {/section}
          {if $feature_right_column eq 'user'}
            <img src="images/none.gif" width="100%" height="0" />
            {literal}
              <script type="text/javascript">
                setfolderstate("rightcolumn");
              </script>
            {/literal}
          {/if}
      </td>
      {/if}
    </tr>
    </table>
  </div>
  {if $feature_bot_bar eq 'y'}
  <div id="tiki-bot">
    {include file="tiki-bot_bar.tpl"}
  </div>
  {/if}
</div>
{if $feature_bidi eq 'y'}
</div>
{/if}
{include file="footer.tpl"}
