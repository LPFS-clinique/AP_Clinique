document.addEventListener("DOMContentLoaded", function () {
  const numSecu = document.getElementById("num_secu");
  numSecu.addEventListener("input", verifierNumeroSecu);
});

function verifierNumeroSecu() {
  const numSecu = document.getElementById("num_secu").value;
  console.log("Numéro de sécurité sociale: ", numSecu);

  const dateNaissance = document.getElementById("date_naissance").value;
  console.log("DateNaissance: ", dateNaissance);

  const civilite = parseInt(
    document.getElementById("civilite_pt_cache").value,
    10
  );
  console.log("Civilité: ", civilite);

  erreurNumSecu.textContent = "";

  if (numSecu.length !== 15) {
    erreurNumSecu.textContent =
      "La longueur du numéro de sécurité sociale est invalide.";
    return false;
  }

  const civiliteSecu = parseInt(numSecu.substring(0, 1));
  if (civilite === 1 && civiliteSecu !== 1) {
    erreurNumSecu.textContent =
      "L'indication de la civilité dans le champ 'Civilité' ne correspond pas";
    return false;
  }
  if (civilite === 2 && civiliteSecu !== 2) {
    erreurNumSecu.textContent =
      "L'indication de la civilité dans le champ 'Civilité' ne correspond pas";
    return false;
  }

  const anneeNaissance = dateNaissance.substring(2, 4);
  const moisNaissance = dateNaissance.substring(5, 7);
  if (
    numSecu.substring(1, 3) !== anneeNaissance ||
    numSecu.substring(3, 5) !== moisNaissance
  ) {
    erreurNumSecu.textContent =
      "L'indication de la date de naissance dans le champ 'Date de naissance' ne correspond pas";
    return false;
  }

  return true;
}
