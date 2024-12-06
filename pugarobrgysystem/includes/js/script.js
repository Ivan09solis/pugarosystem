const inputs = document.querySelectorAll(".otp-field > input");
const button = document.querySelector(".verify");

// Automatically focus the first input field on page load
window.addEventListener("load", () => inputs[0].focus());

// Disable the verify button initially
button.setAttribute("disabled", "disabled");

// Handle OTP paste event
inputs[0].addEventListener("paste", function (event) {
  event.preventDefault();

  const pastedValue = (event.clipboardData || window.clipboardData).getData("text");
  const otpLength = inputs.length;

  for (let i = 0; i < otpLength; i++) {
    if (i < pastedValue.length) {
      inputs[i].value = pastedValue[i];
      inputs[i].removeAttribute("disabled");
      inputs[i].focus(); // Fix: Ensure focus is set correctly
    } else {
      inputs[i].value = ""; // Clear remaining inputs
      inputs[i].setAttribute("disabled", true);
    }
  }
});

// Handle keyup event for each input field
inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
    const currentInput = input;
    const nextInput = input.nextElementSibling;
    const prevInput = input.previousElementSibling;

    // If input is more than one character, reset it
    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }

    // Move to the next input if current is filled
    if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
      nextInput.removeAttribute("disabled");
      nextInput.focus(); // Ensure the next input gets focus
    }

    // Handle Backspace: Move focus to previous input and disable it
    if (e.key === "Backspace") {
      if (prevInput) {
        prevInput.focus(); // Focus previous input
        prevInput.setAttribute("disabled", true);
        prevInput.value = ""; // Clear the value
      }
    }

    // Enable verify button only if all OTP inputs are filled
    button.classList.remove("active");
    button.setAttribute("disabled", "disabled");

    const inputsNo = inputs.length;
    if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
      button.classList.add("active");
      button.removeAttribute("disabled");
      return;
    }
  });
});
