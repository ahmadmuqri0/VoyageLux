const paymentButton = document.getElementById("payment");

paymentButton.addEventListener("click", () => {
    const myForm = document.getElementById("myForm");
    if (myForm.style.display === "block") {
        myForm.style.display = "none";
    } else {
        myForm.style.display = "block";
    }
});