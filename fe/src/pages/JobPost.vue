<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">

    <!-- Site header -->
    <Header />

    <!-- Page content -->
    <main class="grow">

      <!-- Page content -->
      <section>
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
          <div class="pt-28 pb-8 md:pt-36 md:pb-16">

            <div class="md:flex md:justify-between">

              <!-- Sidebar -->
              <aside class="mb-8 md:mb-0 md:w-64 lg:w-72 md:ml-12 lg:ml-20 md:shrink-0 md:order-1">
                <div class="sticky top-8">

                  <div class="relative bg-gray-50 rounded-xl border border-gray-200 p-5">

                    <div class="flex justify-center md:justify-start mb-5">
                      <ul class="inline-flex flex-col space-y-2">
                        <li class="flex items-center">
                          <svg class="shrink-0 fill-gray-400 mr-3" width="14" height="14" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.707 4.293a1 1 0 0 0-1.414 1.414L10.586 8H2V2h3a1 1 0 1 0 0-2H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h8.586l-2.293 2.293a1 1 0 1 0 1.414 1.414l4-4a1 1 0 0 0 0-1.414l-4-4Z" />
                          </svg>
                          <span class="text-sm text-gray-600">{{ item.created_at }}</span>
                        </li>
                        <li class="flex items-center">
                          <svg class="shrink-0 fill-gray-400 mr-3" width="14" height="16" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7" cy="7" r="2" />
                            <path d="M6.3 15.7c-.1-.1-4.2-3.7-4.2-3.8C.7 10.7 0 8.9 0 7c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.7 3.7-2.1 5-.1.1-4.1 3.7-4.2 3.8-.4.3-1 .3-1.4-.1Zm-2.7-5 3.4 3 3.4-3c1-1 1.6-2.2 1.6-3.6 0-2.8-2.2-5-5-5S2 4.2 2 7c0 1.4.6 2.7 1.6 3.7 0-.1 0-.1 0 0Z" />
                          </svg>
                          <span class="text-sm text-gray-600">{{ item.office }}</span>
                        </li>
                        <li class="flex items-center">
                          <svg class="shrink-0 fill-gray-400 mr-3" width="14" height="16" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7" cy="7" r="2" />
                            <path d="M6.3 15.7c-.1-.1-4.2-3.7-4.2-3.8C.7 10.7 0 8.9 0 7c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.7 3.7-2.1 5-.1.1-4.1 3.7-4.2 3.8-.4.3-1 .3-1.4-.1Zm-2.7-5 3.4 3 3.4-3c1-1 1.6-2.2 1.6-3.6 0-2.8-2.2-5-5-5S2 4.2 2 7c0 1.4.6 2.7 1.6 3.7 0-.1 0-.1 0 0Z" />
                          </svg>
                          <span class="text-sm text-gray-600">{{ Schedule.getLabel(item.schedule) }}</span>
                        </li>
                        <li class="flex items-center">
                          <svg class="shrink-0 fill-gray-400 mr-3" width="14" height="16" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7" cy="7" r="2" />
                            <path d="M6.3 15.7c-.1-.1-4.2-3.7-4.2-3.8C.7 10.7 0 8.9 0 7c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.7 3.7-2.1 5-.1.1-4.1 3.7-4.2 3.8-.4.3-1 .3-1.4-.1Zm-2.7-5 3.4 3 3.4-3c1-1 1.6-2.2 1.6-3.6 0-2.8-2.2-5-5-5S2 4.2 2 7c0 1.4.6 2.7 1.6 3.7 0-.1 0-.1 0 0Z" />
                          </svg>
                          <span class="text-sm text-gray-600">{{ Seniority.getLabel(item.seniority) }}</span>
                        </li>
                        <li class="flex items-center">
                          <svg class="shrink-0 fill-gray-400 mr-3" width="14" height="16" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7" cy="7" r="2" />
                            <path d="M6.3 15.7c-.1-.1-4.2-3.7-4.2-3.8C.7 10.7 0 8.9 0 7c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.7 3.7-2.1 5-.1.1-4.1 3.7-4.2 3.8-.4.3-1 .3-1.4-.1Zm-2.7-5 3.4 3 3.4-3c1-1 1.6-2.2 1.6-3.6 0-2.8-2.2-5-5-5S2 4.2 2 7c0 1.4.6 2.7 1.6 3.7 0-.1 0-.1 0 0Z" />
                          </svg>
                          <span class="text-sm text-gray-600">{{ EmploymentType.getLabel(item.employment_type) }}</span>
                        </li>
                        <li class="flex items-center">
                          <svg class="shrink-0 fill-gray-400 mr-3" width="14" height="16" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7" cy="7" r="2" />
                            <path d="M6.3 15.7c-.1-.1-4.2-3.7-4.2-3.8C.7 10.7 0 8.9 0 7c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.7 3.7-2.1 5-.1.1-4.1 3.7-4.2 3.8-.4.3-1 .3-1.4-.1Zm-2.7-5 3.4 3 3.4-3c1-1 1.6-2.2 1.6-3.6 0-2.8-2.2-5-5-5S2 4.2 2 7c0 1.4.6 2.7 1.6 3.7 0-.1 0-.1 0 0Z" />
                          </svg>
                          <span class="text-sm text-gray-600">{{ formatExperience(item.experience) }}</span>
                        </li>
                      </ul>
                    </div>
                  </div>

                </div>
              </aside>

              <!-- Main content -->
              <div class="md:grow">

                <!-- Job description -->
                <div class="pb-8">
                  <div class="mb-4">
                    <router-link class="text-indigo-500 font-medium" to="/"><span class="tracking-normal">&lt;-</span> All Jobs</router-link>
                  </div>
                  <h1 class="text-4xl font-extrabold font-inter mb-10">{{ item.name }}</h1>
                  <!-- Job description -->
                  <div class="space-y-8 mb-8">
                    <div v-if="item.description && typeof item.description === 'object'">
                      <div v-for="(description, index) in item.description" :key="index">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ index }}</h3>
                        <div class="text-gray-500 space-y-3" v-html="transformDescription(description)"></div>
                      </div>
                    </div>
                    <div v-else>
                      <div class="text-gray-500 space-y-3">{{ item.description }}</div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </section>

    </main>

  </div>
</template>

<script>
import {onMounted, ref} from 'vue'
import { useRoute } from 'vue-router'
import Seniority from '../lib/seniority';
import EmploymentType from '../lib/employment-type';
import Schedule from '../lib/schedule';
import {transformDescription} from "../lib/transformDescription.js";
import { useJobPost} from "../services/useJobPost.js";

import Header from '../partials/Header.vue'

export default {
  name: 'JobPost',
  components: {
    Header,
  },
  setup() {
    const route = useRoute()
    const jobId = ref(route.params.id)
    const isInternal = ref(Number(route.params.isInternal))
    const { item, fetchJobPost } = useJobPost(jobId, isInternal)

    onMounted(fetchJobPost);

    return {
      item,
      jobId,
      isInternal,
      Seniority,
      EmploymentType,
      Schedule,
      transformDescription,
    }
  },
  methods: {
    formatExperience(experience) {
      if (!experience) return '';
      return experience.includes('years') ? experience : `${experience} years`;
    },
  }
}
</script>