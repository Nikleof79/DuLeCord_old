$.ajax({
    type: "POST",
    url: "/handlers/api/friends.php",
    data: {
        "target": "GetFriends"
    },
    dataType: "json",
    success: function (response) {
        for (const element of response) {
            $("#friends").html($("#friends").html() + `
            <div>
                <h1> ${element.name} </h1>
            </div>
            `)
        }
            console.log(response)
    }
})