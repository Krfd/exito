<aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-gauge icon"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Dashboard</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <hr class="text-white">
                <li class="sidebar-item">
                    <a href="analytics.php" class="sidebar-link">
                    <i class="fa-solid fa-chart-line icon"></i>
                        <span>Analytics</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="requests.php" class="sidebar-link">
                    <i class="fa-solid fa-bell-concierge icon"></i>
                        <span>Requests</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="pending.php" class="sidebar-link">
                        <i class="fa-solid fa-clock icon"></i>
                        <span>Pending</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="approved.php" class="sidebar-link">
                    <i class="fa-solid fa-user-check icon"></i>
                        <span>Approved</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="declined.php" class="sidebar-link">
                    <i class="fa-solid fa-ban icon"></i>
                        <span>Declined</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="clients.php" class="sidebar-link">
                    <i class="fa-solid fa-user-plus icon"></i>
                        <span>Clients</span>
                    </a>
                </li>
                <hr class="sidebar-divider text-white">
                <li class="sidebar-item">
                    <a href="appointment.php" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#appointment" aria-expanded="false" aria-controls="appointment">
                        <i class="fa-solid fa-calendar-check icon"></i>
                        <span>Appointment</span>
                    </a>
                    <ul id="appointment" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="app_meeting.php" class="sidebar-link">Meeting</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="app_declined.php" class="sidebar-link">Declined</a>
                        </li>
                    </ul>
                </li>
                <hr class="sidebar-divider text-white">
                <li class="sidebar-item">
                    <a href="account.php" class="sidebar-link">
                        <i class="fa-solid fa-user-tie icon"></i>
                        <span>Account</span>
                    </a>
                </li>
                <hr class="sidebar-divider text-white">
            </ul>
            <div class="text-center mt-auto text-white mb-3">
                <small id="date"></small>
                <br>
                <small id="time"></small>
            </div>
            <div class="sidebar-footer">
                <a href="config.php?logout=true" class="sidebar-link">
                    <i class="fa-solid fa-right-from-bracket icon"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>