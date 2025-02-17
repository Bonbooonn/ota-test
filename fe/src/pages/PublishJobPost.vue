<template>
  <div>
    <p v-if="loading">Processing your request...</p>
    <p v-if="error">{{ error }}</p>
  </div>
</template>

<script>
import { onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { usePublishJobPost } from "../services/usePublishJobPost.js";

export default {
  setup() {
    const router = useRouter();
    const route = useRoute();
    const { loading, error, publishJobPost } = usePublishJobPost();

    onMounted(async () => {
      const { isPublished, id } = route.params;
      const API_URL = 'http://api.ota-test.local/api/v1';
      const authToken = localStorage.getItem('authToken');

      const message = await publishJobPost(isPublished, id, API_URL, authToken);

      if (!error.value) {
        alert(message);
        router.push('/');
      } else {
        setTimeout(() => router.push('SignIn'), 3000);
      }
    });

    return {
      loading,
      error,
    };
  },
};
</script>