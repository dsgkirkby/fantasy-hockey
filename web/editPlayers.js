
function deletePlayer(playerID) {
    jQuery.ajax({
        url: "../controllers/deleteUser.php?playerID=" + playerID
    });
}

function startEdit(playerName, hometown, height, weight, dob) {
    $("#name").val(playerName);
    $("#hometown").val(hometown);
    $("#height").val(height);
    $("#weight").val(weight);
    $("#dob").val(dob);
}