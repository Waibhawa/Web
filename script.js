document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("adminForm");
  const studentForm = document.getElementById("studentForm");
  const loginSection = document.getElementById("login-section");
  const adminPortal = document.getElementById("admin-portal");
  const loginMessage = document.getElementById("loginMessage");
  const resultDiv = document.getElementById("result");

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    let formData  = new FormData(loginForm);
    console.log(formData);
    fetch("adminlogin.php", {
      method: "POST",
      body: formData,
    }).then((response) => response.text()).then((data) => {

      if(data === "success"){
        window.location.href = "recordsInput.php"
      }else{
        alert("error");
      }
    })
  });



    })
    