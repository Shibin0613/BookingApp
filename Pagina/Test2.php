<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="function.js"></script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
if (isset($_POST['submitform'])) {
    switch ($_POST["submitform"]) {
        case "save":
            foreach ($_POST as $key => $value) {
                if ($key == 'submitform') continue;
                echo $key;
            }
            break;
    }
}
?>
<script>
function updateForm(id, value)
{
    $.ajax({
        url: "Test2.php",
        type: 'POST',
        data: {submitform: "save", id: value},
        success: function (result) {
            
        },
        error: function (request, status, error) {
            console.error(request, status, error);
        }
    });
}
</script>
<form method="post">
    <input type="text" id="vehicle1" name="vehicle1" value="Bike">
    <input type="text" id="vehicle2" name="vehicle2" value="Car">
    <button type="submit" name="submitform" class="btn btn-success" value="save">Save</button>
</form>
<button onclick="updateForm('vehicle2', 'Plane');" type="button" class="btn btn-primary">Update</button>