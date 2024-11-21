document.addEventListener("DOMContentLoaded", () => {
  const countryButton = document.getElementById("countryBtn"); // The lookup countries button
  const citiesButton = document.getElementById("citiesBtn"); // The lookup cities button
  const input = document.getElementById("country"); // The input field for country name 
  const resultDiv = document.getElementById("result"); // result area
  const httpRequest = new XMLHttpRequest();
  
  
  // Event listener for lookup countries button when clicked
    countryButton.addEventListener("click", () => {
        const countryInput = input.value.trim(); // remove whitespace from input value 

        const url = `world.php?country=${countryInput}&lookup=country`;  //set lookup to country
        httpRequest.onreadystatechange = getResponse;  //callback function 
        httpRequest.open('GET', url, true);  //new GET request
        httpRequest.send();  //send request to server
  });

// Event listener for lookup cities button when clicked
    citiesButton.addEventListener("click", () => {
        const countryInput = input.value.trim(); // remove whitespace from input value 

        const url = `world.php?country=${countryInput}&lookup=cities`;  //set lookup to cities
        httpRequest.onreadystatechange = getResponse;  //callback function 
        httpRequest.open('GET', url, true);  //new GET request
        httpRequest.send();  //send request to server
  });


    //funtion for server's response
    function getResponse() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            //check if response status is OK
            if (httpRequest.status === 200) {
                const response = httpRequest.responseText; //get server response
                resultDiv.innerHTML = response; //display results in result area
            } 
            else {
                alert('There was a problem with the request.');  //error message if unsuccessful
            }
        }
    }
});
