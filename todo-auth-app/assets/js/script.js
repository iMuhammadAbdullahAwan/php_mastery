// Form validation
document.querySelectorAll("form").forEach((form) => {
  form.addEventListener("submit", function (e) {
    const inputs = form.querySelectorAll(
      'input[type="text"], input[type="password"], input[type="date"]'
    );
    let valid = true;
    inputs.forEach((input) => {
      if (input.value.trim() === "") {
        input.style.borderColor = "#b91c1c";
        valid = false;
      } else {
        input.style.borderColor = "#d1d5db";
      }
    });
    if (!valid) {
      e.preventDefault();
      alert("Please fill in all required fields!");
    }
  });
});

// AJAX for task completion
document.querySelectorAll(".complete-task").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const taskId = this.dataset.taskId;
    const xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      `update_task.php?id=${taskId}&csrf_token=${
        document.querySelector('input[name="csrf_token"]').value
      }`,
      true
    );
    xhr.onload = function () {
      if (xhr.status === 200) {
        location.reload();
      } else {
        alert("Error updating task!");
      }
    };
    xhr.send();
  });
});
