<template>
  <main class="flex">

    <!-- Content -->
    <div class="min-h-screen w-full lg:w-1/2">

      <div class="h-full">

        <div class="h-full w-full max-w-md px-6 mx-auto flex flex-col after:mt-auto after:flex-1">

          <!-- Site header -->
          <header class="flex-1 flex mb-auto">
            <div class="flex items-center justify-between h-16 md:h-20">
              <!-- Logo -->
              <router-link class="block group" to="/" aria-label="Cruip">
                <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                  <path class="fill-indigo-500" d="M13.853 18.14 1 10.643 31 1l-.019.058z" />
                  <path class="fill-indigo-300" d="M13.853 18.14 30.981 1.058 21.357 31l-7.5-12.857z" />
                </svg>
              </router-link>
            </div>
          </header>

          <div class="flex-1 py-8">

            <div class="mb-10">
              <h1 class="text-4xl font-extrabold font-inter mb-2">Sign in to JobBoard!</h1>
              <div class="text-gray-500">Enter your email and password</div>
            </div>

            <!-- Form -->
            <form @submit.prevent="handleLogin">
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium mb-1" for="email">Email</label>
                  <input v-model="formData.email" id="email" class="form-input w-full" type="email" required />
                </div>
                <div>
                  <label class="block text-sm font-medium mb-1" for="password">Password</label>
                  <input v-model="formData.password" id="password" class="form-input w-full" type="password" required />
                </div>
              </div>
              <div class="mt-6">
                <button class="btn w-full text-white bg-indigo-500 hover:bg-indigo-600 shadow-xs group">
                  Login <span class="tracking-normal text-indigo-200 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-1">-&gt;</span>
                </button>
              </div>
            </form>

          </div>

        </div>

      </div>

    </div>

    <!-- Right side -->
    <div class="fixed right-0 top-0 bottom-0 hidden lg:block lg:w-1/2 overflow-hidden" aria-hidden="true">

      <!-- Bg -->
      <div class="absolute inset-0 bg-linear-to-b from-indigo-100 to-white pointer-events-none -z-10" aria-hidden="true"></div>

      <!-- Illustration -->
      <div class="hidden md:block absolute right-0 pointer-events-none -z-10" aria-hidden="true">
        <img src="../images/auth-illustration.svg" class="max-w-none" width="1440" height="900" alt="Page Illustration" />
      </div>

    </div>

  </main>
</template>

<script>
import { useLogin } from "../services/useLogin.js";
import {ref} from "vue";
import { useRouter } from 'vue-router';

export default {
  name: 'SignIn',
  setup() {
    const formData = ref({
      email: '',
      password: '',
    });
    const router = useRouter();

    const handleLogin = async() => {
      const result = await useLogin(formData.value);
      alert(result.message);
      if (result.success) {
        router.push('/');
      }
    }

    return {
      formData,
      handleLogin,
    }
  },
}
</script>