const Blocks = {
    "friends": (username, name) => {
        console.log(username,name)
        return `
        <div class="friend">
                <h3 class="friend-name mb-0" id="${username}" dulecord-name="${name} "></h3>
                <p class="friend-type mb-0">Friend</p>
                <div class="friend-btns">
                    <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="deleteFriend(this);" >❎</button>
                </div>
        </div>
        `;
    },
    "requestsFrom": (username, name) => {
        console.log(username,name)
        return `
        <div class="friend requestFrom">
            <p class="friend-name" id="${username}" dulecord-name="${name} " ></p>
            <p class="friend-type">: requestFrom</p>
            <div class="friend-btns">
                <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="deleteRequestFor(this);">❎</button>
            </div>
        </div>
        `
    },
    "requestFor": (username, name) => {
        console.log(username,name)
        return `
        <div class="friend requestFrom">
            <p class="friend-name" dulecord-name="${name}"></p>
            <p class="friend-type">: requestFor</p>
            <div class="friend-btns">
                <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="submitRequestFrom(this);">✅</button>
            </div>
        </div>
        `
    }
}
var dataFromBackend;
function AfterAjax(x){
    dataFromBackend = x;
    displayFriends();
        $('.friend-name').each(function (){
            let attr = $(this).attr('dulecord-name');
            $(this).text(attr);
        })

}

function displayFriends() {
    if (dataFromBackend !== undefined) {
        console.log(dataFromBackend);

        if (dataFromBackend.friends !== null && dataFromBackend.friends !== undefined) {
            dataFromBackend.friends.forEach(friend => {
                $('#friends').append(Blocks.friends(friend.username, friend.name))
            });
        }
        if (dataFromBackend.requestsFor !== null && dataFromBackend.requestsFor !== undefined){
            dataFromBackend.requestsFor.forEach(element => {
                $('#for-me-req').append(Blocks.requestFor(element.username, element.name))
            })
        }

        if (dataFromBackend.requestsFrom !== null && dataFromBackend.requestsFrom !== undefined){
            console.log(dataFromBackend.requestsFrom)
            dataFromBackend.requestsFrom.forEach(element => {
                $('#my-req').append(Blocks.requestsFrom(element.username, element.name))
            });
        }
    }
}

function deleteFriend(button) {
    let username = button.getAttribute('dulecord-target');
    $.ajax({
        type: "POST",
        url: "/handlers/api/delete_friend.php",
        data: {
            'target_username': username
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            if (response === 'successfully') {
                window.location.reload();
            } else {
                alert('Not successfully 😭');
            }
        }
    });
}

function submitRequestFrom(button) {
    let username = button.getAttribute('dulecord-target');
    $.ajax({
        type: "POST",
        url: "/handlers/api/submit_request.php",
        data: {
            'target_username':username
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            if (response === 'successfully') {
                window.location.reload();
            }else{
                alert('Not successfully 😭');
            }
        }
    });
}