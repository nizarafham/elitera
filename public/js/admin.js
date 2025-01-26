document.addEventListener("DOMContentLoaded", () => {
    const sidebarLinks = document.querySelectorAll("aside .sidebar a");
    const mainContent = document.querySelector("main");

    sidebarLinks.forEach(link => {
        link.addEventListener("click", (event) => {
            if (!link.hasAttribute("onclick")) {
                event.preventDefault();
            }

            const target = link.getAttribute("data-target");

            if (target) {
                sidebarLinks.forEach(l => l.classList.remove("active"));
                link.classList.add("active");

                if (target === "course-apply") {
                    renderCourseApplications();
                } else if (target === "course-edit-apply") {
                    renderEditCourseApplications();
                } else {
                    // Membersihkan konten sebelum menambahkan yang baru
                    mainContent.innerHTML = '';
                    const h1 = document.createElement('h1');
                    h1.textContent = target.replace('-', ' ').charAt(0).toUpperCase() + target.slice(1);
                    mainContent.appendChild(h1);
                }
            }
        });
    });

    const renderCourseApplications = async () => {
        try {
            mainContent.innerHTML = '<h1>Course Applications</h1><div class="loading">Loading...</div>';

            const response = await fetch('/admin/courses/json');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const courses = await response.json();
            renderTable(courses, "Pending Course Applications", "/admin/courses");
        } catch (error) {
            handleError(error, "Course Applications");
        }
    };

    const renderEditCourseApplications = async () => {
        try {
            mainContent.innerHTML = '<h1>Course Edit Applications</h1><div class="loading">Loading...</div>';

            const response = await fetch('/admin/edit-courses/json');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const editCourses = await response.json();
            renderTable(editCourses, "Pending Course Edit Applications", "/admin/edit-courses");
        } catch (error) {
            handleError(error, "Course Edit Applications");
        }
    };

    const renderTable = (data, title, routePrefix) => {
        // Membersihkan konten sebelum menambahkan yang baru
        mainContent.innerHTML = '';

        const h1 = document.createElement('h1');
        h1.textContent = title;
        mainContent.appendChild(h1);

        const recentOrdersDiv = document.createElement('div');
        recentOrdersDiv.className = 'recent-orders';

        const h2 = document.createElement('h2');
        h2.textContent = title;
        recentOrdersDiv.appendChild(h2);

        const table = document.createElement('table');
        const thead = table.createTHead();
        const headerRow = thead.insertRow();
        const headers = ["Course Name", "Mentor", "Status", "Actions"];

        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;
            headerRow.appendChild(th);
        });

        const tbody = table.createTBody();

        if (data.length === 0) {
            const row = tbody.insertRow();
            const cell = row.insertCell();
            cell.colSpan = 4;
            cell.className = 'text-center';
            cell.textContent = 'No pending applications';
        } else {
            data.forEach(item => {
                const row = tbody.insertRow();
                const nameCell = row.insertCell();
                nameCell.textContent = item.name || 'Unnamed Course';

                const mentorCell = row.insertCell();
                mentorCell.textContent = item.mentor?.name || 'No Mentor';

                const statusCell = row.insertCell();
                const statusSpan = document.createElement('span');
                statusSpan.className = `status ${(item.status || '').toLowerCase()}`;
                statusSpan.textContent = item.status || 'Unknown';
                statusCell.appendChild(statusSpan);

                const actionsCell = row.insertCell();
                actionsCell.className = 'action-buttons';

                const createForm = (action) => {
                  const form = document.createElement('form');
                  form.action = `${routePrefix}/${item.id}/${action}`;
                  form.method = 'POST';
                  form.style.display = 'inline-block';

                  const csrfInput = document.createElement('input');
                  csrfInput.type = 'hidden';
                  csrfInput.name = '_token';
                  csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                  form.appendChild(csrfInput);

                  const button = document.createElement('button');
                  button.type = 'submit';
                  button.className = `btn btn-${action === 'approve' ? 'primary' : 'danger'}`;
                  button.textContent = action.charAt(0).toUpperCase() + action.slice(1);
                  form.appendChild(button);

                  return form;
                }
                actionsCell.appendChild(createForm('approve'));
                actionsCell.appendChild(createForm('reject'));
            });
        }

        recentOrdersDiv.appendChild(table);
        mainContent.appendChild(recentOrdersDiv);
    };

    const handleError = (error, sectionTitle) => {
        console.error("Error:", error);
        mainContent.innerHTML = `
            <h1>${sectionTitle}</h1>
            <div class="error">
                Error loading ${sectionTitle.toLowerCase()}: ${error.message}
                <br>
                <small>Please check the browser console for more details.</small>
            </div>
        `;
    };
});