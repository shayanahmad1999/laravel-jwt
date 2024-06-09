function logout(form) {
    let url = $(form).attr('action_url');
    let formData = $(form).serialize();
    const token = localStorage.getItem('token');
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        headers: {
            'Authorization': `Bearer ${token}`,
        },
        success: function (response) {
            if (response.message == 'Successfully logged out') {
                window.location.href = '/';
            } else {
                alert('Logout failed');
            }
        }
    });
}