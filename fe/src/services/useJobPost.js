import { ref } from 'vue';

const API_URL = "http://api.ota-test.local/api/v1";

export function useJobPost(jobId, isInternal) {
    const item = ref([]);

    const fetchJobPost = async () => {
        try {
            let url = `${API_URL}/job-post/${jobId.value}/get/`;
            if (!isInternal.value) {
                url = `${API_URL}/job-post/${jobId.value}/get-external/`;
            }

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            });

            if (response.ok) {
                const data = await response.json();
                item.value = data.data;
            }
        } catch (error) {
            console.error('Failed to fetch job post:', error);
        }
    };

    return { item, fetchJobPost };
}