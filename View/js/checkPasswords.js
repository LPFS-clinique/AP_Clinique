let newPasswordInput = document.getElementById("newPassword");
let repeatNewPasswordInput = document.getElementById("repeatNewPassword");
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
    console.log("Les mots de passe ne correspondent pas.");
    updatePasswordConditions(newPasswordInput.value);
    return false;
  }
  return true;
}

function checkCaptcha() {
  if (captchaInput.value.length === 5) {
    console.log("Captcha valide.");
    return true;
  } else {
    console.log("Captcha invalide.");
    return false;
  }
}

function updateSubmitButton() {
  const isPasswordsValid = checkPasswords();
  const isCaptchaValid = checkCaptcha();
  const submitButton = document.getElementById("submitButton");
  console.log("pwdvalid = " + isPasswordsValid);
  console.log(isCaptchaValid);
  if (isPasswordsValid && isCaptchaValid) {
    submitButton.removeAttribute("disabled");
  } else {
    submitButton.setAttribute("disabled", "true");
  }
}

newPasswordInput.addEventListener("input", updateSubmitButton);
repeatNewPasswordInput.addEventListener("input", updateSubmitButton);
captchaInput.addEventListener("input", updateSubmitButton);
