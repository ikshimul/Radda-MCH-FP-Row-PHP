$(document).ready(function(){
    $("#search_key").autocomplete({
        source:"user_search.php"
    });
});