
document.querySelectorAll('.seat').forEach(seat => {
    seat.addEventListener('click', function() {
        if (!this.classList.contains('booked')) {
            this.classList.toggle('selected');
            updateSelectedSeats();
        }
    });
});

function updateSelectedSeats() {
    const selectedSeats = document.querySelectorAll('.seat.selected');
    const selectedList = document.getElementById('selected-seats-list');
    selectedList.innerHTML = '';
    selectedSeats.forEach(seat => {
        const seatInfo = `${seat.id} (${seat.dataset.features}, ${seat.dataset.price})`;
        selectedList.innerHTML += `<li>${seatInfo}</li>`;
    });
}

function filterSeats() {
    const wheelchairFilter = document.getElementById('wheelchair').checked;
    const seats = document.querySelectorAll('.seat');
    seats.forEach(seat => {
        const isAccessible = seat.classList.contains('accessible');
        seat.style.display = wheelchairFilter && !isAccessible ? 'none' : 'flex';
    });
}

function confirmBooking() {
    const selectedSeats = document.querySelectorAll('.seat.selected');
    const errorDiv = document.getElementById('error');
    const bookedList = document.getElementById('booked-seats-list');
    const selectedList = document.getElementById('selected-seats-list');

    errorDiv.textContent = '';
    errorDiv.style.display = 'none';

    if (selectedSeats.length === 0) {
        errorDiv.textContent = 'Please select at least one seat.';
        errorDiv.style.color = 'red';
        return;
    }

    selectedSeats.forEach(seat => {
        seat.classList.remove('selected');
        seat.classList.add('booked');
        const seatInfo = `${seat.id} (${seat.dataset.features}, ${seat.dataset.price})`;
        bookedList.innerHTML += `<li>${seatInfo}</li>`;
    });
    selectedList.innerHTML = '';
}

function goBack() {
    window.history.back();
}