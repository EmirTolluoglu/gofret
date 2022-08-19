const profile = document.getElementById("profile-card");
const right = document.getElementById("right");
const left = document.getElementById("left");
const primary = document.getElementById("primary-icons");
const search_bar = document.getElementById("search-bar");
const search_focus = document.getElementById("search_input");
const logo = document.getElementById("head-logo");
const banner = document.getElementById("banner");



function ogren() {
  banner.src = "img/ogren.png";
}
function ogret() {
  banner.src = "img/ogret.svg";
}

var password = document.getElementById("password"),
  confirm_password = document.getElementById("confirm_password");

function validatePassword() {
  if (password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity("");
  }
}




password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;