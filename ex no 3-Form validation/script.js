const regNo = document.getElementById("reg");
const username = document.getElementById("name");
const year = document.getElementById("year");
const email = document.getElementById("email");
const sem = document.getElementById("sem");
const corePeOe = document.getElementById("core/pe/oe");
const subcode = document.getElementById("subcode");
const subname = document.getElementById("subname");
const credit = document.getElementById("credit");
const phone = document.getElementById("phone");
const gender = document.querySelector('input[name="gender"]:checked');

const qualification = document.getElementById("qualification");

const nineDigitRegex = /^\d{9}$/;
const empty = /^$/;
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$/;
const subcodeRegex = /^[a-zA-Z]{2}[\da-zA-Z]{5}$/;
const core = /^[a-zA-Z]{2}\d{5}$/;
const pe = /^[a-zA-Z]{2}[\da-zA-Z]{2}[a-zA-Z][\da-zA-Z]{2}$/;

function handle(event) {
  event.preventDefault();

  if (empty.test(regNo.value)) {
    SetError(regNo, "Register number is required");
  } else if (!nineDigitRegex.test(regNo.value)) {
    SetError(regNo, "Register No must be exactly 9 digits.");
  }

  if (empty.test(username.value)) {
    SetError(username, "Name is required");
  }

  if (empty.test(year.value)) {
    SetError(year, "Year is required");
  }

  if (empty.test(email.value)) {
    SetError(email, "Email is required");
  } else if (!emailRegex.test(email.value)) {
    SetError(email, "Email is not in valid Format");
  }

  if (empty.test(sem.value)) {
    SetError(sem, "semester is required");
  }

  if (empty.test(corePeOe.value)) {
    SetError(corePeOe, "core/pe/oe is required");
  }

  if (empty.test(subcode.value)) {
    SetError(subcode, "subcode is required");
  } else if (corePeOe.value === "core" && !core.test(subcode.value)) {
    SetError(subcode, "subcode  for core is not in correct format");
  } else if (corePeOe.value === "pe" && !pe.test(subcode.value)) {
    SetError(subcode, "subcode  for PE is not in correct format");
  } else if (!subcodeRegex.test(subcode.value)) {
    SetError(subcode, "subcode not in correct format");
  }

  if (empty.test(subname.value)) {
    SetError(subname, "subname is required");
  }

  if (empty.test(credit.value)) {
    SetError(credit, "credit is required");
  }

  if (empty.test(phone.value)) {
    SetError(phone, "phone number is required");
  }
}

function SetError(element, message) {
  const inputGroup = element.parentElement;
  const errorElement = inputGroup.querySelector(".error");
  errorElement.innerText = message;
  errorElement.classList.add("error");
}
