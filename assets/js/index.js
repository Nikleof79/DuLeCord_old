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
  message: (isFrom, body, avatar_path) => {
    let isFrom_class = !isFrom ? 'messageByIntercultor' : 'messageByMe';
    return `
      <div class="message ${isFrom_class}">
        <img src="${avatar_path} " alt="" class="senderAvatar">
        <div class="d-inline-block">
          <div class="d-flex align-items-center">
            <p class="messageInner">${html_to_string(body)}</p>
          </div>
        </div>
      </div>
      `
  }
};


var intercultor = undefined;

async function AfterAjax(response) {
  // // console.log(response);

  if (response.friends !== null) {
    response.friends.forEach((element) => {
      // // console.log(element);
      $("#friends").append(
        Blocks.friend(element.username, element.name, element.hasAvatar)
      );
    });
  } else {
    $("#friends").html("YOU HAVE NO FRIENDS 😭😭😭😭♿♿♿♿");
  }
  if (window.location.href.split("").indexOf("?") > 0) {
    // console.log(`url has '?'`);

    //url has '?'
    $(".textarea-element").removeAttr("disabled");
    $(".intercultor-header-data").css("display", " block");
    let intercultor_username = window.location.href.split("intercultor=")[1];
    // // console.log(intercultor_username);
    $.ajax({
      type: "POST",
      url: "/handlers/api/get_info_about.php",
      data: {
        'target': intercultor_username
      },
      dataType: "text",
      success: function (data) {
        const response = JSON.parse(data);
        if (response == null && typeof response == 'object') {
          document.getElementById("intercultor-full-info").style.display = "none";
          for (const key in document.getElementsByClassName("intercultor-header-data")) {
            document.getElementsByClassName("intercultor-header-data").item(key).style.display = "none";
          }
          return;
        }
        // // console.log(response);
        $('#intercultor-name').text(response.name);
        $("#intercultor-info-username").text(response.name);
        if (response.hasAvatar == '1') {
          $('#intercultor-avatar').attr('src', `/avatars/${intercultor_username}.jpg`);
          $('#intercultor-info-avatar').attr('src', `/avatars/${intercultor_username}.jpg`);
        }
        $("#intercultor-info-name").html("@" + intercultor_username);
        if (response.about === null) {
          $("#intercultor-info-about").text(`We don't know nothing about ${response.name}`);
        }else{
          $("#intercultor-info-about").text(`We don't know nothing about ${response.name}`);
        }
        intercultor = {
          'username': intercultor_username,
          'name': response.name,
          'hasAvatar': response.hasAvatar,
          'about':response.about
        };
        $("#intercultor-full-info").css('display', 'flex');
        $('#select-chat-info-text').css('display', ' none');
        get_messages(intercultor.username);
        setInterval(() => {
          get_messages(intercultor.username);
        }, 1500);
      }
    });
  } else {
    // $(".intercultor-header-data").css("display", " none");
    // $("#intercultor-full-info").css('display', ' none');
    document.getElementById("intercultor-full-info").style.display = "none";
    // document.getElementsByClassName("intercultor-header-data").forEach(element=>{ element.style.display = "none"; });
    for (const key in document.getElementsByClassName("intercultor-header-data")) {
      document.getElementsByClassName("intercultor-header-data").item(key).style.display = "none";
    }
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
  // // console.log(`${new_height}rem`);

});

$('#textarea-submit').click(function (e) {
  e.preventDefault();
  $(this).attr('disabled', true);
  const btn = this
  const enableButton = async (btn) => {
    setTimeout(() => {
      $(btn).removeAttr('disabled');
    }, 50)
  }
  enableButton(this);
  // console.log('submit');
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
        // console.log(data);
        const response = JSON.parse(data);
        // console.log(response);
        if (response.result) {
          get_messages(intercultor.username);
        } else {
          alert("NO")
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
    dataType: "text",
    success: function (data) {
      // console.log(data);
      ret_data = JSON.parse(data);
      // console.log(ret_data);
      if (ret_data.status == true) {
        show_messages(ret_data, intercultor);
      } else {
        alert("There's some trouble with getting messages , try again later");
      }
    },
    error: (xhr, status, error) => {
      console.error([xhr, status, error]);
    }
  });
}

async function show_messages(messages, intercultor) {
  $('#messages').html("");
  for (const element in messages) {
    if (element != 'status') {
      let message = messages[element];
      let isFrom = message.requester !== intercultor.username;
      let avatar_path
      // console.log(isFrom);
      if (!isFrom) {
        avatar_path = intercultor.hasAvatar == '1' ? `/avatars/${intercultor.username}.jpg` : `/assets/img/account_logo.png`
      } else {
        avatar_path = DataFromBackend['login-data'].hasAvatar == '1' ? `/avatars/${DataFromBackend['login-data'].username}.jpg` : `/assets/img/account_logo.png`;
      }
      $('#messages').append(
        Blocks.message(isFrom, message.body, `${avatar_path}`)
      );
    }
  }
}


