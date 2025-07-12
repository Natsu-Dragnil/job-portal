document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('applyForm');
    const responseBox = document.getElementById('response');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            responseBox.innerText = "Submitting your application...";
            responseBox.style.color = "#555";

            const formData = new FormData(form);

            fetch('apply.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.text())
                .then(data => {
                    responseBox.innerText = data;
                    responseBox.style.color = data.includes("successfully") ? "green" : "red";
                    if (data.includes("successfully")) {
                        form.reset();
                    }
                })
                .catch(error => {
                    responseBox.innerText = "Something went wrong. Please try again.";
                    responseBox.style.color = "red";
                    console.error(error);
                });
        });
    }
});
