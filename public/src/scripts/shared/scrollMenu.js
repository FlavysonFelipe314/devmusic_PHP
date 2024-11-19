const scrollMenuDesktop = () => {
  let menu = document.getElementById("lateral-menu-desktop");
  let triggerHidden = document.getElementById("trigger-hidden");
  let contentBody = document.getElementById("content-body");

  triggerHidden.addEventListener("click", () => {
    if (menu.classList.contains("hidden")) {
      menu.classList.remove("hidden");
      contentBody.classList.remove("remove");
    } else {
      menu.classList.add("hidden");
      contentBody.classList.add("remove");
    }
  });
};

const scrollMenuMobile = () => {
  let menu = document.getElementById("lateral-menu-mobile");
  let triggerOpen = document.getElementById("trigger-open");
  let triggerClose = document.getElementById("trigger-close");

  triggerOpen.addEventListener("click", () => {
    menu.classList.add("open");
  });

  triggerClose.addEventListener("click", () => {
    menu.classList.remove("open");
  });
};

scrollMenuDesktop();
scrollMenuMobile();
s;
