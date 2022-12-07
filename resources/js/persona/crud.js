const contentTable = document.querySelector("#contentTable");

init();

function init() {
    listTableData();
}

/* list functions */
async function getList() {

    const resp = await fetch("/crud-fetch/?uri=api/listar");
        
    return resp.json();

}

async function deletePersona(id) {

    const isConfirmed = await showAlertDelete(id);

    let resp;

    if ( isConfirmed ) {

        resp = await deleteRequest(id);

        await listTableData();

    }


}

async function deleteRequest(id) {

    const resp = await fetch(`/crud-fetch/?uri=api/eliminar&id=${id}`, {
        method: "POST"
    });

    return resp.json();

}

async function showAlertDelete(id) {

    const resp = await Swal.fire({
        title: "¿Desea eliminar este registro?",
        icon: "info",
        showDenyButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No"
    });

    return resp.isConfirmed;

}

async function listTableData() {

    const personas = await getList();

    contentTable.innerHTML = '';

    personas.forEach(persona => {
        
        contentTable.innerHTML += `
            <tr>
                <td>${persona.Nombre}</td>
                <td>${persona.ApellidoPaterno}</td>
                <td>${persona.ApellidoMaterno}</td>
                <td>${persona.Telefono}</td>
                <td>${persona.Correo}</td>
                <td>
                    <a href="/crud-fetch/?uri=editar&id=${persona.id}" class="btn btn-primary btn-sm" >Editar</a>
                    <button onClick="deletePersona(${persona.id})" class="btn btn-secondary btn-sm" >Eliminar</button>
                </td>
            </tr>
        `;

    }); 

}