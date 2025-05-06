const chatBoxSender = "<div class='sender'><div class='senderBoxMessage'><p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p></div></div>";
const chatBoxReceiver = 0;
//Get's the data/messages that we have to display, can be done with php but it's better for smooth experience

function loadMessages(){
    
}



function getPersonDetails(user_ID){
    $.ajax({
        type : "POST",
        url : "chatPage.php",
        data : {userID : user_ID},
        success : alert("It is done")
    });
}

function getPersonFullName() {
    $.ajax({
        type : "GET",
        url: "chatPage.php",
        dataType: "html",

    })
}