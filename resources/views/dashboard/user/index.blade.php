@extends('dashboard.layouts.app')


@section('container')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      line-height: 1.5;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 24px;
    }

    .header {
      margin-bottom: 32px;
    }

    .header h1 {
      font-size: 28px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 8px;
    }

    .header p {
      color: #6b7280;
      font-size: 14px;
    }

    .controls {
      display: flex;
      gap: 16px;
      margin-bottom: 24px;
      align-items: center;
      flex-wrap: wrap;
    }

    .search-container {
      position: relative;
      flex: 1;
      min-width: 250px;
    }

    .search-input {
      width: 100%;
      padding: 10px 12px 10px 40px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 14px;
      background-color: white;
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      width: 16px;
      height: 16px;
      color: #9ca3af;
    }

    .filter-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      background-color: white;
      font-size: 14px;
      cursor: pointer;
      color: #374151;
    }

    .filter-btn:hover {
      background-color: #f9fafb;
    }

    .export-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      background-color: white;
      font-size: 14px;
      cursor: pointer;
      color: #374151;
    }

    .add-user-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      border: none;
      border-radius: 8px;
      background-color: #4f46e5;
      color: white;
      font-size: 14px;
      cursor: pointer;
      font-weight: 500;
    }

    .add-user-btn:hover {
      background-color: #4338ca;
    }

    .table-container {
      background-color: white;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
      overflow: hidden;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table th {
      background-color: #f9fafb;
      padding: 12px 16px;
      text-align: left;
      font-weight: 500;
      font-size: 12px;
      color: #374151;
      border-bottom: 1px solid #e5e7eb;
      position: relative;
    }

    .table th:first-child {
      width: 40px;
      padding-left: 16px;
    }

    .table td {
      padding: 12px 16px;
      border-bottom: 1px solid #f3f4f6;
      font-size: 14px;
      vertical-align: middle;
    }

    .table tr:hover {
      background-color: #f9fafb;
    }

    .checkbox {
      width: 16px;
      height: 16px;
      border: 1px solid #d1d5db;
      border-radius: 4px;
      cursor: pointer;
    }

    .user-avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      margin-right: 12px;
      vertical-align: middle;
    }

    .user-info {
      display: flex;
      align-items: center;
    }

    .user-name {
      font-weight: 500;
      color: #111827;
    }

    .status-badge {
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 500;
      text-transform: capitalize;
    }

    .status-active {
      background-color: #dcfce7;
      color: #166534;
    }

    .status-inactive {
      background-color: #f3f4f6;
      color: #6b7280;
    }

    .status-banned {
      background-color: #fecaca;
      color: #dc2626;
    }

    .status-pending {
      background-color: #1e3a8a;
      color: white;
    }

    .status-suspended {
      background-color: #fed7aa;
      color: #ea580c;
    }

    .role-badge {
      color: #6366f1;
      font-weight: 500;
    }

    .actions {
      display: flex;
      gap: 8px;
    }

    .action-btn {
      padding: 4px;
      border: none;
      background: none;
      cursor: pointer;
      border-radius: 4px;
      color: #6b7280;
    }

    .action-btn:hover {
      background-color: #f3f4f6;
      color: #374151;
    }

    .pagination {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px;
      background-color: white;
      border-top: 1px solid #e5e7eb;
    }

    .pagination-info {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      color: #6b7280;
    }

    .pagination-select {
      padding: 4px 8px;
      border: 1px solid #d1d5db;
      border-radius: 4px;
      font-size: 14px;
    }

    .pagination-controls {
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .pagination-btn {
      padding: 8px 12px;
      border: 1px solid #d1d5db;
      background-color: white;
      cursor: pointer;
      font-size: 14px;
      border-radius: 4px;
      color: #374151;
    }

    .pagination-btn:hover {
      background-color: #f9fafb;
    }

    .pagination-btn.active {
      background-color: #4f46e5;
      color: white;
      border-color: #4f46e5;
    }

    .pagination-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .sort-icon {
      position: absolute;
      right: 8px;
      top: 50%;
      transform: translateY(-50%);
      width: 12px;
      height: 12px;
      color: #9ca3af;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>tabel {{ $judul }} </h1>
      <p>Manage all users in one place. Control access, assign roles, and monitor activity across your platform.</p>
    </div>

    <div class="controls">
      <div class="search-container">
        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <input type="text" class="search-input" placeholder="Search" id="searchInput">
      </div>

      <button class="filter-btn" onclick="toggleFilter('role')">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 9H14V4H5V21H19V9Z"/>
        </svg>
        Role
        <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
          <path d="M7 10l5 5 5-5z"/>
        </svg>
      </button>

      <button class="filter-btn" onclick="toggleFilter('status')">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/>
        </svg>
        Status
        <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
          <path d="M7 10l5 5 5-5z"/>
        </svg>
      </button>

      <button class="filter-btn" onclick="toggleFilter('date')">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
          <path d="M19,3H18V1H16V3H8V1H6V3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V8H19V19Z"/>
        </svg>
        Date
        <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
          <path d="M7 10l5 5 5-5z"/>
        </svg>
      </button>

      <button class="export-btn" onclick="exportData()">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
          <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
        </svg>
        Export
      </button>

      <button class="add-user-btn" onclick="addUser()">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
          <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
        </svg>
        Add User
      </button>
    </div>

    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>
              <input type="checkbox" class="checkbox" id="selectAll" onchange="toggleSelectAll()">
            </th>
            <th>
              Full Name
              <svg class="sort-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z"/>
              </svg>
            </th>
            <th>
              Email
              <svg class="sort-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z"/>
              </svg>
            </th>
            <th>
              Username
              <svg class="sort-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z"/>
              </svg>
            </th>
            <th>
              Status
              <svg class="sort-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z"/>
              </svg>
            </th>
            <th>
              Role
              <svg class="sort-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z"/>
              </svg>
            </th>
            <th>
              Joined Date
              <svg class="sort-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z"/>
              </svg>
            </th>
            <th>
              Last Active
              <svg class="sort-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z"/>
              </svg>
            </th>
            <th>
              Actions
              <svg class="sort-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z"/>
              </svg>
            </th>
          </tr>
        </thead>
        <tbody id="userTableBody">
          <!-- User rows will be populated by JavaScript -->
        </tbody>
      </table>

      <div class="pagination">
        <div class="pagination-info">
          <span>Rows per page</span>
          <select class="pagination-select" id="rowsPerPage" onchange="changeRowsPerPage()">
            <option value="10" selected>10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <span>of 140 rows</span>
        </div>

        <div class="pagination-controls">
          <button class="pagination-btn" onclick="goToPage('first')" disabled>
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
              <path d="M18.41,16.59L13.82,12L18.41,7.41L17,6L11,12L17,18L18.41,16.59M6,6H8V18H6V6Z"/>
            </svg>
          </button>
          <button class="pagination-btn" onclick="goToPage('prev')" disabled>
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
              <path d="M15.41,16.59L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.59Z"/>
            </svg>
          </button>
          <button class="pagination-btn active" onclick="goToPage(1)">1</button>
          <button class="pagination-btn" onclick="goToPage(2)">2</button>
          <button class="pagination-btn" onclick="goToPage(3)">3</button>
          <span style="padding: 0 8px; color: #6b7280;">...</span>
          <button class="pagination-btn" onclick="goToPage(10)">10</button>
          <button class="pagination-btn" onclick="goToPage('next')">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
              <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.59Z"/>
            </svg>
          </button>
          <button class="pagination-btn" onclick="goToPage('last')">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
              <path d="M5.59,7.41L10.18,12L5.59,16.59L7,18L13,12L7,6L5.59,7.41M16,6H18V18H16V6Z"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    const users = [
      {
        id: 1,
        name: 'John Smith',
        email: 'john.smith@gmail.com',
        username: 'jonny77',
        status: 'active',
        role: 'Admin',
        joinedDate: 'March 12, 2023',
        lastActive: '1 minute ago',
        avatar: 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 2,
        name: 'Olivia Bennett',
        email: 'ollyben@gmail.com',
        username: 'olly659',
        status: 'inactive',
        role: 'User',
        joinedDate: 'June 27, 2022',
        lastActive: '1 month ago',
        avatar: 'https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 3,
        name: 'Daniel Warren',
        email: 'dwarren3@gmail.com',
        username: 'dwarren3',
        status: 'banned',
        role: 'User',
        joinedDate: 'January 8, 2024',
        lastActive: '4 days ago',
        avatar: 'https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 4,
        name: 'Chloe Hayes',
        email: 'chloehiye@gmail.com',
        username: 'chloehh',
        status: 'pending',
        role: 'Guest',
        joinedDate: 'October 5, 2021',
        lastActive: '10 days ago',
        avatar: 'https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 5,
        name: 'Marcus Reed',
        email: 'reeds777@gmail.com',
        username: 'reeds7',
        status: 'suspended',
        role: 'User',
        joinedDate: 'February 19, 2023',
        lastActive: '3 months ago',
        avatar: 'https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 6,
        name: 'Isabelle Clark',
        email: 'belleclark@gmail.com',
        username: 'bellecl',
        status: 'active',
        role: 'Moderator',
        joinedDate: 'August 30, 2022',
        lastActive: '1 week ago',
        avatar: 'https://images.pexels.com/photos/1130626/pexels-photo-1130626.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 7,
        name: 'Lucas Mitchell',
        email: 'lucamitch@gmail.com',
        username: 'lucamich',
        status: 'active',
        role: 'Guest',
        joinedDate: 'April 23, 2024',
        lastActive: '4 hours ago',
        avatar: 'https://images.pexels.com/photos/1043471/pexels-photo-1043471.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 8,
        name: 'Mark Wilburg',
        email: 'markwill32@gmail.com',
        username: 'markwill32',
        status: 'banned',
        role: 'User',
        joinedDate: 'November 14, 2020',
        lastActive: '2 months ago',
        avatar: 'https://images.pexels.com/photos/1212984/pexels-photo-1212984.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 9,
        name: 'Nicholas Agenn',
        email: 'nicolass009@gmail.com',
        username: 'nicolass009',
        status: 'suspended',
        role: 'User',
        joinedDate: 'July 6, 2023',
        lastActive: '3 hours ago',
        avatar: 'https://images.pexels.com/photos/1300402/pexels-photo-1300402.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 10,
        name: 'Mia Nadinn',
        email: 'mianaddiin@gmail.com',
        username: 'mianaddiin',
        status: 'inactive',
        role: 'Guest',
        joinedDate: 'December 31, 2021',
        lastActive: '4 months ago',
        avatar: 'https://images.pexels.com/photos/1542085/pexels-photo-1542085.jpeg?auto=compress&cs=tinysrgb&w=64'
      },
      {
        id: 11,
        name: 'Noemi Villan',
        email: 'noemivill99@gmail.com',
        username: 'noemi',
        status: 'active',
        role: 'Admin',
        joinedDate: 'August 10, 2024',
        lastActive: '15 minutes ago',
        avatar: 'https://images.pexels.com/photos/1858175/pexels-photo-1858175.jpeg?auto=compress&cs=tinysrgb&w=64'
      }
    ];

    function renderUsers() {
      const tbody = document.getElementById('userTableBody');
      tbody.innerHTML = '';

      users.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>
            <input type="checkbox" class="checkbox" data-user-id="${user.id}">
          </td>
          <td>
            <div class="user-info">
              <img src="${user.avatar}" alt="${user.name}" class="user-avatar" onerror="this.src='https://dummyimage.com/32x32/e5e5e5/666666?text=User'">
              <span class="user-name">${user.name}</span>
            </div>
          </td>
          <td>${user.email}</td>
          <td>${user.username}</td>
          <td>
            <span class="status-badge status-${user.status}">${user.status}</span>
          </td>
          <td>
            <span class="role-badge">${user.role}</span>
          </td>
          <td>${user.joinedDate}</td>
          <td>${user.lastActive}</td>
          <td>
            <div class="actions">
              <button class="action-btn" onclick="editUser(${user.id})" title="Edit">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                </svg>
              </button>
              <button class="action-btn" onclick="deleteUser(${user.id})" title="Delete">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                </svg>
              </button>
            </div>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    function toggleSelectAll() {
      const selectAll = document.getElementById('selectAll');
      const checkboxes = document.querySelectorAll('input[data-user-id]');

      checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
      });
    }

    function toggleFilter(type) {
      console.log(`Toggle ${type} filter`);
    }

    function exportData() {
      console.log('Export data');
    }

    function addUser() {
      console.log('Add new user');
    }

    function editUser(userId) {
      console.log(`Edit user ${userId}`);
    }

    function deleteUser(userId) {
      console.log(`Delete user ${userId}`);
    }

    function changeRowsPerPage() {
      const select = document.getElementById('rowsPerPage');
      console.log(`Change rows per page to ${select.value}`);
    }

    function goToPage(page) {
      console.log(`Go to page ${page}`);
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      console.log(`Search for: ${searchTerm}`);
      // Implement search logic here
    });

    // Initialize the table
    renderUsers();
  </script>
</body>
</html>
@endsection
