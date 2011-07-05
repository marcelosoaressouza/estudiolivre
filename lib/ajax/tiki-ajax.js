function loadComponent(url, template, htmlelement) {
    xajaxRequestUri = url;
    xajax_loadComponent(template, htmlelement);      
}

/*
xajax.loadingFunction = function() {
    document.getElementById('topMenuLoading').style.display = "inline";
};

xajax.doneLoadingFunction = function() {
    document.getElementById('topMenuLoading').style.display = "none";
};

*/
