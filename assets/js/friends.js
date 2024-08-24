const Blocks = {
    "friends": (username, name) => {
        return `
        <div class="friend">
                <h1 class="friend-name"> ${name} </h1>
                <div class="friend-btns">
                    <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="deleteFriend(this);" >❎</button>
                </div>
        </div>
            `;
    },
    "requestsFrom": (username, name) => {
        return `
        <div class="requestFrom">
            <h1 class="friend-name">${name}</h1>
            <div class="friend-btns">
                <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="deleteRequestFor(this);">❎</button>
            </div>
        </div>
        `
    },
    "requestFor": (username, name) => {
        return `
        <div class="requestFrom">
            <h1 class="friend-name">${name}</h1>
            <div class="friend-btns">
                <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="submitRequestFrom(this);">✅</button>
            </div>
        </div>
        `
    }
}

function displayFriends() {
    if (dataFromBackend !== undefined) {
        console.log(dataFromBackend);

        dataFromBackend.friends.forEach(friend => {
            $('#friends').append(Blocks.friends(friend.username, friend.name))
        });
        dataFromBackend.requestsFor.forEach(element => {
            $('#for-me-req').append(Blocks.requestFor(element.username, element.name))
        })

        dataFromBackend.requestsFrom.forEach(element => {
            $('#my-req').append(Blocks.requestsFrom(element.username, element.name))
        });
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
            if (response == 'successfully') {
                window.location.reload();
            }
        }
    });
}