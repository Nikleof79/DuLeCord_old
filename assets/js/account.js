function AfterAjax(data) {
    $('#user-name').text(data['login-data'].name);
}
