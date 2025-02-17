export function transformDescription(description) {
    if (typeof description === 'string') {
        return `<p>${description}</p>`;
    } else if (typeof description === 'object' && description !== null) {
        let listItems = Object.entries(description).map(
            ([key, value]) => `<li><strong>${key}</strong> ${value}</li>`
        ).join('\n');

        return `<ul>${listItems}</ul>`;
    }
}