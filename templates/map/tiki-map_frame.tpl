{* $Header: /cvsroot/tikiwiki/tiki/templates/map/tiki-map_frame.tpl,v 1.1.2.4 2006/02/22 03:48:59 luciash Exp $ *}

<script src="lib/map/map.js"></script>
  <form name="frmmap" action="tiki-map.phtml" method="get">
   <input type="hidden" name="mapfile" value="{$mapfile}" />
		<table border="0" cellpadding="0" cellspacing="0" >
		  <tr><td align="center">
		      	<input type="image" id="map" src="{$image_url}" 
			{if $xsize != ""}width="{$xsize}"{/if} 
			{if $ysize != ""}height="{$ysize}"{/if} 
		  border="0"
		  alt="{tr}click on the map to zoom or pan, do not drag{/tr}" 
		  title="{tr}click on the map to zoom or pan, do not drag{/tr}" />
		  </td></tr>
		  <tr><td align="center">	
			{if $zoom eq -4}
			<img id="imgzoom0" src="img/icons/zoom-4.gif" onclick="zoomin(0)" alt="-x4" title="{tr}Zoom out x4{/tr}" border="1" />
			{else}
			<img id="imgzoom0" src="img/icons/zoom-4.gif" onclick="zoomin(0)" alt="-x4" title="{tr}Zoom out x4{/tr}" />
			{/if}
			{if $zoom eq -3}
			<img id="imgzoom1" src="img/icons/zoom-3.gif" onclick="zoomin(1)" alt="-x3" title="{tr}Zoom out x3{/tr}" border="1" />
			{else}  
			<img id="imgzoom1" src="img/icons/zoom-3.gif" onclick="zoomin(1)" alt="-x3" title="{tr}Zoom out x3{/tr}" />
			{/if}
			{if $zoom eq -2}
			<img id="imgzoom2" src="img/icons/zoom-2.gif" onclick="zoomin(2)" alt="-x2" title="{tr}Zoom out x2{/tr}" border="1" />
			{else}
			<img id="imgzoom2" src="img/icons/zoom-2.gif" onclick="zoomin(2)" alt="-x2" title="{tr}Zoom out x2{/tr}" />
			{/if}
			{if $zoom eq 0}
			<img id="imgzoom3" src="img/icons/info.gif" onclick="zoomin(3)" alt="Q" title="{tr}Query{/tr}" border="1" />
			{else}
			<img id="imgzoom3" src="img/icons/info.gif" onclick="zoomin(3)" alt="Q" title="{tr}Query{/tr}" />
			{/if}
			{if $zoom eq 1}
			<img id="imgzoom4" src="img/icons/move.gif" onclick="zoomin(4)" alt="P" title="{tr}Pan{/tr}" border="1" />
			{else}
			<img id="imgzoom4" src="img/icons/move.gif" onclick="zoomin(4)" alt="P" title="{tr}Pan{/tr}" />
			{/if}
			{if $zoom eq 2}
			<img id="imgzoom5" src="img/icons/zoom+2.gif" onclick="zoomin(5)" alt="x2" title="{tr}Zoom in x2{/tr}" border="1" />
			{else}
			<img id="imgzoom5" src="img/icons/zoom+2.gif" onclick="zoomin(5)" alt="x2" title="{tr}Zoom in x2{/tr}" />
			{/if}
			{if $zoom eq 3}
			<img id="imgzoom6" src="img/icons/zoom+3.gif" onclick="zoomin(6)" alt="x3" title="{tr}Zoom in x3{/tr}" border="1" />
			{else}
			<img id="imgzoom6" src="img/icons/zoom+3.gif" onclick="zoomin(6)" alt="x3" title="{tr}Zoom in x3{/tr}" />
			{/if}
			{if $zoom eq 4}
			<img id="imgzoom7" src="img/icons/zoom+4.gif" onclick="zoomin(7)" alt="x4" title="{tr}Zoom in x4{/tr}" border="1" />
			{else}
			<img id="imgzoom7" src="img/icons/zoom+4.gif" onclick="zoomin(7)" alt="x4" title="{tr}Zoom in x4{/tr}" />
			{/if}
			&nbsp;
			<select id="zoom" name="zoom" size="1" onchange="cbzoomchange()">
				{html_options values=$zoom_values selected=$zoom output=$zoom_display name=$oldzoom}
			</select>
			<input type="hidden" name="size" value="{$size}" />
			<input type="hidden" name="minx" value="{$minx}" />
			<input type="hidden" name="miny" value="{$miny}" />
			<input type="hidden" name="maxx" value="{$maxx}" />
			<input type="hidden" name="maxy" value="{$maxy}" />
			<input type="hidden" name="oldsize" value="{$size}" />
			<input type="hidden" name="maponly" value="{$maponly}" />
			{section name=i loop=$my_layers}
			{if $my_layers_checked[i] eq "checked"}
				<input type="hidden" name="{$my_layers[i]->name}" value="1"/>
			{/if}
			{/section}
		</td></tr>
		</table>	  
</form>
