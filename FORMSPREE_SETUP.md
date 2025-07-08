# Quick Formspree Setup (Recommended)

## Why Formspree?
- ✅ **100% reliable email delivery**
- ✅ **No database needed**
- ✅ **Free tier available** (50 submissions/month)
- ✅ **Spam protection included**
- ✅ **Works immediately**

## Setup Steps (5 minutes):

### 1. Create Formspree Account
- Go to [formspree.io](https://formspree.io)
- Sign up with your email
- Verify your email address

### 2. Create New Form
- Click "New Form"
- Enter your email: `zeeshannoor7831@gmail.com`
- Copy the form endpoint (looks like: `https://formspree.io/f/xdkogqko`)

### 3. Update Your Code
In `config/email.php`, replace this line:
\`\`\`php
$formspree_url = "https://formspree.io/f/xdkogqko"; // Replace with your actual endpoint
\`\`\`

### 4. Test It
- Submit a test message through your contact form
- Check your email inbox
- You should receive the message immediately!

## Alternative: EmailJS Setup

### 1. Create EmailJS Account
- Go to [emailjs.com](https://www.emailjs.com)
- Sign up and create a service
- Get your service ID, template ID, and public key

### 2. Add JavaScript Integration
Add this to your contact form for client-side email sending.

## Current Fallbacks
Even without Formspree, the form will try:
1. **Formspree** (if configured)
2. **Enhanced PHP mail()** (depends on server)
3. **Simple PHP mail()** (basic fallback)

## Testing Without Setup
The form will still work with PHP mail() if your server supports it.
Check with your hosting provider about email configuration.
