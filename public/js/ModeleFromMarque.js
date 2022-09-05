window.onload = () => {
  let marque = document.querySelector("#annonces_marque");
  marque.addEventListener("change", function () {
    let form = document.querySelector("form");
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

        let nouveauSelect = content.querySelector("#annonces_modele");

        document.querySelector("#annonces_modele").replaceWith(nouveauSelect);
      });
  });
};
