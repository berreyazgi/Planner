const loginBtn = document.querySelector("#login");
const registerBtn = document.querySelector("#register");
const loginForm = document.querySelector(".login-form");
const registerForm = document.querySelector(".register-form");

loginBtn.addEventListener("click", () => {
  loginForm.style.backgroundColor= "transparent";
  registerForm.style.backgroundColor="rgba(255, 255, 255, 0.3)";

  loginForm.style.left ="50%";
  registerForm.style.left ="-50%";

  loginForm.style.opacity = 1;
  registerForm.style.opacity = 0;
});

registerBtn.addEventListener("click", () => {
  loginForm.style.backgroundColor= "rgba(255, 255, 255, 0.3)";
  registerForm.style.backgroundColor="transparent";

  loginForm.style.left ="150%";
  registerForm.style.left ="50%";

  loginForm.style.opacity = 0;
  registerForm.style.opacity = 1;
});