const Blocks = {
  friend: (username, name, hasAvatar) => {
    let avatar_path;
    // =hasAvatar ? 'assets/img/account_logo.png' : 'avatars/' + username + '.jpg';
    if (hasAvatar == "1") {
      avatar_path = "avatars/" + username + ".jpg";
    } else {
      avatar_path = "assets/img/account_logo.png";
    }
    return `
        <a href='/index.php?intercultor=${username} ' class="friend">
            <img src= "${avatar_path}"  alt="${html_to_string(name)}" class="friend-avatar">
            <h1 class="friend-name">${html_to_string(name)}</h1>
        </a>        
        `;
  },
};


var intercultor = undefined;

async function AfterAjax(response) {
  // console.log(response);

  if (response.friends !== null) {
    response.friends.forEach((element) => {
      // console.log(element);
      $("#friends").append(
        Blocks.friend(element.username, element.name, element.hasAvatar)
      );
    });
  } else {
    $("#friends").html("YOU HAVE NO FRIENDS 😭😭😭😭♿♿♿♿");
  }
  if (window.location.href.split("").indexOf("?") > 0) {
    $(".textarea-element").removeAttr("disabled");
    $(".intercultor-header-data").css("display", " block");
    let intercultor_username = window.location.href.split("intercultor=")[1];
    // console.log(intercultor_username);
    $.ajax({
      type: "POST",
      url: "/handlers/api/get_info_about.php",
      data: {
        'target': intercultor_username
      },
      dataType: "text",
      success: function (data) {
        const response = JSON.parse(data);
        // console.log(response);
        $('#intercultor-name').text(response.name);
        if (response.hasAvatar == '1') {
          $('#intercultor-avatar').attr('src', `/avatars/${intercultor_username}.jpg`);
        }
        intercultor = {
          'username': intercultor_username,
          'name': response.name
        }
        get_messages(intercultor.username);
        $("#intercultor-full-info").css('display', 'block');
        $('#select-chat-info-text').css('display', ' none');
      }
    });
  } else {
    $(".intercultor-header-data").css("display", " none");
    $("#intercultor-full-info").css('display', ' none');
  }
}

$('#textarea-input').on('input', function () {
  const min_height = 3;
  const max_height = 7;
  let new_height = $('#textarea-input').val().split('\n').length;
  new_height = new_height > min_height ? new_height : min_height;
  new_height = new_height < max_height ? new_height : max_height;
  $('#textarea').height(`${new_height + 0.3}rem`);
  $('#textarea').css('bottom', `${new_height - 3}rem`);
  // console.log(`${new_height}rem`);

});

$('#textarea-submit').click(function (e) {
  e.preventDefault();
  console.log('a');
  // const message_body = $('#textarea-input').val();
  if (intercultor !== undefined) {
    const send_data = {
      'body': $('#textarea-input').val(),
      'reciever': intercultor.username
    }
    $.ajax({
      type: "POST",
      url: "/handlers/api/send_message.php",
      data: send_data,
      dataType: "text",
      success: function (data) {
        const response = JSON.parse(data);
        // console.log(response);
        if (response.result) {
          get_messages(intercultor.username);
        }
      }
    });
  }
});


function get_messages(username) {
  let ret_data = null;
  $.ajax({
    type: "POST",
    url: "/handlers/api/get_messages.php",
    data: {
      intercultor: username
    },
    dataType: "json",
    success: function (data) {
      ret_data = data;
    }
  });

}