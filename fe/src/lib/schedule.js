const Schedule = Object.freeze({
    FullTime: 'full_time',
    PartTime: 'part_time',

    toArray() {
        return Object.values(Schedule).filter(value => typeof value === 'string');
    },

    labels: {
        'full-time': 'Full Time',
        'part-time': 'Part Time',
        'full_time': 'Full Time',
        'part_time': 'Part Time'
    },

    getLabel(key) {
        return this.labels[key];
    }
});

export default Schedule;