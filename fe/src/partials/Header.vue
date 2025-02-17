<template>
  <header class="absolute w-full z-30">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="flex items-center justify-between h-16 md:h-20">

        <!-- Site branding -->
        <div class="shrink-0 mr-4">
          <!-- Logo -->
          <router-link class="block group" to="/" aria-label="Cruip">
            <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg">
              <path class="fill-indigo-500" d="M13.853 18.14 1 10.643 31 1l-.019.058z" />
              <path class="fill-indigo-300" d="M13.853 18.14 30.981 1.058 21.357 31l-7.5-12.857z" />
            </svg>
          </router-link>
        </div>

        <!-- Desktop navigation -->
        <nav class="flex grow">

          <!-- Desktop sign in links -->
          <ul class="flex grow justify-end flex-wrap items-center">
            <li>
              <router-link class="text-sm font-medium text-indigo-500 hover:underline px-3 lg:px-5 py-2 flex items-center" to="/signin">Sign in</router-link>
            </li>
            <li class="ml-3">
              <router-link class="btn-sm text-white bg-indigo-500 hover:bg-indigo-600 w-full shadow-xs" to="/post-a-job">Post a job</router-link>
            </li>
          </ul>

        </nav>

      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: 'Header',
}
</script>