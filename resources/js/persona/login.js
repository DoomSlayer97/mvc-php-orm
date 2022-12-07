
const form = document.querySelector("#loginForm");
const loginButton = document.querySelector("#buttonLogin");

form.addEventListener("submit", onSubmit)

function onSubmit(e) {

    e.preventDefault();

    console.log(getFormValues());

}

function getFormValues() {

    const Email = document.querySelector("#EmailForm").value;
    const Password = document.querySelector("#PasswordForm").value;

    const dataForm = {
        Email,
        Password
    }

    return dataForm;

}

function setLoadingState(isLoading = true) {

    if ( isLoading ) {

        loginButton.innerHTML = `
            <div class="spinner-border" role="status"></div>
        `;

        loginButton.disabled = true;

    } else {

        loginButton.innerHTML = "Ingresar";
        loginButton.disabled = false;

    }

}