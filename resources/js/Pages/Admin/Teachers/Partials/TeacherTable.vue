  
<script setup>
import { ref, reactive } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import Table from '@/Components/Table.vue';
import CreatedUpdatedBy from '@/Components/Admin/CreatedUpdatedBy.vue';
import ToggleStatus from '@/Components/Admin/ToggleStatus.vue';
import PrimaryPaginatorButton from '@/Components/PrimaryPaginatorButton.vue';
import SecondaryPaginatorButton from '@/Components/SecondaryPaginatorButton.vue';
import PrimaryIconButton from '@/Components/PrimaryIconButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';
import DeleteTeacherForm from '@/Pages/Admin/Teachers/Partials/DeleteTeacherForm.vue';


const props = defineProps({
    teachers: Object,
});

const showModal = ref(false);
const selectedTeacher = ref(null);

const toggleModal = (teacher) => {
    selectedTeacher.value = teacher;
    showModal.value = !showModal.value;
};


</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200">ID</th>
                <th class="py-2 px-4 border-b bg-slate-200 whitespace-nowrap">Teacher Name</th>
                <th class="py-2 px-4 border-b bg-slate-200">Designation</th>
                <th class="py-2 px-4 border-b bg-slate-200">Subject</th>
                <th class="py-2 px-4 border-b bg-slate-200">Class</th>
                <th class="py-2 px-4 border-b bg-slate-200">Created/Edited</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>


            <tr v-if="teachers.data.length > 0" v-for="(teacher, index) in teachers.data" :key="index"
                class="hover:bg-blue-100" :class="teacher.status === 0 ? 'bg-gray-200 opacity-70' : ''">
                <td class="py-2 px-4 border-b text-center">{{ (teachers.current_page - 1) * teachers.per_page + index + 1
                }}</td>
                <td class="py-2 px-4 border-b text-center">{{ teacher.unique_id }}</td>
                <td class="py-2 px-4 border-b">{{ teacher.user.name }}</td>
                <td class="py-2 px-4 border-b text-center">{{ teacher.designation }}</td>
                <td class="py-2 px-4 border-b text-center" v-if="teacher.subject">{{ teacher.subject.name + '(' +
                    teacher.subject.code + ')' }}</td>
                <td class="py-2 px-4 border-b text-center" v-else>No Subject Found</td>
                <td class="py-2 px-4 border-b text-center" v-if="teacher.classroom">{{ teacher.classroom.name }}</td>
                <td class="py-2 px-4 border-b text-center" v-else>No Class Found</td>
                <td class="py-2 px-4 border-b text-center">
                    <CreatedUpdatedBy :createdUpdatedBy="teacher" />
                </td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">

                        <!-- <ToggleStatus :toggle="teacher" :toggleType="`teachers`" /> -->
                        <Link :href="route('admin.teachers.edit', teacher.id)">
                        <PrimaryIconButton>
                            <i class="fas fa-pen"></i>
                        </PrimaryIconButton>
                        </Link>

                        <!-- Delete button -->
                        <DangerIconButton class="ml-1" @click="() => toggleModal(teacher)">
                            <i class="fas fa-trash"></i>
                        </DangerIconButton>

                    </div>
                </td>
            </tr>

            <tr v-else>
                <td colspan="8" class="text-center p-3">
                    Not Data Found
                </td>
            </tr>
        </template>
    </Table>
    <!-- Modal form outside the table -->
    <DeleteTeacherForm :show="showModal" :teacher="selectedTeacher" @close="toggleModal" />
    <div class="mt-5">
        <template v-for="(link, index) in teachers.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === teachers.links.length - 1">
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
                <template v-else-if="index === teachers.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>

    </div>
</template>



