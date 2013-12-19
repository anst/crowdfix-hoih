function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

$(function () {
  var idea_id = getUrlVars()["id"];
  $.post("./api.php","id="+idea_id,function(data){
    $("#content").html(data);
  });
  $(document).on('click', '#up',function() { 
    $.post("./vote.php","id="+idea_id+"&"+"mode=1");
    $.post("./api.php","id="+idea_id,function(data){
    $("#content").html(data);
  });
  });
  $(document).on('click', '#down',function() {
    $.post("./vote.php","id="+idea_id+"&"+"mode=0");
    $.post("./api.php","id="+idea_id,function(data){
    $("#content").html(data);
  });
  });
});