// Advanced Animation Controller for Portfolio
class PortfolioAnimations {
    constructor() {
      this.init()
      this.setupIntersectionObserver()
      this.setupParallax()
      this.setupTypewriter()
      this.setupStaggerAnimations()
      this.setupFormAnimations()
      this.setupCustomCursor()
    }
  
    init() {
      // Wait for DOM to be fully loaded
      if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", () => this.startAnimations())
      } else {
        this.startAnimations()
      }
    }
  
    startAnimations() {
      this.animatePageLoad()
      this.setupScrollAnimations()
      this.setupHoverEffects()
      this.setupClickAnimations()
    }
  
    // Page Load Animation
    animatePageLoad() {
      // Add loading class to body
      document.body.classList.add("loading")
  
      // Remove loading class after animations
      setTimeout(() => {
        document.body.classList.remove("loading")
        document.body.classList.add("loaded")
      }, 1000)
    }
  
    // Intersection Observer for Scroll Animations
    setupIntersectionObserver() {
      const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      }
  
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
          if (entry.isIntersecting) {
            // Add delay based on element position
            setTimeout(() => {
              entry.target.classList.add("animate-in", "visible")
  
              // Trigger specific animations based on element type
              this.triggerElementSpecificAnimation(entry.target)
            }, index * 100)
          }
        })
      }, observerOptions)
  
      // Observe elements for animation
      const animateElements = document.querySelectorAll(`
              .animate-on-scroll,
              .animate-slide-left,
              .animate-slide-right,
              .animate-scale,
              .fade-in-up,
              .fade-in-left,
              .fade-in-right,
              .scale-in,
              .service-card,
              .project-card-new,
              .contact-item,
              .info-item,
              .timeline-item,
              .profile-circle,
              .about-profile-img
          `)
  
      animateElements.forEach((el) => {
        observer.observe(el)
      })
    }
  
    // Element-specific animations
    triggerElementSpecificAnimation(element) {
      if (element.classList.contains("service-card")) {
        this.animateServiceCard(element)
      } else if (element.classList.contains("project-card-new")) {
        this.animateProjectCard(element)
      } else if (element.classList.contains("timeline-item")) {
        this.animateTimelineItem(element)
      }
    }
  
    // Service Card Animation
    animateServiceCard(card) {
      const icon = card.querySelector(".service-icon")
      const title = card.querySelector("h3")
      const description = card.querySelector("p")
  
      if (icon) {
        setTimeout(() => (icon.style.transform = "scale(1.1)"), 200)
        setTimeout(() => (icon.style.transform = "scale(1)"), 400)
      }
  
      if (title) {
        title.style.animation = "slideInUp 0.6s ease 0.3s both"
      }
  
      if (description) {
        description.style.animation = "fadeInUp 0.6s ease 0.5s both"
      }
    }
  
    // Project Card Animation
    animateProjectCard(card) {
      const badge = card.querySelector(".project-tech-badge")
      const image = card.querySelector(".project-screenshot")
      const title = card.querySelector(".project-title")
      const description = card.querySelector(".project-description")
  
      if (badge) {
        badge.style.animation = "scaleIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.2s both"
      }
  
      if (image) {
        image.style.animation = "fadeInUp 0.8s ease 0.3s both"
      }
  
      if (title) {
        title.style.animation = "slideInUp 0.6s ease 0.5s both"
      }
  
      if (description) {
        description.style.animation = "fadeInUp 0.6s ease 0.7s both"
      }
    }
  
    // Timeline Item Animation
    animateTimelineItem(item) {
      const dot = item.querySelector(".timeline-dot")
      const content = item.querySelector(".timeline-content")
  
      if (dot) {
        dot.style.animation = "scaleIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.2s both"
      }
  
      if (content) {
        content.style.animation = "slideInLeft 0.6s ease 0.4s both"
      }
    }
  
    // Scroll Animations
    setupScrollAnimations() {
      let ticking = false
  
      window.addEventListener("scroll", () => {
        if (!ticking) {
          requestAnimationFrame(() => {
            this.updateScrollAnimations()
            ticking = false
          })
          ticking = true
        }
      })
    }
  
    updateScrollAnimations() {
      const scrolled = window.pageYOffset
      const rate = scrolled * -0.5
  
      // Parallax effect for hero background
      const heroImage = document.querySelector(".image-bg")
      if (heroImage) {
        heroImage.style.transform = `translateY(${rate * 0.3}px)`
      }
  
      // Header hide/show on scroll
      this.handleHeaderScroll(scrolled)
    }
  
    handleHeaderScroll(scrolled) {
      const header = document.querySelector(".header")
      if (!header) return
  
      if (scrolled > 100) {
        header.style.transform = "translateY(-100%)"
      } else {
        header.style.transform = "translateY(0)"
      }
    }
  
    // Parallax Effect
    setupParallax() {
      document.addEventListener("mousemove", (e) => {
        const mouseX = e.clientX / window.innerWidth
        const mouseY = e.clientY / window.innerHeight
  
        // Parallax for floating elements
        const floatingElements = document.querySelectorAll(".floating")
        floatingElements.forEach((el, index) => {
          const speed = (index + 1) * 0.5
          const x = (mouseX - 0.5) * speed * 20
          const y = (mouseY - 0.5) * speed * 20
          el.style.transform = `translate(${x}px, ${y}px)`
        })
      })
    }
  
    // Typewriter Effect
    setupTypewriter() {
      const typewriterElements = document.querySelectorAll(".typing-text")
  
      typewriterElements.forEach((element) => {
        const text = element.textContent
        element.textContent = ""
        element.style.borderRight = "2px solid var(--primary-color)"
  
        let i = 0
        const typeInterval = setInterval(() => {
          if (i < text.length) {
            element.textContent += text.charAt(i)
            i++
          } else {
            clearInterval(typeInterval)
            // Remove cursor after typing is complete
            setTimeout(() => {
              element.style.borderRight = "none"
            }, 1000)
          }
        }, 100)
      })
    }
  
    // Stagger Animations
    setupStaggerAnimations() {
      const staggerContainers = document.querySelectorAll(".stagger-container")
  
      staggerContainers.forEach((container) => {
        const items = container.querySelectorAll(".stagger-item")
  
        const observer = new IntersectionObserver((entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              items.forEach((item, index) => {
                setTimeout(() => {
                  item.classList.add("animate-in")
                }, index * 100)
              })
            }
          })
        })
  
        observer.observe(container)
      })
    }
  
    // Hover Effects
    setupHoverEffects() {
      // Enhanced button hover effects
      const buttons = document.querySelectorAll(".btn")
      buttons.forEach((btn) => {
        btn.addEventListener("mouseenter", () => {
          btn.style.transform = "translateY(-3px) scale(1.05)"
        })
  
        btn.addEventListener("mouseleave", () => {
          btn.style.transform = "translateY(0) scale(1)"
        })
      })
  
      // Card tilt effect
      const cards = document.querySelectorAll(".project-card-new, .service-card")
      cards.forEach((card) => {
        card.addEventListener("mousemove", (e) => {
          const rect = card.getBoundingClientRect()
          const x = e.clientX - rect.left
          const y = e.clientY - rect.top
  
          const centerX = rect.width / 2
          const centerY = rect.height / 2
  
          const rotateX = (y - centerY) / 10
          const rotateY = (centerX - x) / 10
  
          card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(10px)`
        })
  
        card.addEventListener("mouseleave", () => {
          card.style.transform = "perspective(1000px) rotateX(0) rotateY(0) translateZ(0)"
        })
      })
    }
  
    // Click Animations
    setupClickAnimations() {
      // Ripple effect for buttons
      const buttons = document.querySelectorAll(".btn")
      buttons.forEach((btn) => {
        btn.addEventListener("click", (e) => {
          const ripple = document.createElement("span")
          const rect = btn.getBoundingClientRect()
          const size = Math.max(rect.width, rect.height)
          const x = e.clientX - rect.left - size / 2
          const y = e.clientY - rect.top - size / 2
  
          ripple.style.cssText = `
                      position: absolute;
                      width: ${size}px;
                      height: ${size}px;
                      left: ${x}px;
                      top: ${y}px;
                      background: rgba(255, 255, 255, 0.3);
                      border-radius: 50%;
                      transform: scale(0);
                      animation: ripple 0.6s ease-out;
                      pointer-events: none;
                  `
  
          btn.style.position = "relative"
          btn.style.overflow = "hidden"
          btn.appendChild(ripple)
  
          setTimeout(() => {
            ripple.remove()
          }, 600)
        })
      })
    }
  
    // Form Animations
    setupFormAnimations() {
      const formGroups = document.querySelectorAll(".form-group")
  
      formGroups.forEach((group, index) => {
        const input = group.querySelector("input, textarea")
        const label = group.querySelector("label")
  
        if (input && label) {
          // Animate form groups on scroll
          setTimeout(() => {
            group.classList.add("animate-in")
          }, index * 100)
  
          // Focus animations
          input.addEventListener("focus", () => {
            group.style.transform = "translateY(-2px)"
            label.style.color = "var(--primary-color)"
          })
  
          input.addEventListener("blur", () => {
            group.style.transform = "translateY(0)"
            if (!input.value) {
              label.style.color = ""
            }
          })
        }
      })
    }
  
    // Custom Cursor
    setupCustomCursor() {
      if (window.innerWidth > 768) {
        // Only on desktop
        const cursor = document.createElement("div")
        cursor.className = "custom-cursor"
        cursor.style.cssText = `
                  position: fixed;
                  width: 20px;
                  height: 20px;
                  background: var(--primary-color);
                  border-radius: 50%;
                  pointer-events: none;
                  z-index: 9999;
                  transition: transform 0.1s ease;
                  opacity: 0;
              `
        document.body.appendChild(cursor)
  
        document.addEventListener("mousemove", (e) => {
          cursor.style.left = e.clientX - 10 + "px"
          cursor.style.top = e.clientY - 10 + "px"
          cursor.style.opacity = "0.7"
        })
  
        // Scale cursor on hover
        const hoverElements = document.querySelectorAll("a, button, .btn, .project-card-new, .service-card")
        hoverElements.forEach((el) => {
          el.addEventListener("mouseenter", () => {
            cursor.style.transform = "scale(2)"
            cursor.style.opacity = "0.3"
          })
  
          el.addEventListener("mouseleave", () => {
            cursor.style.transform = "scale(1)"
            cursor.style.opacity = "0.7"
          })
        })
      }
    }
  
    // Tab Animation
    animateTabSwitch(activeTab, activePane) {
      // Animate tab button
      activeTab.style.transform = "scale(1.05)"
      setTimeout(() => {
        activeTab.style.transform = "scale(1)"
      }, 200)
  
      // Animate tab content
      activePane.style.animation = "tabSlideIn 0.5s ease forwards"
  
      // Animate child elements
      const childElements = activePane.querySelectorAll(".info-item, .timeline-item, .skills-column li")
      childElements.forEach((el, index) => {
        setTimeout(() => {
          el.classList.add("animate-in")
        }, index * 50)
      })
    }
  
    // Success Animation
    showSuccessAnimation(element) {
      const checkmark = document.createElement("div")
      checkmark.className = "checkmark"
      element.appendChild(checkmark)
  
      setTimeout(() => {
        checkmark.remove()
      }, 2000)
    }
  
    // Loading Animation
    showLoadingAnimation(element) {
      const spinner = document.createElement("div")
      spinner.className = "loading-spinner"
      element.appendChild(spinner)
      return spinner
    }
  
    // Utility method to add CSS keyframes
    addKeyframes(name, keyframes) {
      const style = document.createElement("style")
      style.textContent = `@keyframes ${name} { ${keyframes} }`
      document.head.appendChild(style)
    }
  }
  
  // Initialize animations when DOM is ready
  const portfolioAnimations = new PortfolioAnimations()
  
  // Add ripple keyframes
  portfolioAnimations.addKeyframes(
    "ripple",
    `
      to {
          transform: scale(4);
          opacity: 0;
      }
  `,
  )
  
  // Export for use in other files
  window.PortfolioAnimations = PortfolioAnimations
  