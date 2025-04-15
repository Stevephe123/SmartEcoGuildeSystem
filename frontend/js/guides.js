document.addEventListener('DOMContentLoaded', () => {
    loadGuides();
    updateCurrentYear(); // Assuming you want the footer year here too
});

async function loadGuides() {
    const container = document.getElementById('guides-container');
    if (!container) return;

    try {
        const response = await fetch('/data/guides.json');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const guidesData = await response.json();

        container.innerHTML = ''; // Clear "Loading guides..."

        guidesData.forEach(guide => {
            const guideCard = createGuideCard(guide);
            container.appendChild(guideCard);
        });

    } catch (error) {
        console.error('Error loading guides:', error);
        container.innerHTML = '<p class="error-message">Failed to load guide data.</p>';
    }
}

function createGuideCard(guide) {
    const guideCard = document.createElement('div');
    guideCard.className = 'guide-card';

    const guideImage = document.createElement('div');
    guideImage.className = 'guide-image';
    const icon = document.createElement('i');
    icon.className = 'fas fa-user-circle fa-5x';
    guideImage.appendChild(icon);
    if (guide.image) {
        guideImage.style.backgroundImage = `url('${guide.image}')`;
        guideImage.style.backgroundSize = 'cover';
        guideImage.innerHTML = '';
    }

    const guideInfo = document.createElement('div');
    guideInfo.className = 'guide-info';

    const name = document.createElement('h3');
    name.textContent = guide.name;

    const expertise = document.createElement('p');
    expertise.className = 'expertise';
    expertise.textContent = `Expertise: ${guide.expertise.join(', ')}`;

    const parks = document.createElement('p');
    parks.className = 'parks';
    parks.textContent = `Parks: ${guide.licensedParks.join(', ')}`;

    const profileLink = document.createElement('a');
    profileLink.href = `guide-profile.html?id=${guide.id}`;
    profileLink.className = 'btn btn-outline';
    profileLink.textContent = 'View Profile';

    guideInfo.appendChild(name);
    guideInfo.appendChild(expertise);
    guideInfo.appendChild(parks);
    guideInfo.appendChild(profileLink);

    guideCard.appendChild(guideImage);
    guideCard.appendChild(guideInfo);

    return guideCard;
}

function updateCurrentYear() {
    const currentYearSpan = document.getElementById('current-year');
    if (currentYearSpan) {
        currentYearSpan.textContent = new Date().getFullYear();
    }
}