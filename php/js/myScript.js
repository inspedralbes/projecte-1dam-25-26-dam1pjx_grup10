function validarRegInc() {
    let x = document.forms["formRegInci"]["descripcio"].value;
    let y = document.forms["formRegInci"]["departament"].value;

    if (x==="" || y ===""){
        alert("La descripció de la incidència i el nom de departament no poden estar buits.")
        return false;

    }
}


function validarCrearAct(){
    let x = document.forms["crear_Act"]["descripcio"].value;
    let y = document.forms["crear_Act"]["temps_trigat"].value;


    if (y === ""){
        alert("Si us plau, introdueix un valor al camp -Temps Trigat-")
        return false;
    }

    if (x.length < 20){
        alert("La descripció de l'actuació ha de contenir almenys 20 caràcters.")
        return false;
    }
}



function validarNumId(){
    let x = document.forms["consultar_Inc_id"]["idIncidencia"].value;

    if (x === ""){
        alert("Si us plau, introdueix un ID");
        return false;
    }
}

function validarNumTec(){
    let x = document.forms["incidencies_tecnics"]["idTecnic"].value;

    if (x === ""){
        alert("Si us plau, introdueix un ID");
        return false;
    }
}

function validarCampsEditInc(){
    let x = document.forms["editar_incidencia"]["prioritat"].value;
    let y = document.forms["editar_incidencia"]["tipologia"].value;
    let z = document.forms["editar_incidencia"]["idTecnic"].value;

    if (x==="" || y === "" || z === ""){
        alert("Falten camps per emplenar");
        return false;
    }
}