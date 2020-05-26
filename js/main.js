
var chat = {};
var chatInterval;


    btns =  document.getElementsByClassName('button_list');
    
    for(var i = 0; i<btns.length; i++){
        btns[i].addEventListener('click', fun);
    }

    function fun(){
        if(chatInterval!==null)
            clearInterval(chatInterval);
        callbackTester (getdata, this.value);
        entry = document.querySelector('.entry');
        entry.onkeydown = e => {
        if(e.keyCode == 13 && e.shiftKey === false){
            throwMessage(entry.value, this.value);
            e.preventDefault();
        }
        };
        
        chatInterval = setInterval(getdata, 5000, this.value);
    }
    

function getdata(usrTo){
    var request = new XMLHttpRequest();
    request.open('POST', '../kom/chatt.php');
    request.onload = function(){
        document.querySelector('.messages').innerHTML = request.responseText;
        var messagescon = document.querySelector('.messages');
        messagescon.scrollTop = messagescon.scrollHeight - messagescon.clientHeight;

    }
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send('method=fetch&usrTo=' + usrTo);

}


function callbackTester (callback) {
    callback (arguments[1]);
}




function throwMessage(message, usrTo){
    if(message !== null && message.trim().length != 0){
        var request = new XMLHttpRequest();
        request.open('POST', '../kom/chatt.php');
        request.onload = function(){
            callbackTester (getdata, usrTo); //refresh
            entry.value = '';

        }

        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send('method=throw&message=' + message + "&usrTo=" + usrTo);
    }
}


