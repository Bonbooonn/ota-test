const EmploymentType = Object.freeze({
    Permanent: 'permanent',
    Contractual: 'contractual',
    Internship: 'internship',

    toArray() {
        return Object.values(EmploymentType).filter(value => typeof value === 'string');
    },

    labels: {
        permanent: 'Permanent',
        contractual: 'Contractual',
        internship: 'Internship'
    },

    getLabel(key) {
        return this.labels[key];
    }
});

export default EmploymentType;