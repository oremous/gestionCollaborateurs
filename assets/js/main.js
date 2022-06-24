import collabdb, {
  bulkcreate,
  createEle,
  getData,
  SortObj
} from "./module.js";


let db = collabdb("Gestion", {
  collaborateurs: `++id, nom, prenom, numero, date, dateReserve, adresse, taches,`
});

// input tags
const collabid = document.getElementById("collabid");
const collabname = document.getElementById("nom");
const collabprenom = document.getElementById("prenom");
const collabnumero = document.getElementById("numero");
const collabdate = document.getElementById("date");
const collabdatereserve = document.getElementById("datereserve");
const collabadresse = document.getElementById("adresse");
const collabtaches = document.getElementById("taches");

// create button
const btncreate = document.getElementById("btn-create");
const btnread = document.getElementById("btn-read");
const btnupdate = document.getElementById("btn-update");
const btndelete = document.getElementById("btn-delete");

// user data

// event listerner for create button
btncreate.onclick = event => {
  // insert values
  let flag = bulkcreate(db.collaborateurs, {
    nom: collabname.value,
    prenom: collabprenom.value,
    numero: collabnumero.value.
    date: collabdate.value,
    dateReserve: collabdatereserve.value,
    adresse: collabadresse.value,
    taches: collabtaches.value
  });
  // reset textbox values
  //proname.value = "";
  //seller.value = "";
  // price.value = "";
  collabname.value = collabprenom.value = collabnumero.value = collabdate.value = collabdatereserve.value = collabadresse.value = collabtaches = "";

  // set id textbox value
  getData(db.collaborateurs, data => {
    collabid.value = data.id + 1 || 1;
  });
  table();

  let insertmsg = document.querySelector(".insertmsg");
  getMsg(flag, insertmsg);
};

// event listerner for create button
btnread.onclick = table;

// button update
btnupdate.onclick = () => {
  const id = parseInt(collabid.value || 0);
  if (id) {
    // call dexie update method
    db.collaborateurs.update(id, {
      nom: collabname.value,
    prenom: collabprenom.value,
    numero: collabnumero.value.
    date: collabdate.value,
    dateReserve: collabdatereserve.value,
    adresse: collabadresse.value,
    taches: collabtaches.value
    }).then((updated) => {
      // let get = updated ? `data updated` : `couldn't update data`;
      let get = updated ? true : false;

      // display message
      let updatemsg = document.querySelector(".updatemsg");
      getMsg(get, updatemsg);

      collabname.value = collabprenom.value = collabnumero.value = collabdate.value = collabdatereserve.value = collabadresse.value = collabtaches = "";
      //console.log(get);
    })
  } else {
    console.log(`Please Select id: ${id}`);
  }
}

// delete button
btndelete.onclick = () => {
  db.delete();
  db = collabdb("collaborateurs", {
    collaborateurs: `++id, nom, prenom, numero, date, dateReserve, adresse, taches,`
  });
  db.open();
  table();
  textID(userid);
  // display message
  let deletemsg = document.querySelector(".deletemsg");
  getMsg(true, deletemsg);
}

window.onload = event => {
  // set id textbox value
  textID(collabid);
};




// create dynamic table
function table() {
  const tbody = document.getElementById("tbody");
  const notfound = document.getElementById("notfound");
  notfound.textContent = "";
  // remove all childs from the dom first
  while (tbody.hasChildNodes()) {
    tbody.removeChild(tbody.firstChild);
  }


  getData(db.collaborateurs, (data, index) => {
    if (data) {
      createEle("tr", tbody, tr => {
        for (const value in data) {
          createEle("td", tr, td => {
            td.textContent = data.taches === data[value] ? `$ ${data[value]}` : data[value];
          });
        }
        createEle("td", tr, td => {
          createEle("i", td, i => {
            i.className += "fas fa-edit btnedit";
            i.setAttribute(`data-id`, data.id);
            // store number of edit buttons
            i.onclick = editbtn;
          });
        })
        createEle("td", tr, td => {
          createEle("i", td, i => {
            i.className += "fas fa-trash-alt btndelete";
            i.setAttribute(`data-id`, data.id);
            // store number of edit buttons
            i.onclick = deletebtn;
          });
        })
      });
    } else {
      notfound.textContent = "No record found in the database...!";
    }

  });
}

const editbtn = (event) => {
  let id = parseInt(event.target.dataset.id);
  db.collaborateurs.get(id, function (data) {
    let newdata = SortObj(data);
    collabname.value = newdata.nom || "";
    collabprenom.value = newdata.prenom || "";
    collabdate.value = newdata.date || "";
    collabdatereserve.value = newdata.sdatereserve || "";
    collabadresse.value = newdata.adresse || "";
    collabtaches.value = newdata.taches || "";
  });
}

// delete icon remove element 
const deletebtn = event => {
  let id = parseInt(event.target.dataset.id);
  db.collaborateurs.delete(id);
  table();
}

// textbox id
function textID(textboxid) {
  getData(db.products, data => {
    textboxid.value = data.id + 1 || 1;
  });
}

// function msg
function getMsg(flag, element) {
  if (flag) {
    // call msg 
    element.className += " movedown";

    setTimeout(() => {
      element.classList.forEach(classname => {
        classname == "movedown" ? undefined : element.classList.remove('movedown');
      })
    }, 4000);
  }
}