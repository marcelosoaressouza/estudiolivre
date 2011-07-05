<h1><a href="tiki-gmap_usermap.php" class="pagetitle">{tr}Users Map{/tr}</a></h1>
<br /><br />


{if empty($gmap_key)}
<div class="highlight">{tr}You need to set a <a href="tiki-admin.php?page=gmap">Google Maps API key</a>{/tr}</div>
{else}
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$gmap_key}"></script>
{/if}


<div class="wikitext">
<div id="map" style="width: 500px; height: 400px;border: 1px solid #000;"></div>
</div>

<script type="text/javascript">
//<![CDATA[
function load() {literal}{{/literal}
  var map = new GMap2(document.getElementById("map"));
  map.addControl(new GLargeMapControl());
  map.addControl(new GMapTypeControl());
  map.addControl(new GScaleControl());
  map.setCenter(new GLatLng({$gmap_defaulty}, {$gmap_defaultx}), {$gmap_defaultz});

{foreach key=i item=u from=$users}
	marker{$i} = new GMarker(new GLatLng({$u[0]},{$u[1]}));
	map.addOverlay(marker{$i});
	GEvent.addListener(marker{$i},"click", function() {literal}{{/literal}
		marker{$i}.openInfoWindowHtml('{$u[2]}');
	{literal}});{/literal}
{/foreach}

{literal}}{/literal}
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
function addLoadEvent(func) {literal}{{/literal}
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {literal}{{/literal}
    window.onload = func;
  {literal}}{/literal} else {literal}{{/literal}
    window.onload = function() {literal}{{/literal}
      if (oldonload) {literal}{{/literal}
        oldonload();
      {literal}}{/literal}
      func();
    {literal}}{/literal}
  {literal}}{/literal}
{literal}}{/literal}

addLoadEvent(load);
//]]>
</script>

