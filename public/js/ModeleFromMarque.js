console.log("ok");
const marque = document.querySelector("#car_marque");
console.log(marque);
marque.addEventListener("change", function () {
  console.log("ok");
  let form = document.querySelector(".container >form");
  let data = this.name + " = " + this.value;

  fetch(form.action, {
    method: form.getAttribute("method"),
    body: data,
    headers: {
      "Content-Type": "application/x-www-form-urlencoded;charset:utf-8",
    },
  })
    .then((response) => response.text())
    .then((html) => {
      let content = document.createElement("html");
      content.innerHTML = html;

      let nouveauSelect = content.querySelector("#car_modele");

      document.querySelector("#car_modele").replaceWith(nouveauSelect);
    });
});
