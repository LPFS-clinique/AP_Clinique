document.addEventListener("DOMContentLoaded", function () {
  const dateNaissanceInput = document.getElementById("date_naissance_pt");
  dateNaissanceInput.addEventListener("change", function () {
    const currentDate = new Date();
    const inputDate = new Date(this.value);
    if (isNaN(inputDate)) return;

    if (inputDate > currentDate) {
      alert("La date de naissance doit être antérieur à aujourd'hui");
      this.value = "";
    }
  });
});

function limitLength(obj, maxLength) {
  if (obj.value.length > maxLength) {
    obj.value = obj.value.slice(0, maxLength);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("divNomEpouse").style.display = "none";

  document
    .getElementById("civilite_pt")
    .addEventListener("change", function () {
      var selectedValue = this.value;

      if (Number(selectedValue) === 1) {
        document.getElementById("divNomEpouse").style.display = "none";
      } else {
        document.getElementById("divNomEpouse").style.display = "block";
      }
    });
});
