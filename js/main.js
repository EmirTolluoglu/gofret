const profile = document.getElementById("profile-card");
const right = document.getElementById("right");
const left = document.getElementById("left");
const primary = document.getElementById("primary-icons");
const search_bar = document.getElementById("search-bar");
const search_focus = document.getElementById("search_input");
const logo = document.getElementById("head-logo");
const banner = document.getElementById("banner");

function large(respond) {
  if (respond.matches) {
    // If media query matches
    left.appendChild(profile);
    left.insertBefore(profile, left.children[0]);
  } else {
    right.appendChild(profile);
    right.insertBefore(profile, right.children[0]);
  }
}

function small(respond) {
  if (respond.matches) {
    // If media query matches
    logo.src = "img/ico.png";
    logo.width = "36";
    logo.height = "36";
  } else {
    logo.src = "img/gofret.png";
    logo.width = "96";
    logo.height = "36";
  }
}

function helllo() {
  primary.style.display = "none";
  search_bar.style.display = "block";
  search_focus.focus();
}

function focusgg() {
  primary.style.display = "";
  search_bar.style.display = "";
}

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

const lg = window.matchMedia("(max-width: 991.98px)");
const sm = window.matchMedia("(max-width: 575.98px)");
large(lg);
small(sm);
lg.addListener(large);
sm.addListener(small);
