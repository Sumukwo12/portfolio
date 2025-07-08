<?php 
$page_title = "Projects - Zeeshan Noor";
include 'includes/header.php'; 

// Hardcoded projects data matching the uploaded image design
$projects = [
    [
        'id' => 1,
        'title' => 'Epesystems Attendance portal',
        'description' => 'Epesys attendance portal is the ultimate tool to manage employee attendance and streamline your HR processes.',
        'image_url' => 'assets/images/download.jpg',
        'technology' => 'REACT JS',
        'github_url' => 'https://github.com/zeeshannoor/attendance-portal',
        'live_url' => 'https://attendance-portal-demo.com',
        'featured' => true
    ],
    [
        'id' => 2,
        'title' => 'Calcu-web-app',
        'description' => 'Coincalcu: Simplifying cryptocurrency investing with advanced charting and data visualization, transforming complex data effortlessly.',
        'image_url' => 'assets/images/download.jpg',
        'technology' => 'REACT JS',
        'github_url' => 'https://github.com/zeeshannoor/calculator-app',
        'live_url' => 'https://calculator-app-demo.com',
        'featured' => true
    ],
    [
        'id' => 3,
        'title' => 'Admin Panel',
        'description' => 'In this Admin Panel, you can easily manage your clients\' portfolios, generate customized reports, and streamline your workflow.',
        'image_url' => 'assets/images/download.jpg',
        'technology' => 'REACT JS',
        'github_url' => 'https://github.com/zeeshannoor/admin-panel',
        'live_url' => 'https://admin-panel-demo.com',
        'featured' => true
    ],
    [
        'id' => 4,
        'title' => 'Adventure Awaits',
        'description' => 'A travel booking platform with stunning UI and seamless user experience for planning your next adventure.',
        'image_url' => 'assets/images/download.jpg',
        'technology' => 'NEXT JS',
        'github_url' => 'https://github.com/zeeshannoor/adventure-app',
        'live_url' => 'https://adventure-app-demo.com',
        'featured' => true
    ],
    [
        'id' => 5,
        'title' => 'E-Commerce Platform',
        'description' => 'Modern e-commerce platform built with Next.js featuring product catalog, shopping cart, and payment integration.',
        'image_url' => 'assets/images/download.jpg',
        'technology' => 'NEXT JS',
        'github_url' => 'https://github.com/zeeshannoor/ecommerce-store',
        'live_url' => 'https://ecommerce-store-demo.com',
        'featured' => true
    ],
    [
        'id' => 6,
        'title' => 'Portfolio Website',
        'description' => 'Responsive portfolio website showcasing projects and skills with modern design and smooth animations.',
        'image_url' => 'assets/images/download.jpg',
        'technology' => 'NEXT JS',
        'github_url' => 'https://github.com/zeeshannoor/portfolio-site',
        'live_url' => 'https://portfolio-demo.com',
        'featured' => false
    ],
    [
        'id' => 7,
        'title' => 'Task Management System',
        'description' => 'A comprehensive task management system with team collaboration, real-time updates, and project tracking capabilities.',
        'image_url' => 'assets/images/download.jpg',
        'technology' => 'python',
        'github_url' => 'https://github.com/zeeshannoor/task-management',
        'live_url' => 'https://task-management-demo.com',
        'featured' => false
    ],
    [
        'id' => 8,
        'title' => 'Weather Dashboard',
        'description' => 'Interactive weather dashboard with detailed forecasts, charts, and location-based weather information.',
        'image_url' => 'assets/images/download.jpg',
        'technology' => 'PHP',
        'github_url' => 'https://github.com/zeeshannoor/weather-dashboard',
        'live_url' => 'https://weather-dashboard-demo.com',
        'featured' => false
    ]
];

// Filter projects if needed
$filter = $_GET['filter'] ?? 'all';
$filtered_projects = $projects;

if ($filter !== 'all') {
    $filtered_projects = array_filter($projects, function($project) use ($filter) {
        return strtolower($project['technology']) === strtolower($filter);
    });
}

// Get unique technologies for filter buttons
$technologies = array_unique(array_column($projects, 'technology'));
sort($technologies);
?>

<main>
    <!-- Projects Section -->
    <section class="projects-section-new">
        <div class="container">
            <div class="projects-header">
                <div class="section-label">
                    <span class="dot"></span>
                    <span>My Projects</span>
                </div>
                <h2 class="section-title">Featured Work</h2>
                <p class="section-description">
                    Here are some of my recent projects that showcase my skills and experience in web development.
                </p>
            </div>

            <!-- Projects Grid - New Design -->
            <div class="projects-grid-new">
                <?php foreach ($filtered_projects as $project): ?>
                    <div class="project-card-new" onclick="openProject('<?php echo htmlspecialchars($project['github_url']); ?>')">
                        <div class="project-tech-badge">
                            <?php echo htmlspecialchars($project['technology']); ?>
                        </div>
                        <div class="project-image-container">
                            <img src="<?php echo htmlspecialchars($project['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($project['title']); ?>"
                                 loading="lazy"
                                 class="project-screenshot">
                        </div>
                        <div class="project-content">
                            <h3 class="project-title"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="project-description"><?php echo htmlspecialchars($project['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (empty($filtered_projects)): ?>
                <div class="no-projects">
                    <i class="fas fa-folder-open"></i>
                    <h3>No projects found</h3>
                    <p>No projects match the selected filter. Try selecting "All Projects".</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<script>
function openProject(githubUrl) {
    if (githubUrl && githubUrl !== '#') {
        window.open(githubUrl, '_blank');
    }
}

// Smooth animations for project cards
document.addEventListener('DOMContentLoaded', function() {
    const projectCards = document.querySelectorAll('.project-card-new');
    
    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Apply initial styles and observe
    projectCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
