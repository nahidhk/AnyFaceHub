const nxtBtn = document.getElementById("nxtBtn");
const FullName = document.getElementsByName("FullName")[0];
FullName.addEventListener("input", function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, "");
    this.style.textTransform = "capitalize";

});
const Gender = document.getElementsByName("Gender")[0];
Gender.addEventListener("input", function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, "");
    this.style.textTransform = "capitalize";
});


function nextStep() {
    const FullName = document.getElementsByName("FullName")[0];
    const DateOfBirth = document.getElementsByName("DateOfBirth")[0];
    const Gender = document.getElementsByName("Gender")[0];

    if (FullName.value === "" || DateOfBirth.value === "" || Gender.value === "") {
        const errorNote = "Please fill in all fields."
        document.getElementById("error").innerText = errorNote;
    } else {
        // Proceed to the next step
        document.getElementById("step1").style.display = "none"
        document.getElementById("step2").style.display = "block"
    }
}

function prevStep() {
    // Go back to the previous step
    document.getElementById("step2").style.display = "none"
    document.getElementById("step1").style.display = "block"
}
function sendRequest() {
    const phoneoremail = document.getElementsByName("phoneoremail")[0];
    const password = document.getElementsByName("password")[0];
    if (phoneoremail.value === "" || password.value === "") {
        const errorNote = "Please fill in all fields."
        document.getElementById("error").innerText = errorNote;
    } else if (password.value !== confirmPassword.value) {
        const errorNote = "Passwords do not match."
        document.getElementById("error").innerText = errorNote;
    } else {
        // Send the request to create the account
        alert("Account created successfully!");
    }
}