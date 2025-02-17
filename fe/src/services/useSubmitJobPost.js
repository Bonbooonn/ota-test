export async function useSubmitJobPost(formData) {
    try {
        const response = await fetch('http://api.ota-test.local/api/v1/job-post/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData),
        });

        if (response.ok) {
            return { success: true, message: 'Job posted successfully!' };
        } else {
            const errorData = await response.json();
            return { success: false, message: errorData.message || 'Failed to post the job.' };
        }
    } catch (error) {
        console.error('Error submitting job post:', error);
        return { success: false, message: 'An error occurred while posting the job.' };
    }
}