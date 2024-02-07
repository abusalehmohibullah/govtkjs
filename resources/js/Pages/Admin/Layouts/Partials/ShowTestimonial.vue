  
<script setup>

import { ref, reactive, computed, watch, onMounted } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationLogoBn from '@/Components/ApplicationLogoBn.vue';
import QrcodeVue from 'qrcode.vue';

const { student, classroom } = defineProps(['student', 'classroom']);

// Define a reactive variable for QR code data
const qrCodeData = ref(student.student_id); // Replace with your actual data

// Define options for the QR code (customize as needed)
const qrCodeOptions = ref({
    size: 100,
    color: '#000000',
});


</script>
<style>
.qrcode {
    height: 300px !important;
    width: 300px !important;
}

.page {
    background-image: url(/assets/images/border-golden.png);
    width: 3507px;
    height: 2481px;
    padding: 120px 200px;
}

.qrcode-container {
    width: 400px;
    height: 400px;
}

.school-name {
    font-size: 130px;
    font-weight: bolder;
    letter-spacing: -4px;
}

.school-name>div {
    margin-bottom: -20px;
}

.school-address {
    margin-top: -40px;
    font-size: 80px;
}

.title>div{
    font-size: 100px;
    font-weight: bolder;
    margin-top: 50px;
    color: white;
    background-color: black;
    border: solid 1px black;
    border-radius: 50px;
    padding: 0 50px;
    margin-bottom: 50px;
}

.main-content {
    font-size: 60px;
}

.main-content>div {
    margin-bottom: 40px;
}

.font-bengali {
    font-family: 'Noto Serif Bengali', serif;
}

.slot {
    width: 100%;
    text-align: center;
    /* border-bottom: dotted black 10px; */
    font-weight: bold;
    color: black;
    position: relative;
}

.slot::after {
    content: '';
    background-color: black;
    height: 3px;
    width: 100%;
    position: absolute;
    left: 0;
    bottom: 20px;
}

.indent {
    text-indent: 200px;
}

.ending {
    margin-top: 100px;
}
</style>

<template>
    <div>

        <!-- container  -->
        <div class="relative page bg-cover bg-center border font-bengali text-black">
            <div class="w-full">
                <div class="flex justify-between pl-0 pr-[7px] pt-[1px]">
                    <div class="w-[400px] h-[400px]">
                        <ApplicationLogoBn class="block w-[400px] h-[400px]" />
                    </div>
                    <div class="text-center school-name">
                        <div>সরকারি রাজৈর গোপালগঞ্জ কপালী যুবক সংঘ</div>
                        <div>পাইলট মডেল ইনস্টিটিউশন ও কলেজ</div>
                    </div>
                    <div class="qrcode-container flex justify-center items-center mt-1">
                        <qrcode-vue :value="qrCodeData" :options="qrCodeOptions" class="qrcode" />
                    </div>
                </div>
                <div class="text-center school-address">রাজৈর, মাদারীপুর।</div>
            </div>

            <div class="text-center title flex items-center justify-center z-50"><div class="z-50">প্রশংসা পত্র</div></div>
            <div class="main-content">
                <div class="flex whitespace-nowrap indent">এই মর্মে প্রত্যয়ন করা যাচ্ছে যে, <span class="slot">{{
                    student.student_name_bn }}</span></div>
                <div class="flex whitespace-nowrap">পিতা: <span class="slot">{{ student.father_name_bn }}</span>, মাতা:
                    <span class="slot">{{ student.mother_name_bn }}</span>
                </div>
                <div class="flex whitespace-nowrap">অত্র বিদ্যালয় হতে মাধ্যমিক ও উচ্চমাধ্যমিক শিক্ষা বোর্ড, ঢাকার অধীনে
                    <span class="slot"></span> সনে অনুষ্ঠিত মাধ্যমিক স্কুল সার্টফিকেট পরীক্ষায় অংশগ্রহণ করে
                </div>
                <div class="flex whitespace-nowrap"><span class="slot"></span> শাখায় জিপিএ <span class="slot"></span>
                    পয়েন্ট অর্জন করেছে। ভর্তি বহি অনুযায়ী তার জন্ম তারিখ ইং <span class="slot">{{ date_of_birth }}</span>।
                </div>
                <div class="indent ending">তার নৈতিক চরিত্র প্রসংশনীয়। অত্র বিদ্যালয়ে অধ্যয়ণকালে সে বিদ্যালয়ে নিয়ম শৃংখলা
                    বিরোধী কোন কার্যে অংশগ্রহণ করে নি। </div>
                    <div class="font-semibold">আমি তার জীবনের সর্বাঙ্গীন উন্নতি কামনা করি।</div>

            </div>
            <!-- watermark -->
            <div class="w-full h-full absolute top-0 left-0 flex justify-center items-center">
                <ApplicationLogoBn class="block w-[2000px] h-[2000px] opacity-10" />
            </div>
        </div>

    </div>
</template>

<style>
.font-bengali {
    font-family: 'Noto Serif Bengali', serif;
}
</style>

