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
    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
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


    <!-- 🧭 Section 1: Auth -->
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
}</code></pre>
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

        <div class="endpoint" data-title="Logout">
          <h3>2. Logout</h3>
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
          <h3>3. Add User</h3>
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
{ "message": "ليس لديك الصلاحية لإضافة مستخدم." }</code></pre>
              <pre><code>// 422 Validation Error
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email has already been taken."],
    "password": ["The password confirmation does not match."]
  }
}</code></pre>
            </details>
          </div>
        </div>

        <div class="endpoint" data-title="Forget Password">
          <h3>4. Forget Password</h3>
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
          <h3>5. Check Forget Code</h3>
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
          <h3>6. Reset Password</h3>
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

        {{-- <div class="endpoint" data-title="Get Logged In User">
          <h3>7. Get Logged In User</h3>
          <div class="endpoint-content">
            <p><span class="method GET">GET</span> /api/user</p>
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
        </div> --}}
        <div class="endpoint" data-title="Get Logged In User">
          <h3>7. Profile</h3>
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

      </div>
    </div>


    <!-- 🧭 Section 2: Tasks -->
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
    "id": 10,
    "category": { "id": 1, "name": "Training" },
    "owner": { "id": 2, "name": "Amar" },
    "delegation": { "id": 3, "name": "Sara" }
  }
]</code></pre>
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
  "id": 12,
  "category": { "id": 3, "name": "Support" },
  "owner": { "id": 5, "name": "Rami" },
  "delegation": { "id": 6, "name": "Nour" }
}</code></pre>
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
  "delegation_id": 7
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

        <div class="endpoint" data-title="Delete Task">
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
        </div>

      </div>
    </div>


    <!-- 📨 Section 3: Inquiries -->
    <div class="section-wrapper">
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
            <pre><code>[
  {
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
    },
]</code></pre>
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
    </div>


    <!-- 🔄 Section 4: Follow-ups -->
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
            <p><span class="method GET">GET</span> /api/followups/{inquiry_id}</p>
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

      </div>
    </div>
    

    <!-- 🔄 Section 5: Sections -->
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
            <p><strong>Description:</strong> Permanently deletes a section from the system.</p>
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