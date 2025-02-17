export function transformDescription(description) {
    if (typeof description === 'string') {
        // If it's a string, just return it
        return `<p>${description}</p>`;
    } else if (typeof description === 'object' && description !== null) {
        // If it's an object, create a list from its key-value pairs
        let listItems = Object.entries(description).map(
            ([key, value]) => `<li><strong>${key}</strong> ${value}</li>`
        ).join('\n');

        return `<ul>${listItems}</ul>`;
    }
}