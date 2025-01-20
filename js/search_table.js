
function employeeSearchTable() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("EmployeeSearchBox");
  filter = input.value.toLowerCase();
  table = document.getElementById("employeeTable");
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    // Start from 1 to skip header row
    let rowVisible = false;
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j]) {
        txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
          rowVisible = true;
        }
      }
    }
    tr[i].style.display = rowVisible ? "" : "none";
  }
}

// Function to implement Product table search

function productSearchTable() {
  let input = document.getElementById("productSearchInput");
  let filter = input.value.toLowerCase();
  let table = document.getElementById("productTable");
  let tr = table.getElementsByTagName("tr");

  for (let i = 1; i < tr.length; i++) {
    // Start from 1 to skip the header row
    let td = tr[i].getElementsByTagName("td");
    let match = false;

    for (let j = 0; j < td.length; j++) {
      if (td[j]) {
        if (td[j].innerText.toLowerCase().indexOf(filter) > -1) {
          match = true;
          break;
        }
      }
    }

    if (match) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}

// Function to implement Customer table search
function customerSearchTable() {
  let input = document.getElementById("customerSearchInput");
  var filter = input.value.toLowerCase();
  var table = document.getElementById("customerTable");
  var rows = table.getElementsByTagName("tr");

  for (var i = 1; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName("td");
    var found = false;

    for (var j = 0; j < cells.length; j++) {
      var cell = cells[j];
      if (cell) {
        var text = cell.textContent || cell.innerText;
        if (text.toLowerCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
    }

    if (found) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }
}

// Auto search functionality for sells table
function sellsSearchTable() {
  // Get input value
  let input = document.getElementById("sellsSearchInput");
  let filter = input.value.toUpperCase();
  let table = document.getElementById("sells_table");
  let tr = table.getElementsByTagName("tr");

  // Loop through all rows, except the first one (headers)
  for (let i = 1; i < tr.length; i++) {
    let td = tr[i].getElementsByTagName("td");
    let found = false;

    for (let j = 0; j < td.length; j++) {
      if (td[j]) {
        let cellText = td[j].textContent || td[j].innerText;
        if (cellText.toUpperCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
    }

    // If found, show the row, otherwise hide it
    if (found) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
