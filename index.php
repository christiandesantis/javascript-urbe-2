<!-- Autor: Christian De Santis -->
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro de Actividades Diarias</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Registro de Actividades Diarias</h1>
                <h6 class="text-center">Christian De Santis - N1113</h6>
                <form onsubmit="submitForm(event)">
                    <div class="form-group text-center">
                        <label for="activity">Actividad:</label>
                        <input type="text" class="form-control" id="activity" required style="margin-right: 12px;">
                        <label for="date">Fecha:</label>
                        <input type="date" class="form-control" id="date" required>
                    </div>
                    <div class="text-center">
                        <button type="submit">Agregar Registro</button>
                    </div>
                </form>
                <div>
                    <h2>Registros</h2>
                    <ul id="records-list"></ul>
                </div>
            </div>
        </div>
    </div>

    <script>
    function submitForm(event) {
        event.preventDefault();
        var activity = document.getElementById("activity").value;
        var date = document.getElementById("date").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "api/insert.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText);
            document.getElementById("activity").value = '';
            document.getElementById("date").value = '';
            displayRecords();
        }
        };
        xhr.send("activity=" + activity + "&date=" + date);
    }

    function displayRecords() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/select.php", true);
        xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var records = JSON.parse(xhr.responseText);
            var recordsList = document.getElementById("records-list");
            recordsList.innerHTML = '';
            for (var i = 0; i < records.length; i++) {
            var record = records[i];
            var recordItem = document.createElement("li");
            recordItem.innerHTML = record.activity + " - " + record.date;
            var deleteButton = document.createElement("button");
            deleteButton.style.marginRight = "4px";
            deleteButton.style.marginLeft = "12px";
            deleteButton.innerHTML = "Eliminar";
            deleteButton.onclick = (function(id) {
                return function() {
                deleteRecord(id);
                }
            })(record.id);
            var modifyButton = document.createElement("button");
            modifyButton.innerHTML = "Modificar";
            modifyButton.onclick = (function(id) {
                return function() {
                modifyRecord(id);
                }
            })(record.id);
            recordItem.appendChild(deleteButton);
            recordItem.appendChild(modifyButton);
            recordsList.appendChild(recordItem);
            }
        }
        };
        xhr.send();
    }

    function deleteRecord(id) {
        var xhr = new XMLHttpRequest();
        xhr.open("DELETE", "api/delete.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText);
            displayRecords();
        }
        };
        xhr.send("id=" + id);
    }

    function modifyRecord(id) {
        var activity = prompt("Ingresar actividad modificada:");
        var date = prompt("Ingresar fecha modificada:");

        if (activity == null || activity == "" || date == null || date == "") {
            alert("No se ingresó actividad o fecha");
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("PUT", "api/update.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText);
            displayRecords();
        }
        };
        xhr.send("id=" + id + "&activity=" + activity + "&date=" + date);
    }

    displayRecords();
    </script>
</body>
</html>