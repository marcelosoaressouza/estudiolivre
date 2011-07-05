{include file="header.tpl"}{* This must be included as the first thing in a document to be XML compliant *}
<script type="text/javascript" src="lib/js/toggleImage.js"></script>
{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/estudiolivre/tiki-print.tpl,v 1.5 2006-07-21 11:14:41 rhwinter Exp $ *}
<link rel="StyleSheet"  href="styles/estudiolivre/css/print.css" type="text/css" />

{* Index we display a wiki page here *}
<div id="printLogo">
	<img src="styles/estudiolivre/logoTop.png">
</div>

<div id="printSite">
www.estudiolivre.org
</div>

<div id="tiki-clean">
  <div  id="tiki-mid">
    {include file=$mid}
  </div>
</div>
{include file="footer.tpl"}
