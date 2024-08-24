const Blocks = {
    "friends":(username,name) =>{
        return `
        <div class="friend">
                <h1 class="friend-name"> ${name} </h1>
                <div class="friend-btns">
                    <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="deleteFriend(this);" >❎</button>
                </div>
        </div>
            `;
    },
    "requestsFrom":(username,name)=>{
        return `
        <div class="requestFrom">
            <h1 class="friend-name">${name}</h1>
            <div class="friend-btns">
                <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="submitRequestFrom(this);">✅</button>
                <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="deleteRequestFrom(this);">❎</button>
            </div>
        </div>
        `
    },
    "requestFor":(username,name)=> {
        return `
        <div class="requestFrom">
            <h1 class="friend-name">${name}</h1>
            <div class="friend-btns">
                <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="declineRequestFor(this);">❎</button>
            </div>
        </div>
        `
    }
}

function displayFriends(){
    if (dataFromBackend !== undefined) {
        dataFromBackend.friends.forEach(friend => {
            $('#friends').append(Blocks.friends(friend.username, friend.name))
        })
        dataFromBackend.request["for"].forEach(request => {
            $('#for-me-req').append(Blocks.requestFor(request.username, request.name))
        })

        dataFromBackend.request.from.forEach(request => {
            $('#my-req').append(Blocks.requestFor(request.username, request.name))
        })
    }
}

function deleteFriend(button) {
    let username = button.getAttribute('dulecord-target');
    $.ajax({
        type: "POST",
        url: "/handlers/api/delete_friend.php",
        data: {
            'target_username':username
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            if (response === 'successfully'){
                window.location.reload();
            }
        }
    });
}