<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Train Track API Documentation</title>
  <style>
    /* Global */
    body {
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: #e0e0e0;
      margin: 0;
      scroll-behavior: smooth;
    }

    header {
      background-color: #1e1e2f;
      color: #ffffff;
      padding: 2rem;
      text-align: center;
      border-bottom: 2px solid #333;
      font-family: 'Segoe UI', sans-serif;
    }

    main {
      padding: 2rem;
    }

    h1,
    h2,
    h3 {
      color: #80bdff;
      margin-bottom: 0.5rem;
    }

    /* Code blocks */
    code,
    pre {
      background-color: #272727;
      color: #f1f1f1;
      padding: 0.5rem;
      border-radius: 4px;
      font-family: monospace;
      overflow-x: auto;
      word-break: break-word;
      white-space: nowrap;
    }

    /* Endpoint Styling */
    .endpoint {
      margin-bottom: 1rem;
      border: 1px solid #333;
      border-radius: 5px;
      background-color: #1a1a1a;
    }

    .endpoint h3 {
      cursor: pointer;
      background-color: #222;
      color: #ffcc00;
      padding: 0.75rem 1rem;
      margin: 0;
    }

    .endpoint-content {
      padding: 1rem;
      display: none;
    }

    .method {
      font-weight: bold;
      padding: 2px 8px;
      border-radius: 4px;
      background-color: #555;
      color: #fff;
      text-transform: uppercase;
      font-size: 0.9em;
    }

    .method.GET {
      background-color: #198754;
    }

    .method.POST {
      background-color: #0d6efd;
    }

    .method.PUT {
      background-color: #ffc107;
      color: #000;
    }

    .method.DELETE {
      background-color: #dc3545;
    }

    /* Section collapsible wrapper */
    .section-header {
      background-color: #202020;
      color: #ffcc00;
      padding: 1rem;
      cursor: pointer;
      border: 1px solid #333;
      border-radius: 5px;
      margin-top: 2rem;
    }

    .section-content {
      display: none;
      padding: 1rem;
      border-left: 2px solid #555;
    }

    /* Search bar */
    .search {
      margin-bottom: 2rem;
    }

    .search input {
      width: 100%;
      padding: 0.75rem;
      border-radius: 4px;
      border: 1px solid #555;
      font-size: 1rem;
      background-color: #1f1f1f;
      color: #e0e0e0;
    }

    /* Light Mode */
    body.light-mode {
      background-color: #f0f0f0;
      color: #1c1c1c;
    }

    body.light-mode header {
      background-color: #e0e0e0;
      color: #111;
    }

    body.light-mode .endpoint {
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 1.5rem;
    }

    body.light-mode .endpoint h3 {
      background-color: #f0f0f0;
      color: #222;
    }

    body.light-mode .endpoint-content {
      background-color: #ffffff;
      border-left: 3px solid #ddd;
      padding: 1rem;
      border-radius: 4px;
    }

    body.light-mode .section-header {
      background-color: #eeeeee;
      color: #333;
      border-color: #ccc;
    }

    body.light-mode .section-content {
      background-color: #ffffff;
      border-left: 2px solid #ccc;
    }

    body.light-mode .search input {
      background-color: #f5f5f5;
      color: #222;
      border: 1px solid #aaa;
    }

    body.light-mode code,
    body.light-mode pre {
      background: #f4f4f4;
      color: #202020;
    }
  </style>


</head>

<body>
  <header>
    <!-- Success icon with checkmark -->
    {{-- <svg style="display:block;margin:20px auto;width:80px;height:80px;fill:#27ae60;" viewBox="0 0 24 24">
      <path
        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
    </svg> --}}
    <h1>Train Track API Documentation</h1>
    <p>Comprehensive guide to using our API</p>
    <button onclick="toggleTheme()">🌓 Toggle Theme</button>

  </header>

  <main>
    <section id="introduction">
      <h2>Introduction</h2>
      <p>Welcome to the API documentation. This API allows you to interact with our platform programmatically.</p>
    </section>

    <section id="authentication">
      <h2>Authentication</h2>
      <p>Include your API key in the header:</p>
      <pre><code>Authorization: Bearer YOUR_API_KEY</code></pre>
    </section>

    <section class="search">
      <h2>Search Endpoints</h2>
      <input type="text" id="searchBox" placeholder="Search for endpoint titles or URLs..." />
    </section>


    <!-- Section 1: Auth -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Authentication & Users</h2>
      </div>
      <div class="section-content">

        <div class="endpoint" data-title="Login">
          <h3>1. Login</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/login</p>
            <p><strong>Description:</strong> Authenticates the user using email and password. Returns a
              token if
              successful.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "email": "dstroman@example.net", "password": "12345678" }</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
                  "message": "Logged in successfully ",
                  "token": "14|gAftDniU5VipCR7h2A4PRFC0VIXQntQgJE48an5I1d0b6cdd",
                  "user": {
                      "id": 9,
                      "name": "Prof. Grayson Mann",
                      "email": "dstroman@example.net",
                      "email_verified_at": "2025-06-04 23:10:15",
                      "position": "Coordinator",
                      "section_id": 1,
                      "role_id": 3,
                      "code": null,
                      "status": 1,
                      "img_url": null,
                      "created_at": "2025-06-04T23:10:15.000000Z",
                      "updated_at": "2025-06-04T23:10:15.000000Z",
                      "section": {
                          "id": 1,
                          "name": "UAT & Training",
                          "division": "Customer Care Support",
                          "deleted_at": null,
                          "created_at": "2025-06-04T23:09:41.000000Z",
                          "updated_at": "2025-06-04T23:09:41.000000Z"
                      },
                      "role": {
                          "id": 3,
                          "name": "Trainer",
                          "created_at": "2025-06-04T23:10:14.000000Z",
                          "updated_at": "2025-06-04T23:10:14.000000Z"
                      }
                  }
              }</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Incorrect login credentials" }</code></pre>
              <pre><code>// 422 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."],
    "password": ["The password must be at least 6 characters."]
  }
}</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Login/Mobile">
          <h3>2. Login from mobile app</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/login/mobile</p>
            <p><strong>Description:</strong> Authenticates the user using email and password. Returns a
              token if successful.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "email": "trainer@mail.com", "password": "12345678" }</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{"message": "Logged in successfully ",
              "token": "67|N57kbO3yp0pBs7D2VcW52BvTPoiaS2h7RBbzZzBo877b6546",
              "user": {
                "id": 3,
                "name": "trainer",
                "email": "trainer@mail.com",
                "email_verified_at": null,
                "position": "Coordinator",
                "section_id": 1,
                "role_id": 3,
                "delegation_id": null,
                "code": null,
                "status": 1,
                "img_url": null,
                "created_at": "2025-08-14T20:15:50.000000Z",
                "updated_at": "2025-08-14T20:15:50.000000Z",
                "section": {
                  "id": 1,
                  "name": "UAT & Training",
                  "division": "CC - Customer Care Support",
                  "email": "UAT@mail.com",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:49.000000Z",
                  "updated_at": "2025-08-14T20:15:49.000000Z"
                },
                "role": {
                  "id": 3,
                  "name": "Trainer",
                  "created_at": "2025-08-14T20:15:49.000000Z",
                  "updated_at": "2025-08-14T20:15:49.000000Z"
                }
              }
            }</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Incorrect login credentials" }</code></pre>
              <pre><code>// 422 Validation Error
                {
                  "message": "The given data was invalid.",
                  "errors": {
                    "email": ["The email field is required."],
                    "password": ["The password must be at least 6 characters."]
                  }
                }</code>
              </pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Logout">
          <h3>3. Logout</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/logout</p>
            <p><strong>Description:</strong> Logs the user out and deletes all active tokens.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>// No body needed</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "Logout successfully" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Add User">
          <h3>4. Add User</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/add_user</p>
            <p><strong>Description:</strong> Creates a new user. Only Super Admins can perform this action.
            </p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "name": "New User", "email": "newuser@example.com", "password": "password123", "password_confirmation": "password123", "role_id": 2, "section_id": 1 }</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "User added successfully!" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
              <pre><code>// 403 Forbidden
                { "message": "Unauthorized!" }</code></pre>
              <pre><code>// 422 Validation Error
                {
                  "message": "The given data was invalid.",
                  "errors": {
                    "email": ["The email has already been taken."],
                    "password": ["The password confirmation does not match."]
                  }
                }</code>
              </pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Update Profile">
          <h3>5. Update Profile</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/updateProfile/{id}</p>
            <p><strong>Description:</strong> updateProfile of user. Only Super Admins can perform this action.
            </p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "name": "New User", "email": "newuser@example.com", "password": "password123", "password_confirmation": "password123", "role_id": 2, "section_id": 1 , 'delegation_id' : 2}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "User updated successfully!" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code>
              </pre>
              <pre><code>// 403 Forbidden
                  { "message": "Unauthorized!" }</code>
              </pre>
              <pre><code>// 400 trying to set delegation to not trainer
                  { "message": "Sorry ! the trainer only who can has a delegation , Thank you for your understanding !" }</code>
              </pre>
              <pre><code>// 400 trying to set delegation not trainer
                  { "message": "Sorry! the delegation should only be a trainer !" }</code>
              </pre>
              <pre><code>// 422 Validation Error
                {
                  "message": "The given data was invalid.",
                  "errors": {
                    "email": ["The email has already been taken."],
                    "password": ["The password confirmation does not match."]
                  }
                }</code>
              </pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Change Role">
          <h3>6. Change Role</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/changeRole</p>
            <p><strong>Description:</strong> change Role of specified User</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "user_id": 10, "role_id": 2 }</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "user\'s roles has been changed successfully!" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
              <pre><code>// 403 Forbidden
                { "message": "Unauthorized!" }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Block">
          <h3>7. Block / Unblock user</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/block</p>
            <p><strong>Description:</strong> Block / Unblock specified user</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "user_id": 10, "status": true }</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "user has been unblocked successfully !" }</code></pre>

            <p><strong>Request2 Example:</strong></p>
            <pre><code>{ "user_id": 10, "status": 0 }</code></pre>
            <p><strong>Response2 Example:</strong></p>
            <pre><code>{ "message": "user has been blocked successfully !" }</code></pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
              <pre><code>// 403 Forbidden
                { "message": "Unauthorized!" }</code></pre>
              <pre><code>// 400 Wrong request
                { "message": "user is already active !" }</code></pre>
              <pre><code>// 400 Wrong request
                { "message": "user is already blocked !" }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Forget Password">
          <h3>8. Forget Password</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/forget_password</p>
            <p><strong>Description:</strong> Sends a verification code to the entered user's email.
            </p>
            <p><strong>Request Example:</strong></p>

            <pre><code>{ "email": "user@example.com" }</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "status": 200, "message": "Send code successfully" }</code></pre>

          </div>
        </div>

        <div class="endpoint" data-title="Check Forget Code">
          <h3>9. Check Forget Code</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/check_forget_code</p>
            <p><strong>Description:</strong> Validates the code sent to the user's email.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "email": "admin@example.com", "code": "13245" }</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "status": 200, "message": "Code Is valid" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Invalid
{ "status": 401, "message": "Invalid code or email" }</code></pre>

            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Reset Password">
          <h3>10. Reset Password</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reset_password</p>
            <p><strong>Description:</strong> Updates a user's password after verifying the code.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "email": "user@example.com",
  "code": "12345",
  "password": "new_password",
  "password_confirmation": "new_password"
}</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Invalid
{ "status": 401, "message": "Invalid request" }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get All Users">
          <h3>11. Get All Users</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/users</p>
            <p><strong>Description:</strong> Retrieves All user.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>// No body needed (auth token required)</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{ "id": 3, "name": "John Doe", "email": "john@example.com", "role_id": 2, "section_id": 1 }]</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get Blocked Users">
          <h3>12. Get Blocked Users</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/blockedUsers</p>
            <p><strong>Description:</strong> Retrieves All blocked Users .</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>// No body needed (auth token required)</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{ "id": 3, "name": "John Doe", "email": "john@example.com", "role_id": 2, "section_id": 1 }]</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get user based on Role">
          <h3>13. Get users based on Role</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/userRoles/{Role_id}</p>
            <p><strong>Description:</strong> Retrieves All Users of specifer Role .</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>// No body needed (auth token required)</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{ "id": 3, "name": "John Doe", "email": "john@example.com", "role_id": 2, "section_id": 1 }]</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get Logged In User">
          <h3>14. Profile</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/profile</p>
            <p><strong>Description:</strong> Retrieves the currently authenticated user's profile.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>// No body needed (auth token required)</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "id": 3, "name": "John Doe", "email": "john@example.com", "role_id": 2, "section_id": 1 }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Search User">
          <h3>15. Search User</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/users/search?query=keyword</p>
            <p><strong>Description:</strong> Searches users by name or email. (Should be logged in)</p>
            <p><strong>Response Example (matches found):</strong></p>
            <pre><code>[{ "id": 3, "name": "John Doe", "email": "john@example.com", "role_id": 2, "section_id": 1 }]</code></pre>
            <p><strong>Alternate Response Example (no matches):</strong></p>
            <pre><code>{ "message": "not found !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code>
              </pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Update My Profile">
          <h3>16. Update MY Profile</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/updateMyProfile</p>
            <p><strong>Description:</strong> update Profile of authenticated user.
            </p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "name": "New User", "password": "password123", "password_confirmation": "password123" , 'image':image}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "Your profile updated successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code>
              </pre>
              <pre><code>// 422 Validation Error
                {
                  "message": "The given data was invalid.",
                  "errors": {
                    "password": ["The password confirmation does not match."]
                  }
                }</code>
              </pre>
            </details>
          </div>
        </div>

      </div>
    </div>

    <!-- Section 2: Sections -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Sections</h2>
      </div>
      <div class="section-content">

        <div class="endpoint" data-title="List All Sections">
          <h3>1. List All Sections</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/sections</p>
            <p><strong>Description:</strong> Retrieves all sections in the system.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
  {
    "id": 1,
    "name": "UAT & Training",
    "division": "CC - Customer Care Support"
  },
  {
    "id": 2,
    "name": "Segment Consumer",
    "division": "Marketing - P&S"
  },
  {
    "id": 3,
    "name": "CVM",
    "division": "Marketing - P&S"
  }
]</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }

// 403 Forbidden (if not superadmin)
{ "message": "User does not have the right roles." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Create New Section">
          <h3>2. Create New Section</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/sections</p>
            <p><strong>Description:</strong> Creates a new section in the system.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "name": "VAS - Administration & Operation",
  "division": "IT - CSD"
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "Section has been added successfully!" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 400 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name field is required."],
    "division": ["The division field must be a string."]
  }
}

// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get Section Details">
          <h3>3. Get Section Details</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/sections/1</p>
            <p><strong>Description:</strong> Retrieves details of a specific section.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
  "id": 1,
  "name": "UAT & Training",
  "division": "CC - Customer Care Support"
}</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Section] 999" }

// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Update Section">
          <h3>4. Update Section</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/sections/4</p>
            <p><strong>Description:</strong> Updates an existing section's information.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "name": "VAS - Administration & Operations",
  "division": "IT - Customer Support Division"
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "Section has been updated successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Section] 999" }

// 400 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "division": ["The division field must be a string."]
  }
}</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Delete Section">
          <h3>5. Delete Section</h3>
          <div class="endpoint-content">
            <p><span class="method DELETE">DELETE</span> /api/sections/2</p>
            <p><strong>Description:</strong> Soft deletes a section from the system.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "Section has been deleted successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Section] 999" }

// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Search Section">
          <h3>6. Search Section</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/sections/search?query=keyword</p>
            <p><strong>Description:</strong> Searches sections by name or division. (Should be logged in)</p>
            <p><strong>Response Example (matches found):</strong></p>
            <pre><code>[
              {
                "id": 1,
                "name": "UAT & Training",
                "division": "CC - Customer Care Support",
                "email": "CCTraining@mtn.com.sy"
              }
              ]</code>
            </pre>
            <p><strong>Alternate Response Example (no matches):</strong></p>
            <pre><code>{ "message": "not found !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="List With Trashed">
          <h3>7. List All Sections (With Trashed)</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/sections/withTrashed</p>
            <p><strong>Description:</strong> Lists all sections including soft-deleted ones. (Role: SuperAdmin, Admin)
            </p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "id": 1,
                "name": "UAT & Training",
                "division": "CC - Customer Care Support",
                "email": "CCTraining@mtn.com.sy",
                "deleted_at":"2025-08-15T08:00:00.000000Z"
              }
              ]</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }

                // 403 Forbidden (if not SuperAdmin/Admin)
                { "message": "User does not have the right roles." }</code>
              </pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="List Only Trashed">
          <h3>8. List Only Trashed Sections</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/sections/trashed</p>
            <p><strong>Description:</strong> Lists only the soft-deleted sections. (Role: SuperAdmin, Admin)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "id": 1,
                "name": "UAT & Training",
                "division": "CC - Customer Care Support",
                "email": "CCTraining@mtn.com.sy",
                "deleted_at":"2025-08-15T08:00:00.000000Z"
              }
              ]</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }

// 403 Forbidden (if not SuperAdmin/Admin)
{ "message": "User does not have the right roles." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Restore Section">
          <h3>9. Restore Section</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/sections/restore/{id}</p>
            <p><strong>Description:</strong> Restores a previously soft-deleted Section. (Role: SuperAdmin, Admin)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "section has been restored successfully !','section' => $section" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 400 Bad Request (section isn't deleted)
                { "message": "sections isn't deleted !" }

                // 401 Unauthorized
                { "message": "Unauthenticated." }

                // 403 Forbidden (if not SuperAdmin/Admin)
                { "message": "User does not have the right roles." }

                // 404 Not Found
                { "message": "No query results for model [Category] 123" }</code>
              </pre>
            </details>
          </div>
        </div>

      </div>
    </div>

    <!-- Section 3: Categories -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Categories</h2>
      </div>
      <div class="section-content">

        <!-- 1. List All Categories -->
        <div class="endpoint" data-title="List All Categories">
          <h3>1. List All Categories</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/categories</p>
            <p><strong>Description:</strong> Retrieves all categories in the system. (Should be logged in)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
  {
    "id": 3,
    "name": "call screening",
    "description": "call screening",
    "owner_id": null,
    "weight": 0,
    "deleted_at": null,
    "created_at": "2025-08-14T20:15:54.000000Z",
    "updated_at": "2025-08-14T20:15:54.000000Z"
  },
  {
    "id": 16,
    "name": "Call me",
    "description": "Call me",
    "owner_id": null,
    "weight": 0,
    "deleted_at": null,
    "created_at": "2025-08-14T20:15:54.000000Z",
    "updated_at": "2025-08-14T20:15:54.000000Z"
  }
]</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }

// 403 Forbidden (if not superadmin)
{ "message": "User does not have the right roles." }</code></pre>
            </details>
          </div>
        </div>

        <!-- 2. Create New Category -->
        <div class="endpoint" data-title="Create New Category">
          <h3>2. Create New Category</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/categories</p>
            <p><strong>Description:</strong> Creates a new category in the system. (Role: SuperAdmin, Admin)</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "name": "Annual Validity",
  "description": "Annual Validity",
  "weight": 70
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "Category has been added successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 400 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name field is required."],
    "description": ["The description field must be a string."],
    "weight": ["The weight must be between 0 and 100."]
  }
}

// 401 Unauthorized
{ "message": "Unauthenticated." }

// 403 Forbidden (if not SuperAdmin/Admin)
{ "message": "User does not have the right roles." }</code></pre>
            </details>
          </div>
        </div>

        <!-- 3. Update Category -->
        <div class="endpoint" data-title="Update Category">
          <h3>3. Update Category</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/categories/{id}</p>
            <p><strong>Description:</strong> Updates a category’s details. If <code>owner_id</code> is provided, a new
              Task is created for that category using the latest task’s delegation. (Role: SuperAdmin, Admin)</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "name": "Updated Category Name",
  "description": "Updated description",
  "owner_id": 5,
  "weight": 80
}</code></pre>
            <p><strong>Response Example (with owner_id):</strong></p>
            <pre><code>{ "message": "Category has been updated successfully ! And new Task has been created successfully !" }</code></pre>
            <p><strong>Response Example (without owner_id):</strong></p>
            <pre><code>{ "message": "Category has been updated successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 400 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name has already been taken."],
    "owner_id": ["The selected owner id is invalid."],
    "weight": ["The weight must be between 0 and 100."]
  }
}

// 401 Unauthorized
{ "message": "Unauthenticated." }

// 403 Forbidden (if not SuperAdmin/Admin)
{ "message": "User does not have the right roles." }

// 404 Not Found
{ "message": "No query results for model [Category] 123" }</code></pre>
            </details>
          </div>
        </div>

        <!-- 4. Delete Category -->
        <div class="endpoint" data-title="Delete Category">
          <h3>4. Delete Category</h3>
          <div class="endpoint-content">
            <p><span class="method DELETE">DELETE</span> /api/categories/{id}</p>
            <p><strong>Description:</strong> Soft-deletes a category. (Role: SuperAdmin, Admin)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "Category has been deleted successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }

// 403 Forbidden (if not SuperAdmin/Admin)
{ "message": "User does not have the right roles." }

// 404 Not Found
{ "message": "No query results for model [Category] 123" }</code></pre>
            </details>
          </div>
        </div>

        <!-- 5. Restore Category -->
        <div class="endpoint" data-title="Restore Category">
          <h3>5. Restore Category</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/categories/restore/{id}</p>
            <p><strong>Description:</strong> Restores a previously soft-deleted category. (Role: SuperAdmin, Admin)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "category has been restored successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 400 Bad Request (category isn't deleted)
{ "message": "category isn't deleted !" }

// 401 Unauthorized
{ "message": "Unauthenticated." }

// 403 Forbidden (if not SuperAdmin/Admin)
{ "message": "User does not have the right roles." }

// 404 Not Found
{ "message": "No query results for model [Category] 123" }</code></pre>
            </details>
          </div>
        </div>

        <!-- 6. Search Categories -->
        <div class="endpoint" data-title="Search Categories">
          <h3>6. Search Categories</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/categories/search?query=keyword</p>
            <p><strong>Description:</strong> Searches categories by name or description. (Should be logged in)</p>
            <p><strong>Response Example (matches found):</strong></p>
            <pre><code>[
  {
    "id": 7,
    "name": "Prepaid & Postpaid Subscription ( Stay With us - Pick your number )",
    "description": "Prepaid & Postpaid Subscription ( Stay With us - Pick your number )",
    "owner_id": null,
    "weight": 0,
    "deleted_at": null,
    "created_at": "2025-08-14T20:15:53.000000Z",
    "updated_at": "2025-08-14T20:15:53.000000Z"
  }
]</code></pre>
            <p><strong>Alternate Response Example (no matches):</strong></p>
            <pre><code>{ "message": "not found !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <!-- 7. List All Categories (With Trashed) -->
        <div class="endpoint" data-title="List With Trashed">
          <h3>7. List All Categories (With Trashed)</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/categories/withTrashed</p>
            <p><strong>Description:</strong> Lists all categories including soft-deleted ones. (Role: SuperAdmin, Admin)
            </p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
  {
    "id": 10,
    "name": "RBT",
    "description": "RBT",
    "deleted_at": "2025-08-15T08:00:00.000000Z"
  },
  {
    "id": 11,
    "name": "superclip",
    "description": "superclip",
    "deleted_at": null
  }
]</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }

// 403 Forbidden (if not SuperAdmin/Admin)
{ "message": "User does not have the right roles." }</code></pre>
            </details>
          </div>
        </div>

        <!-- 8. List Only Trashed Categories -->
        <div class="endpoint" data-title="List Only Trashed">
          <h3>8. List Only Trashed Categories</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/categories/trashed</p>
            <p><strong>Description:</strong> Lists only the soft-deleted categories. (Role: SuperAdmin, Admin)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
  {
    "id": 10,
    "name": "RBT",
    "description": "RBT",
    "deleted_at": "2025-08-15T08:00:00.000000Z"
  }
]</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }

// 403 Forbidden (if not SuperAdmin/Admin)
{ "message": "User does not have the right roles." }</code></pre>
            </details>
          </div>
        </div>


        <!-- 9. Show Category -->
        <div class="endpoint" data-title="Show Category">
          <h3>9. Show Category</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/categories/{id}</p>
            <p><strong>Description:</strong> Retrieves a single category by ID. (Should be logged in)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
  "id": 11,
  "name": "superclip",
  "description": "superclip",
  "owner_id": null,
  "weight": 0,
  "deleted_at": null,
  "created_at": "2025-08-14T20:15:53.000000Z",
  "updated_at": "2025-08-14T20:15:53.000000Z"
}</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }

// 404 Not Found
{ "message": "No query results for model [Category] 123" }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="index No Owner">
          <h3>10. index No Owner</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/categories/indexNoOwner</p>
            <p><strong>Description:</strong> Lists only the categories have no owner. (Role: SuperAdmin, Admin)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
                {
                  "id": 10,
                  "name": "RBT",
                  "description": "RBT",
                  'owner_id':null
                }
              ]</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }

                // 403 Forbidden (if not SuperAdmin/Admin)
                { "message": "User does not have the right roles." }</code>
              </pre>
            </details>
          </div>
        </div>

      </div>
    </div>

    <!-- Section 4: Tasks -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Tasks</h2>
      </div>
      <div class="section-content">

        <div class="endpoint" data-title="Get All Tasks">
          <h3>1. Get All Tasks</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/tasks</p>
            <p><strong>Description:</strong> Retrieves a list of all tasks with their category, owner, and
              delegation
              info.</p>
            <pre><code>// Requires Authorization Header</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
                {
                  "id": 1,
                  "category_id": 1,
                  "owner_id": 1,
                  "delegation_id": 2,
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-14T20:15:54.000000Z",
                  "category": {
                    "id": 1,
                    "name": "superclip",
                    "description": "superclip",
                    "owner_id": 3,
                    "weight": 0,
                    "deleted_at": null,
                    "created_at": "2025-08-14T20:15:53.000000Z",
                    "updated_at": "2025-08-14T20:15:53.000000Z"
                  },
                  "owner": {
                    "id": 1,
                    "name": "Admin",
                    "email": "admin@mail.com",
                    "email_verified_at": null,
                    "position": "Manager",
                    "section_id": 1,
                    "role_id": 1,
                    "delegation_id": null,
                    "code": null,
                    "status": 1,
                    "img_url": null,
                    "created_at": "2025-08-14T20:15:50.000000Z",
                    "updated_at": "2025-08-14T20:15:50.000000Z"
                  },
                  "delegation": {
                    "id": 2,
                    "name": "Alaa",
                    "email": "aelolabi@mtn.com.sy",
                    "email_verified_at": null,
                    "position": "Coordinator",
                    "section_id": 1,
                    "role_id": 3,
                    "delegation_id": null,
                    "code": null,
                    "status": 1,
                    "img_url": null,
                    "created_at": "2025-08-14T20:15:50.000000Z",
                    "updated_at": "2025-08-14T20:15:50.000000Z"
                  }
                },
              ]</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get Task by ID">
          <h3>2. Get Task by ID</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/tasks/{id}</p>
            <p><strong>Description:</strong> Shows details of one task, including category and related
              users.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
                "id": 1,
                "category_id": 1,
                "owner_id": 1,
                "delegation_id": 2,
                "deleted_at": null,
                "created_at": "2025-08-14T20:15:54.000000Z",
                "updated_at": "2025-08-14T20:15:54.000000Z",
                "category": {
                  "id": 1,
                  "name": "superclip",
                  "description": "superclip",
                  "owner_id": 3,
                  "weight": 0,
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:53.000000Z",
                  "updated_at": "2025-08-14T20:15:53.000000Z"
                },
                "owner": {
                  "id": 1,
                  "name": "Admin",
                  "email": "admin@mail.com",
                  "email_verified_at": null,
                  "position": "Manager",
                  "section_id": 1,
                  "role_id": 1,
                  "delegation_id": null,
                  "code": null,
                  "status": 1,
                  "img_url": null,
                  "created_at": "2025-08-14T20:15:50.000000Z",
                  "updated_at": "2025-08-14T20:15:50.000000Z"
                },
                "delegation": {
                  "id": 2,
                  "name": "Alaa",
                  "email": "aelolabi@mtn.com.sy",
                  "email_verified_at": null,
                  "position": "Coordinator",
                  "section_id": 1,
                  "role_id": 3,
                  "delegation_id": null,
                  "code": null,
                  "status": 1,
                  "img_url": null,
                  "created_at": "2025-08-14T20:15:50.000000Z",
                  "updated_at": "2025-08-14T20:15:50.000000Z"
                }
              }</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Task] 999." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Create Task">
          <h3>3. Create Task</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/tasks</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Creates a new task. `owner_id` and `delegation_id` must be
              different.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "category_id": 2,
  "owner_id": 5,
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
  "message": "the task has been added successfully !"
}</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
              <pre><code>// 422 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "owner_id": ["The owner_id field is required."],
    "category_id": ["The category_id must be numeric."]
  }
}</code></pre>
              <pre><code>// 422 Business Logic Error
{ "message": "the owner cannot be delegation on himself !" }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Bulk Create Tasks">
          <h3>4. Bulk Create Tasks</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/bulktasks</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Creates multiple tasks in one request (array of task objects).
            </p>
            <p><strong>Request Example:</strong></p>
            <pre><code>[
  { "category_id": 1, "owner_id": 2, "delegation_id": 3 },
  { "category_id": 2, "owner_id": 4, "delegation_id": 6 }
]</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
  "message": "Bulk tasks created successfully"
}</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 422 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "0.owner_id": ["The owner_id field is required."]
  }
}</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Update Task">
          <h3>5. Update Task</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/tasks/{id}</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Updates task details such as assigned owner, delegate, or
              category.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "category_id": 3,
  "owner_id": 5,
  "delegation_id": 6
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
  "message": "task updated successfully"
}</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Task] 78." }</code></pre>
            </details>
          </div>
        </div>

        {{-- <div class="endpoint" data-title="Delete Task">
          <h3>6. Delete Task</h3>
          <div class="endpoint-content">
            <p><span class="method DELETE">DELETE</span> /api/tasks/{id}</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Soft-deletes the task by ID.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "task deleted successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Task] 100." }</code></pre>
            </details>
          </div>
        </div> --}}

        <div class="endpoint" data-title="Reset All Tasks">
          <h3>6. Reset All Tasks</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/tasks/reset</p>
            <p><strong>Description:</strong> Reset All Task (remove the owner from categories)
              users.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{'message' : 'reset tasks has been done successfully !'}</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
                { "message": "No query results for model [Task] 999." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Reset Specified Task">
          <h3>7. Reset Specified Task</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/tasks/reset/{id}</p>
            <p><strong>Description:</strong> Reset Specified Task (remove the owner from category)
            </p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{'message' : 'reset task has been done successfully !'}</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
                { "message": "No query results for model [Task] 999." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Randomly Assign">
          <h3>8. Randomly Assign</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/random-assign</p>
            <p><strong>Description:</strong> Reset All Tasks then random-assign
            </p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{'message' : 'Tasks have been randomly assigned successfully!'}</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
                { "message": "There are no trainers to assign tasks to!" }</code></pre>
            </details>
          </div>
        </div>


      </div>
    </div>

    <!-- Section: Inquiries -->
    {{-- <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Inquiries</h2>
      </div>
      <div class="section-content">

        <!-- 1. Get All Inquiries -->
        <div class="endpoint">
          <h3>1. Get All Inquiries</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries</p>
            <p><strong>Description:</strong> Retrieves every inquiry with relations: user, assigneeUser, category,
              status, followUps, attachments.</p>
            <p><strong>Sample cURL:</strong></p>
            <pre><code>curl -X GET https://yourdomain.com/api/inquiries</code></pre>
            <p><strong>Sample Response:</strong></p>
            <pre><code>[
  {
    "id": 1,
    "title": "VPN not working",
    "body": "Please reset credentials",
    "status": { "id": 1, "name": "opened" }
  }
]</code></pre>
          </div>
        </div>

        <!-- 2. Get My Inquiries -->
        <div class="endpoint">
          <h3>2. Get My Inquiries</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/myinquiries</p>
            <p><strong>Auth:</strong> Bearer token</p>
            <p><strong>Sample cURL:</strong></p>
            <pre><code>curl -H "Authorization: Bearer &lt;token&gt;" \
  https://yourdomain.com/api/inquiries/myinquiries</code></pre>
          </div>
        </div>

        <!-- 3. Create Inquiry -->
        <div class="endpoint">
          <h3>3. Create Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries</p>
            <p><strong>Auth:</strong> Bearer token</p>
            <p><strong>Sample cURL:</strong></p>
            <pre><code>curl -X POST https://yourdomain.com/api/inquiries \
 -H "Authorization: Bearer &lt;token&gt;" \
 -F category_id=1 \
 -F title="Can't access VPN" \
 -F body="Please reset my VPN credentials." \
 -F "attachments[]=@/path/to/file.pdf"</code></pre>
            <p><strong>Sample Response:</strong></p>
            <pre><code>{ "message": "the inquiry has been submitted successfully !" }</code></pre>
          </div>
        </div>

        <!-- 4. Show Inquiry -->
        <div class="endpoint">
          <h3>4. Get Inquiry by ID</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/{id}</p>
            <p><strong>Sample cURL:</strong></p>
            <pre><code>curl -X GET https://yourdomain.com/api/inquiries/5</code></pre>
          </div>
        </div>

        <!-- 5. Delete Inquiry -->
        <div class="endpoint">
          <h3>5. Delete Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method DELETE">DELETE</span> /api/inquiries/{id}</p>
            <p><strong>Auth:</strong> Bearer token (SuperAdmin/Admin)</p>
            <pre><code>curl -X DELETE https://yourdomain.com/api/inquiries/5 \
 -H "Authorization: Bearer &lt;token&gt;"</code></pre>
          </div>
        </div>

        <!-- 6. Restore Inquiry -->
        <div class="endpoint">
          <h3>6. Restore Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/restore/{id}</p>
            <pre><code>curl -X GET https://yourdomain.com/api/inquiries/restore/5 \
 -H "Authorization: Bearer &lt;token&gt;"</code></pre>
          </div>
        </div>

        <!-- 7. Search Inquiries -->
        <div class="endpoint">
          <h3>7. Search Inquiries</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/search?query=keyword</p>
            <pre><code>curl -G https://yourdomain.com/api/inquiries/search \
 -d query="VPN reset"</code></pre>
          </div>
        </div>

        <!-- 8. Reassign Inquiry -->
        <div class="endpoint">
          <h3>8. Reassign Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries/reassign</p>
            <pre><code>curl -X POST https://yourdomain.com/api/inquiries/reassign \
 -H "Authorization: Bearer &lt;token&gt;" \
 -d inquiry_id=5 \
 -d assignee_id=12</code></pre>
          </div>
        </div>

        <!-- 9. Reply to Inquiry -->
        <div class="endpoint">
          <h3>9. Reply to Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries/reply</p>
            <pre><code>curl -X POST https://yourdomain.com/api/inquiries/reply \
 -H "Authorization: Bearer &lt;token&gt;" \
 -F inquiry_id=5 \
 -F response="Your VPN is reset" \
 -F status_id=3</code></pre>
          </div>
        </div>

        <!-- 10. Reopen Inquiry -->
        <div class="endpoint">
          <h3>10. Reopen Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries/reopen/{inq_id}</p>
            <pre><code>curl -X POST https://yourdomain.com/api/inquiries/reopen/5 \
 -H "Authorization: Bearer &lt;token&gt;"</code></pre>
          </div>
        </div>

        <!-- 11. Statistics -->
        <div class="endpoint">
          <h3>11. Statistics</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/statistics</p>
            <pre><code>curl -X GET https://yourdomain.com/api/inquiries/statistics \
 -H "Authorization: Bearer &lt;token&gt;"</code></pre>
            <p><strong>Sample Response:</strong></p>
            <pre><code>{
  "opened_inquiries": 12,
  "pending_inquiries": 5,
  "closed_inquiries": 8,
  "average_handling_time": "4.5 hours",
  "average_ratings": 4.3
}</code></pre>
          </div>
        </div>

      </div>
    </div> --}}

    <!-- Section 5: Inquiries -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Inquiries</h2>
      </div>

      <div class="section-content">

        <!-- Endpoint 1: Get All Inquiries -->
        <div class="endpoint" data-title="Get All Inquiries">
          <h3>1. Get All Inquiries</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries</p>
            <p><strong>Description:</strong> Returns all inquiries with linked user, assignee, status, and category.</p>
            <pre><code>// No body needed</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{
  "id": 1,
  "user_id": 23,
  "assignee_id": 2,
  "category_id": 1,
  "cur_status_id": 1,
  "title": "استفسار عن خدمة سوبركليب",
  "body": "كيف يمكن تفعيل السوبر كليب",
  "response": null,
  "closed_at": null,
  "deleted_at": null,
  "created_at": "2025-07-09T09:10:56.000000Z",
  "updated_at": "2025-07-09T09:10:56.000000Z",
  "user": {
    "id": 23,
    "name": "new user",
    "email": "new@mail.com",
    // ... user fields
  },
  "assignee_user": {
    "id": 2,
    "name": "Alaa",
    // ... assignee fields
  },
  "category": {
    "id": 1,
    "name": "superclip",
    // ... category fields
  },
  "status": {
    "id": 1,
    "name": "opened",
    // ... status fields
  }
}]</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <!-- Endpoint 2: Get Trashed Inquiries -->
        <div class="endpoint" data-title="Get Trashed Inquiries">
          <h3>2. Get Inquiries With Trashed</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiriesWithTrashed</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Returns all inquiries including soft-deleted ones (admin only).</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{
  "id": 4,
  "user_id": 23,
  "deleted_at": "2025-08-15T10:30:00.000000Z",
  // ... other fields same as endpoint 1
}]</code></pre>
          </div>
        </div>

        <!-- Endpoint 3: Search Inquiries -->
        <div class="endpoint" data-title="Search Inquiries">
          <h3>3. Search Inquiries</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/search</p>
            <p><strong>Description:</strong> Searches inquiries by title, body, or response. Keyword split supported.
            </p>
            <p><strong>Query Param:</strong> <code>?query=password reset</code></p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{
  "id": 5,
  "title": "Password Reset Request",
  "body": "I need to reset my password",
  // ... other fields same as endpoint 1
}]</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "not found !" }</code></pre>
            </details>
          </div>
        </div>

        <!-- Endpoint 4: Create Inquiry -->
        <div class="endpoint" data-title="Create Inquiry">
          <h3>4. Create Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries</p>
            <p><strong>Description:</strong> Submits a new inquiry. Status and user are auto-set by backend.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "category_id": 1,
  "title": "Can't access VPN",
  "body": "Please reset my VPN credentials."
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ 
  "message": "the inquiry has been submitted successfully !",
  "inquiry": {
    "id": 25,
    "title": "Can't access VPN",
    // ... created inquiry fields
  }
}</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
              <pre><code>// 422 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "title": ["The title field is required."]
  }
}</code></pre>
            </details>
          </div>
        </div>

        <!-- Endpoint 5: Get Inquiry by ID -->
        <div class="endpoint" data-title="Get Inquiry by ID">
          <h3>5. Get Inquiry by ID</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/{id}</p>
            <p><strong>Description:</strong> Returns one inquiry with related user, category, status, and assignee.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
  "id": 1,
  "title": "استفسار عن خدمة سوبركليب",
  // ... all fields same as endpoint 1
}</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Inquiry] 404." }</code></pre>
            </details>
          </div>
        </div>

        <!-- Endpoint 6: Get Inquiries by Status -->
        <div class="endpoint" data-title="Get Inquiries by Status">
          <h3>6. Get Inquiries by Status ID</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiriesStatus/{status_id}</p>
            <p><strong>Description:</strong> Filters inquiries by current status (e.g. Open, Closed).</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{
  "id": 3,
  "cur_status_id": 3,
  "title": "Closed Inquiry Example",
  // ... other fields same as endpoint 1
}]</code></pre>
          </div>
        </div>

        <!-- Endpoint 7: Update Inquiry -->
        {{-- <div class="endpoint" data-title="Update Inquiry">
          <h3>7. Update Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries/{id}</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Updates inquiry information or status (admin only).</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "title": "Updated VPN Issue",
  "cur_status_id": 2
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
  "message": "Inquiry updated successfully!",
  "inquiry": {
    "id": 15,
    "title": "Updated VPN Issue",
    "cur_status_id": 2,
    // ... updated fields
  }
}</code></pre>
          </div>
        </div> --}}

        <!-- Endpoint 8: Delete Inquiry -->
        <div class="endpoint" data-title="Delete Inquiry">
          <h3>8. Delete Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method DELETE">DELETE</span> /api/inquiries/{id}</p>
            <p><strong>Description:</strong> Soft-deletes the inquiry.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ 
  "message": "inquiry has been deleted successfully !" 
}</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Inquiry] 111." }</code></pre>
            </details>
          </div>
        </div>

        <!-- Endpoint 9: Restore Inquiry -->
        <div class="endpoint" data-title="Restore Inquiry">
          <h3>9. Restore Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/restore/{id}</p>
            <p><strong>Description:</strong> Restores a previously soft-deleted inquiry by ID.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ 
  "message": "inquiry has been restored successfully !" 
}</code></pre>
          </div>
        </div>

        <!-- Endpoint 10: Get Only Trashed Inquiries -->
        <div class="endpoint" data-title="Get Only Trashed Inquiries">
          <h3>10. Get Only Trashed Inquiries</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/indexOnlyTrashed</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Returns only soft-deleted inquiries (admin only).</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{
  "id": 4,
  "user_id": 23,
  "deleted_at": "2025-08-15T10:30:00.000000Z",
  // ... other inquiry fields
}]</code></pre>
          </div>
        </div>

        <!-- Endpoint 11: Get Statistics -->
        <div class="endpoint" data-title="Get Statistics">
          <h3>11. Get Statistics</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/statistics</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Returns inquiry statistics including counts and averages...</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{
                "opened_inquiries": 41,
                "pending_inquiries": 1,
                "reopened_inquiries": 3,
                "closed_inquiries": 2,
                "average_handling_time": "129 hours",
                "average_ratings": 2.5,
                "trainers_performance": [
                  {
                    "name": "Alaa",
                    "closed_inquiries": 2,
                    "not_closed_inquiries": 17
                  },
                  {
                    "name": "trainer",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 13
                  },
                  {
                    "name": "Mohammad Alaa El Olabi",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 15
                  },
                  {
                    "name": "Prof. Emile Kozey Jr.",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 0
                  },
                  {
                    "name": "Edward Durgan",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 0
                  },
                  {
                    "name": "Elvera Smith",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 0
                  },
                  {
                    "name": "Antonette Stracke",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 0
                  },
                  {
                    "name": "Florine Kovacek",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 0
                  },
                  {
                    "name": "Anderson Stroman Sr.",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 0
                  },
                  {
                    "name": "Kamron Strosin",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 0
                  },
                  {
                    "name": "Mekhi Okuneva DVM",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 0
                  },
                  {
                    "name": "Ms. Sarina Aufderhar",
                    "closed_inquiries": 0,
                    "not_closed_inquiries": 0
                  }
                ],
                "topCategories": [
                  {
                    "name": "superclip",
                    "inquiries_count": 15
                  },
                  {
                    "name": "Post & Prepaid Cancelation",
                    "inquiries_count": 15
                  },
                  {
                    "name": "Conference  Post & Pre",
                    "inquiries_count": 6
                  },
                  {
                    "name": "Others",
                    "inquiries_count": 11
                  }
                ],
                "inquiries_last_7_days": [
                  {
                    "label": "Wednesday",
                    "total": 0
                  },
                  {
                    "label": "Thursday",
                    "total": 0
                  },
                  {
                    "label": "Friday",
                    "total": 0
                  },
                  {
                    "label": "Saturday",
                    "total": 36
                  },
                  {
                    "label": "Sunday",
                    "total": 1
                  },
                  {
                    "label": "Monday",
                    "total": 5
                  },
                  {
                    "label": "Tuesday",
                    "total": 1
                  }
                ],
                "inquiries_last_6_months": [
                  {
                    "label": "Mar",
                    "total": 0
                  },
                  {
                    "label": "Apr",
                    "total": 0
                  },
                  {
                    "label": "May",
                    "total": 0
                  },
                  {
                    "label": "Jun",
                    "total": 0
                  },
                  {
                    "label": "Jul",
                    "total": 0
                  },
                  {
                    "label": "Aug",
                    "total": 47
                  }
                ]
              }</code>
            </pre>
          </div>
        </div>

        <!-- Endpoint 12: Reassign Inquiry -->
        <div class="endpoint" data-title="Reassign Inquiry">
          <h3>12. Reassign Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries/reassign</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin,admin</p>
            <p><strong>Description:</strong> Reassigns an inquiry to another trainer.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "inquiry_id": 15,
  "assignee_id": 8
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ 
  "message": "the inquiry has been reassigned successfully to Trainer Name!" 
}</code></pre>
          </div>
        </div>

        <!-- Endpoint 13: Reply to Inquiry -->
        <div class="endpoint" data-title="Reply to Inquiry">
          <h3>13. Reply to Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries/reply</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin,admin,trainer</p>
            <p><strong>Description:</strong> Submits a response to an inquiry and updates its status.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "inquiry_id": 15,
  "response": "Please check your VPN settings",
  "status_id": 3
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ 
  "message": "your reply has been submitted successfully !" 
}</code></pre>
          </div>
        </div>

        <!-- Endpoint 14: Get My Inquiries -->
        <div class="endpoint" data-title="Get My Inquiries">
          <h3>14. Get My Inquiries</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/myinquiries</p>
            <p><strong>Middleware:</strong> auth:sanctum</p>
            <p><strong>Description:</strong> Returns inquiries related to current user (both sent and assigned).</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{
  "id": 15,
  "user_id": 42,
  "title": "VPN Access Issue",
  "body": "Can't connect to VPN",
  // ... other inquiry fields
}]</code></pre>
          </div>
        </div>

        <!-- Endpoint 15: Get Inquiries by Sender -->
        <div class="endpoint" data-title="Get Inquiries by Sender">
          <h3>15. Get Inquiries by Sender</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/Sender/{sender_id}</p>
            <p><strong>Middleware:</strong> auth:sanctum</p>
            <p><strong>Description:</strong> Returns inquiries sent by a specific user.</p>
            <p><strong>Example:</strong> <code>/api/inquiries/Sender/42</code></p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{
  "id": 15,
  "user_id": 42,
  "title": "Sender's Inquiry",
  // ... other inquiry fields
}]</code></pre>
          </div>
        </div>

        <!-- Endpoint 16: Get Inquiries by Trainer -->
        <div class="endpoint" data-title="Get Inquiries by Trainer">
          <h3>16. Get Inquiries by Trainer</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/Trainer/{assignee_id}</p>
            <p><strong>Middleware:</strong> auth:sanctum</p>
            <p><strong>Description:</strong> Returns inquiries assigned to a specific trainer.</p>
            <p><strong>Example:</strong> <code>/api/inquiries/Trainer/8</code></p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{
  "id": 15,
  "assignee_id": 8,
  "title": "Assigned to Trainer",
  // ... other inquiry fields
}]</code></pre>
          </div>
        </div>

        <!-- Endpoint 17: Reopen Inquiry -->
        <div class="endpoint" data-title="Reopen Inquiry">
          <h3>17. Reopen Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries/reopen</p>
            <p><strong>Middleware:</strong> auth:sanctum</p>
            <p><strong>Description:</strong> Reopens a closed inquiry (only original sender can reopen).</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
                "inquiry_id": 1,
                "response": "Can't access VPN",
                }</code>
              </pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ 
                "message": "the inquiry has been reopened successfully !" 
              }</code>
            </pre>
          </div>
        </div>

      </div>
    </div>

    <!-- Section 5: Inquiries -->
    {{-- <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Inquiries</h2>
      </div>
      <div class="section-content">

        <div class="endpoint" data-title="Get All Inquiries">
          <h3>1. Get All Inquiries</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries</p>
            <p><strong>Description:</strong> Returns all inquiries with linked user, assignee, status, and
              category.</p>
            <pre><code>// No body needed</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>[{
        "id": 1,
        "user_id": 23,
        "assignee_id": 2,
        "category_id": 1,
        "cur_status_id": 1,
        "title": "استفسار عن خدمة سوبركليب",
        "body": "كيف يمكن تفعيل السوبر كليب",
        "response": null,
        "closed_at": null,
        "deleted_at": null,
        "created_at": "2025-07-09T09:10:56.000000Z",
        "updated_at": "2025-07-09T09:10:56.000000Z",
        "user": {
            "id": 23,
            "name": "new user",
            "email": "new@mail.com",
            "email_verified_at": null,
            "position": null,
            "section_id": null,
            "role_id": 2,
            "code": null,
            "status": 1,
            "img_url": null,
            "created_at": "2025-07-09T08:27:02.000000Z",
            "updated_at": "2025-07-09T08:27:02.000000Z"
        },
        "assignee_user": {
            "id": 2,
            "name": "Alaa",
            "email": "alolaby25@gmail.com",
            "email_verified_at": null,
            "position": "Coordinator",
            "section_id": 1,
            "role_id": 3,
            "code": null,
            "status": 1,
            "img_url": null,
            "created_at": "2025-07-09T08:09:54.000000Z",
            "updated_at": "2025-07-09T08:09:54.000000Z"
        },
        "category": {
            "id": 1,
            "name": "superclip",
            "description": "superclip",
            "is_active": 1,
            "owner_id": null,
            "delegation_id": null,
            "created_at": "2025-07-09T08:09:56.000000Z",
            "updated_at": "2025-07-09T08:09:56.000000Z"
        },
        "status": {
            "id": 1,
            "name": "opened",
            "value": "-1",
            "created_at": "2025-07-09T08:09:56.000000Z",
            "updated_at": "2025-07-09T08:09:56.000000Z"
        }
    },]
  </code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get Trashed Inquiries">
          <h3>2. Get Inquiries With Trashed</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiriesWithTrashed</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Returns all inquiries including soft-deleted ones (admin only).
            </p>
          </div>
        </div>

        <div class="endpoint" data-title="Search Inquiries">
          <h3>3. Search Inquiries</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/search</p>
            <p><strong>Description:</strong> Searches inquiries by title, body, or response. Keyword split
              supported.</p>
            <p><strong>Query Param:</strong> <code>?query=password reset</code></p>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "not found !" }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Create Inquiry">
          <h3>4. Create Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries</p>
            <p><strong>Description:</strong> Submits a new inquiry. Status and user are auto-set by backend.
            </p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "category_id": 1,
  "title": "Can't access VPN",
  "body": "Please reset my VPN credentials."
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "the inquiry has been submitted successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
              <pre><code>// 422 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "title": ["The title field is required."]
  }
}</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get Inquiry by ID">
          <h3>5. Get Inquiry by ID</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/{id}</p>
            <p><strong>Description:</strong> Returns one inquiry with related user, category, status, and
              assignee.</p>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Inquiry] 404." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get Inquiries by Status">
          <h3>6. Get Inquiries by Status ID</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiriesStatus/{status_id}</p>
            <p><strong>Description:</strong> Filters inquiries by current status (e.g. Open, Closed).</p>
          </div>
        </div>

        <div class="endpoint" data-title="Update Inquiry">
          <h3>7. Update Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/inquiries/{id}</p>
            <p><strong>Middleware:</strong> auth:sanctum, role.superadmin</p>
            <p><strong>Description:</strong> Updates inquiry information or status (admin only).</p>
          </div>
        </div>

        <div class="endpoint" data-title="Delete Inquiry">
          <h3>8. Delete Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method DELETE">DELETE</span> /api/inquiries/{id}</p>
            <p><strong>Description:</strong> Soft-deletes the inquiry.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "inquiry has been deleted successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [Inquiry] 111." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Restore Inquiry">
          <h3>9. Restore Inquiry</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/inquiries/restore/{id}</p>
            <p><strong>Description:</strong> Restores a previously soft-deleted inquiry by ID.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "inquiry has been restored successfully !" }</code></pre>
          </div>
        </div>

      </div>
    </div> --}}


    <!-- Section 6: Follow-ups -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Follow-ups</h2>
      </div>

      <div class="section-content">

        <div class="endpoint" data-title="Get All Follow-ups">
          <h3>1. Get All Follow-ups</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/followups</p>
            <p><strong>Description:</strong> Returns a list of all follow-up records.</p>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get Follow-ups by Inquiry">
          <h3>2. Get Follow-ups by Inquiry ID</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/followupsrequest/{inquiry_id}</p>
            <p><strong>Description:</strong> Fetches all follow-ups related to a specific inquiry.</p>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No followups found for inquiry 999." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Create Follow-up">
          <h3>3. Create Follow-up</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/followups</p>
            <p><strong>Description:</strong> Creates a follow-up record and links it to an inquiry, section,
              and follower.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{
  "inquiry_id": 3,
  "status": 1,
  "section_id": 2
}</code></pre>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "the inquiry is following up successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
{ "message": "Unauthenticated." }</code></pre>
              <pre><code>// 422 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "inquiry_id": ["The inquiry_id field is required."]
  }
}</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Update Follow-up">
          <h3>4. Update Follow-up</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/followups/{id}</p>
            <p><strong>Description:</strong> Updates the status or section of a follow-up entry.</p>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [FollowUp] 999." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Delete Follow-up">
          <h3>5. Delete Follow-up</h3>
          <div class="endpoint-content">
            <p><span class="method DELETE">DELETE</span> /api/followups/{id}</p>
            <p><strong>Description:</strong> Deletes a follow-up record by ID.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "follow-up deleted successfully" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
{ "message": "No query results for model [FollowUp] 404." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Restore Follow-up">
          <h3>6. Restore Follow-up</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/followups/restore/{id}</p>
            <p><strong>Description:</strong> Restores a soft-deleted follow-up.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "follow-up restored successfully" }</code></pre>
          </div>
        </div>

        <div class="endpoint" data-title="followups of Section">
          <h3>7. Followups of Section</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/followupsSection/{section_id}</p>
            <p><strong>Description:</strong> Restores a follow-ups of section.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "id": 5,
                "inquiry_id": 1,
                "status": 1,
                "follower_id": 3,
                "section_id": 6,
                "response": null,
                "created_at": "2025-08-14T20:24:02.000000Z",
                "updated_at": "2025-08-14T20:24:02.000000Z",
                "inquiry": {
                  "id": 1,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 3,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": "تم الرد",
                  "closed_at": "2025-08-24 20:52:57",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-24T20:52:57.000000Z"
                }
              },
              {
                "id": 9,
                "inquiry_id": 1,
                "status": 1,
                "follower_id": 3,
                "section_id": 6,
                "response": null,
                "created_at": "2025-08-15T15:36:51.000000Z",
                "updated_at": "2025-08-15T15:36:51.000000Z",
                "inquiry": {
                  "id": 1,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 3,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": "تم الرد",
                  "closed_at": "2025-08-24 20:52:57",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-24T20:52:57.000000Z"
                }
              },]</code></pre>
          </div>
        </div>

        <div class="endpoint" data-title="followups of Section">
          <h3>8. Follow up details</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/followups/{id}</p>
            <p><strong>Description:</strong> Restores a specified follow-up.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
                            {
                "id": 1,
                "inquiry_id": 1,
                "status": 0,
                "follower_id": 1,
                "section_id": 4,
                "response": null,
                "created_at": "2025-08-14T20:15:55.000000Z",
                "updated_at": "2025-08-15T20:45:22.000000Z",
                "inquiry": {
                  "id": 1,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 3,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": "تم الرد",
                  "closed_at": "2025-08-24 20:52:57",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-24T20:52:57.000000Z"
                },
                "section": {
                  "id": 4,
                  "name": "VAS - Adminstration&Operation",
                  "division": "IT - CSD",
                  "email": "VAS@mail.com",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:49.000000Z",
                  "updated_at": "2025-08-14T20:15:49.000000Z"
                },
                "follower": {
                  "id": 1,
                  "name": "Admin",
                  "email": "admin@mail.com",
                  "email_verified_at": null,
                  "position": "Manager",
                  "section_id": 1,
                  "role_id": 1,
                  "delegation_id": null,
                  "code": null,
                  "status": 1,
                  "img_url": null,
                  "created_at": "2025-08-14T20:15:50.000000Z",
                  "updated_at": "2025-08-14T20:15:50.000000Z"
                }
              }]</code>
            </pre>
          </div>
        </div>

      </div>
    </div>


    <!-- Section 7: Favourites -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Favourites</h2>
      </div>
      <div class="section-content">

        <div class="endpoint" data-title="Get All Favourites">
          <h3>1. Get All Favourites</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/favourites</p>
            <p><strong>Description:</strong> Returns a list of All favourites Inquiries . (Admin/SuperAdmin)</p>

            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "id": 1,
                "inquiry_id": 1,
                "user_id": 3,
                "created_at": "2025-08-16T19:44:06.000000Z",
                "updated_at": "2025-08-16T19:44:06.000000Z",
                "inquiry": {
                  "id": 1,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 3,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": "تم الرد",
                  "closed_at": "2025-08-23 10:10:36",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-23T10:10:36.000000Z"
                }
              },
              {
                "id": 2,
                "inquiry_id": 2,
                "user_id": 3,
                "created_at": "2025-08-16T19:44:06.000000Z",
                "updated_at": "2025-08-16T19:44:06.000000Z",
                "inquiry": {
                  "id": 2,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 2,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": null,
                  "closed_at": "2025-08-16 20:15:54",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-14T20:15:54.000000Z"
                }
              },
              {
                "id": 4,
                "inquiry_id": 4,
                "user_id": 3,
                "created_at": "2025-08-16T19:44:06.000000Z",
                "updated_at": "2025-08-16T19:44:06.000000Z",
                "inquiry": {
                  "id": 4,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 3,
                  "cur_status_id": 4,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": null,
                  "closed_at": null,
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:55.000000Z",
                  "updated_at": "2025-08-14T20:15:55.000000Z"
                }
              }
            ]
            </code>
            </pre>


            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Add to favourites">
          <h3>2. Add Inquiry to favourites</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/favourites</p>
            <p><strong>Description:</strong> Add an inquiry to favourites.</p>

            <p><strong>Request Example:</strong></p>
            <pre><code>{ "inquiry_id": 1 }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>'message' => 'Inquiry has been favourited successfully !'
            </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get myFavourites">
          <h3>3. Get myFavourites</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/myFavourites</p>
            <p><strong>Description:</strong> Returns a list of myFavourites Inquiries .</p>

            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "id": 1,
                "inquiry_id": 1,
                "user_id": 3,
                "created_at": "2025-08-16T19:44:06.000000Z",
                "updated_at": "2025-08-16T19:44:06.000000Z",
                "inquiry": {
                  "id": 1,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 3,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": "تم الرد",
                  "closed_at": "2025-08-23 10:10:36",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-23T10:10:36.000000Z"
                }
              },
              {
                "id": 2,
                "inquiry_id": 2,
                "user_id": 3,
                "created_at": "2025-08-16T19:44:06.000000Z",
                "updated_at": "2025-08-16T19:44:06.000000Z",
                "inquiry": {
                  "id": 2,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 2,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": null,
                  "closed_at": "2025-08-16 20:15:54",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-14T20:15:54.000000Z"
                }
              },
              {
                "id": 4,
                "inquiry_id": 4,
                "user_id": 3,
                "created_at": "2025-08-16T19:44:06.000000Z",
                "updated_at": "2025-08-16T19:44:06.000000Z",
                "inquiry": {
                  "id": 4,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 3,
                  "cur_status_id": 4,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": null,
                  "closed_at": null,
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:55.000000Z",
                  "updated_at": "2025-08-14T20:15:55.000000Z"
                }
              }
            ]
            </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Remove from favourites">
          <h3>4. Remove Favourite</h3>
          <div class="endpoint-content">
            <p><span class="method DELETE">DELETE</span> /api/favourites/{id}</p>
            <p><strong>Description:</strong> Remove Inquiry from favourites</p>
            <p><strong>Rule:</strong> favourite.user == auth.user </p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "the inquiry has been removed from favourite successfully !" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
                { "message": "No query results for model [Section] 999" }

                // 403 Unauthorized
                { "message": "unauthorized !" }</code></pre>
            </details>
          </div>
        </div>

      </div>
    </div>

    <!-- Section 8: Ratings -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Ratings</h2>
      </div>
      <div class="section-content">

        <div class="endpoint" data-title="Get All Ratings">
          <h3>1. Get All Rating</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/ratings</p>
            <p><strong>Description:</strong> Returns a list of All Ratings . (Admin/SuperAdmin/Trainer)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "rating_id": 1,
                "score": 5,
                "feedback": "v.good response",
                "rated_by": "Asa Cruickshank",
                "rated_by_role": "User",
                "inquiry_title": "استفسار عن خدمة سوبركليب",
                "user": {
                  "id": 14,
                  "name": "Asa Cruickshank",
                  "email": "freddie97@example.org",
                  "email_verified_at": "2025-08-14 20:15:52",
                  "position": "Rep",
                  "section_id": 1,
                  "role_id": 5,
                  "delegation_id": null,
                  "code": null,
                  "status": 1,
                  "img_url": null,
                  "created_at": "2025-08-14T20:15:52.000000Z",
                  "updated_at": "2025-08-14T20:15:52.000000Z",
                  "role": {
                    "id": 5,
                    "name": "User",
                    "created_at": "2025-08-14T20:15:49.000000Z",
                    "updated_at": "2025-08-14T20:15:49.000000Z"
                  }
                },
                "inquiry": {
                  "id": 2,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 2,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": null,
                  "closed_at": "2025-08-16 20:15:54",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-14T20:15:54.000000Z",
                  "category": {
                    "id": 1,
                    "name": "superclip",
                    "description": "superclip",
                    "owner_id": 3,
                    "weight": 0,
                    "deleted_at": null,
                    "created_at": "2025-08-14T20:15:53.000000Z",
                    "updated_at": "2025-08-14T20:15:53.000000Z"
                  }
                }
              },
              ]</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Add rating">
          <h3>2. Add Rating to Inquiry Response</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/ratings</p>
            <p><strong>Description:</strong> Add Rating to Inquiry Response. (Admin/SuperAdmin/User)</p>

            <p><strong>Request Example:</strong></p>
            <pre><code>{ "inquiry_id": 2 , "score":4 , "feedback_text" : "clear response"}</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>'message' => 'The rating has been sent successfully.'
            </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get a Rating of id">
          <h3>3. Get a specified Rating</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/ratings/{id}</p>
            <p><strong>Description:</strong> Returns a specified Rating . (Admin/SuperAdmin/Trainer)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "rating_id": 1,
                "score": 5,
                "feedback": "v.good response",
                "rated_by": "Asa Cruickshank",
                "rated_by_role": "User",
                "inquiry_title": "استفسار عن خدمة سوبركليب",
                "user": {
                  "id": 14,
                  "name": "Asa Cruickshank",
                  "email": "freddie97@example.org",
                  "email_verified_at": "2025-08-14 20:15:52",
                  "position": "Rep",
                  "section_id": 1,
                  "role_id": 5,
                  "delegation_id": null,
                  "code": null,
                  "status": 1,
                  "img_url": null,
                  "created_at": "2025-08-14T20:15:52.000000Z",
                  "updated_at": "2025-08-14T20:15:52.000000Z",
                  "role": {
                    "id": 5,
                    "name": "User",
                    "created_at": "2025-08-14T20:15:49.000000Z",
                    "updated_at": "2025-08-14T20:15:49.000000Z"
                  }
                },
                "inquiry": {
                  "id": 2,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 2,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": null,
                  "closed_at": "2025-08-16 20:15:54",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-14T20:15:54.000000Z",
                  "category": {
                    "id": 1,
                    "name": "superclip",
                    "description": "superclip",
                    "owner_id": 3,
                    "weight": 0,
                    "deleted_at": null,
                    "created_at": "2025-08-14T20:15:53.000000Z",
                    "updated_at": "2025-08-14T20:15:53.000000Z"
                  }
                }
              },
              ]</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Update Rating">
          <h3>4. Update Rating of Inquiry Response</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/ratings/{id}</p>
            <p><strong>Description:</strong> Update Rating to Inquiry Response. (Admin/SuperAdmin/User)</p>

            <p><strong>Request Example:</strong></p>
            <pre><code>{ "score":2 , "feedback_text" : "unclear response"}</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>{
                  "message": "Rating updated successfully.",
                  "data": {
                    "id": 1,
                    "inquiry_id": 2,
                    "user_id": 14,
                    "score": "2",
                    "feedback_text": "unclear response",
                    "created_at": "2025-08-26T18:45:26.000000Z",
                    "updated_at": "2025-08-26T19:37:58.000000Z"
                  }
                }
              </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Delete Rating">
          <h3>5. Delete Rating</h3>
          <div class="endpoint-content">
            <p><span class="method DELETE">DELETE</span> /api/ratings/{id}</p>
            <p><strong>Description:</strong> Permanently deletes a rating from the system.</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>{ "message": "Rating has been deleted successfully!" }</code></pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 404 Not Found
                { "message": "No query results for model [Rating] 999" }

                // 401 Unauthorized
                { "message": "Unauthenticated." }</code>
              </pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get All Users Ratings">
          <h3>6. Get All Users Rating</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/ratings/user</p>
            <p><strong>Description:</strong> Returns a list of All Users Ratings . (Admin/SuperAdmin/Trainer)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "rating_id": 1,
                "score": 5,
                "feedback": "v.good response",
                "rated_by": "Asa Cruickshank",
                "rated_by_role": "User",
                "inquiry_title": "استفسار عن خدمة سوبركليب",
                "user": {
                  "id": 14,
                  "name": "Asa Cruickshank",
                  "email": "freddie97@example.org",
                  "email_verified_at": "2025-08-14 20:15:52",
                  "position": "Rep",
                  "section_id": 1,
                  "role_id": 5,
                  "delegation_id": null,
                  "code": null,
                  "status": 1,
                  "img_url": null,
                  "created_at": "2025-08-14T20:15:52.000000Z",
                  "updated_at": "2025-08-14T20:15:52.000000Z",
                  "role": {
                    "id": 5,
                    "name": "User",
                    "created_at": "2025-08-14T20:15:49.000000Z",
                    "updated_at": "2025-08-14T20:15:49.000000Z"
                  }
                },
                "inquiry": {
                  "id": 2,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 2,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": null,
                  "closed_at": "2025-08-16 20:15:54",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-14T20:15:54.000000Z",
                  "category": {
                    "id": 1,
                    "name": "superclip",
                    "description": "superclip",
                    "owner_id": 3,
                    "weight": 0,
                    "deleted_at": null,
                    "created_at": "2025-08-14T20:15:53.000000Z",
                    "updated_at": "2025-08-14T20:15:53.000000Z"
                  }
                }
              },
              ]</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Get All Admins Ratings">
          <h3>7. Get All Admins Rating</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/ratings/admin</p>
            <p><strong>Description:</strong> Returns a list of All Admins Ratings . (Admin/SuperAdmin/Trainer)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "rating_id": 1,
                "score": 5,
                "feedback": "v.good response",
                "rated_by": "Asa Cruickshank",
                "rated_by_role": "User",
                "inquiry_title": "استفسار عن خدمة سوبركليب",
                "user": {
                  "id": 14,
                  "name": "Asa Cruickshank",
                  "email": "freddie97@example.org",
                  "email_verified_at": "2025-08-14 20:15:52",
                  "position": "Rep",
                  "section_id": 1,
                  "role_id": 2,
                  "delegation_id": null,
                  "code": null,
                  "status": 1,
                  "img_url": null,
                  "created_at": "2025-08-14T20:15:52.000000Z",
                  "updated_at": "2025-08-14T20:15:52.000000Z",
                  "role": {
                    "id": 5,
                    "name": "User",
                    "created_at": "2025-08-14T20:15:49.000000Z",
                    "updated_at": "2025-08-14T20:15:49.000000Z"
                  }
                },
                "inquiry": {
                  "id": 2,
                  "user_id": 23,
                  "assignee_id": 2,
                  "category_id": 1,
                  "cur_status_id": 2,
                  "title": "استفسار عن خدمة سوبركليب",
                  "body": "كيف يمكن تفعيل السوبر كليب",
                  "response": null,
                  "closed_at": "2025-08-16 20:15:54",
                  "deleted_at": null,
                  "created_at": "2025-08-14T20:15:54.000000Z",
                  "updated_at": "2025-08-14T20:15:54.000000Z",
                  "category": {
                    "id": 1,
                    "name": "superclip",
                    "description": "superclip",
                    "owner_id": 3,
                    "weight": 0,
                    "deleted_at": null,
                    "created_at": "2025-08-14T20:15:53.000000Z",
                    "updated_at": "2025-08-14T20:15:53.000000Z"
                  }
                }
              },
              ]</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

      </div>
    </div>

    <!-- Section 9: Reports -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Reports</h2>
      </div>
      <div class="section-content">

        <div class="endpoint" data-title="System Report">
          <h3>1. System Reports</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/system/</p>
            <p><strong>Description:</strong> Returns a System Report.</p>

            <p><strong>Request Example:</strong></p>
            <pre><code>{ "start_date": "​2025-08-01", "end_date": "2025-08-31​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>{
                "users_count": 23,
                "active_users_count": 23,
                "trainers_count": 12,
                "active_trainers_count": 12,
                "sections_count": 8,
                "categories_count": 17,
                "inquiries_count": 4,
                "closed_inquiries_count": 1,
                "opened_inquiries_count": 1,
                "pending_inquiries_count": 1,
                "reopened_inquiries_count": 1,
                "avg_closing": "48:00"
              }
            </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Export System Report to Excel">
          <h3>2. Export System Report to Excel</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/systemExcel</p>
            <p><strong>Description:</strong> Download an Excel System Report file.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "start_date": "​2025-08-01", "end_date": "2025-08-31​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>1756194332systemReport.xlsx</code></pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Category Report">
          <h3>3. Category Reports</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/category</p>
            <p><strong>Description:</strong> Returns a Category Report.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "start_date": "​2025-08-01", "end_date": "2025-08-31​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>[
                {
                  "category_id": 1,
                  "category_name": "superclip",
                  "category_weight": 0,
                  "total_inquiries": 15,
                  "opened_inquiries": 12,
                  "closed_inquiries": 1,
                  "pending_inquiries": 1,
                  "reopened_inquiries": 1,
                  "avg_closing": "240:37",
                  "avg_rating": 2
                },
                {
                  "category_id": 2,
                  "category_name": "RBT",
                  "category_weight": 0,
                  "total_inquiries": 1,
                  "opened_inquiries": 0,
                  "closed_inquiries": 1,
                  "pending_inquiries": 0,
                  "reopened_inquiries": 0,
                  "avg_closing": "18:52",
                  "avg_rating": 4
                },{
                    "category_id": null,
                    "category_name": "Total",
                    "total_inquiries": 46,
                    "opened_inquiries": 40,
                    "closed_inquiries": 3,
                    "pending_inquiries": 1,
                    "reopened_inquiries": 2,
                    "avg_closing": "86:44",
                    "avg_evaluation": null
                  }
                ]
            </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Export Category Report to Excel">
          <h3>4. Export Category Report to Excel</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/categoryExcel</p>
            <p><strong>Description:</strong> Download an Excel Category Report file.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "start_date": "​2025-08-01", "end_date": "2025-08-31​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>1756194332categoryReport.xlsx</code></pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Trainers Report">
          <h3>5. Trainers Report</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/trainers/</p>
            <p><strong>Description:</strong> Returns a Trainers Report.</p>

            <p><strong>Request Example:</strong></p>
            <pre><code>{ "start_date": "​2025-08-01", "end_date": "2025-08-31​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "user_id": 2,
                "username": "Alaa",
                "total_responded_inquiries": 4,
                "opened_inquiries": 1,
                "closed_inquiries": 1,
                "pending_inquiries": 1,
                "reopened_inquiries": 1,
                "avg_closing_hours": "18:52",
                "last_delegated_user": "Admin"
              },
              {
                "user_id": 3,
                "username": "trainer",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },
              {
                "user_id": 4,
                "username": "Gabriel Cummings",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },
              {
                "user_id": 5,
                "username": "Prof. Emile Kozey Jr.",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },
              {
                "user_id": 6,
                "username": "Edward Durgan",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },
              {
                "user_id": 7,
                "username": "Elvera Smith",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },]
            </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Export Trainers Report to Excel">
          <h3>6. Export Trainers Report to Excel</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/trainerExcel</p>
            <p><strong>Description:</strong> Download an Excel Trainers Report file.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "start_date": "​2025-08-01", "end_date": "2025-08-31​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>1756276118_trainerReport.xlsx</code></pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Trainers Details">
          <h3>7. Trainers Details</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/reports/trainers</p>
            <p><strong>Description:</strong> Returns a Trainers details.</p>

            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "user_id": 2,
                "username": "Alaa",
                "total_responded_inquiries": 4,
                "opened_inquiries": 1,
                "closed_inquiries": 1,
                "pending_inquiries": 1,
                "reopened_inquiries": 1,
                "avg_closing_hours": "18:52",
                "last_delegated_user": "Admin"
              },
              {
                "user_id": 3,
                "username": "trainer",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },
              {
                "user_id": 4,
                "username": "Gabriel Cummings",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },
              {
                "user_id": 5,
                "username": "Prof. Emile Kozey Jr.",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },
              {
                "user_id": 6,
                "username": "Edward Durgan",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },
              {
                "user_id": 7,
                "username": "Elvera Smith",
                "total_responded_inquiries": 0,
                "opened_inquiries": 0,
                "closed_inquiries": 0,
                "pending_inquiries": 0,
                "reopened_inquiries": 0,
                "avg_closing_hours": null,
                "last_delegated_user": null
              },]
            </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="my Daily Report">
          <h3>8. my Daily Report</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/myDailyReport</p>
            <p><strong>Description:</strong> Returns myDailyReport</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "start_date": "​2025-08-01", "end_date": "2025-08-31​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>[
                {
                  "date": "2025-08-01",
                  "total_responded": 0,
                  "opened": 0,
                  "closed": 0,
                  "pending": 0,
                  "reopened": 0,
                  "avg_closing": null,
                  "followups": 0,
                  "last_delegation_from": null
                },
                {
                  "date": "2025-08-02",
                  "total_responded": 0,
                  "opened": 0,
                  "closed": 0,
                  "pending": 0,
                  "reopened": 0,
                  "avg_closing": null,
                  "followups": 0,
                  "last_delegation_from": null
                },...{
                  "date": "Total",
                  "total_responded": 13,
                  "opened": 12,
                  "closed": 0,
                  "pending": 0,
                  "reopened": 1,
                  "avg_closing": null,
                  "followups": 19,
                  "last_delegation_from": "-"
                }]
              </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Export my Daily Report to Excel">
          <h3>9. Export my Daily Report to Excel</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/myDailyExcel</p>
            <p><strong>Description:</strong> Download an Excel of myDaily Report file.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "start_date": "​2025-08-01", "end_date": "2025-08-31​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>1756276118_dailyReport.xlsx</code></pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="my Weekly Report">
          <h3>10. my Weekly Report</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/myWeeklyReport</p>
            <p><strong>Description:</strong> Returns myDailyReport</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "month": "​2025-08" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>[
                  {
                    "date": "2025-08-01 → 2025-08-01",
                    "total_responded": 0,
                    "opened": 0,
                    "closed": 0,
                    "pending": 0,
                    "reopened": 0,
                    "avg_closing": null,
                    "followups": 0,
                    "last_delegation_from": null
                  },
                  {
                    "date": "2025-08-02 → 2025-08-08",
                    "total_responded": 0,
                    "opened": 0,
                    "closed": 0,
                    "pending": 0,
                    "reopened": 0,
                    "avg_closing": null,
                    "followups": 0,
                    "last_delegation_from": null
                  },
                  {
                    "date": "2025-08-09 → 2025-08-15",
                    "total_responded": 0,
                    "opened": 0,
                    "closed": 0,
                    "pending": 0,
                    "reopened": 0,
                    "avg_closing": null,
                    "followups": 1,
                    "last_delegation_from": null
                  },
                  {
                    "date": "2025-08-16 → 2025-08-22",
                    "total_responded": 0,
                    "opened": 0,
                    "closed": 0,
                    "pending": 0,
                    "reopened": 0,
                    "avg_closing": null,
                    "followups": 0,
                    "last_delegation_from": null
                  },
                  {
                    "date": "2025-08-23 → 2025-08-29",
                    "total_responded": 13,
                    "opened": 12,
                    "closed": 0,
                    "pending": 0,
                    "reopened": 1,
                    "avg_closing": null,
                    "followups": 11,
                    "last_delegation_from": null
                  },
                  {
                    "date": "2025-08-30 → 2025-08-31",
                    "total_responded": 0,
                    "opened": 0,
                    "closed": 0,
                    "pending": 0,
                    "reopened": 0,
                    "avg_closing": null,
                    "followups": 0,
                    "last_delegation_from": null
                  },
                  {
                    "date": "Total",
                    "total_responded": 13,
                    "opened": 12,
                    "closed": 0,
                    "pending": 0,
                    "reopened": 1,
                    "avg_closing": null,
                    "avg_evaluation": null,
                    "followups": 12,
                    "last_delegation_from": "-"
                  }
                ]
              </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Export my Weekly Report to Excel">
          <h3>11. Export my Weekly Report to Excel</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/myWeeklyExcel</p>
            <p><strong>Description:</strong> Download an Excel of myWeekly Report file.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "month​": "2025-08​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>1756276118_weeklyReport.xlsx</code></pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="my Monthly Report">
          <h3>12. my Monthly Report</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/myMonthlyReport</p>
            <p><strong>Description:</strong> Returns myMonthlyReport</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "year": "​2025" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>[{
                  "date": "August 2025",
                  "total_responded": 13,
                  "opened": 12,
                  "closed": 0,
                  "pending": 0,
                  "reopened": 1,
                  "avg_closing": null,
                  "followups": 19,
                  "last_delegation_from": null
                },
                {
                  "date": "September 2025",
                  "total_responded": 0,
                  "opened": 0,
                  "closed": 0,
                  "pending": 0,
                  "reopened": 0,
                  "avg_closing": null,
                  "followups": 0,
                  "last_delegation_from": null
                },
                {
                  "date": "October 2025",
                  "total_responded": 0,
                  "opened": 0,
                  "closed": 0,
                  "pending": 0,
                  "reopened": 0,
                  "avg_closing": null,
                  "followups": 0,
                  "last_delegation_from": null
                },
                {
                  "date": "November 2025",
                  "total_responded": 0,
                  "opened": 0,
                  "closed": 0,
                  "pending": 0,
                  "reopened": 0,
                  "avg_closing": null,
                  "followups": 0,
                  "last_delegation_from": null
                },
                {
                  "date": "December 2025",
                  "total_responded": 0,
                  "opened": 0,
                  "closed": 0,
                  "pending": 0,
                  "reopened": 0,
                  "avg_closing": null,
                  "followups": 0,
                  "last_delegation_from": null
                },
                {
                  "date": "Total",
                  "total_responded": 13,
                  "opened": 12,
                  "closed": 0,
                  "pending": 0,
                  "reopened": 1,
                  "avg_closing": null,
                  "avg_evaluation": null,
                  "followups": 19,
                  "last_delegation_from": "-"
                }
              ]</code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Export my Monthly Report to Excel">
          <h3>13. Export my Monthly Report to Excel</h3>
          <div class="endpoint-content">
            <p><span class="method POST">POST</span> /api/reports/myMonthlyExcel</p>
            <p><strong>Description:</strong> Download an Excel of myMonthly Report file.</p>
            <p><strong>Request Example:</strong></p>
            <pre><code>{ "yaer": "2025​" }</code></pre>

            <p><strong>Response Example:</strong></p>
            <pre><code>1756276118_monthlyReport.xlsx</code></pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

      </div>
    </div>

    <!-- Section 10: Notification -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Notifications</h2>
      </div>
      <div class="section-content">

        {{-- <div class="endpoint" data-title="All Notifcations">
          <ifca>1. List All Notifcations</h3>
            <div class="endpoint-content">
              <p><span class="method POST">POST</span> /api/notifications/</p>
              <p><strong>Description:</strong> Returns all notifications.</p>

              <p><strong>Response Example:</strong></p>
              <pre><code>{
                "users_count": 23,
                "active_users_count": 23,
                "trainers_count": 12,
                "active_trainers_count": 12,
                "sections_count": 8,
                "categories_count": 17,
                "inquiries_count": 4,
                "closed_inquiries_count": 1,
                "opened_inquiries_count": 1,
                "pending_inquiries_count": 1,
                "reopened_inquiries_count": 1,
                "avg_closing": "48:00"
              }
            </code>
            </pre>

              <details>
                <summary><strong>Possible Error Responses</strong></summary>
                <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
              </details>
            </div>
        </div> --}}

        <div class="endpoint" data-title="My Notifcations">
          <h3>2. My Notifcations</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/notifications/myNotifications</p>
            <p><strong>Description:</strong> Returns my notifications.</p>

            <p><strong>Response Example:</strong></p>
            <pre><code>[
                {
                  "id": 1,
                  "inquiry_id": 10,
                  "user_id": 3,
                  "message": "Hello, this is just for you!",
                  "status": "unread",
                  "created_at": "2025-08-23T12:46:28.000000Z",
                  "updated_at": "2025-08-23T12:46:28.000000Z"
                },
                {
                  "id": 2,
                  "inquiry_id": 11,
                  "user_id": 3,
                  "message": "Hello, this is just for you!",
                  "status": "unread",
                  "created_at": "2025-08-23T12:48:35.000000Z",
                  "updated_at": "2025-08-23T12:48:35.000000Z"
                },
                {
                  "id": 3,
                  "inquiry_id": 12,
                  "user_id": 3,
                  "message": "Hello, this is just for you!",
                  "status": "unread",
                  "created_at": "2025-08-23T12:52:20.000000Z",
                  "updated_at": "2025-08-23T12:52:20.000000Z"
                },
                {
                  "id": 4,
                  "inquiry_id": 13,
                  "user_id": 3,
                  "message": "Hello, this is just for you!",
                  "status": "unread",
                  "created_at": "2025-08-23T12:52:54.000000Z",
                  "updated_at": "2025-08-23T12:52:54.000000Z"
                },
                {
                  "id": 5,
                  "inquiry_id": 14,
                  "user_id": 3,
                  "message": "Hello, this is just for you!",
                  "status": "unread",
                  "created_at": "2025-08-23T12:59:27.000000Z",
                  "updated_at": "2025-08-23T12:59:27.000000Z"
                },
                {
                  "id": 6,
                  "inquiry_id": 15,
                  "user_id": 3,
                  "message": "Hello, this is just for you!",
                  "status": "unread",
                  "created_at": "2025-08-23T13:00:59.000000Z",
                  "updated_at": "2025-08-23T13:00:59.000000Z"
                },
                {
                  "id": 7,
                  "inquiry_id": 16,
                  "user_id": 3,
                  "message": "Hello, this is just for you!",
                  "status": "unread",
                  "created_at": "2025-08-23T13:01:19.000000Z",
                  "updated_at": "2025-08-23T13:01:19.000000Z"
                }
              ]
            </code>
            </pre>

            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

      </div>
    </div>

    <!-- Section 11: Roles -->
    <div class="section-wrapper">
      <div class="section-header"
        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
        <h2>Roles</h2>
      </div>

      <div class="section-content">
        <div class="endpoint" data-title="Get All Roles">
          <h3>1. Get All Roles</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/roles</p>
            <p><strong>Description:</strong> Returns a list of all Roles. (SuperAdmin,Admin,Trainer)</p>
            <p><strong>Response Example:</strong></p>
            <pre><code>[
              {
                "id": 1,
                "name": "SuperAdmin",
                "created_at": "2025-08-14T20:15:49.000000Z",
                "updated_at": "2025-08-14T20:15:49.000000Z"
              },
              {
                "id": 2,
                "name": "Admin",
                "created_at": "2025-08-14T20:15:49.000000Z",
                "updated_at": "2025-08-14T20:15:49.000000Z"
              },
              {
                "id": 3,
                "name": "Trainer",
                "created_at": "2025-08-14T20:15:49.000000Z",
                "updated_at": "2025-08-14T20:15:49.000000Z"
              },
              {
                "id": 4,
                "name": "Assistant",
                "created_at": "2025-08-14T20:15:49.000000Z",
                "updated_at": "2025-08-14T20:15:49.000000Z"
              },
              {
                "id": 5,
                "name": "User",
                "created_at": "2025-08-14T20:15:49.000000Z",
                "updated_at": "2025-08-14T20:15:49.000000Z"
              }
            ]</code>
            </pre>
            <details>
              <summary><strong>Possible Error Responses</strong></summary>
              <pre><code>// 401 Unauthorized
                { "message": "Unauthenticated." }</code></pre>
            </details>
          </div>
        </div>

      </div>
    </div>


  </main>

  <script>
    document.querySelectorAll(".endpoint h3").forEach(header => {
      header.addEventListener("click", () => {
        const content = header.nextElementSibling;
        content.style.display = content.style.display === "block" ? "none" : "block";
      });
    });

    document.getElementById("searchBox").addEventListener("input", function () {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll(".endpoint").forEach(endpoint => {
        const title = endpoint.getAttribute("data-title").toLowerCase();
        endpoint.style.display = title.includes(keyword) ? "block" : "none";
      });
    });

    function toggleTheme() {
      document.body.classList.toggle("light-mode");
    }
  </script>
</body>

</html>