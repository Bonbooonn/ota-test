const Seniority = Object.freeze({
    Entry: 'entry',
    Junior: 'junior',
    Mid: 'mid',
    Senior: 'senior',
    Experienced: 'experienced',

    toArray() {
        return Object.values(Seniority).filter(value => typeof value === 'string');
    },

    labels: {
        entry: 'Entry Level',
        junior: 'Junior',
        mid: 'Mid Level',
        senior: 'Senior',
        experienced: 'Experienced'
    },

    getLabel(key) {
        return this.labels[key];
    }
});

export default Seniority;