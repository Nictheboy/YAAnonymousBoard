document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', event => {
            const postId = event.target.dataset.postId;
            fetch(`like.php?post_id=${postId}`)
                .then(response => response.text())
                .then(data => {
                    event.target.nextElementSibling.innerText = data;
                });
        });
    });
});
