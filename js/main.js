window.onresize = function () {
  if (
    window.innerWidth <= 575.98 &&
    document.getElementsByTagName("NAV")[0] == null
  ) {
    const template =
      '<div class="container"><div class="d-flex justify-content-around py-3 w-100"><a href="index" ><i class="fa fa-home text-secondary fa-lg"></i></a><a href="m-index"><i class="fa fa-heart text-secondary fa-lg"></i></a><a href="m-trades"><img src="img/trade.png" alt=""></a><a href="profile"><i class="fa fa-user text-secondary fa-lg"></i></a><a href="notifications"><i class="fa fa-bell text-secondary fa-lg"></i></a></div></div>';
    const node = document.createElement("nav");
    node.setAttribute("id", "mobile-nav");
    node.innerHTML = template;
    document.getElementsByTagName("BODY")[0].appendChild(node);
  } else if (
    window.innerWidth > 575.98 &&
    document.getElementsByTagName("NAV")[0] != null
  ) {
    const node = document.getElementById("mobile-nav");
    node.parentNode.removeChild(node);
  }
};

window.onload = function () {
  if (
    window.innerWidth <= 575.98 &&
    document.getElementsByTagName("NAV")[0] == null
  ) {
    const template =
      '<div class="container"><div class="d-flex justify-content-around py-3 w-100"><a href="index" ><i class="fa fa-home text-secondary fa-lg"></i></a><a href="m-index"><i class="fa fa-heart text-secondary fa-lg"></i></a><a href="m-trades"><img src="img/trade.png" alt=""></a><a href="profile"><i class="fa fa-user text-secondary fa-lg"></i></a><a href="notifications"><i class="fa fa-bell text-secondary fa-lg"></i></a></div></div>';
    const node = document.createElement("nav");
    node.setAttribute("id", "mobile-nav");
    node.innerHTML = template;
    document.getElementsByTagName("BODY")[0].appendChild(node);
  }
  var fadeTarget = document.getElementById("preloader");
  var fadeEffect = setInterval(function () {
    if (!fadeTarget.style.opacity) {
      fadeTarget.style.opacity = 1;
    }
    if (fadeTarget.style.opacity > 0) {
      fadeTarget.style.opacity -= 0.1;
    } else {
      clearInterval(fadeEffect);

      fadeTarget.remove();

      var element = document.getElementById("pop-up");
      if (element) {
        element.classList.add("open");
      }
    }
  }, 50);
};

function menuToggle() {
  const toggleMenu = document.querySelector(".menu");
  toggleMenu.classList.toggle("active");
}
2;

function closePopUpMenu() {
  var element = document.getElementById("pop-up");
  element.classList.remove("open");
  element.parentElement.style.display = "none";
}

// const profile = document.getElementById("profile-card");
// const right = document.getElementById("right");
// const left = document.getElementById("left");
// const primary = document.getElementById("primary-icons");
// const search_bar = document.getElementById("search-bar");
// const search_focus = document.getElementById("search_input");
// const logo = document.getElementById("head-logo");
// const banner = document.getElementById("banner");

// const template = '<nav id="mobile-nav"><div class="container"><div class="d-flex justify-content-around py-3 w-100"><a href="index"><i class="fa fa-home text-secondary fa-lg"></i></a><a href=""><i class="fa fa-heart text-secondary fa-lg"></i></a><a href="trades"><img src="img/trade.png" alt=""></a><a href="profile/degister"><i class="fa fa-user text-secondary fa-lg"></i></a><a href="notifications"><i class="fa fa-bell text-secondary fa-lg"></i></a></div></div></nav>';

//if window is less than 768px then show mobile nav

// $(document).ready(function () {
//   alert("Merhaba");
// $(window).resize(function () {
//   alert("resize");
//     if ($(window).width() <= 575) {
//       $("body").append(template);
//     }
//   })
// });
// function ogren() {
//   banner.src = "img/ogren.png";
// }
// function ogret() {
//   banner.src = "img/ogret.svg";
// }

// var password = document.getElementById("password"),
//   confirm_password = document.getElementById("confirm_password");

// function validatePassword() {
//   if (password.value != confirm_password.value) {
//     confirm_password.setCustomValidity("Passwords Don't Match");
//   } else {
//     confirm_password.setCustomValidity("");
//   }
// }

// password.onchange = validatePassword;
// confirm_password.onkeyup = validatePassword;
