const API_URL = "http://api.ota-test.local/api/v1";

export async function useLogin(formData) {
    try {
        const response = await fetch(`${API_URL}/user/authenticate`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData),
        });
        const data = await response.json();
        if (response.ok) {
            const token = data.data.token;
            if (token) {
                localStorage.setItem('authToken', token);
            }

            return { success: true, message: 'Logged in successfully!' };
        } else {
            return { success: false, message: data.message || 'Failed to log in.' };
        }
    } catch (error) {
        console.error('Failed to fetch job boards:', error);
        return { success: false, message: 'An error occurred while logging in.' };
    }
}