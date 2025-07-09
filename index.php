<?php 
$page_title = "Lawrence Kimasar - Full stack Developer";
include 'config/database.php';
include 'includes/header.php'; 

// Fetch skills from database
try {
    $stmt = $pdo->query("SELECT * FROM skills ORDER BY category, name");
    $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $skills = [];
}
?>

<main>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <span class="hero-label">Full STACK DEVELOPER</span>
                    <h1 class="hero-title">
                        Hello, my name is <span class="text-muted">Lawrence Kimasar</span>
                    </h1>
                    <p class="hero-description">
                        Brief description with insights into myself, my vocational journey, and what I engage in professionally.
                    </p>
                    
                    <div class="hero-buttons">
                        <a href="contact.php" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Contact me
                        </a>
                        <a href="assets/cv/resume.pdf" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-eye"></i> View CV
                        </a>
                    </div>
                    
                    <div class="social-links">
                        <a href="https://www.linkedin.com/in/lawrence-kimasar-1439b72b4/" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/Sumukwo12" class="social-link"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                
                <div class="hero-image">
                    <div class="image-container">
                        <div class="image-bg"></div>
                        <img src="assets/images/my_logo.png" alt="Profile" class="profile-img">
                        <div class="experience-badge">
                            <span class="experience-number">5 0+</span>
                            <div class="experience-text">
                                <div>Years of</div>
                                <div>Experience</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="scroll-indicator">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="about-header">
                <div class="section-label">
                    <span class="dot"></span>
                    <span>About Me</span>
                </div>
            </div>

            <div class="about-content">
                <!-- Profile Image -->
                <div class="about-image">
                    <div class="profile-circle">
                        <img src="assets/images/my_logo.png" alt="Zeeshan Noor" class="about-profile-img">
                    </div>
                </div>

                <!-- Tabbed Content -->
                <div class="about-tabs-container">
                    <!-- Tab Navigation -->
                    <div class="about-tabs">
                        <button class="tab-btn active" data-tab="personal">Personal Info</button>
                        <button class="tab-btn" data-tab="qualifications">Qualifications</button>
                        <button class="tab-btn" data-tab="skills">Skills</button>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Personal Info Tab -->
                        <div class="tab-pane active" id="personal">
                            <h2>Unmatched Services Quality for Over 3 Years</h2>
                            <p class="about-description">
                                I specialize in crafting intuitive website with cutting-edge technology, delivering 
                                dynamic and engaging user experience.
                            </p>

                            <div class="personal-info-grid">
                                <div class="info-item">
                                    <i class="fas fa-user"></i>
                                    <span>Lawrence Kimasar</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-phone"></i>
                                    <span>+254704425535</span>
                                </div>
                                
                                <div class="info-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>kimasarlawrence@gmail.com</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Bachelor's of Science Information and Communication Technology</span>
                                </div>
                            </div>

                            <div class="language-skills">
                                <h4>Language Skill</h4>
                                <p>English</p>
                            </div>
                        </div>

                        <!-- Qualifications Tab -->
                        <div class="tab-pane" id="qualifications">
                            <h2>My Awesome journey</h2>
                            
                            <div class="qualifications-grid">
                                <div class="experience-section">
                                    <h3><i class="fas fa-briefcase"></i> Experience</h3>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content">
                                            <h4>Sharvic East Africa Limited</h4>
                                            <p>Software Developer</p>
                                            <span class="timeline-date">May 2025 – July 2025</span>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content">
                                            <h4>Geonet Technologies Limited</h4>
                                            <p>Software Developer and IT Support</p>
                                            <span class="timeline-date">May 2025 – July 2025</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="education-section">
                                    <h3><i class="fas fa-graduation-cap"></i> Education</h3>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content">
                                            <h4>Laikipia University</h4>
                                            <p>BICT</p>
                                            <span class="timeline-date">2021 - 2025</span>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content">
                                            <h4>Emining Boys High School</h4>
                                            <p>B-</p>
                                            <span class="timeline-date">2017 - 2020</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Skills Tab -->
                        <div class="tab-pane" id="skills">
                            <h2>What I Use Everyday</h2>
                            
                            <div class="skills-content">
                                <h4>Skills</h4>
                                <div class="skills-list">
                                    <div class="skills-column">
                                        <ul>
                                            <li>HTML</li>
                                            <li>CSS</li>
                                            <li>Python</li>
                                            <li>JavaScript</li>
                                            <li>TypeScript</li>
                                            <li>ReactJS</li>
                                            <li>NextJS</li>
                                            <li>Git</li>
                                            <li>ChartJs</li>
                                        </ul>
                                    </div>
                                    <div class="skills-column">
                                        <ul>
                                            <li>React Query</li>
                                            <li>Socket.io</li>
                                            <li>PWA (Progressive Web Application)</li>
                                            <li>React Testing Library</li>
                                            <li>Moment.js</li>
                                            <li>Draft.Js</li>
                                            <li>Web-Components</li>
                                            <li>Jenkins</li>
                                            <li>Web3.js</li>
                                            <li>MetaMask</li>
                                        </ul>
                                    </div>
                                </div>

                                <h4>Tools</h4>
                                <div class="tools-icons">
                                    <div class="tool-icon">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vscode/vscode-original.svg" alt="VS Code">
                                    </div>
                                    <div class="tool-icon">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" alt="Git">
                                    </div>
                                    <div class="tool-icon">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/chrome/chrome-original.svg" alt="Chrome">
                                    </div>
                                    <div class="tool-icon">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg" alt="Figma">
                                    </div>
                                    <div class="tool-icon">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/cursor/cursor-original.svg" alt="cursor">
                                    </div>
                                    <div class="tool-icon">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jenkins/jenkins-original.svg" alt="Jenkins">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- My Services Section -->
  <section class="services-section">
      <div class="container">
          <div class="services-header">
              <div class="section-label">
                  <span class="dot"></span>
                  <span>My Services</span>
              </div>
          </div>

          <div class="services-grid">
              

              <div class="service-card">
  <div class="service-icon">
    <i class="fas fa-code"></i>
  </div>
  <h3>Software & Application Development</h3>
  <p>Develop custom desktop, web, and mobile applications using Python, PHP, and Java. Solve organizational problems with OOP, structured, and event-driven paradigms to build efficient systems.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-globe"></i>
  </div>
  <h3>Web Development & Internet Technologies</h3>
  <p>Design responsive and interactive websites using HTML, CSS, JavaScript, and PHP. Create IoT-integrated dashboards and manage websites on Linux servers using open-source tools.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-database"></i>
  </div>
  <h3>Database Design & Management</h3>
  <p>Design and maintain relational databases with MySQL or Oracle. Build data-driven applications, perform normalization, indexing, and optimization for efficient performance.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-project-diagram"></i>
  </div>
  <h3>Systems Analysis & Project Management</h3>
  <p>Analyze systems to gather requirements, document and manage ICT projects using SDLC or Agile. Collaborate in team-based development with full project lifecycle understanding.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-shield-alt"></i>
  </div>
  <h3>Cybersecurity & Information Assurance</h3>
  <p>Implement and monitor cybersecurity strategies. Conduct audits, scans, access control, and safeguard networks, databases, and internal systems against threats.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-network-wired"></i>
  </div>
  <h3>Networking & Infrastructure</h3>
  <p>Design, configure, and maintain LAN/WAN environments. Set up routers, switches, firewalls, and develop distributed systems and network services.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-chart-line"></i>
  </div>
  <h3>Data Analytics & Business Intelligence</h3>
  <p>Perform data analysis using Excel, Python, and SQL. Build dashboards and reports to derive insights that support business decision-making.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-robot"></i>
  </div>
  <h3>Artificial Intelligence & Machine Learning</h3>
  <p>Develop AI systems for decision support and task automation. Apply machine learning for trend analysis and explore applications in IoT, business, and healthcare.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-shopping-cart"></i>
  </div>
  <h3>E-Commerce & Business IT Services</h3>
  <p>Build online stores and integrate payment systems. Support BPO with CRM and automation, ensuring compliance with digital policies and information laws.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-tools"></i>
  </div>
  <h3>IT Support & System Maintenance</h3>
  <p>Provide helpdesk services and system troubleshooting. Manage user accounts, updates, and maintain hardware/software across networks and servers.</p>
</div>

<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-users"></i>
  </div>
  <h3>Human-Centered Design & User Experience</h3>
  <p>Design accessible and user-friendly interfaces. Conduct usability testing, gather feedback, and simplify technical content for diverse audiences.</p>
</div>


              
          </div>
      </div>
  </section>
</main>

<script>
// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetTab = btn.getAttribute('data-tab');

            // Remove active class from all tabs and panes
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            // Add active class to clicked tab and corresponding pane
            btn.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>
