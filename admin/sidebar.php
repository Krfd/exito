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
                <li class="sidebar-item">
                    <a href="requests.php" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#requests" aria-expanded="false" aria-controls="requests">
                        <i class="fa-solid fa-bell-concierge icon"></i>
                        <span>Requests</span>
                    </a>
                    <ul id="requests" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="pending.php" class="sidebar-link">Pending</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="approved.php" class="sidebar-link">Approved</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="declined.php" class="sidebar-link">Declined</a>
                        </li>
                    </ul>
                </li>
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
                            <a href="app_declined" class="sidebar-link">Declined</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="account.php" class="sidebar-link">
                        <i class="fa-solid fa-user-tie icon"></i>
                        <span>Account</span>
                    </a>
                </li>
            </ul>
            <div class="text-center mt-auto text-white mb-3">
                <small id="date"></small>
                <br>
                <small id="time"></small>
            </div>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-right-from-bracket icon"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>