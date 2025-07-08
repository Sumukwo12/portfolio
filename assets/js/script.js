// Theme Toggle Functionality
document.addEventListener("DOMContentLoaded", () => {
  const themeToggle = document.getElementById("themeToggle")
  const body = document.body
  const icon = themeToggle.querySelector("i")

  // Check for saved theme preference or default to light mode
  const currentTheme = localStorage.getItem("theme") || "light"

  if (currentTheme === "dark") {
    body.setAttribute("data-theme", "dark")
    icon.className = "fas fa-sun"
  }

  themeToggle.addEventListener("click", () => {
    const currentTheme = body.getAttribute("data-theme")

    if (currentTheme === "dark") {
      body.removeAttribute("data-theme")
      icon.className = "fas fa-moon"
      localStorage.setItem("theme", "light")
    } else {
      body.setAttribute("data-theme", "dark")
      icon.className = "fas fa-sun"
      localStorage.setItem("theme", "dark")
    }
  })

  // Mobile Menu Toggle
  const mobileToggle = document.getElementById("mobileToggle")
  const navMenu = document.getElementById("navMenu")

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener("click", () => {
      navMenu.classList.toggle("active")
      mobileToggle.classList.toggle("active")
    })
  }

  // Smooth Scrolling for Anchor Links (for homepage sections)
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()
      const target = document.querySelector(this.getAttribute("href"))
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  })

  // Scroll indicator click handler
  const scrollIndicator = document.querySelector(".scroll-indicator")
  if (scrollIndicator) {
    scrollIndicator.addEventListener("click", () => {
      const aboutSection = document.querySelector("#about")
      if (aboutSection) {
        aboutSection.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  }

  // Form Validation
  const contactForm = document.querySelector(".contact-form")
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      const inputs = this.querySelectorAll("input[required], textarea[required]")
      let isValid = true

      inputs.forEach((input) => {
        if (!input.value.trim()) {
          input.style.borderColor = "#dc3545"
          isValid = false
        } else {
          input.style.borderColor = ""
        }

        // Email validation
        if (input.type === "email" && input.value.trim()) {
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
          if (!emailRegex.test(input.value)) {
            input.style.borderColor = "#dc3545"
            isValid = false
          }
        }
      })

      if (!isValid) {
        e.preventDefault()
        alert("Please fill in all required fields correctly.")
      }
    })
  }

  // Animate elements on scroll
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = "1"
        entry.target.style.transform = "translateY(0)"
      }
    })
  }, observerOptions)

  // Observe elements for animation
  document.querySelectorAll(".service-card, .project-card, .skill-badge").forEach((el) => {
    el.style.opacity = "0"
    el.style.transform = "translateY(20px)"
    el.style.transition = "opacity 0.6s ease, transform 0.6s ease"
    observer.observe(el)
  })

  // Header scroll effect
  let lastScrollTop = 0
  const header = document.querySelector(".header")

  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop

    if (scrollTop > lastScrollTop && scrollTop > 100) {
      // Scrolling down
      header.style.transform = "translateY(-100%)"
    } else {
      // Scrolling up
      header.style.transform = "translateY(0)"
    }

    lastScrollTop = scrollTop
  })

  // Add loading animation
  window.addEventListener("load", () => {
    document.body.classList.add("loaded")
  })
})

// Utility function to show notifications
function showNotification(message, type = "info") {
  const notification = document.createElement("div")
  notification.className = `notification ${type}`
  notification.textContent = message

  notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 9999;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `

  if (type === "success") {
    notification.style.background = "#28a745"
  } else if (type === "error") {
    notification.style.background = "#dc3545"
  } else {
    notification.style.background = "#17a2b8"
  }

  document.body.appendChild(notification)

  // Animate in
  setTimeout(() => {
    notification.style.transform = "translateX(0)"
  }, 100)

  // Remove after 3 seconds
  setTimeout(() => {
    notification.style.transform = "translateX(100%)"
    setTimeout(() => {
      document.body.removeChild(notification)
    }, 300)
  }, 3000)
}
