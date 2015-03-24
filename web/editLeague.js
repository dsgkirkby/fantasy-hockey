
function deleteTeam(teamID) {
    jQuery.ajax({
        url: "../controllers/deleteTeam.php?teamID=" + teamID
    });
}