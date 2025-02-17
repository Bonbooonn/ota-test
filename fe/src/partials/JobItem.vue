<template>
  <div class="nth-[-n+12]:-order-1 group border-b border-gray-200">
    <div class="px-4 py-6">
      <div class="sm:flex items-center space-y-3 sm:space-y-0 sm:space-x-5">
        <div class="grow lg:flex items-center justify-between space-y-5 lg:space-x-2 lg:space-y-0">
          <div>
            <div class="flex items-start space-x-2">
              <div class="text-sm text-gray-800 font-semibold mb-1">{{item.name}}</div>
            </div>
            <div class="mb-2">
              <router-link
                  class="text-lg text-gray-800 font-bold"
                  :to="{ name: 'JobPost', params: { isInternal: item.is_internal ? 1 : 0, id: item.id } }"
              >
                <span v-html="transformDescription(item.description)"></span>
              </router-link>
            </div>
          </div>
          <div class="min-w-[120px] flex items-center lg:justify-end space-x-3 lg:space-x-0">
            <div class="lg:hidden lg:group-hover:block">
              <router-link
                  class="btn-sm py-1.5 px-3 text-white bg-indigo-500 hover:bg-indigo-600 group shadow-xs"
                  :to="{ name: 'JobPost', params: { isInternal: item.is_internal ? 1 : 0, id: item.id } }"
              >
                Apply Now <span class="tracking-normal text-indigo-200 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-1">-&gt;</span>
              </router-link>
            </div>
            <div class="lg:group-hover:hidden text-sm italic text-gray-500">{{item.created_at}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {transformDescription} from "../lib/transformDescription.js";

export default {
  name: 'JobItem',
  props: ['item'],
  setup() {
    return {
      transformDescription,
    }
  },
}
</script>