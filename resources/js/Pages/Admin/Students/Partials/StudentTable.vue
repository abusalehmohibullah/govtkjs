  
<script setup>
import { ref, reactive } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
// import { Inertia } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import Table from '@/Components/Table.vue';
import CreatedUpdatedBy from '@/Components/Admin/CreatedUpdatedBy.vue';
import ToggleStatus from '@/Components/Admin/ToggleStatus.vue';
import PrimaryPaginatorButton from '@/Components/PrimaryPaginatorButton.vue';
import SecondaryPaginatorButton from '@/Components/SecondaryPaginatorButton.vue';
import SecondaryIconButton from '@/Components/SecondaryIconButton.vue';
import PrimaryIconButton from '@/Components/PrimaryIconButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';
import DeleteStudentForm from '@/Pages/Admin/Students/Partials/DeleteStudentForm.vue';
import SelectInput from '@/Components/SelectInput.vue';

const props = defineProps({
    students: Object,
    selected_classroom: Object,
    classrooms: Object,
});

const showModal = ref(false);
const selectedStudent = ref(null);

const toggleModal = (student) => {
    selectedStudent.value = student;
    showModal.value = !showModal.value;
};

const selectedClassroom = ref({ id: '', name: '' });
const selectedClass = props.classrooms.find(classroom => classroom.id === props.selected_classroom.id);
if (selectedClass) {
    selectedClassroom.value = { id: selectedClass.id, name: selectedClass.name };
} else {
    selectedClassroom.value = { id: '', name: '' };
}

const handleClassroomSelected = async (selectedLabel) => {
    console.log('g');
    const url = route('admin.students.index', { selected_classroom: selectedLabel });

    await router.get(url, {
        preserveScroll: true,
    });// Update albumName ref
};



</script>

<template>
    <div class="md:flex justify-between items-start pt-4 gap-3 bg-white rounded px-2">
        <div class="flex gap-2 md:w-full justify-between md:justify-start mb-2">
            <div class="border rounded w-full md:w-36 p-1">
                <div class="text-xs">Class</div>
                <div class="font-bold text-xl text-end">{{
                    selected_classroom.grade.name }}</div>
            </div>
            <div class="border rounded w-full md:w-36 p-1" v-if="selected_classroom.section">
                <div class="text-xs">Section</div>
                <div class="font-bold text-xl text-end">{{
                    selected_classroom.section.name }}</div>
            </div>
            <div class="border rounded w-full md:w-36 p-1" v-if="selected_classroom.group">
                <div class="text-xs">Group</div>
                <div class="font-bold text-xl text-end">{{
                    selected_classroom.group.name }}</div>
            </div>
        </div>
        
        <div class="w-full md:w-72">
            <InputLabel for="classroom_id" value="Class">
                <template #required>*</template>
            </InputLabel>

            <SelectInput :options="classrooms" inputName="classroom_id" :fieldName="'name'" :valueField="'id'"
                :selectedOption="selectedClassroom" @option-selected="handleClassroomSelected" class="capitalize" />
        </div>
    </div>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">Roll No</th>
                <th class="py-2 px-4 border-b bg-slate-200">Student ID</th>
                <th class="py-2 px-4 border-b bg-slate-200">Reg. No</th>
                <th class="py-2 px-4 border-b bg-slate-200">Name</th>
                <th class="py-2 px-4 border-b bg-slate-200">Father's Name</th>
                <th class="py-2 px-4 border-b bg-slate-200">Mother's Name</th>
                <th class="py-2 px-4 border-b bg-slate-200">Photo</th>
                <th class="py-2 px-4 border-b bg-slate-200">Created/Edited</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>


            <tr v-if="students.data.length > 0" v-for="(student, index) in students.data" :key="index"
                class="hover:bg-blue-100">
                <td class="py-2 px-4 border-b text-center">{{ student.roll_no }}</td>
                <td class="py-2 px-4 border-b">
                    <div class="font-medium text-center text-slate-500">{{ student.student_id }}</div>
                </td>
                <td class="py-2 px-4 border-b text-center">{{ student.registration_no }}</td>
                <td class="py-2 px-4 border-b">
                    <div>{{ student.student_name_en }}</div>
                    <div class="font-bengali">{{ student.student_name_bn }}</div>
                </td>
                <td class="py-2 px-4 border-b">
                    <div>{{ student.father_name_en }}</div>
                    <div class="font-bengali">{{ student.father_name_bn }}</div>
                </td>
                <td class="py-2 px-4 border-b">
                    <div>{{ student.mother_name_en }}</div>
                    <div class="font-bengali">{{ student.mother_name_bn }}</div>
                </td>
                <td class="py-2 px-4 border-b flex items-center justify-center">
                    <div v-if="student.photo"><img :src="'/storage/' + student.photo" class="d-block h-24 w-20"
                            alt="..."></div>
                    <div v-else class="h-24 w-20 flex justify-center items-center flex-col">
                        <div>No</div>
                        <div>Photo</div>
                        <div>Found</div>
                    </div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <CreatedUpdatedBy :createdUpdatedBy="student" />
                </td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">
                        <!-- <ToggleStatus :toggle="student" :toggleType="`students`" /> -->

                        <Link
                            :href="route('admin.students.show', { student: student.student_id, selected_classroom: selected_classroom.id })">
                        <SecondaryIconButton>
                            <i class="fas fa-eye"></i>
                        </SecondaryIconButton>
                        </Link>

                        <Link class="ml-1"
                            :href="route('admin.students.edit', { student: student.student_id, selected_classroom: selected_classroom.id })">
                        <PrimaryIconButton>
                            <i class="fas fa-pen"></i>
                        </PrimaryIconButton>
                        </Link>

                        <!-- Delete button -->
                        <DangerIconButton class="ml-1" @click="() => toggleModal(student)">
                            <i class="fas fa-trash"></i>
                        </DangerIconButton>

                    </div>
                </td>
            </tr>

            <tr v-else>
                <td colspan="4" class="text-center p-3">
                    Not Data Found
                </td>
            </tr>
        </template>
    </Table>
    <!-- Modal form outside the table -->
    <DeleteStudentForm :show="showModal" :student="selectedStudent" @close="toggleModal" />


    <div class="mt-5">
        <template v-for="(link, index) in students.links">
            <template v-if="link.url">
                <Link :href="`${link.url}&selected_classroom=${selected_classroom.id}`">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === students.links.length - 1">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" />
                    </template>
                    <template v-else>
                        <SecondaryPaginatorButton v-html="link.label" />
                    </template>
                </template>
                </Link>
            </template>
            <template v-else>
                <template v-if="index === 0">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" class='opacity-40' />
                </template>
                <template v-else-if="index === students.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>
    </div>
</template>


<style>
.font-bengali {
    font-family: 'Noto Serif Bengali', serif;
}
</style>