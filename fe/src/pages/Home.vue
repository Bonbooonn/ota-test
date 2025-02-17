<template>
  <div className="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">

    <!-- Site header -->
    <Header />

    <!-- Page content -->
    <main class="grow">
      <!-- Page content -->
      <section>
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
          <div class="py-8 md:py-16">
            <div class="md:flex md:justify-between">

              <!-- Main content -->
              <div class="md:grow">

                <JobList />

              </div>

            </div>
          </div>
        </div>
      </section>

    </main>
  </div>
</template>

<script>
import Header from '../partials/Header.vue'
import JobList from '../partials/JobList.vue'

export default {
  name: 'Home',
  components: {
    Header,
    JobList,
},
}
</script>