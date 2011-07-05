{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-num_submissions.tpl,v 1.6.10.2 2005/12/18 16:23:10 marclaporte Exp $ *}

{if $feature_submissions eq 'y'}
{tikimodule title="{tr}Waiting Submissions{/tr}" name="num_submissions" flip=$module_params.flip decorations=$module_params.decorations}
  {tr}We have{/tr} {$modNumSubmissions} <a class="linkmodule" href="tiki-list_submissions.php">{tr}submissions waiting to be examined{/tr}</a>.
{/tikimodule}
{/if}
