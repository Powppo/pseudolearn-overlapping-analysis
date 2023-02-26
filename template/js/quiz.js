const checkButton = document.getElementById("check");
const submitButton = document.getElementById("submit");

const failAlert = document.getElementById("fail-alert");
const successAlert = document.getElementById("success-alert");

checkButton.addEventListener("click", function () {
  failAlert.classList.toggle("show");
});

submitButton.addEventListener("click", function () {
  successAlert.classList.toggle("show");
});
