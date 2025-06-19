function isValidSearch() {
  SearchedIteam = document.getElementById("search-input").value;
  if (SearchedIteam === "") {
    document.getElementById("errorMessage").innerHTML =
      "Search field cannot be empty!";
    return false;
  } else {
    return true;
  }
}
// }
// // dsad

// document.addEventListener('DOMContentLoaded', () => {
//   const filterSelect = document.getElementById('FilterEvents');
//   const eventCards = document.querySelectorAll('.eventCards');

//   // Event listener for filter change
//   filterSelect.addEventListener('change', function() {
//     const filterValue = this.value;
//     filterEvents(filterValue);
//   });

//   // Function to filter events based on selected criteria
//   function filterEvents(criteria) {
//     const eventContainer = document.getElementById('EventCardContainer');
//     const eventArray = Array.from(eventCards); // Convert NodeList to Array

//     switch (criteria) {
//       case 'LowToHigh':
//         eventArray.sort((a, b) => {
//           const priceA = parseFloat(a.querySelector('.price').textContent.replace('$', ''));
//           const priceB = parseFloat(b.querySelector('.price').textContent.replace('$', ''));
//           return priceA - priceB; // Low to High
//         });
//         break;
        
//       case 'HighToLow':
//         eventArray.sort((a, b) => {
//           const priceA = parseFloat(a.querySelector('.price').textContent.replace('$', ''));
//           const priceB = parseFloat(b.querySelector('.price').textContent.replace('$', ''));
//           return priceB - priceA; // High to Low
//         });
//         break;

//       case 'All':
//         eventArray.forEach(card => card.style.display = 'block');
//         break;
//     }

//     displayEvents(eventArray);
//   }

 

//   // Function to display sorted/filtered events
//   function displayEvents(eventArray) {
//     const eventContainer = document.getElementById('EventCardContainer');

//     // Clear all current events before adding sorted/filtered ones
//     eventContainer.innerHTML = '';

//     // Append the sorted/filtered event cards back to the container
//     eventArray.forEach(card => {
//       eventContainer.appendChild(card);
//     });
//   }
// });



// const divs = document.querySelectorAll(".eventCards");

// divs.forEach((div) => {
//   div.addEventListener("click", () => {
//     window.location.href = "EventDetails.html"; // Change this URL
//   });
// });
