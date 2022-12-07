
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

const form = document.querySelector("#personaForm");
form.addEventListener("submit", onSubmit)

const saveButton = document.querySelector("#buttonSave");

const currentId = params.id;
let isNew = true;

init();

function init() {

    if (currentId) {

        isNew = false;

        getPersona();

    } 

}

async function getPersona() {

    const resp = await fetch(`/crud-fetch/?uri=api/buscar&id=${currentId}`);

    const data = await resp.json();

    if ( !data ) return;
    
    setFormValues(data);

}

function setFormValues(data) {

    document.querySelector("#NombreForm").value = data.Nombre;
    document.querySelector("#ApellidoPaternoForm").value = data.ApellidoPaterno;
    document.querySelector("#ApellidoMaternoForm").value = data.ApellidoMaterno;
    document.querySelector("#TelefonoForm").value = data.Telefono;
    document.querySelector("#CorreoForm").value = data.Correo;

}

async function onSubmit(e) {

    e.preventDefault();

    let resp;

    setLoadingState(true);

    if ( isNew ) {
        resp = await saveNew();
    } else {
        resp = await saveChanges();
    }

    setLoadingState(false);

    if ( resp.status == 200 || resp.status == 201 ) 
        window.location.href = "/crud-fetch";
    
}

function getFormValues() {

    const Nombre = document.querySelector("#NombreForm").value;
    const ApellidoPaterno = document.querySelector("#ApellidoPaternoForm").value;
    const ApellidoMaterno = document.querySelector("#ApellidoMaternoForm").value;
    const Telefono = document.querySelector("#TelefonoForm").value;
    const Correo = document.querySelector("#CorreoForm").value;

    const dataForm = {
        Nombre,
        ApellidoPaterno,
        ApellidoMaterno,
        Telefono,
        Correo,
    }

    return dataForm;

}

async function saveChanges() {

    const bodyParams = getFormValues();

    const resp = fetch(`/crud-fetch/?uri=api/actualizar&id=${currentId}`, {
        body: JSON.stringify(bodyParams),
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        }
    });

    return resp;

}

async function saveNew() {

    const bodyParams = getFormValues();

    const resp = await fetch("/crud-fetch/?uri=api/crear", {
        body: JSON.stringify(bodyParams),
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        }
    });

    return resp;

}

function setLoadingState(isLoading = true) {

    if ( isLoading ) {

        saveButton.innerHTML = `
            <div class="spinner-border" role="status"></div>
        `;

        saveButton.disabled = true;

    } else {

        if ( isNew )
            saveButton.innerHTML = "Agregar";
        else
            saveButton.innerHTML = "Guardar cambios";

        saveButton.disabled = false;

    }

}