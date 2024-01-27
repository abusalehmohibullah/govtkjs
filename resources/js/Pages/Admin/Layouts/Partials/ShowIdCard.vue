  
<script setup>

import { ref, reactive, computed, watch, onMounted } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationMark.vue';
import QrcodeVue from 'qrcode.vue';

import Table from '@/Components/Table.vue';

const { student, classroom } = defineProps(['student', 'classroom']);

// Define a reactive variable for QR code data
const qrCodeData = ref(student.student_id); // Replace with your actual data

// Define options for the QR code (customize as needed)
const qrCodeOptions = ref({
    size: 500,
    color: '#000000',
});


const isLongName = computed(() => student.student_name_en.length > 23);

const computedClasses = computed(() => ({
    uppercase: true,
    'text-center': true,
    'font-semibold': true,
    'mt-[2px]': true,
    'tracking-tight': true,
    'text-xs': isLongName.value,
}));

</script>
<style>
.qrcode {
    height: 70px !important;
    width: 70px !important;
}
</style>

<template>
    <div>

        <div class="flex justify-center items-center">
            <!-- container  -->
            <div class="w-[324px] h-[204px] flex flex-row relative bg-white">
                <!-- left stripe  -->
                <div class="w-[22px] h-full bg-blue-950 flex items-center justify-center text-white">
                    <div class="transform -rotate-90 whitespace-nowrap tracking-widest">IDENTITY CARD</div>
                </div>

                <div class="w-full">
                    <!-- top bar  -->
                    <div class="w-full h-[50px] bg-[#BDD8EE]">
                    </div>
                    <div class="flex h-[154px]">
                        <div class="absolute bottom-0 left-20">
                            <img :src="'/assets/images/hm-sign.png'" class="d-block w-16 m-[2px]" alt="...">
                        </div>
                        <div class="w-[103px] m-[2px] flex items-center" v-if="student.photo != ''"><img
                                :src="'/storage/' + student.photo" class="d-block w-[103px] m-[2px]" alt="...">
                        </div>
                        <div v-else class="h-full w-[103px] flex justify-center items-center flex-col">
                            <div>No</div>
                            <div>Photo</div>
                            <div>Found</div>
                        </div>

                        <div class="w-[193px] text-black">
                            <div class="flex justify-center items-center mt-1">
                                <qrcode-vue :value="qrCodeData" :options="qrCodeOptions" class="qrcode" />
                            </div>
                            <div>
                                <div :class="computedClasses">{{ student.student_name_en }}</div>
                                <div class="text-center -mt-1" v-if="student.roll_no">Roll No: {{ student.roll_no }}</div>
                                <div class="Capitalize text-center -mt-1">Class: {{ classroom.grade.name }}<span
                                        class="capitalize" v-if="classroom.section">({{ classroom.section.name
                                        }})</span><span class="capitalize" v-if="classroom.group">-{{ classroom.group.name
}}</span>
                                </div>
                                <div class="font-bold text-center -mt-1">ID No: {{ student.student_id }}</div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="absolute w-full">
                    <div class="flex justify-between pl-0 pr-[7px] pt-[1px]">
                        <div class="w-12 h-12">
                            <ApplicationLogo class="block" />
                        </div>
                        <div class="text-end text-semi-bold font-[oswald] text-[17px] text-black">
                            <div class="text-end">Government Rajoir Gopalgonj Kapali Jubak </div>
                            <div class="text-end -mt-[5px]">Sanghya Pilot Model Institution and College</div>
                        </div>
                    </div>
                    <!-- <div class="text-center text-sm font-[oswald] -mt-1">Rajoir, Madaripur</div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.font-bengali {
    font-family: 'Noto Serif Bengali', serif;
}
</style>

