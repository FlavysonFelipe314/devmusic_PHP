const scrollBanner = () => {
  const bannerContent = document.querySelector(".banner-content");

  function scrollRight() {
    bannerContent.scrollLeft += 220;
  }

  function scrollLeft() {
    bannerContent.scrollLeft -= 220;
  }
  document
    .getElementById("scroll-right")
    .addEventListener("click", scrollRight);
  document.getElementById("scroll-left").addEventListener("click", scrollLeft);
};

scrollBanner();
