// Define a function to retrieve and populate the combo boxes for different positions
function retrieveContestants(Post_name) {
    // Simulate retrieving contestants for the specified position (replace with your logic)
    const contestants = getContestantsForPosition(Post_name);

    // Get the combo box element
    const comboBox = document.getElementById(Post_name);

    // Clear existing options
    comboBox.innerHTML = "";

    // Populate options based on retrieved contestants
    contestants.forEach((contestant) => {
        const option = document.createElement("option");
        option.value = contestant.contestantid; // Use contestant ID as the option value
        option.textContent = contestant.name; // Display contestant name in the option
        comboBox.appendChild(option);
    });
}

// Simulate retrieving contestants (replace with your data source logic)
// Replace this function with an actual AJAX request to fetch contestants from the server
function getContestantsForPosition(Post_name) {
    // Simulate fetching data for the specified position (replace with your server request)
    if (Post_name === "President") {
        return [
            { contestantid: 1, name: "Candidate 1" },
            { contestantid: 2, name: "Candidate 2" },
            { contestantid: 3, name: "Candidate 3" }
        ];
    } else if (Post_name === "Vice_president") {
        return [
            { contestantid: 4, name: "Candidate 4" },
            { contestantid: 5, name: "Candidate 5" },
            { contestantid: 6, name: "Candidate 6" }
        ];
    }
    // Add similar conditions for other positions

    // Return an empty array if the position is not recognized
    return [];
}

// Add event listeners for each position
document.getElementById("President").addEventListener("change", function() {
    retrieveContestants("President");
});
document.getElementById("Vice_president").addEventListener("change", function() {
    retrieveContestants("Vice_president");
});
// Add similar event listeners for other positions

// Trigger initial population of the options (e.g., for President)
retrieveContestants("President");
