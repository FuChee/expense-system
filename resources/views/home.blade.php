<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        @vite(['resources/css/home-style.css'])
    </head>
    <body>
        <div class="layout">
            <aside class="sidebar">
                <div>
                    <div class="brand">Expense System</div>

                    <div class="nav-links">
                        <a href="/home" class="active">Dashboard</a>
                        <a href="/expenses/index">My Expenses</a>
                        <a href="/expenses/create">Add Expense</a>
                        <a href="/categories">My Categories</a>
                        @can('isAdmin')
                            <a href="/users">View Users</a>
                        @endcan
                    </div>
                </div>
            </aside>

            <main class="main">
                <div class="topbar">
                    <h1>Dashboard</h1>
                   
                    <div class="user-dropdown">
                        <div class="user-box" onclick="toggleDropdown()">
                            Welcome, {{ auth()->user()->name }}
                            <span class="dropdown-arrow">▼</span>
                        </div>

                        <div class="dropdown-menu" id="userDropdown">
                            <a href="/home" class="dropdown-item">Dashboard</a>
                            <a href="/expenses/index" class="dropdown-item">Expenses</a>
                            <a href="/profile" class="dropdown-item">Profile</a>
                            <form method="POST" action="/logout" class="dropdown-form">
                                @csrf
                                <button type="submit" class="dropdown-item logout-btn">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="welcome-card">
                    @if(Session::get('user_email'))
                        <h2>
                            Welcome {{ Session::get('user_email') }}
                        </h2>
                    @endif
                    <p>Manage your expenses, track your categories, and monitor your spending from one place.</p>

                    @can('isAdmin')
                        <span class="role-badge">Administrator Access</span>
                    @else
                        <span class="role-badge">User Access</span>
                    @endcan
                </div>

                <div class="stats-grid">
                    <div class="card">
                        <div class="stat-title">Total Expenses</div>
                        <div class="stat-value">RM {{ $totalExpenses }}</div>
                    </div>

                    <div class="card">
                        <div class="stat-title">This Month</div>
                        <div class="stat-value">RM {{ $thisMonthExpenses }}</div>
                    </div>
                    <div class="card">
                        <div class="stat-title">Categories Added</div>
                        <div class="stat-value">{{ $categoryCount }}</div>
                    </div>
                    <div class="card">
                        <div class="stat-title">Transactions</div>
                        <div class="stat-value">0</div>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="card">
                        <div class="section-title">Monthly Spending - {{ now()->year }}</div>
                        <canvas id="monthlyChart" height="120"></canvas>
                    </div>

                    <div class="card">
                        <div class="section-title">Category Spending</div>
                        <canvas id="categoryChart" height="120"></canvas>
                    </div>
                </div>
                <br>

                <div class="card">
                    <div class="section-title">Quick Actions</div>
                    <div class="action-buttons">
                        <a href="/expenses/create" class="btn btn-primary">+ Add Expense</a>
                        <a href="/expenses/index" class="btn btn-light">View Expenses</a>
                        <a href="/categories" class="btn btn-light">Manage Categories</a>
                        @can('isAdmin')
                            <a href="/users" class="btn btn-light">Manage Users</a>
                        @endcan
                    </div>
                    @can('isAdmin')
                        <div class="admin-panel">
                            You are logged in as an admin. You can manage categories, users and monitor all system data.
                        </div>
                    @endcan
                </div>
            </main>
        </div>
        <script>
            function toggleDropdown() {
                document.getElementById("userDropdown").classList.toggle("show");
            }

            window.onclick = function(event) {
                if (!event.target.closest('.user-dropdown')) {
                    const dropdown = document.getElementById("userDropdown");
                    if (dropdown.classList.contains("show")) {
                        dropdown.classList.remove("show");
                    }
                }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const monthlyData = @json($monthlyData);
            const categoryByMonth = @json($categoryByMonth);

            const monthLabels = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];

            let currentMonth = new Date().getMonth() + 1;

            const categoryChart = new Chart(document.getElementById('categoryChart'), {
                type: 'pie',
                data: {
                    labels: categoryByMonth[currentMonth]?.labels ?? [],
                    datasets: [{
                        label: 'Category Spending',
                        data: categoryByMonth[currentMonth]?.data ?? []
                    }]
                }
            });

            new Chart(document.getElementById('monthlyChart'), {
                type: 'bar',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Monthly Spending',
                        data: monthlyData,
                        backgroundColor: '#2563eb'
                    }]
                },
                options: {
                    onClick: function(event, elements) {
                        if (elements.length > 0) {
                            const index = elements[0].index;
                            const selectedMonth = index + 1;

                            categoryChart.data.labels = categoryByMonth[selectedMonth]?.labels ?? [];
                            categoryChart.data.datasets[0].data = categoryByMonth[selectedMonth]?.data ?? [];
                            categoryChart.data.datasets[0].label = 'Category Spending - ' + monthLabels[index];
                            categoryChart.update();
                        }
                    }
                }
            });
        </script>
    </body>
</html>