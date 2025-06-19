function isValidSearch() {
  SearchedIteam = document.getElementById("search-input").value;
  if (SearchedIteam === "") {
    document.getElementById("errorMessage").innerHTML =
      "Search field cannot be empty!";
    return false;
  } else {
    return true;
  }
}
function isValidEmail() {
  const email = document.getElementById("newsletter-input").value;
  const errorElement = document.getElementById("EmailError");

  if (!email.includes("@") || !email.includes(".")) {
    errorElement.innerHTML = "**Please enter a valid email address.**";
    return false;
  }

  const parts = email.split("@");
  if (parts.length !== 2) {
    errorElement.innerHTML = "**Please enter a valid email address.**";
    return false;
  }

  const username = parts[0];
  const domain = parts[1];
  if (local.length === 0 || domain.length < 3) {
    errorElement.innerHTML = "**Please enter a valid email address.**";
    return false;
  }

  const domainParts = domain.split(".");
  if (domainParts.length < 2 || domainParts.some((part) => part.length === 0)) {
    errorElement.innerHTML = "**Please enter a valid email address.**";
    return false;
  }

  errorElement.innerHTML = "";
  return true;
}

