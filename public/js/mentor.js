function searchSubject() {
    const query = document.getElementById('search').value.toLowerCase();
    const rows = document.querySelectorAll('table tbody tr');
    rows.forEach(row => {
      const className = row.cells[0].textContent.toLowerCase();
      if (className.includes(query)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }
  