document.addEventListener("DOMContentLoaded", () => {
  const lookupButton = document.getElementById("lookup"); // The lookup button
  const input = document.getElementById("country"); // The input field for country name 
  const resultDiv = document.getElementById("result"); // result area
  const httpRequest = new XMLHttpRequest();
  
  // Event listener for lookup button when clicked
    lookupButton.addEventListener("click", () => {
        const countryInput = input.value.trim(); // remove whitespace from input value 

        const url = `world.php?country=${countryInput}`;
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
