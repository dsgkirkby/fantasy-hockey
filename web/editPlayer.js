
function deletePlayer(playerID) {
    jQuery.ajax({
        url: "../controllers/deletePlayer.php?playerID=" + playerID
    });
}

function startEdit(playerID, name, hometown, height, weight, dob) {
	$("#playerID").val(playerID);
    $("#name").val(name);
    $("#hometown").val(hometown);
    $("#height").val(height);
    $("#weight").val(weight);
    $("#dob").val(dob);
}