function isValid() {
  input = document.getElementById("Search_bar").value;
  if (input === "") {
    document.getElementById("Search_bar_error").innerHTML =
      "Search box cannot be empty";
    return false;
  } else {
    return true;
  }
}
function unbanUser(username) {
    const confirmUnban = confirm("Are you sure you want to unban " + username + "?");

    if (confirmUnban) {
      alert(username + " has been unbanned.");
    } else {
      alert("Unban cancelled.");
    }
  }
