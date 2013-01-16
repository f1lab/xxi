function chek(){
	$.getJSON("orders/comment/unread", 
		function (data){
        // console.log(data);
        if(data.countUnreadedTickets > 0){
                var n = window.webkitNotifications.createNotification(
                        "http://xxi.lan/img/new.png",
                        "Новых комментариев " + data.countUnreadedTickets,
                        ""
                        );
                
                n.ondisplay = function() {
                setTimeout(function () {n.cancel();}, 20000);
                };
                n.onclick = function(){
                              window.open("http://xxi.lan");
                              n.cancel();     
                            }
                n.show();
        }   
    }
    
  )
}

if (window.webkitNotifications.checkPermission() == 0){
var timerId = setInterval("chek()", 60000);
}
else{
 console.log("Notifications not supported!");
 var p = window.webkitNotifications.requestPermission();
}
