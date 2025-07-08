// Enhanced Contact Form Functionality
document.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.querySelector(".contact-form")
    const submitBtn = contactForm.querySelector('button[type="submit"]')
    const originalBtnText = submitBtn.innerHTML
  
    // Real-time validation
    const inputs = contactForm.querySelectorAll("input, textarea")
    inputs.forEach((input) => {
      input.addEventListener("blur", validateField)
      input.addEventListener("input", clearError)
    })
  
    // Form submission with enhanced feedback
    contactForm.addEventListener("submit", (e) => {
      if (!validateForm()) {
        e.preventDefault()
        return false
      }
  
      // Show loading state
      submitBtn.disabled = true
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending Email...'
  
      // Add visual feedback
      contactForm.style.opacity = "0.7"
  
      // Show progress message
      showProgressMessage("Sending your message directly to lawrence's email...")
  
      // Re-enable button after reasonable time (in case of slow server)
      setTimeout(() => {
        if (submitBtn.disabled) {
          submitBtn.disabled = false
          submitBtn.innerHTML = originalBtnText
          contactForm.style.opacity = "1"
        }
      }, 10000) // 10 seconds timeout
    })
  
    function validateField(e) {
      const field = e.target
      const value = field.value.trim()
  
      clearError(e)
  
      if (field.hasAttribute("required") && !value) {
        showError(field, "This field is required")
        return false
      }
  
      if (field.type === "email" && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        if (!emailRegex.test(value)) {
          showError(field, "Please enter a valid email address")
          return false
        }
      }
  
      if (field.name === "message" && value) {
        if (value.length < 10) {
          showError(field, "Message must be at least 10 characters long")
          return false
        }
        if (value.length > 2000) {
          showError(field, "Message is too long (max 2000 characters)")
          return false
        }
      }
  
      if (field.name === "subject" && value.length > 200) {
        showError(field, "Subject is too long (max 200 characters)")
        return false
      }
  
      return true
    }
  
    function validateForm() {
      let isValid = true
      inputs.forEach((input) => {
        if (!validateField({ target: input })) {
          isValid = false
        }
      })
      return isValid
    }
  
    function showError(field, message) {
      field.style.borderColor = "#dc3545"
      field.style.boxShadow = "0 0 0 3px rgba(220, 53, 69, 0.1)"
  
      // Remove existing error message
      const existingError = field.parentNode.querySelector(".error-message")
      if (existingError) {
        existingError.remove()
      }
  
      // Add new error message
      const errorDiv = document.createElement("div")
      errorDiv.className = "error-message"
      errorDiv.style.cssText = `
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        animation: slideIn 0.3s ease;
      `
      errorDiv.textContent = message
  
      field.parentNode.appendChild(errorDiv)
    }
  
    function clearError(e) {
      const field = e.target
      field.style.borderColor = ""
      field.style.boxShadow = ""
  
      const errorMessage = field.parentNode.querySelector(".error-message")
      if (errorMessage) {
        errorMessage.remove()
      }
    }
  
    function showProgressMessage(message) {
      const progressDiv = document.createElement("div")
      progressDiv.className = "progress-message"
      progressDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #17a2b8;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        z-index: 9999;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        max-width: 300px;
      `
      progressDiv.innerHTML = `<i class="fas fa-paper-plane"></i> ${message}`
  
      document.body.appendChild(progressDiv)
  
      // Animate in
      setTimeout(() => {
        progressDiv.style.transform = "translateX(0)"
      }, 100)
  
      // Remove after 5 seconds
      setTimeout(() => {
        progressDiv.style.transform = "translateX(100%)"
        setTimeout(() => {
          if (document.body.contains(progressDiv)) {
            document.body.removeChild(progressDiv)
          }
        }, 300)
      }, 5000)
    }
  
    // Character counter for message field
    const messageField = contactForm.querySelector('textarea[name="message"]')
    if (messageField) {
      const counter = document.createElement("div")
      counter.className = "char-counter"
      counter.style.cssText = `
        text-align: right;
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
      `
  
      messageField.parentNode.appendChild(counter)
  
      messageField.addEventListener("input", function () {
        const length = this.value.length
        counter.textContent = `${length}/2000 characters`
  
        if (length > 2000) {
          counter.style.color = "#dc3545"
        } else if (length > 1800) {
          counter.style.color = "#ffc107"
        } else if (length >= 10) {
          counter.style.color = "#28a745"
        } else {
          counter.style.color = "#6c757d"
        }
      })
  
      // Initialize counter
      messageField.dispatchEvent(new Event("input"))
    }
  
    // Auto-hide success/error messages after 8 seconds
    const messages = document.querySelectorAll(".message")
    messages.forEach((message) => {
      if (message.classList.contains("success")) {
        setTimeout(() => {
          message.style.opacity = "0"
          setTimeout(() => {
            message.style.display = "none"
          }, 300)
        }, 8000)
      }
    })
  
    // Add email validation indicator
    const emailField = contactForm.querySelector('input[name="email"]')
    if (emailField) {
      emailField.addEventListener("input", function () {
        const email = this.value.trim()
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  
        if (email && emailRegex.test(email)) {
          this.style.borderColor = "#28a745"
          this.style.boxShadow = "0 0 0 3px rgba(40, 167, 69, 0.1)"
        } else if (email) {
          this.style.borderColor = "#dc3545"
          this.style.boxShadow = "0 0 0 3px rgba(220, 53, 69, 0.1)"
        } else {
          this.style.borderColor = ""
          this.style.boxShadow = ""
        }
      })
    }
  })
  