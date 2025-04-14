const jsonData = {
    "pageTitle": "Smart Eco Guide System - Discover National Parks",
    "metadata": {
        "description": "Explore national parks, discover wildlife, and learn about conservation efforts.",
        "keywords": ["national parks", "eco-tourism", "wildlife", "conservation", "guides", "tourism"]
    },
    "header": {
        "logo": {
            "url": "/images/logo.png",
            "alt": "Smart Eco Guide System Logo"
        },
        "navigation": [
            {
                "label": "Home",
                "url": "/",
                "active": true
            },
            {
                "label": "Parks",
                "url": "/parks"
            },
            {
                "label": "Guides",
                "url": "/guides"
            },
            {
                "label": "About",
                "url": "/about"
            },
            {
                "label": "Login/Register",
                "url": "/login"
            }
        ]
    },
    "banner": {
        "imageUrl": "/images/home-banner.jpg",
        "title": "Welcome to Our National Parks",
        "subtitle": "Your comprehensive guide to exploring the natural wonders of our parks.",
        "callToAction": {
            "label": "Discover Parks",
            "url": "/parks"
        }
    },
    "sections": [
        {
            "type": "featured-parks",
            "title": "Featured National Parks",
            "description": "Explore some of our most popular and breathtaking national parks.",
            "parks": [
                {
                    "name": "Gunung Gading National Park",
                    "imageUrl": "/images/gunung-gading.jpg",
                    "url": "/parks/gunung-gading",
                    "description": "Famous for its Rafflesia flowers."
                },
                {
                    "name": "Bako National Park",
                    "imageUrl": "/images/bako.jpg",
                    "url": "/parks/bako",
                    "description": "Home to proboscis monkeys and diverse wildlife."
                },
                {
                    "name": "Lambir Hills National Park",
                    "imageUrl": "/images/lambir.jpg",
                    "url": "/parks/lambir",
                    "description": "Known for its waterfalls and hiking trails."
                }
            ]
        },
        {
            "type": "about-us",
            "title": "About the Smart Eco Guide System",
            "content": "The Smart Eco Guide System is designed to enhance your experience in national parks by providing you with real-time information, interactive guides, and tools to help you discover the beauty of nature.",
            "imageUrl": "/images/about-us.jpg"
        },
        {
            "type": "testimonials",
            "title": "What Our Visitors Say",
            "testimonials": [
                {
                    "author": "John Doe",
                    "quote": "The app was incredibly helpful in navigating the park and finding wildlife."
                },
                {
                    "author": "Jane Smith",
                    "quote": "The real-time updates on sightings were amazing!"
                }
            ]
        }
    ],
    "footer": {
        "content": "© 2025 Smart Eco Guide System | All rights reserved.",
        "socialLinks": [
            {
                "icon": "facebook",
                "url": "https://facebook.com"
            },
            {
                "icon": "instagram",
                "url": "https://instagram.com"
            }
        ]
    }
};

const rootElement = document.getElementById('root');

function createHeader(headerData) {
    const header = document.createElement('header');
    const logo = document.createElement('div');
    logo.innerHTML = `<img src="${headerData.logo.url}" alt="${headerData.logo.alt}">`;

    const nav = document.createElement('nav');
    const ul = document.createElement('ul');
    headerData.navigation.forEach(item => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = item.url;
        a.textContent = item.label;
        if (item.active) {
            a.classList.add('active');  // You'll need CSS for this class
        }
        li.appendChild(a);
        ul.appendChild(li);
    });
    nav.appendChild(ul);

    header.appendChild(logo);
    header.appendChild(nav);
    return header;
}

function createBanner(bannerData) {
    const banner = document.createElement('div');
    banner.classList.add('banner');
    banner.innerHTML = `
        <h1>${bannerData.title}</h1>
        <p>${bannerData.subtitle}</p>
        <button onclick="window.location.href='${bannerData.callToAction.url}'">${bannerData.callToAction.label}</button>
    `;
    return banner;
}

function createFeaturedParksSection(parksData) {
    const section = document.createElement('div');
    section.classList.add('section', 'featured-parks');
    section.innerHTML = `<h2>${parksData.title}</h2><p>${parksData.description}</p>`;

    const parksContainer = document.createElement('div');
    parksData.parks.forEach(park => {
        const parkCard = document.createElement('div');
        parkCard.classList.add('park-card');
        parkCard.innerHTML = `
            <img src="${park.imageUrl}" alt="${park.name}">
            <h3>${park.name}</h3>
            <p>${park.description}</p>
            <a href="${park.url}">Learn More</a>
        `;
        parksContainer.appendChild(parkCard);
    });
    section.appendChild(parksContainer);
    return section;
}


function createAboutUsSection(aboutUsData) {
    const section = document.createElement('div');
    section.classList.add('section', 'about-us');
    section.innerHTML = `
        <h2>${aboutUsData.title}</h2>
        <img src="${aboutUsData.imageUrl}">
        <p>${aboutUsData.content}</p>
    `;
    return section;
}

function createTestimonialsSection(testimonialsData) {
    const section = document.createElement('div');
    section.classList.add('section', 'testimonials');
    section.innerHTML = `<h2>${testimonialsData.title}</h2>`;
    const testimonialsContainer = document.createElement('div');

    testimonialsData.testimonials.forEach(testimonial => {
        const testimonialDiv = document.createElement('div');
        testimonialDiv.innerHTML = `
            <p>"${testimonial.quote}"</p>
            <p>- ${testimonial.author}</p>
        `;
        testimonialsContainer.appendChild(testimonialDiv);
    });
    section.appendChild(testimonialsContainer);
    return section;
}

function createFooter(footerData) {
    const footer = document.createElement('footer');
    footer.textContent = footerData.content;
    const socialDiv = document.createElement('div');
    footerData.socialLinks.forEach(link => {
        const a = document.createElement('a');
        a.href = link.url;
        a.textContent = link.icon; //  You might use icon libraries here (e.g., Font Awesome)
        socialDiv.appendChild(a)
    })
    footer.appendChild(socialDiv);
    return footer;
}

//  Function to render the entire page
function renderPage() {
    rootElement.innerHTML = ''; // Clear existing content

    const header = createHeader(jsonData.header);
    const banner = createBanner(jsonData.banner);

    rootElement.appendChild(header);
    rootElement.appendChild(banner);

    jsonData.sections.forEach(sectionData => {
        let section;
        if (sectionData.type === 'featured-parks') {
            section = createFeaturedParksSection(sectionData);
        } else if (sectionData.type === 'about-us') {
            section = createAboutUsSection(sectionData);
        } else if (sectionData.type === 'testimonials') {
            section = createTestimonialsSection(sectionData)
        }
        if (section) {
            rootElement.appendChild(section);
        }
    });

    const footer = createFooter(jsonData.footer);
    rootElement.appendChild(footer);
}

//  Call the renderPage function to display the content
renderPage();
