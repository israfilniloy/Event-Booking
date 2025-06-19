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

function deleteUser() {
  const confirmed = confirm(
    "⚠️ Are you sure you want to permanently delete this user? This action cannot be undone."
  );
  if (confirmed) {
    console.log("User deleted permanently.");
    alert("User has been permanently deleted.");
  }
}
