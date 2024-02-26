document.getElementById("formulaire").addEventListener("submit", (e)=> {
    e.preventDefault();
    // Si tu veux que le form s'envoie
    return true;
    
    // Sinon si y'a un problème
    return false;
})