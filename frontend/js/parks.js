document.addEventListener('DOMContentLoaded', () => {
    loadAllParks();
    updateCurrentYear(); // Assuming you want the footer year here too
});

async function loadAllParks() {
    const container = document.getElementById('all-parks-container');
    if (!container) return;

    try {
        const response = await fetch('/data/parks.json');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const parksData = await response.json();

        container.innerHTML = ''; // Clear "Loading parks..."

        parksData.forEach(park => {
            const parkCard = createParkCard(park); // Reusing the function from script.js
            container.appendChild(parkCard);
        });

    } catch (error) {
        console.error('Error loading all parks:', error);
        container.innerHTML = '<p class="error-message">Failed to load park data.</p>';
    }
}

// Assuming createParkCard function is either in script.js or defined here
// If it's only used on the parks page, you can define it here:
function createParkCard(park) {
    const parkCard = document.createElement('div');
    parkCard.className = 'park-card';

    const parkImage = document.createElement('div');
    parkImage.className = 'park-image';
    parkImage.textContent = park.name + ' Image';
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

function updateCurrentYear() {
    const currentYearSpan = document.getElementById('current-year');
    if (currentYearSpan) {
        currentYearSpan.textContent = new Date().getFullYear();
    }
}