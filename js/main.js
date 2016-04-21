var lastTimeID = 0;
var total = document.getElementById('total').value;
var count=0;
$(document).ready(function() {
  $('#btnSend').click( function() {
    sendChatText();
    
  });
  startChat();
});

function startChat(){
  
}

function getChatText(a) {
  var path="/online game";	
  var ans=document.getElementById(a).value;
  window.alert(a+" "+ans);
  $.ajax({
    type: "GET",
    url: path + "/getAns.php?id="+a+"&ans="+ans
  }).done( function( data )
  {
	  
	  if(data=="true")
	  {
		  window.alert(data);
		  document.getElementById(a).readOnly = true;
		  document.getElementById('b'+a).disabled = true;
		  count=count+1;
		  if(count == total)
	  {
		  document.getElementById('submit').disabled = false;
		  }
		  }
		  else
		  {
	  window.alert(data);
			  document.getElementById(a).value="";
			  }
  });
}

function sendChatText(){
  var chatInput = $('#chatInput').val();
  var path="/chat app";
  if(chatInput != ""){
  
    $.ajax({
      type: "GET",
      url: path + "/submit.php?chattext=" + encodeURIComponent( chatInput )
    });
	
  }
}


function nextLevel(){
  window.alert("asd");
  var path="/online game";
     $.ajax({
      type: "GET",
      url: path + "/nextLevel.php"
    });
	
  
}