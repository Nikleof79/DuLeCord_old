function AfterAjax(data) {
    $('#user-name').text(data['login-data'].name);
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
            console.log(response);
            
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

