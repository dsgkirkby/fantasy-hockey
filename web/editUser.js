
function deleteUser(username) {
    jQuery.ajax({
        url: "../controllers/deleteUser.php?username=" + username
    });
}