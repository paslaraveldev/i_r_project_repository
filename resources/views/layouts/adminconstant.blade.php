


</html><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="asset/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" 
    crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('assetz/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assetz/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('assetz/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('assetz/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>INSTITUTION RESEARCH REPOSITORY SYSTEM</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{asset('assetz/img/.jpg')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Apsacal</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="/Admin" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i> Admin Dashboard</a>


                    <!-- Projects Management -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>PROJECTS</a>
                        <div class="dropdown-menu bg-transparent border-0">
                             <a class="nav-link" href="/admin/projects/register" class="dropdown-item">Register Project Concepts</a>
                             <a class="nav-link" href="/admin/projects/manage" class="dropdown-item">Manage Projects</a>
                             <a class="nav-link" href="/admin/projects/view" class="dropdown-item">View Projects</a>
                        </div>
                    </div> 

    <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>CONCEPT</a>
         <div class="dropdown-menu bg-transparent border-0">
            <!-- Link to view all concepts -->
                           <a class="nav-link" href="{{ route('admin.concepts.index') }}" class="dropdown-item">Manage concepts</a>
            
            <!-- Link to view a specific concept (Example with ID) -->
                         <a class="nav-link" href="{{ route('admin.concepts.show', ['id' => 1]) }}" class="dropdown-item">View concept</a>
            
            <!-- Link to view concepts by a specific group -->
                          <a class="nav-link" href="{{ route('admin.concepts.byGroup', ['groupId' => 1]) }}" class="dropdown-item">View concepts by group</a>
        </div>
    </div>

                      <!-- user Management -->
   <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa fa-users me-2"></i>USER MANAGEMENT
        </a>
        <div class="dropdown-menu bg-transparent border-0">
            <!-- Link to the user creation page -->
            <a class="dropdown-item" href="{{ route('users.create') }}">Create User</a>

            <!-- Link to the user editing page -->
            <a class="dropdown-item" href="{{ url('users/manage') }}">Edit User</a>

            <!-- Link to the user viewing page -->
            <a class="dropdown-item" href="{{ route('users.index') }}">View Users</a>
        </div>
    </div>


    <!-- Groups Management -->
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa fa-users me-2"></i>GROUP MANAGEMENT
        </a>
        <div class="dropdown-menu bg-transparent border-0">
            <!-- View All Groups Route -->
            <a href="{{ route('groups.index') }}" class="dropdown-item">View All Groups</a>
            
         
        </div>
    </div>





                    <!-- Supervisors Management -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-chalkboard-teacher me-2"></i>COURSES</a>
                        <div class="dropdown-menu bg-transparent border-0">
                             <a class="nav-link" href="{{ route('courses.create') }}" class="dropdown-item">Add Courses</a>
                             <a class="nav-link" href="{{ route('courses.index') }}" class="dropdown-item">View Courses</a>
                        </div>
                    </div>


                      <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-chalkboard-teacher me-2"></i>DEPARTMENT</a>
                        <div class="dropdown-menu bg-transparent border-0">
                             <a class="nav-link" href="{{ route('departments.create') }}" class="dropdown-item">Add Department</a>
                             <a class="nav-link" href="{{ route('departments.index') }}" class="dropdown-item">View Department</a>
                        </div>
                    </div>

                    <!-- Notifications and Reports -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-bell me-2"></i>NOTIFICATIONS</a>
                        <div class="dropdown-menu bg-transparent border-0">
                             <a class="nav-link" href="/admin/notifications" class="dropdown-item">View Notifications</a>
                             <a class="nav-link" href="/admin/notifications/send" class="dropdown-item">Send Notifications</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-file-alt me-2"></i>REPORTS</a>
                        <div class="dropdown-menu bg-transparent border-0">
                             <a class="nav-link" href="/admin/reports" class="dropdown-item">View Reports</a>
                        </div>
                    </div>
                    </div>

                </div>
            </nav>
        </div>

        <!-- {{ route('courses.index') }} -->
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form type="get" action="#" class="d-none d-md-flex ms-4">
        <input class="form-control bg-dark border-0" type="search" placeholder="Search" name="query">
        <button type="submit" class="btn btn-primary">SEARCH</button>
    </form>
    <div class="navbar-nav align-items-center ms-auto">
        


        <!-- Notifications Dropdown -->
<!-- Notification Dropdown -->




        <!-- Profile Dropdown -->
        <!-- Profile Dropdown -->
<div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <!-- Check if the user has an image, otherwise display a default one -->
       <img class="rounded-circle me-lg-2" 
    src="{{ Auth::check() && Auth::user()->image ? asset('images/users/' . Auth::user()->image) : asset('assetz/img/user.jpg') }}" 
    alt="User Image" 
    style="width: 40px; height: 40px;">
    </a>
    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
        <!-- Link to My Profile -->
       
        <!-- Settings -->
        <a href="#" class="dropdown-item">Settings</a>
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item">Log Out</button>
        </form>
    </div>
</div>



    </div>
</nav>

            <!-- Navbar End -->
             @yield('content')

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">The Young leaders</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="https://htmlcodex.com">AP Technologies.</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">CGC</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assetz/lib/chart/chart.min.js')}}"></script>
    <script src="{{asset('assetz/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('assetz/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('assetz/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    
        <script src="{{asset('assetz/lib/tempusdominus/js/checkbox.js')}}"></script>

    <script src="{{asset('assetz/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('assetz/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
        <script src="{{asset('assetz/lib/tempusdominus/js/section.js')}}"></script>
<!-- sections -->
        <script src="{{asset('assetz/lib/tempusdominus/js/sectionss.js')}}"></script>
                <script src="{{asset('assetz/lib/tempusdominus/js/sect.js')}}"></script>


    <script src="{{asset('assetz/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('assetz/js/main.js')}}"></script>
</body>

</html>