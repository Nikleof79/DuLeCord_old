const Blocks = {
    "friends":(username , name) =>{
        return `
        <div class="friend">
                <h1 class="friend-name"> ${name} </h1>
                <div class="friend btns">
                    <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="function() {
                       deleteFriend(this.getAttribute('dulecord-target'));
                    }" >❎</button>
                </div>
        </div>
            `;

    }

}


function displayList(list,user_data,block){
    list.forEach(element => {
        console.log(element)
        if (element.requester === user_data.username) {
            $(block).text($(block).text() + element.reciver);
            console.log(element.reciver)
        }else{
            $(block).text($(block).text() + element.requester);
            console.log(element.requester)
        }
    })
}

function getFriends(){
    $.ajax({
        type: "POST",
        url: "/handlers/api/get_friends.php",
        data: {
            "target": "GetFriends"
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.friends[0] === null) {
                // $("#friends").html("You have no friends ♿");
            }else{
                response.friends.forEach(element => {
                    console.log(element)
                    if (element.requester === response.user_data.username) {
                        $('#friends').html($('#friends').html() + element.reciver);
                        console.log(element.reciver)
                    }else{
                        $('#friends').html($('#friends').html() + element.requester);
                        console.log(element.requester)
                    }
                })
            }
            if (response.requestTo[0] === null){
                // $("#for-me-req").html("No requests");
                console.log('No requests')
            }else{
                $("#for-me-req").html( response.requestTo);
            }
            if (response.requestFrom[0] === null){
                // $("#my-req").html( "You didn't throw requests" );
            }else{
                displayList(response.requestFrom,response.user_data,'#my-req');
            }
        }
    })
}

function deleteFriend(target_username){
    $.ajax({
        type: "POST",
        url: "/handlers/api/deleteFriend.php",
        data: {},
        dataType: "application/json",
        success: function (response) {
            
        }
    });
}
$(document).ready(function(){
    getFriends();
    
})