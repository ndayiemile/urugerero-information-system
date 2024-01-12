// btn click effects
let btnClickElements = document.querySelectorAll(".btn-click");
btnClickElements.forEach((btn) => {
  btn.addEventListener("mousedown", () => {
    // look for an active
    btnClickElements.forEach((element) => {
      if (element.classList.contains("bg-light-green")) {
        element.classList.replace("bg-light-green", "bg-white");
      }
    });
    // btn.classList.remove('shadow-sm')
  });
  btn.addEventListener("mouseup", () => {
    // btn.classList.add('shadow-sm')
    btn.classList.replace("bg-white", "bg-light-green");
  });
});

function isLoggedIn() {
  console.log(getCookie("userId"));
  if (getCookie("userId") != null) {
    return true;
  } else {
    if (DEBUGMODE) {
      console.log(document.cookie);
      console.log(getCookie("userId"));
      return false;
    } else {
      return false;
    }
  }
}

function styleTopNav() {
  let topNav = ObjectId("top-nav");
  let cohortSection = ObjectId("cohort-section");
  document.onscroll = () => {
    if (cohortSection.getClientRects()[0].top < 66) {
      if (!topNav.classList.contains("shadow")) {
        topNav.classList.add("shadow");
      }
    } else {
      if (topNav.classList.contains("shadow")) {
        topNav.classList.remove("shadow");
      }
    }
  };
}
styleTopNav();
