const toogleOptions = () => {
  let cadastrarTrigger = document.getElementById("cadastrar-trigger");
  let cadastrarTriggerMobile = document.getElementById(
    "cadastrar-trigger-mobile"
  );

  let cadastrarBox = document.getElementById("cadastrar-box");
  let cadastrarBoxMobile = document.getElementById("cadastrar-box-mobile");

  cadastrarTrigger.addEventListener("click", () => {
    if (cadastrarBox.classList.contains("apareceBox")) {
      cadastrarBox.classList.remove("apareceBox");
    } else {
      cadastrarBox.classList.add("apareceBox");
    }
  });

  cadastrarTriggerMobile.addEventListener("click", () => {
    if (cadastrarBoxMobile.classList.contains("apareceBoxMobile")) {
      cadastrarBoxMobile.classList.remove("apareceBoxMobile");
    } else {
      cadastrarBoxMobile.classList.add("apareceBoxMobile");
    }
  });
};

toogleOptions();
