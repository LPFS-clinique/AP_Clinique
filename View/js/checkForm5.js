let ageUser;

document.addEventListener("DOMContentLoaded", function () {
  ageUser = parseInt(document.getElementById("ageUser").value);
});

function DivLivretFam() {
  if (ageUser > 18) {
    document.getElementById("div_livret_famille").classList.add("hidden");
  }
}
