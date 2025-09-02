document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.fcl-form');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const data = new FormData(form);
            data.append('action', 'fcl_submit_form'); // ✅ Add this line

            fetch(fcl_ajax.ajax_url, {
                method: 'POST',
                body: data
            })
            .then(res => res.text())
            .then(response => {
                form.innerHTML = `<p>${response}</p>`;
            });
        });
    }
});
