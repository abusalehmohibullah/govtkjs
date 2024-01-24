<script setup>

import GeneralLayout from '@/Layouts/GeneralLayout.vue';
import { computed } from 'vue';


defineProps({
  teachers: Object,
});

const prependProtocol = (url) => {
  // Check if the URL is not null or undefined
  if (url) {
    // Prepend "https://" if the URL doesn't already contain a protocol
    return url.startsWith('http') ? url : `https://${url}`;
  }

  // Return an empty string or handle as appropriate for your case
  return '';
};

</script>

<template>
  <GeneralLayout>
    <div class="container p-5">
      <div class="font-bold text-3xl text-center">Our Teachers</div>
      <div v-if="teachers" v-for="(teachersInGroup, designation) in teachers" :key="designation"
        class="flex items-center justify-center flex-wrap">
        <div v-if="teachersInGroup" v-for="teacher in teachersInGroup" :key="teacher.id"
          class="w-1/2 md:w-1/3 lg:w-1/4 h-[400px] sm:h-[520px] md:h-[540px] lg:h-[500px] p-1">
          <div class="bg-white rounded-lg h-full flex flex-col justify-between">
            <div class="flex items-center justify-center pt-10 flex-col">
              <img :src="teacher.user.profile_photo_url" class="rounded-full w-24 h-24 sm:w-52 sm:h-52 object-cover">
              <div class="text-gray-800 font-semibold text-base sm:text-xl mt-5 text-center capitalize">{{ teacher.user.name }}</div>
              <div class="text-gray-500 text-sm sm:text-base font-semibold text-center">{{ teacher.designation }}</div>
              <div class="text-gray-500 text-xs sm:text-sm text-center">{{ teacher.qualification }}</div>
            </div>

            <!-- <div class="flex items-center justify-center pt-2 flex-col">
            <div class="text-base">{{ teacher.mobile_no }}</div>
          </div> -->
            <div>
              <div class="flex items-center justify-end pt-2 flex-col">
                <div class="text-center text-[10px]" v-if="teacher.user">Write at</div>
                <div class="text-[10px] sm:text-sm md:text-xs xl:text-base">{{ teacher.user.email }}</div>
              </div>
              <div class="flex items-center justify-end mt-3 mb-3 flex-col">
                <h1 class="text-xs text-gray-500">Follow On</h1>
                <div class="flex mt-2">
                  <a class="sm:btn p-1" :href="prependProtocol(teacher.facebook)" target="_blank">
                    <i class="text-sm sm:text-xl fa-brands fa-facebook-f"></i>
                  </a>
                  <a class="sm:btn p-1" :href="prependProtocol(teacher.instagram)" target="_blank">
                    <i class="text-sm sm:text-xl fa-brands fa-instagram"></i>
                  </a>
                  <a class="sm:btn p-1" :href="prependProtocol(teacher.twitter)" target="_blank">
                    <i class="text-sm sm:text-xl fa-brands fa-x-twitter"></i>
                  </a>
                  <a class="sm:btn p-1" :href="prependProtocol(teacher.linkedin)" target="_blank">
                    <i class="text-sm sm:text-xl fa-brands fa-linkedin-in"></i>
                  </a>
                  <a class="sm:btn p-1" :href="prependProtocol(teacher.youtube)" target="_blank">
                    <i class="text-sm sm:text-xl fa-brands fa-youtube"></i>
                  </a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </GeneralLayout>
</template>

