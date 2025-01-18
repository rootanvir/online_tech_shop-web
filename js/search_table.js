// Function to implement Employee table search

function searchTable() {
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

function searchTable() {
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
