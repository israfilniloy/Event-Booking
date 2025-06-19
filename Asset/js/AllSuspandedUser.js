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

