let newPasswordInput = document.getElementById("newPassword");
let repeatNewPasswordInput = document.getElementById("repeatNewPassword");
let submitButton = document.getElementById("submitButton");
let captchaInput = document.getElementById("captcha");

let errorDiv = document.createElement("div");
errorDiv.className = "text-red-600 mt-2";
errorDiv.id = "passwordError";

let successDiv = document.createElement("div");
successDiv.className = "text-green-600 mt-2";
successDiv.id = "passwordSuccess";

function isValidPassword(password) {
  const minLength = 16;
  const maxLength = 30;
  const regex =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{16,30}$/;

  return (
    regex.test(password) &&
    password.length >= minLength &&
    password.length <= maxLength
  );
}

function updatePasswordConditions(password) {
  document.getElementById("condition-length").style.color =
    password.length >= 16 && password.length <= 30 ? "green" : "red";
  document.getElementById("condition-lowercase").style.color = /[a-z]/.test(
    password
  )
    ? "green"
    : "red";
  document.getElementById("condition-uppercase").style.color = /[A-Z]/.test(
    password
  )
    ? "green"
    : "red";
  document.getElementById("condition-digit").style.color = /\d/.test(password)
    ? "green"
    : "red";
  document.getElementById("condition-specialchar").style.color =
    /[@$!%*?&]/.test(password) ? "green" : "red";
}

function checkPasswords() {
  if (newPasswordInput.value !== repeatNewPasswordInput.value) {
    submitButton.disabled = true;
    errorDiv.innerText = "Les mots de passe ne correspondent pas.";
    if (!document.getElementById("passwordError")) {
      repeatNewPasswordInput.parentNode.appendChild(errorDiv);
    }
  } else {
    submitButton.disabled = !isValidPassword(newPasswordInput.value);
    if (document.getElementById("passwordError")) {
      errorDiv.remove();
    }
  }
  updatePasswordConditions(newPasswordInput.value);
}

captchaInput.addEventListener("input", function () {
  submitButton.disabled =
    this.value.length !== 5 || !isValidPassword(newPasswordInput.value);
});

newPasswordInput.addEventListener("input", checkPasswords);
repeatNewPasswordInput.addEventListener("input", checkPasswords);
