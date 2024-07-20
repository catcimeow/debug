document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('itemSearch');
    const searchBar = document.querySelector('.search-bar');
    let debounceTimer;

    searchInput.addEventListener('input', function () {
        const query = searchInput.value.trim();

        if (debounceTimer) {
            clearTimeout(debounceTimer);
        }

        debounceTimer = setTimeout(() => {
            if (query.length > 2) {
                fetch(`/search/bakedgoods?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        displaySuggestions(data.results, query);
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                searchBar.innerHTML = ''; // Clear suggestions if the query is too short
            }
        }, 300); // Adjust delay as needed
    });

    function displaySuggestions(items, query) {
        let suggestionsHTML = '';
        items.forEach(item => {
            suggestionsHTML += `
                <div class="suggestion" data-query="${query}" data-id="${item.id}">
                    ${item.name}
                </div>
            `;
        });
        searchBar.innerHTML = suggestionsHTML;

        const suggestions = document.querySelectorAll('.suggestion');
        suggestions.forEach(suggestion => {
            suggestion.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const query = this.getAttribute('data-query');
                window.location.href = `/baked_goods/search?q=${encodeURIComponent(query)}&id=${id}`;
            });
        });
    }
});
