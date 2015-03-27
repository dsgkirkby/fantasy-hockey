
function deleteUser(username) {
    jQuery.ajax({
        url: "../controllers/deleteUser.php?username=" + username
    });
}

function startEdit(username, password, email, is_admin) {
    $("#username").val(username);
    $("#password").val(password);
    $("#email").val(email);
    $("#is_admin").val(is_admin ? "true" : "false");
}