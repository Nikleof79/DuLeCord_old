const Blocks = {
    "friends":(username) =>{
        return `
        <div class="friend">
                <h1 class="friend-name"> ${username} </h1>
                <div class="friend btns">
                    <button class="friend-btn smile-font friend-deleter" dulecord-target="${username}"  onclick="deleteFriend(this);" >❎</button>
                </div>
        </div>
            `;

    }
}