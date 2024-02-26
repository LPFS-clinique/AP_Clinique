document.addEventListener('DOMContentLoaded', function() {
    const dateAdmissionInput = document.getElementById('date_admission');
    const medecinSelect = document.getElementById('medecin');


    dateAdmissionInput.addEventListener('input', function() {
        const currentDate = new Date();
        const inputDate = new Date(this.value);

        if (inputDate < currentDate) {
            alert('La date d\'hospitalisation doit être postérieur à aujourd\'hui');
            this.value = '';
        }
    });


    medecinSelect.addEventListener('change', function() {
        if (this.value === 'medecin') {
            alert('Veuillez sélectionner un médecin valide.');
        }
    });
});
