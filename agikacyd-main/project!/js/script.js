// Combined and optimized JavaScript
        document.addEventListener("DOMContentLoaded", () => {
            // Generate photo strips (fixed Vue.js issue)
            const photoContainer = document.getElementById('photoStripsContainer');
            if (photoContainer) {
              
              const imageList = [
                'pics/photo1(7).jpg',
                'pics/photo1(2).jpg',
                'pics/photo1(3).jpg',
                'pics/photo1(4).jpg',
                'pics/photo1(5).jpg',
                'pics/photo1(6).jpg'
              ];
                for (let i = 0; i < 6; i++) {
                    const col = document.createElement('div');
                    col.className = 'col-4';
                    
                    const photoStrip = document.createElement('div');
                    photoStrip.className = 'photo-strip-grid';
                    
                    photoStrip.style.backgroundImage = `url('${imageList[i]}')`;
                    photoStrip.style.backgroundSize = 'cover';
                    photoStrip.style.backgroundPosition = 'center';
                    photoStrip.style.backgroundRepeat = 'no-repeat';
                    
                    col.appendChild(photoStrip);
                    photoContainer.appendChild(col);
                }
            }

            // Smooth scrolling for navigation links
            const navLinks = document.querySelectorAll('.nav-link[href^="#"]');

            navLinks.forEach((link) => {
                link.addEventListener("click", function (e) {
                    e.preventDefault();

                    const targetId = this.getAttribute("href");
                    const targetSection = document.querySelector(targetId);

                    if (targetSection) {
                        // Calculate offset for fixed header
                        const headerHeight = document.querySelector("header").offsetHeight;
                        const targetPosition = targetSection.offsetTop - headerHeight;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: "smooth",
                        });

                        // Close mobile menu if open
                        const navbarCollapse = document.querySelector(".navbar-collapse");
                        if (navbarCollapse && navbarCollapse.classList.contains("show")) {
                            const bsCollapse = new window.bootstrap.Collapse(navbarCollapse);
                            bsCollapse.hide();
                        }
                    }
                });
            });

            // Add active class to navigation based on scroll position
            window.addEventListener("scroll", () => {
                const sections = document.querySelectorAll("section[id], main[id]");
                const navLinks = document.querySelectorAll(".nav-link");

                let current = "";

                sections.forEach((section) => {
                    const sectionTop = section.offsetTop - 100;
                    const sectionHeight = section.offsetHeight;

                    if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                        current = section.getAttribute("id");
                    }
                });

                navLinks.forEach((link) => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === "#" + current) {
                        link.classList.add("active");
                    }
                });
            });
        });