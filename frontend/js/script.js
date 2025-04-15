document.addEventListener('DOMContentLoaded', () => {
    loadFeaturedParks();
    updateCurrentYear();
});

// --- Utility Functions ---

function updateCurrentYear() {
    const currentYearSpan = document.getElementById('current-year');
    if (currentYearSpan) {
        currentYearSpan.textContent = new Date().getFullYear();
    }
}

async function fetchData(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        console.error(`Error fetching data from ${url}:`, error);
        return null; // Or throw the error if you want the caller to handle it
    }
}

function createParkCard(park) {
    const parkCard = document.createElement('div');
    parkCard.className = 'park-card';

    const parkImage = document.createElement('div');
    parkImage.className = 'park-image';
    parkImage.textContent = `${park.name} Image`;
    if (park.images && park.images.length > 0) {
        parkImage.style.backgroundImage = `url('${park.images[0]}')`;
        parkImage.style.backgroundSize = 'cover';
        parkImage.textContent = '';
    }

    const parkInfo = document.createElement('div');
    parkInfo.className = 'park-info';

    const title = document.createElement('h3');
    title.textContent = park.name;

    const description = document.createElement('p');
    description.textContent = park.description;

    const features = document.createElement('div');
    features.className = 'park-features';
    park.features.slice(0, 3).forEach(feature => {
        const featureTag = document.createElement('span');
        featureTag.className = 'feature-tag';
        featureTag.textContent = feature;
        features.appendChild(featureTag);
    });

    const link = document.createElement('a');
    link.href = `park-detail.html?id=${park.id}`;
    link.className = 'btn';
    link.textContent = 'Explore';

    parkInfo.appendChild(title);
    parkInfo.appendChild(description);
    parkInfo.appendChild(features);
    parkInfo.appendChild(link);

    parkCard.appendChild(parkImage);
    parkCard.appendChild(parkInfo);

    return parkCard;
}

// --- Specific Data Loading Functions ---

async function loadFeaturedParks() {
    const container = document.getElementById('featured-parks-container');
    if (!container) return;

    const parksData = await fetchData('/data/parks.json');
    if (parksData) {
        container.innerHTML = '';
        const featuredParks = parksData.filter(park => park.featured);
        featuredParks.slice(0, 2).forEach(park => {
            const parkCard = createParkCard(park);
            container.appendChild(parkCard);
        });
    } else {
        container.innerHTML = '<p class="error-message">Failed to load featured parks.</p>';
    }
}