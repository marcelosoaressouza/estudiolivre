{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-directory_stats.tpl,v 1.6.10.1 2005/02/23 21:12:46 michael_davey Exp $ *}

{if $feature_directory eq 'y'}
{tikimodule title="{tr}Directory Stats{/tr}" name="directory_stats" flip=$module_params.flip decorations=$module_params.decorations}

  {tr}Sites{/tr}: {$modDirStats.valid}<br />
  {tr}Sites to validate{/tr}: {$modDirStats.invalid}<br />
  {tr}Categories{/tr}: {$modDirStats.categs}<br />
  {tr}Searches{/tr}: {$modDirStats.searches}<br />
  {tr}Visited links{/tr}: {$modDirStats.visits}<br />

{/tikimodule}
{/if}
