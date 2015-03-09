
function deleteTeam(teamID) {
    jQuery.ajax({
        url: "deleteTeam.php?teamID=" + teamID
    }).done(function(response) {
        console.log("Delete completed");
        console.log(response);
    });
}