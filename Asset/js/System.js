function PromoForm_Validation() {
  const promoCode = document.getElementById("promoCode").value.trim();
  const expireDate = document.getElementById("expireDate").value;
  const discount = document.getElementById("discount").value;

  let errorMsg = "";

  if (promoCode === "") {
    errorMsg = "Promo code is required";
  } else if (expireDate === "") {
    errorMsg = "Expire date is required";
  } else if (discount === "" || discount < 0 || discount > 100) {
    errorMsg = "Discount must be a number between 0 and 100";
  }

  if (errorMsg !== "") {
    document.getElementById("errorMessage").innerText = errorMsg;
    return false; 
  }
  return true; 
}
function VenueForm_Validation() {
  const venueName = document.getElementById("venueName").value.trim();
  const capacity = document.getElementById("capacity").value;
  const location = document.getElementById("location").value.trim();

  let errorMsg = "";

  if (venueName === "") {
    errorMsg = "Venue name is required";
  } else if (capacity === "" || capacity < 1) {
    errorMsg = "Capacity must be at least 1";
  } else if (location === "") {
    errorMsg = "Location is required";
  }

  if (errorMsg !== "") {
    document.getElementById("venueErrorMessage").innerText = errorMsg;
    return false; 
  }

  return true; 
}
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