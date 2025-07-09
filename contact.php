<?php 
$page_title = "Contact - kimasar lawrence";
include 'config/email.php';
include 'includes/header.php'; 

$message = '';
$message_type = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $user_message = trim($_POST['message'] ?? '');
    
    // Validation
    $errors = [];
    
    if (empty($first_name)) $errors[] = "First name is required";
    if (empty($last_name)) $errors[] = "Last name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
    if (empty($subject)) $errors[] = "Subject is required";
    if (empty($user_message)) $errors[] = "Message is required";
    
    // Enhanced validation
    if (strlen($user_message) < 10) $errors[] = "Message is too short (minimum 10 characters)";
    if (strlen($user_message) > 2000) $errors[] = "Message is too long (maximum 2000 characters)";
    if (strlen($subject) > 200) $errors[] = "Subject is too long (maximum 200 characters)";
    
    // Spam protection
    if (!empty($_POST['website'])) $errors[] = "Spam detected";
    
    // Rate limiting (simple session-based)
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $current_time = time();
    $last_submission = $_SESSION['last_contact_submission'] ?? 0;
    
    if ($current_time - $last_submission < 60) { // 1 minute cooldown
        $errors[] = "Please wait a minute before sending another message";
    }
    
    if (empty($errors)) {
        try {
            // Prepare email data
            $email_data = [
                'name' => $first_name . ' ' . $last_name,
                'email' => $email,
                'subject' => $subject,
                'message' => htmlspecialchars($user_message, ENT_QUOTES, 'UTF-8')
            ];
            
            // Create email content
            $email_subject = "Portfolio Contact: " . $subject;
            $email_body = EmailConfig::getContactEmailTemplate($email_data);
            
            // Send email directly
            $result = EmailConfig::sendDirectEmail(
                EmailConfig::YOUR_EMAIL,
                $email_subject,
                $email_body,
                $email,
                $first_name . ' ' . $last_name
            );
            
            if ($result['success']) {
                $message = "✅ Thank you! Your message has been sent successfully. I'll get back to you within 24 hours.";
                $message_type = "success";
                
                // Update session to prevent spam
                $_SESSION['last_contact_submission'] = $current_time;
                
                // Log successful submission
                error_log("Contact form: Message sent successfully via " . $result['method'] . " from " . $email);
                
                // Clear form data on success
                $first_name = $last_name = $email = $subject = $user_message = '';
                
            } else {
                throw new Exception("Email delivery failed: " . $result['method']);
            }
            
        } catch(Exception $e) {
            error_log("Contact form error: " . $e->getMessage());
            $message = "❌ Sorry, there was an error sending your message. Please try emailing me directly at " . EmailConfig::YOUR_EMAIL;
            $message_type = "error";
        }
    } else {
        $message = "❌ " . implode("<br>", $errors);
        $message_type = "error";
    }
}
?>

<main>
    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="section-header">
                <div class="section-label">
                    <span class="dot"></span>
                    <span>Get In Touch</span>
                </div>
                <h1 class="section-title">Let's Work Together</h1>
                <p class="section-description">
                    Send me a message. All messages come directly to my email.
                </p>
            </div>

            <div class="contact-content">
                <!-- Contact Info -->
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <p><a href="mailto:kimasarlawrence@gmail.com" style="color: inherit; text-decoration: none;">kimasarlawrence@gmail.com</a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Phone</h4>
                            <p><a href="tel:+254704425535" style="color: inherit; text-decoration: none;">+254 704425535</a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Location</h4>
                            <p>Kenya</p>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="https://www.linkedin.com/in/lawrence-kimasar-1439b72b4/" class="social-link" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/Sumukwo12" class="social-link" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="mailto:kimasarlawrence@gmail.com" class="social-link" title="Email"><i class="fas fa-envelope"></i></a>
                    </div>

                    <!-- Direct Contact Info -->
                    <div style="margin-top: 2rem; padding: 1.5rem; background: var(--bg-light); border-radius: 12px; border-left: 4px solid var(--primary-color);">
                        <h4 style="color: var(--primary-color); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-info-circle"></i> Direct Contact
                        </h4>
                        <p style="font-size: 0.9rem; color: var(--text-muted); margin: 0; line-height: 1.5;">
                            Messages from this form come directly to my email inbox. 
                           
                        </p>
                        <p style="font-size: 0.9rem; color: var(--text-muted); margin: 0.5rem 0 0 0;">
                            <strong>Backup:</strong> <a href="mailto:kimasarlawrence@gmail.com" style="color: var(--primary-color);">kimasarlawrence@gmail.com</a>
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-container">
                    <?php if ($message): ?>
                        <div class="message <?php echo $message_type; ?>">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" method="POST" action="">
                        <!-- Honeypot field for spam protection (hidden) -->
                        <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First Name *</label>
                                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name ?? ''); ?>" required maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name ?? ''); ?>" required maxlength="50">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required maxlength="100">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($subject ?? ''); ?>" required maxlength="200" placeholder="e.g., Project Inquiry, Collaboration, Job Opportunity">
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message * <span style="font-size: 0.8rem; color: var(--text-light);">(10-2000 characters)</span></label>
                            <textarea id="message" name="message" rows="6" required minlength="10" maxlength="2000" placeholder="Tell me about your project, requirements, timeline, budget, or any questions you have. The more details you provide, the better I can help you!"><?php echo htmlspecialchars($user_message ?? ''); ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-full">
                            <i class="fas fa-paper-plane"></i> Send Message Directly
                        </button>
                        
                        <div style="text-align: center; margin-top: 1rem;">
                            <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0;">
                                <i class="fas fa-shield-alt" style="color: var(--primary-color);"></i>
                                Your message goes directly to my email.
                            </p>
                            <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0.5rem 0 0 0;">
                                Response time: As soon as possible
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="assets/js/contact-form.js"></script>
<?php include 'includes/footer.php'; ?>
