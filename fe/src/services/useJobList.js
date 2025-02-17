import { ref } from 'vue';

export function useJobList() {
    const jobList = ref([]);

    const fetchJobList = async () => {
        try {
            const response = await fetch('http://api.ota-test.local/api/v1/job-post/get-combined', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            });
            if (response.ok) {
                const data = await response.json();
                jobList.value = data.data;
            }
        } catch (error) {
            console.error('Failed to fetch job list:', error);
        }
    };

    return { jobList, fetchJobList };
}