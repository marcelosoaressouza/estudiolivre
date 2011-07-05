{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-articles-js.tpl,v 1.1.2.2 2006/08/04 22:11:16 luciash Exp $ *}
<script type="text/javascript">
        var articleTypes = new Array();
{foreach from=$types key=type item=properties}


        typeProp = new Array();

    {foreach from=$properties key=prop item=value}
        typeProp['{$prop|escape}'] = '{$value|escape}';
    {/foreach}

        articleTypes['{$type|escape}'] = typeProp;
{/foreach}
</script>
        