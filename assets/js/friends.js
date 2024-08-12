function getFriends(){
    $.ajax({
        type: "POST",
        url: "/handlers/api/get_friends.php",
        data: {
            "target": "GetFriends"
        },
        dataType: "json",
        success: function (response) {
            if (response.friends === [null]) {
                $("#friends").html("You have no friends ♿");
            } else {
                response.friends.forEach(element => {
                    console.log(element)
                    if (element.requester == response.user_data.username) {
                        $('#friends').html($('#friends').html() + element.reciver);
                        console.log(element.reciver)
                    }else{
                        $('#friends').html($('#friends').html() + element.requester);
                        console.log(element.requester)
                    }
                })
            }
        }
    })
}

$(document).ready(function(){
    getFriends();
})