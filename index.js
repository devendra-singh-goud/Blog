
// this js is used for add minimum 6 word in your content in create file 

document.getElementById('postForm').addEventListener('submit', function(event) {
    var content = document.getElementById('content').value.trim();
    var words = content.split(/\s+/).filter(word => word.length > 0);

    if (words.length < 6) {
        event.preventDefault(); // Prevent form submission
        document.getElementById('content-error').textContent = "Content must contain at least 6 words.";
    } else {
        document.getElementById('content-error').textContent = ""; // Clear the error
    }
});
