<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUST Research Repository</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: yellowgreen;
            padding: 15px;
            text-align: center;
        }
        .navbar ul {
            list-style: none;
            padding: 0;
        }
        .navbar ul li {
            display: inline;
            margin: 0 15px;
        }
        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        .hero {
            text-align: center;
            padding: 50px;
            background: rgba(255, 255, 0, 0.7);
        }
        .search-sort {
            text-align: center;
            margin: 20px;
        }
        .projects-list, .latest-projects, .supervisors-carousel {
            margin: 20px;
            padding: 20px;
            background: rgba(0, 128, 255, 0.8);
            color: white;
            border-radius: 10px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .project-card {
            background: white;
            color: black;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .carousel {
            display: flex;
            overflow: auto;
        }
        .supervisor {
            margin: 10px;
            text-align: center;
        }
        .supervisor img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        footer {
            text-align: center;
            padding: 10px;
            background: green;
            color: white;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <h1>Mbarara University Research Repository</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Programs</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Proposals</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="hero">
        <h2>Empowering Innovation Through Research</h2>
        <p>Explore groundbreaking projects and contribute to the future of science and technology.</p>
    </section>
    
    <section class="search-sort">
        <input type="text" placeholder="Search projects by title...">
        <div class="sort-options">
            <h3>Sort By:</h3>
            <ul>
                <li><a href="#">Date of Issue</a></li>
                <li><a href="#">Project Type</a></li>
                <li><a href="#">Authors</a></li>
                <li><a href="#">Courses</a></li>
            </ul>
        </div>
    </section>
    
    <section class="projects-list">
        <h3>Public Research Projects</h3>
        <div class="projects">
            <article>
                <h4>Project Title</h4>
                <p>Abstract summary goes here...</p>
                <button onclick="promptLogin()">Read More</button>
            </article>
        </div>
    </section>
    
    <section class="latest-projects">
        <h3>Latest Ready for Submission Reports</h3>
        <div class="grid">
            <div class="project-card">Title - Description <button onclick="promptLogin()">Read More</button></div>
            <div class="project-card">Title - Description <button onclick="promptLogin()">Read More</button></div>
            <div class="project-card">Title - Description <button onclick="promptLogin()">Read More</button></div>
            <div class="project-card">Title - Description <button onclick="promptLogin()">Read More</button></div>
            <div class="project-card">Title - Description <button onclick="promptLogin()">Read More</button></div>
            <div class="project-card">Title - Description <button onclick="promptLogin()">Read More</button></div>
        </div>
    </section>
    
    <section class="supervisors-carousel">
        <h3>Lead Supervisors</h3>
        <div class="carousel">
            <div class="supervisor">Supervisor Name <img src="supervisor1.jpg"></div>
            <div class="supervisor">Supervisor Name <img src="supervisor2.jpg"></div>
            <div class="supervisor">Supervisor Name <img src="supervisor3.jpg"></div>
            <div class="supervisor">Supervisor Name <img src="supervisor4.jpg"></div>
        </div>
    </section>
    
    <footer>
        <p>Important Links | Contact Us | Terms of Use</p>
    </footer>
    
    <script>
        function promptLogin() {
            alert("Please log in to view this project.");
        }
    </script>
</body>
</html>
