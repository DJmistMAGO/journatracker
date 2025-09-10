function updateDateTime() {
  const options = {
    timeZone: 'Asia/Manila',
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit'
  };
  const now = new Date().toLocaleString('en-PH', options);
  document.getElementById('datetime').textContent = now;
}

// Update every second
setInterval(updateDateTime, 1000);
updateDateTime();
