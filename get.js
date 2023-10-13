function retrieveContestants(Post_name, selectId) {
    // Make an AJAX request to fetch contestants based on the selected position
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `get_contestants.php?position=${Post_name}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const contestants = JSON.parse(xhr.responseText);
            const comboBox = document.getElementById(selectId);

            // Clear existing options
            comboBox.innerHTML = "";

            // Populate options based on retrieved contestants
            contestants.forEach((contestant) => {
                const option = document.createElement("option");
                option.value = contestant.contestant_ID;
                option.textContent = contestant.First_Name;
                comboBox.appendChild(option);
            });
        }
    };
    xhr.send();
}
