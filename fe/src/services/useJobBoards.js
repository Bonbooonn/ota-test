import { ref } from 'vue';

export function useJobBoards() {
    const jobBoards = ref([]);

    const fetchJobBoards = async () => {
        try {
            const response = await fetch('http://api.ota-test.local/api/v1/job-board/get-all', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            });
            if (response.ok) {
                const data = await response.json();
                jobBoards.value = data.data;
            }
        } catch (error) {
            console.error('Failed to fetch job boards:', error);
        }
    };

    return { jobBoards, fetchJobBoards };
}