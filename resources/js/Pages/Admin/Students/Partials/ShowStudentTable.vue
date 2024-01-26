  
<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref, reactive, computed, watch, onMounted } from 'vue';

import Table from '@/Components/Table.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import FileInput from '@/Components/FileInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DateInput from '@/Components/DateInput.vue';
import SelectInput from '@/Components/SelectInput.vue';

const { student, classroom } = defineProps(['student', 'classroom']);


</script>

<template>
    <div>
        <div class="flex flex-col md:flex-row w-full gap-2 justify-end items-center">
            <div v-if="student.photo != ''"><img :src="'/storage/' + student.photo" class="d-block h-48 w-40 mt-5"
                    alt="...">
            </div>
            <div v-else class="h-48 w-40 flex justify-center items-center flex-col">
                <div>No</div>
                <div>Photo</div>
                <div>Found</div>
            </div>
            <div class="w-full">
                <Table class="md:text-base w-full" :class="mt - 0">
                    <template #tbody>
                        <tr v-if="classroom.grade" class="py-2 px-4 border-b">
                            <td class="border-r px-2 py-1 w-1/3 md:w-1/4">Class</td>
                            <td class="border-l px-2 py-1 w-2/3 md:w-3/4 font-semibold">{{ classroom.grade.name }}</td>
                        </tr>
                        <tr v-if="classroom.section" class="py-2 px-4 border-b">
                            <td class="border-r px-2 py-1 w-1/3 md:w-1/4">Section</td>
                            <td class="border-l px-2 py-1 w-2/3 md:w-3/4 font-semibold">{{ classroom.section.name }}</td>
                        </tr>
                        <tr v-if="classroom.group" class="py-2 px-4 border-b">
                            <td class="border-r px-2 py-1 w-1/3 md:w-1/4">Group</td>
                            <td class="border-l px-2 py-1 w-2/3 md:w-3/4 font-semibold">{{ classroom.group.name }}</td>
                        </tr>
                        <tr v-if="student.session" class="py-2 px-4 border-b">
                            <td class="border-r px-2 py-1 w-1/3 md:w-1/4">Session</td>
                            <td class="border-l px-2 py-1 w-2/3 md:w-3/4 font-semibold">{{ student.session }}</td>
                        </tr>
                    </template>
                </Table>
            </div>
        </div>
        <Table class="md:text-base w-full">
            <template #tbody>
                <tr v-if="student.roll_no" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Roll</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.roll_no }}</td>
                </tr>
                <tr v-if="student.student_id" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Student ID</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.student_id }}</td>
                </tr>
                <tr v-if="student.unique_id" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Unique ID</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.unique_id }}</td>
                </tr>
                <tr v-if="student.registration_no" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Registration No</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.registration_no }}</td>
                </tr>
            </template>
        </Table>

        <Table class="md:text-base">
            <template #tbody>
                <tr v-if="student.brid" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Birth Registration ID</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.brid }}</td>
                </tr>
                <tr v-if="student.date_of_birth" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Date of Birth</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.date_of_birth }}</td>
                </tr>
            </template>
        </Table>

        <Table class="md:text-base">
            <template #tbody>
                <tr v-if="student.student_name_en" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Name</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.student_name_en }}</td>
                </tr>
                <tr v-if="student.student_name_bn" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3 font-bengali">নাম</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold font-bengali">{{ student.student_name_bn }}</td>
                </tr>
                <tr v-if="student.father_name_en" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Father's Name</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.father_name_en }}</td>
                </tr>
                <tr v-if="student.father_name_bn" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3 font-bengali">পিতার নাম</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold font-bengali">{{ student.father_name_bn }}</td>
                </tr>
                <tr v-if="student.mother_name_en" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Mother's Name</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.mother_name_en }}</td>
                </tr>
                <tr v-if="student.mother_name_bn" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3 font-bengali">মাতার নাম</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold font-bengali">{{ student.mother_name_bn }}</td>
                </tr>
                <tr v-if="student.guardian_name_en" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Guardian's Name</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.guardian_name_en }}</td>
                </tr>
                <tr v-if="student.guardian_name_bn" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3 font-bengali">অভিভাবকের নাম</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold font-bengali">{{ student.guardian_name_bn }}</td>
                </tr>
                <tr v-if="student.address_en" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Address</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.address_en }}</td>
                </tr>
                <tr v-if="student.address_bn" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3 font-bengali">ঠিকানা</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold font-bengali">{{ student.address_bn }}</td>
                </tr>
            </template>
        </Table>

        <Table class="md:text-base">
            <template #tbody>
                <tr v-if="student.email" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Email Address</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.email }}</td>
                </tr>
                <tr v-if="student.student_mobile_no" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Student's Mobile No</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.student_mobile_no }}</td>
                </tr>
                <tr v-if="student.father_mobile_no" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Father's Mobile No</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.father_mobile_no }}</td>
                </tr>
                <tr v-if="student.mother_mobile_no" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Mother's Mobile No</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.mother_mobile_no }}</td>
                </tr>
                <tr v-if="student.guardian_mobile_no" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Guardian's Mobile No</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.guardian_mobile_no }}</td>
                </tr>
                <tr v-if="student.gender_en" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Gender</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.gender_en }}</td>
                </tr>
                <tr v-if="student.religion_en" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Religion</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.religion_en }}</td>
                </tr>
                <tr v-if="student.disability_status_en" class="py-2 px-4 border-b">
                    <td class="border-r px-2 py-1 w-1/3">Disability</td>
                    <td class="border-l px-2 py-1 w-2/3 font-semibold">{{ student.disability_status_en }}</td>
                </tr>
            </template>
        </Table>
    </div>
</template>

<style>
.font-bengali {
    font-family: 'Noto Serif Bengali', serif;
}
</style>

