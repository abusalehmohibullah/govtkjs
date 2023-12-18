<script setup>

import GeneralLayout from '@/Layouts/GeneralLayout.vue';
import { computed } from 'vue';

// // Define a list of color names
// const colorNames = ['red', 'pink', 'violet', 'blue', 'green', 'yellow', 'orange', 'paste'];

// // Create a computed property to generate a random color name
// const randomColorName = computed(() => {
//     const randomIndex = Math.floor(Math.random() * colorNames.length);
//     return colorNames[randomIndex];
// });

// defineProps({
//     notice: Object,
// });

</script>

<template>
    <GeneralLayout>
        <div class="container p-5">
            <div class="font-bold text-3xl text-center">Our Teachers</div>
            <div class="flex items-center justify-center gap-2">
                <div class="bg-white w-1/4 mt-5 rounded-lg">
                    <div class="flex items-center justify-center pt-10 flex-col">
                        <img src="https://i.pinimg.com/originals/a8/bc/90/a8bc90ea196737604770aaf9c2d56a51.jpg"
                            class="rounded-full w-52">
                        <div class="text-gray-800 font-semibold text-xl mt-5">Bae Suzy</div>
                        <div class="text-gray-500 text-base font-semibold">Assistant Teacher</div>
                        <div class="text-gray-500 text-sm">B.SC (Hon's) (Physics), B.Ed</div>
                    </div>

                    <!-- <div class="flex items-center justify-center pt-2 flex-col">
                        <div class="text-base">0191254349</div>
                        <div class="text-base">abcxyz@gmail.com</div>
                    </div> -->

                    <div class="flex items-center justify-center mt-3 mb-6 flex-col">
                        <h1 class="text-xs text-gray-500">Follow On</h1>
                        <div class="flex mt-2">
                            <a class="btn p-1" href="https://www.facebook.com/"><i
                                    class="text-xl fa-brands fa-facebook-f"></i></a>
                            <a class="btn p-1" href="https://www.linkedin.com/"><i
                                    class="text-xl fa-brands fa-instagram"></i></a>
                            <a class="btn p-1" href="https://www.linkedin.com/"><i
                                    class="text-xl fa-brands fa-x-twitter"></i></a>
                            <a class="btn p-1" href="https://www.linkedin.com/"><i
                                    class="text-xl fa-brands fa-linkedin-in"></i></a>
                            <a class="btn p-1" href="https://www.youtube.com/"><i
                                    class="text-xl fa-brands fa-youtube"></i></a>
                        </div>

                        <!-- <div class="flex items-center justify-center pt-2 flex-col">
                            <div class="text-center text-[10px]">Write at</div>
                            <div class="text-base">abcxyz@gmail.com</div>
                        </div> -->

                    </div>
                </div>

            </div>
        </div>
    </GeneralLayout>
</template>

