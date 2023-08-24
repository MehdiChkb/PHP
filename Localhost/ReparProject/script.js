function addRow() {
    const table = document.getElementById('travauxTable').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow(table.rows.length);
    const cell1 = newRow.insertCell(0);
    const cell2 = newRow.insertCell(1);
    const cell3 = newRow.insertCell(2);
    const cell4 = newRow.insertCell(3);
    const cell5 = newRow.insertCell(4);
  
    cell1.innerHTML = '<input type="text" class="table-input" name="designationTravaux[]" required>';
    cell2.innerHTML = '<input type="text" class="table-input" name="refArticles[]" required>';
    cell3.innerHTML = '<input type="number" class="table-input" name="quantite[]" required>';
    cell4.innerHTML = '<input type="number" class="table-input" name="prixUnitaire[]" step="0.01" required>';
    cell5.innerHTML = '<button type="button" onclick="deleteRow(this)">Supprimer</button>';
  }
  
  let button = document.querySelector('.buttonx');
  let buttonText = document.querySelector('.tick');
  
  const tickMark = "<svg width=\"58\" height=\"45\" viewBox=\"0 0 58 45\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#fff\" fill-rule=\"nonzero\" d=\"M19.11 44.64L.27 25.81l5.66-5.66 13.18 13.18L52.07.38l5.65 5.65\"/></svg>";
  
  buttonText.innerHTML = "Submit";
  
  button.addEventListener('click', function() {
  
    if (buttonText.innerHTML !== "Submit") {
      buttonText.innerHTML = "Submit";
    } else if (buttonText.innerHTML === "Submit") {
      buttonText.innerHTML = tickMark;
    }
    this.classList.toggle('buttonx__circle');
  });