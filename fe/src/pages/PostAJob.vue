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
              <h1 class="text-4xl font-extrabold font-inter mb-2">Post a job on JobBoard</h1>
            </div>

            <!-- Form -->
            <form @submit.prevent="handleJobSubmission" class="mb-12">
              <div class="divide-y divide-gray-200 -my-6">
                <div class="py-6">
                  <div class="space-y-4">
                    <!-- Job Board -->
                    <div>
                      <label class="block text-sm text-gray-800 font-medium mb-1" for="job_board">Job Board <span class="text-rose-500">*</span></label>
                      <select v-model="formData.job_board_id" id="job_board" class="form-select text-sm py-2 w-full" required>
                        <option v-for="value in jobBoards" :key="value.id" :value="value.id">
                          {{ value.title }}
                        </option>
                      </select>
                    </div>
                    <!-- Position -->
                    <div>
                      <label class="block text-sm font-medium mb-1" for="position">Position Name <span class="text-red-500">*</span></label>
                      <input v-model="formData.name" id="position" class="form-input w-full" type="text" required placeholder="E.g., Secretary" />
                    </div>
                    <!-- Employment Type -->
                    <div>
                      <label class="block text-sm text-gray-800 font-medium mb-1" for="employment_type">Employment Type <span class="text-rose-500">*</span></label>
                      <select v-model="formData.employment_type" id="employment_type" class="form-select text-sm py-2 w-full" required>
                        <option v-for="value in EmploymentType.toArray()" :key="value" :value="value">
                          {{ EmploymentType.getLabel(value) }}
                        </option>
                      </select>
                    </div>
                    <!-- Seniority -->
                    <div>
                      <label class="block text-sm text-gray-800 font-medium mb-1" for="seniority">Seniority <span class="text-rose-500">*</span></label>
                      <select v-model="formData.seniority" id="seniority" class="form-select text-sm py-2 w-full" required>
                        <option v-for="value in Seniority.toArray()" :key="value" :value="value">
                          {{ Seniority.getLabel(value) }}
                        </option>
                      </select>
                    </div>
                    <!-- Schedule -->
                    <div>
                      <label class="block text-sm text-gray-800 font-medium mb-1" for="schedule">Schedule <span class="text-rose-500">*</span></label>
                      <select v-model="formData.schedule" id="schedule" class="form-select text-sm py-2 w-full" required>
                        <option v-for="value in Schedule.toArray()" :key="value" :value="value">
                          {{ Schedule.getLabel(value) }}
                        </option>
                      </select>
                    </div>
                    <!-- Job Description -->
                    <div>
                      <label class="block text-sm text-gray-800 font-medium mb-1" for="description">Job Description <span class="text-rose-500">*</span></label>
                      <textarea v-model="formData.description" id="description" class="form-textarea text-sm py-2 w-full" rows="4" required></textarea>
                    </div>
                    <!-- Office -->
                    <div>
                      <label class="block text-sm font-medium mb-1" for="office">Office <span class="text-rose-500">*</span></label>
                      <input v-model="formData.office" id="office" class="form-input w-full" type="text" required/>
                    </div>
                    <!-- Department -->
                    <div>
                      <label class="block text-sm font-medium mb-1" for="department">Department <span class="text-rose-500">*</span></label>
                      <input v-model="formData.department" id="department" class="form-input w-full" type="text" required/>
                    </div>
                    <!-- Experience -->
                    <div>
                      <label class="block text-sm font-medium mb-1" for="experience">Experience <span class="text-rose-500">*</span></label>
                      <input v-model="formData.experience" id="experience" class="form-input w-full" type="text" required/>
                    </div>
                    <!-- Creator Email -->
                    <div>
                      <label class="block text-sm font-medium mb-1" for="creator_email">Job Poster Email <span class="text-rose-500">*</span></label>
                      <input v-model="formData.creator_email" id="creator_email" class="form-input w-full" type="text" required/>
                    </div>
                  </div>
                </div>
                <div class="py-6">
                  <button type="submit" class="btn w-full text-white bg-indigo-500 hover:bg-indigo-600 shadow-xs">Post Job</button>
                </div>
              </div>
            </form>

          </div>

        </div>

      </div>

    </div>

  </main>
</template>

<script>
import {onMounted, ref} from 'vue'
import Seniority from '../lib/seniority';
import EmploymentType from '../lib/employment-type';
import Schedule from '../lib/schedule';
import { useJobBoards} from "../services/useJobBoards.js";
import { useSubmitJobPost } from "../services/useSubmitJobPost.js";

export default {
  name: 'PostAJob',
  setup() {
    const formData = ref({
      job_board_id: '',
      name: '',
      employment_type: '',
      seniority: '',
      schedule: '',
      description: '',
      office: '',
      department: '',
      experience: '',
      creator_email: '',
    });

    const stick = ref(false)
    const highlight = ref(true)
    const { jobBoards, fetchJobBoards } = useJobBoards();

    const handleJobSubmission = async () => {
      const result = await useSubmitJobPost(formData.value);
      alert(result.message);
    };

    onMounted(fetchJobBoards);
    return {
      formData,
      stick,
      highlight,
      Seniority,
      EmploymentType,
      Schedule,
      jobBoards,
      handleJobSubmission
    }
  },
}
</script>