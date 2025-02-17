import { ref } from 'vue';

export function usePublishJobPost() {
    const loading = ref(false);
    const error = ref(null);

    const publishJobPost = async (isPublished, id, API_URL, authToken) => {
        loading.value = true;
        error.value = null;

        try {
            let url = `${API_URL}/job-post/${id}/approve`;
            if (!Number(isPublished)) {
                url = `${API_URL}/job-post/${id}/reject`;
            }

            const response = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${authToken}`,
                },
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Failed to publish the job post.');
            }

            return data.message || 'Job post published successfully!';
        } catch (err) {
            console.error('Failed to publish job post:', err);
            error.value = err.message || 'An unexpected error occurred.';
        } finally {
            loading.value = false;
        }
    };

    return {
        loading,
        error,
        publishJobPost,
    };
}