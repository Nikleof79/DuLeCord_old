function AfterAjax(data) {
    $('#user-name').text(data['login-data'].name);
    $('#user-username').text(data['login-data'].username);
}
$('.changer-theme').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",   
        url: "/handlers/api/change_settings.php",
        data: {
                "theme":$(this).attr('dulecord-theme')
        },
        dataType: "text",
        success: function (response) {
            if (response === 'succesfully') {
                window.location.reload();
            }
        },
        error: function(xhr, status, error) { 
            console.error(`Xhr : ${xhr} ; Status : ${status} ; \n error`);
            alert("Theres some troubles on our server , try again later")
         }
    });
})

