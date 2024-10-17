// var cssData = {
//   themes: {
//     default:
//         "background: rgb(15,19,53); background: linear-gradient(0deg, rgba(15,19,53,1) 16%, rgba(26,37,137,1) 100%);",
//     aqua: "background: rgb(52,105,207); background: linear-gradient(0deg, rgba(52,105,207,1) 16%, rgba(0,255,224,1) 100%);",
//     grape:
//         "background: rgb(53,21,93); background: linear-gradient(0deg, rgba(53,21,93,1) 0%, rgba(37,15,65,1) 100%);",
//     dark: "background: rgb(34,34,34); background: linear-gradient(0deg, rgba(34,34,34,1) 0%, rgba(17,17,17,1) 100%);",
//   },
// };

const isMobile = matchMedia('(max-width: 1024px)').matches;
var DataFromBackend;
$(document).ready(function () {
  $.ajax({
    type: "POST",
    url: "/handlers/api/get_data.php",
    data: { target: "GetData" },
    contentType: 'text',
    success: function (data) {
      const response = (data);
      $("body").addClass(`${JSON.parse(response.settings).theme}-theme`);
      $(".my-avatar").each(function (index, element) {
        if (response["login-data"].hasAvatar == "1") {
          $(this).attr(
            "src",
            "/avatars/" + response["login-data"].username + ".jpg"
          );
        }
      });
      DataFromBackend = response
      AfterAjax(response);
    },
    error: (jqXHR, textStatus, errorThrown) => {
      console.log(`${errorThrown}`);
    },
  });
});
