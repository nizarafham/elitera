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
                } else {
                    mainContent.innerHTML = `<h1>${target.replace('-', ' ').charAt(0).toUpperCase() + target.slice(1)}</h1>`;
                }
            }
        });
    });

    const renderCourseApplications = async () => {
        try {
            mainContent.innerHTML = '<h1>Course Applications</h1><div class="loading">Loading...</div>';
            
            console.log('Fetching courses from:', '/admin/courses/json'); // Debug log
            const response = await fetch('/admin/courses/json');
            console.log('Response status:', response.status); // Debug log
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const courses = await response.json();
            console.log('Received courses data:', courses); // Debug log

            if (!Array.isArray(courses)) {
                throw new Error('Received data is not an array');
            }

            let tableRows = '';
            courses.forEach((course) => {
                console.log('Processing course:', course); // Debug log
                tableRows += `
                    <tr>
                        <td>${course.name || 'Unnamed Course'}</td>
                        <td>${course.mentor?.name || 'No Mentor'}</td>
                        <td>
                            <span class="status ${(course.status || '').toLowerCase()}">
                                ${course.status || 'Unknown'}
                            </span>
                        </td>
                        <td class="action-buttons">
                            <form action="/admin/courses/${course.id}/approve" method="POST" style="display:inline-block;">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </form>
                            <form action="/admin/courses/${course.id}/reject" method="POST" style="display:inline-block;">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </td>
                    </tr>
                `;
            });

            mainContent.innerHTML = `
                <h1>Course Applications</h1>
                <div class="recent-orders">
                    <h2>Pending Course Applications</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Mentor</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${courses.length ? tableRows : '<tr><td colspan="4" class="text-center">No pending course applications</td></tr>'}
                        </tbody>
                    </table>
                </div>
            `;
        } catch (error) {
            console.error("Detailed error:", {
                message: error.message,
                stack: error.stack
            });
            mainContent.innerHTML = `
                <h1>Course Applications</h1>
                <div class="error">
                    Error loading course applications: ${error.message}
                    <br>
                    <small>Please check the browser console for more details.</small>
                </div>
            `;
        }
    };
});