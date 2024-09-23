const Blocks = {
  friend: (username,name,hasAvatar) => {
    let avatar_path; 
    // =hasAvatar ? 'assets/img/account_logo.png' : 'avatars/' + username + '.jpg';
    if (hasAvatar == '1') {
        avatar_path = 'avatars/' + username + '.jpg';
    } else {
        avatar_path = 'assets/img/account_logo.png';            
    }
    return `
        <a href='/index.php?intercultor=${username} ' class="friend">
            <img src= "${avatar_path}"  alt="${name}" class="friend-avatar">
            <h1 class="friend-name">${name}</h1>
        </a>        
        `;
  },
};

function AfterAjax(response) {
    response.friends.forEach(element => {
        console.log(element)
        $('#friends').append(
            Blocks.friend(element.username,element.name,element.hasAvatar)
        );
        
    });
}
