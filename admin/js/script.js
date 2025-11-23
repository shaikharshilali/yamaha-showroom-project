document.addEventListener('DOMContentLoaded', function() {
    // Confirm before delete actions
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });
    
    // Dashboard charts can be added here
    // Example using Chart.js (would need to include the library)
});