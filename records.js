document.addEventListener("submit", (e) => {
  e.preventDefault();
  // Check if the form is the #adminForm
  if (e.target.closest("#recordsInput")) {
    const adminForm = e.target.closest("#recordsInput");
    const formData = new FormData(adminForm);

    // Validate Theory Marks
    const theoryMarks = document.querySelectorAll('.theory');
    for (let marks of theoryMarks) {
      if (!checkMarks(marks.value, "theory")) {
        alert("Please enter valid Theory Marks (0 - 80)");
        return;
      }
    }

    // Validate Practical Marks
    const practicalMarks = document.querySelectorAll('.practical');
    for (let marks of practicalMarks) {
      if (!checkMarks(marks.value, "practical")) {
        alert("Please enter valid Practical Marks (0 - 20)");
        return;
      }
    }

    // Submit form data via fetch API
    fetch("storeRecords.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "success") {
          alert("Records added successfully");
        } else {
          alert(data);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred while submitting the form.");
      });
  }
});

function checkMarks(marks, type) {
  const markValue = parseInt(marks, 10);

  // Ensure marks is a valid number
  if (isNaN(markValue)) {
    return false;
  }

  switch (type) {
    case "theory":
      return markValue >= 0 && markValue <= 80;

    case "practical":
      return markValue >= 0 && markValue <= 20;

    default:
      return false;
  }
}

