
function validate() {
    const name = document.getElementById("name");
    let x = false;
    if (!name.value || name.value.trim() === "") {
        const nameError = document.getElementById("nameError");
        nameError.classList.add("visible");

        nameError.setAttribute("aria-hidden", false);
        nameError.setAttribute("aria-invalid", true);
        x = false;
    } else {
        x = true;
    }
    return x;
}

function search() {
    const name = document.getElementById("pesquisar");

    if (!name.value) {
        const nameError = document.getElementById("pesquisaError");
        nameError.classList.add("visible");

        nameError.setAttribute("aria-hidden", false);
        nameError.setAttribute("aria-invalid", true);
        return false;
    }
    return true;
}