document.addEventListener("click", function(e){
  if(e.target.closest(".student-details-row") && !e.target.closest("#deleteRecord")){
  let studentDetailsRow = e.target.closest(".student-details-row");
  let studentId = studentDetailsRow.dataset.id;
  let studentYear = studentDetailsRow.dataset.year;
  let form = new FormData();
  form.append("symbolNo",studentId)
  form.append("year",studentYear)

  fetch("getResults.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "404") {
        alert("No records found");
      }else{
        document.querySelector(".student-info-container").style.display =  "none";
        document.querySelector("#result").innerHTML = data;
        document.querySelector("#backBtn").style.display = "flex";
      }
    });
  }if(e.target.closest("#backBtn")){
    document.querySelector(".student-info-container").style.display =  "block";
        document.querySelector("#result").innerHTML = "";
        document.querySelector("#backBtn").style.display = "none";
  }
  if(e.target.closest(".download-result")){
      // Make a POST request to trigger PDF download
      let downloadBtn = e.target.closest(".download-result")
      let symbolNo = downloadBtn.dataset.studentid
      let year = downloadBtn.dataset.year;
      let form = new FormData();
      form.append("symbolNo",symbolNo)
      form.append("year",year)

      fetch("downloadResult.php", {
        method: 'POST',
        body: form
      })
    .then(response => {
        if (!response.ok) throw new Error('Failed to generate PDF');
        return response.blob();
    })
    .then(blob => {
        //Create a link element
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = 'Student_Result.pdf';
        link.click();

        //Clean up
        window.URL.revokeObjectURL(link.href);
    })
    .catch(error => alert(error.message));
  }
  if(e.target.closest("#deleteRecord")){
    let studentId = e.target.closest("#deleteRecord").dataset.studentid;
    let form = new FormData()
    form.append("studentId",studentId)
    fetch("deleteRecord.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "success") {
          alert("records deleted");
          window.location.reload();
        }
      });
  }
})

document.addEventListener("submit", function(e){
  if(e.target.closest("#studentForm")){
  e.preventDefault();
  let studentForm = e.target;
  let formData = new FormData(studentForm);
  fetch("getResults.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "404") {
        alert("No records found");
      }else{
        document.querySelector("#studentForm").style.display =  "none";
        document.querySelector("#result").innerHTML = data;
        document.querySelector(".form-section").style.display = "none";

      }
    });
  }
})
