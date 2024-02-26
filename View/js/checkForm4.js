function validerDonneesFormulaire() {
  var nom = document.getElementById("nom_p1").value;
  var prenom = document.getElementById("prenom_p1").value;
  var adresse = document.getElementById("adresse_p1").value;
  var codePostal = document.getElementById("codePostal_p1").value;
  var ville = document.getElementById("ville_p1").value;
  var numTel = document.getElementById("num_tel_p1").value;

  var nom = document.getElementById("nom_p2").value;
  var prenom = document.getElementById("prenom_p2").value;
  var adresse = document.getElementById("adresse_p2").value;
  var codePostal = document.getElementById("codePostal_p2").value;
  var ville = document.getElementById("ville_p2").value;
  var numTel = document.getElementById("num_tel_p2").value;

  if (
    nom.length > 50 ||
    prenom.length > 50 ||
    adresse.length > 50 ||
    codePostal.length > 5 ||
    ville.length > 85 ||
    numTel.length > 15
  ) {
    alert("Les données saisies ne respectent pas les formats requis.");
    return false;
  }
  return true;
}

function limitLength(obj, maxLength) {
  if (obj.value.length > maxLength) {
    obj.value = obj.value.slice(0, maxLength);
  }
}

document.querySelector("form").onsubmit = function (event) {
  var codePostal = document.querySelector("code_postal_p1").value;
  var regex = /^[0-9]{5}$/;
  if (!regex.test(codePostal)) {
    alert("Veuillez entrer un code postal valide.");
    event.preventDefault();
  }
};

document.querySelector("form").onsubmit = function (event) {
  var codePostal = document.querySelector("code_postal_p2").value;
  var regex = /^[0-9]{5}$/;
  if (!regex.test(codePostal)) {
    alert("Veuillez entrer un code postal valide.");
    event.preventDefault();
  }
};

document.querySelector("form").onsubmit = function (event) {
  var numTel = document.querySelector("num_tel_p1").value;
  var regex = /^[0-9]{10}}$/;
  if (!regex.test(numTel)) {
    alert("Veuillez entrer un numéro de téléphone valide.");
    event.preventDefault();
  }
};

document.querySelector("form").onsubmit = function (event) {
  var numTel = document.querySelector("num_tel_p2").value;
  var regex = /^[0-9]{10}}$/;
  if (!regex.test(numTel)) {
    alert("Veuillez entrer un numéro de téléphone valide.");
    event.preventDefault();
  }
};
