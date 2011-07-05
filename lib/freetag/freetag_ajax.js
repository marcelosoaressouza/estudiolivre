
//cp.set_persistent_connection('yes');

var objectType = '';
var currentTag = '';
var selectedElement = false;

function listObjects(tag) {
    currentTag = tag;
    var cp = new cpaint();
    cp.set_response_type('XML');
    //cp.set_debug(2);

    document.getElementById('ajaxLoading').style.display = 'block';

    cp.call('tiki-freetag_list_objects_ajax.php', 'list_objects', renderObjectList, tag, objectType);
}

function renderObjectList(result) {
    var objects = result.getElementsByTagName('object');
    
    if (!objects.length) {
	document.getElementById('objectList').innerHTML = '';
	return;
    }

    var href = objects.item(0).getElementsByTagName('href');

    var data = new Array();
    for (var i=0; i<objects.length; i++) {
	var obj = objects[i];
	var item = new Array();
	for (var j=0; j<obj.childNodes.length; j++) {
	    item[obj.childNodes[j]['tagName']] = obj.childNodes[j]['textContent'];
	}
	data[i] = item;
    }

    var content = '';
    for (var i=0; i<data.length; i++) {
	var item = data[i];
	content += '<div class="freetagObject' + (i%2 ? 'Odd' : 'Even') + '">';
	content += '  <div class="freetagObjectName">';
	content += '    <a href="'+item['href']+'">'+item['name']+'</a>';
	content += '  </div>';
	content += '  <div class="freetagObjectType">'+item['type']+'</div>';
	content += '  <div class="freetagObjectDescription">'+item['description']+'</div>';
	content += '</div>';
    }

    if (currentTag && document.getElementById('currentTag1')) {
	document.getElementById('currentTag1').innerHTML = currentTag;
    }
    if (currentTag && document.getElementById('currentTag2')) {    
	document.getElementById('currentTag2').innerHTML = currentTag;
    }
    document.getElementById('objectList').innerHTML = content;    

    document.getElementById('ajaxLoading').style.display = 'none';
}

function setObjectType(type, button) {
    objectType = type;
    if (!selectedElement) 
	selectedElement = document.getElementById('typeAll');
    selectedElement.className = 'linkbut';
    button = document.getElementById(button);
    button.className= 'linkbut highlight';
    selectedElement = button;
    listObjects(currentTag);
}



