
function createTable() {
  let rowsSelect = document.getElementById("rows");
  let colsSelect = document.getElementById("cols");
  let bordeSelect = document.getElementById("borde");
  let rows = rowsSelect.value;
  let cols = colsSelect.value;
  let borde = bordeSelect.value;

  const table = document.createElement("table");

  for (let i = 0; i < rows; i++) {
    const row = document.createElement("tr");

    for (let j = 0; j < cols; j++) {
      const cell = document.createElement("td");
      cell.innerHTML = "Elemento";
      row.appendChild(cell);
    }

    table.appendChild(row);
  }

  document.body.appendChild(table);

  rowsSelect.addEventListener("change", createTable);
  colsSelect.addEventListener("change", createTable);
}

