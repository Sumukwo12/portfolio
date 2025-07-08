<?php
// Direct Email Configuration (No Database)
class EmailConfig {
    // Your email settings
    const YOUR_EMAIL = "kimasarlawrence@gmail.com";
    const YOUR_NAME = "Lawrence Kimasar";
    
    // Email template for direct delivery
    public static function getContactEmailTemplate($data) {
        return "subject: $data[subject] \n message: $data[message]";}
        /*
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>New Contact Message</title>
            <style>
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    background: white;
                    border-radius: 10px;
                    overflow: hidden;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }
                .header {
                    background: linear-gradient(135deg, #ff7b54, #e66a47);
                    color: white;
                    padding: 30px 20px;
                    text-align: center;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                    font-weight: 600;
                }
                .content {
                    padding: 30px;
                }
                .info-section {
                    background: #f8f9fa;
                    padding: 20px;
                    border-radius: 8px;
                    margin: 20px 0;
                }
                .info-row {
                    margin: 12px 0;
                }
                .label {
                    font-weight: 600;
                    color: #ff7b54;
                    display: inline-block;
                    min-width: 80px;
                    margin-right: 15px;
                }
                .value {
                    color: #333;
                }
                .message-section {
                    background: white;
                    border: 1px solid #e9ecef;
                    border-left: 4px solid #ff7b54;
                    padding: 20px;
                    margin: 20px 0;
                    border-radius: 0 8px 8px 0;
                }
                .message-label {
                    font-weight: 600;
                    color: #ff7b54;
                    margin-bottom: 10px;
                    font-size: 16px;
                }
                .message-text {
                    color: #555;
                    line-height: 1.8;
                    font-size: 15px;
                    white-space: pre-wrap;
                }
                .footer {
                    background: #f8f9fa;
                    padding: 20px;
                    text-align: center;
                    border-top: 1px solid #e9ecef;
                }
                .footer p {
                    margin: 0;
                    color: #6c757d;
                    font-size: 14px;
                }
                .timestamp {
                    color: #6c757d;
                    font-size: 12px;
                    margin-top: 10px;
                }
                .reply-info {
                    background: #e8f5e8;
                    padding: 15px;
                    border-radius: 8px;
                    margin: 15px 0;
                    border-left: 4px solid #28a745;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>📧 New Contact Message</h1>
                    <p style='margin: 5px 0 0 0; opacity: 0.9;'>From your portfolio website</p>
                </div>
                
                <div class='content'>
                    <div class='info-section'>
                        <div class='info-row'>
                            <span class='label'>👤 Name:</span>
                            <span class='value'>{$data['name']}</span>
                        </div>
                        <div class='info-row'>
                            <span class='label'>📧 Email:</span>
                            <span class='value'><a href='mailto:{$data['email']}' style='color: #ff7b54; text-decoration: none;'>{$data['email']}</a></span>
                        </div>
                        <div class='info-row'>
                            <span class='label'>📋 Subject:</span>
                            <span class='value'>{$data['subject']}</span>
                        </div>
                    </div>
                    
                    <div class='message-section'>
                        <div class='message-label'>💬 Message:</div>
                        <div class='message-text'>{$data['message']}</div>
                    </div>
                    
                    <div class='reply-info'>
                        <strong>💡 To Reply:</strong> Simply reply to this email or click the email address above to respond directly to {$data['name']}.
                    </div>
                    
                    <div class='timestamp'>
                        📅 Received: " . date('F j, Y \a\t g:i A') . "
                    </div>
                </div>
                
                <div class='footer'>
                    <p>This message was sent from your portfolio contact form.</p>
                    <p style='margin-top: 10px;'>
                        <strong>Website:</strong> <a href='http://localhost/portfolio/' style='color: #ff7b54;'>Your Portfolio</a>
                    </p>
                </div>
            </div>
        </body>
        </html>
        */
        
    
    // Multiple email sending methods for better reliability
    public static function sendDirectEmail($to, $subject, $body, $from_email, $from_name) {
        // Method 1: Try Formspree (most reliable)
        if (self::sendViaFormspree($to, $subject, $body, $from_email, $from_name)) {
            return ['success' => true, 'method' => 'Formspree'];
        }
        
        // Method 2: Try enhanced PHP mail
        if (self::sendViaPHPMail($to, $subject, $body, $from_email, $from_name)) {
            return ['success' => true, 'method' => 'PHP Mail'];
        }
        
        // Method 3: Try simple mail as last resort
        if (self::sendSimpleMail($to, $subject, $body, $from_email, $from_name)) {
            return ['success' => true, 'method' => 'Simple Mail'];
        }
        
        return ['success' => false, 'method' => 'All methods failed'];
    }
    
    // Method 1: Formspree (most reliable)
    private static function sendViaFormspree($to, $subject, $body, $from_email, $from_name) {
        // You need to replace this with your actual Formspree endpoint
        $formspree_url = "https://formspree.io/f/xvgrjagz"; // Replace with your Formspree ID
        
        $data = [
            'email' => $from_email,
            'name' => $from_name,
            'subject' => $subject,
            'message' => strip_tags($body), // Formspree works better with plain text
            '_replyto' => $from_email,
            '_subject' => $subject
        ];
        
        // Check if curl is available
        if (!function_exists('curl_init')) {
            return false;
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $formspree_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);
        
        // Log for debugging
        if ($curl_error) {
            error_log("Formspree CURL Error: " . $curl_error);
        }
        error_log("Formspree Response Code: " . $http_code);
        
        return $http_code === 200;
    }
    
    // Method 2: Enhanced PHP Mail
    private static function sendViaPHPMail($to, $subject, $body, $from_email, $from_name) {
        // Clean and validate
        $to = filter_var($to, FILTER_SANITIZE_EMAIL);
        $from_email = filter_var($from_email, FILTER_SANITIZE_EMAIL);
        
        if (!filter_var($to, FILTER_VALIDATE_EMAIL) || !filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Enhanced headers
        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $from_name . ' <' . $from_email . '>',
            'Reply-To: ' . $from_email,
            'Return-Path: ' . $from_email,
            'X-Mailer: PHP/' . phpversion(),
            'X-Priority: 3',
            'Date: ' . date('r'),
            'Message-ID: <' . time() . rand(1000, 9999) . '@' . $_SERVER['HTTP_HOST'] . '>',
        ];
        
        $additional_parameters = '-f' . $from_email;
        
        return @mail($to, $subject, $body, implode("\r\n", $headers), $additional_parameters);
    }
    
    // Method 3: Simple mail (fallback)
    private static function sendSimpleMail($to, $subject, $body, $from_email, $from_name) {
        $headers = "From: $from_name <$from_email>\r\n";
        $headers .= "Reply-To: $from_email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        return @mail($to, $subject, $body, $headers);
    }
}
?>
