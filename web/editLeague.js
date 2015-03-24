
function deleteTeam(teamID) {
    jQuery.ajax({
        url: "../controllers/deleteTeam.php?teamID=" + teamID
    });
}
function deleteLeague(leagueID){
    jQuery.ajax({
        url: "../controllers/deleteLeague.php?leagueID=" + leagueID
    });
}