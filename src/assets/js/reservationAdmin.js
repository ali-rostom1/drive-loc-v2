document.querySelectorAll(".approveBtn").forEach(btn => btn.addEventListener("click", approveReservation));
document.querySelectorAll(".declineBtn").forEach(btn => btn.addEventListener("click", declineReservation));
document.querySelectorAll(".deleteBtn").forEach(btn => btn.addEventListener("click", deleteReservation));



async function approveReservation(event) {
    const id = event.target.dataset.id;
    const response = await fetch(`../clientPages/AJAX/reservation.php?approve=${id}`);
    if (response.ok) {
        location.reload();
    }
}
async function declineReservation(event) {
    const id = event.target.dataset.id;
    const response = await fetch(`../clientPages/AJAX/reservation.php?decline=${id}`);
    if (response.ok) {
        location.reload();
    }
}
async function deleteReservation(event) {
    const id = event.target.dataset.id;
    const response = await fetch(`../clientPages/AJAX/reservation.php?delete=${id}`);
    if (response.ok) {
        location.reload();
    }
}