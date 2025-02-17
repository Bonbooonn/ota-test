<template>
  <div class="pb-8 md:pb-16">
    <h2 class="text-3xl font-bold font-inter mb-10">Latest jobs</h2>
    <!-- List container -->
    <div class="flex flex-col">

      <!-- Items -->
      <JobItem
        v-for="item in jobList"
        :key="item.id"
        :item="item"
      />

    </div>
  </div>
</template>

<script>
import {onMounted} from 'vue'

import JobItem from './JobItem.vue'
import { useJobList } from '../services/useJobList.js'

export default {
  name: 'JobList',
  components: {
    JobItem,
  },
  setup() {
    const { jobList, fetchJobList } = useJobList();

    onMounted(fetchJobList);
    return {
      jobList,
    }  
  },
}
</script>