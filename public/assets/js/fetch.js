const token = localStorage.getItem('token');

axios.get('/api/user', {
    headers: {
        'Authorization': `Bearer ${token}`
    }
})
    .then(response => {
        $('#userInfo').html('Welcome ' + response.data.name)
    })
    .catch(error => {
        console.error(error);
    });

axios.get('/api/custom/posts', {
    headers: {
        'Authorization': `Bearer ${token}`
    }
})
    .then(response => {
        const posts = response.data.data;
        if (Array.isArray(posts)) {
            posts.forEach(post => {
                $('#posts').append(`
                    <div class="post">
                        <div class="post-title">${escapeHtml(post.title)}</div>
                        <div class="post-content">${escapeHtml(post.content)}</div>
                        <div class="post-date">Posted on: ${new Date(post.created_at).toLocaleDateString()}</div>
                    </div>
                `);
            });
        } else {
            console.error('Unexpected response format:', response.data);
        }
    })
    .catch(error => {
        console.error('Error fetching posts:', error);
        $('#posts').append('<p>Failed to load posts. Please try again later.</p>');
    });

function escapeHtml(string) {
    return String(string).replace(/[&<>"'`=\/]/g, function (s) {
        return {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
            '/': '&#x2F;',
            '`': '&#x60;',
            '=': '&#x3D;'
        }[s];
    });
}
