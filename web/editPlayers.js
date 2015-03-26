
function deletePlayer(playerID) {
    jQuery.ajax({
        url: "../controllers/deleteUser.php?playerID=" + playerID
    });
}

function startEdit(playerID, hometown, height, weight, dob) {
    $("#playerID").val(playerID);
    $("#hometown").val(hometown);
    $("#height").val(height);
    $("#weight").val(weight);
    $("#dob").val(dob);
}