{* --- IMPORTANT: If you edit this (or any other TPL file) file via the Tiki built-in TPL editor (tiki-edit_templates.php), all the javascript will be stripped. This will cause problems. (Ex.: menus stop collapsing/expanding).

You should only modify header.tpl via a text editor through console, or ssh, or FTP edit commands. And only if you know what you are doing ;-)

You are most likely wanting to modify the top of your Tiki site. Please consider using Site Identity feature or modifying tiki-top_bar.tpl which you can do safely via the web-based interface.       --- *}<!DOCTYPE html PUBLIC
"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="robots" content="noindex,nofollow" />
{* --- tikiwiki block --- *}
{php} include("lib/tiki-dynamic-js.php"); {/php}
		<script type="text/javascript" src="lib/tiki-js.js"></script>
{include file="bidi.tpl"}{* this is included for Right-to-left languages *}

{* --- page title block --- *}
{strip}
		<title>{tr}Error{/tr}: {if $trail}{breadcrumbs type="fulltrail" loc="head" crumbs=$trail}{else}{$siteTitle}
{if $page ne ''} : {$page|escape}
{elseif $headtitle} : {$headtitle}
{elseif $arttitle ne ''} : {$arttitle}
{elseif $title ne ''} : {$title}
{elseif $thread_info.title ne ''} : {$thread_info.title}
{elseif $post_info.title ne ''} : {$post_info.title}
{elseif $forum_info.name ne ''} : {$forum_info.name}
{elseif $categ_info.name ne ''} : {$categ_info.name}
{elseif $userinfo.login ne ''} : {$userinfo.login}
{/if}{/if}
		</title>
{/strip}

{* --- main CSS file --- *}
		<link rel="StyleSheet" media="all" href="styles/{$style}" type="text/css" />

{* --- favicon file --- *}
{if $favicon}		<link rel="icon" href="{$favicon}" />{/if}

{* --- Integrator block --- *}
{if strlen($integrator_css_file) > 0}
		<link rel="StyleSheet" href="{$integrator_css_file}" type="text/css" />
{/if}

{$trl}

	</head>

{* ---- BODY ---- *}
	<body class="error simple">
	
{* main content follows here *}
		<div id="main"{if $feature_bidi eq 'y'} dir="rtl"{/if}><!-- START of main content -->

			<div id="c1c2"><!-- START of column 1 and column 2 holder -->

				<div id="wrapper"><!-- START of column 1 wrapper -->
					<div id="col1" class="{if $feature_left_column ne 'n'} marginleft{/if}{if $feature_right_column ne 'n'} marginright{/if}">

						<div class="content">

							<div class="cbox">
								<div class="cbox-title">{tr}Error{/tr}</div>
								<div class="cbox-data">
									<p>{$msg}</p>
									<a href="javascript:window.close()" class="linkmenu">{tr}Close Window{/tr}</a>
								</div>
							</div>
						
						</div>

					</div><!-- END of column 1 -->
				</div><!-- END of column1 wrapper -->

			</div><!-- END of column 1 and column 2 holder -->


		</div><!-- END of main content -->

{if $tiki_p_admin eq 'y' and $feature_debug_console eq 'y'}
  {* Include debugging console. Note it should be processed as near as possible to the end of file *}

  {php}  include_once("tiki-debug_console.php"); {/php}
  {include file="tiki-debug_console.tpl"}

{/if}
{if $lastup}
		<div style="font-size:x-small;text-align:center;color:#999;">{tr}Last update from CVS{/tr}: {$lastup|tiki_long_datetime}</div>
{/if}
	</body>
</html>
