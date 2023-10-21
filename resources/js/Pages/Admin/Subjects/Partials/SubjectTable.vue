  
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
import DeleteSubjectForm from '@/Pages/Admin/Subjects/Partials/DeleteSubjectForm.vue';


const props = defineProps({
    subjects: Object,
});

const showModal = ref(false);
const selectedSubject = ref(null);

const toggleModal = (subject) => {
    selectedSubject.value = subject;
    showModal.value = !showModal.value;
};


</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200">Subject Code</th>
                <th class="py-2 px-4 border-b bg-slate-200">Subject Name</th>
                <th class="py-2 px-4 border-b bg-slate-200">Created/Edited</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>


            <tr v-if="subjects.data.length > 0" v-for="(subject, index) in subjects.data" :key="index"
                class="hover:bg-blue-100" :class="subject.status === 0 ? 'bg-gray-200 opacity-70' : ''">
                <td class="py-2 px-4 border-b text-center">{{ (subjects.current_page - 1) * subjects.per_page + index + 1 }}</td>
                <td class="py-2 px-4 border-b text-center">{{ subject.code }}</td>
                <td class="py-2 px-4 border-b text-center w-full">{{ subject.name }}</td>
                <td class="py-2 px-4 border-b text-center">
                    <CreatedUpdatedBy :createdUpdatedBy="subject" />
                </td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">

<ToggleStatus :toggle="subject" :toggleType="`subjects`"/>
                        <Link :href="route('admin.subjects.edit', subject.id)">
                        <PrimaryIconButton>
                            <i class="fas fa-pen"></i>
                        </PrimaryIconButton>
                        </Link>

                        <!-- Delete button -->
                        <DangerIconButton class="ml-1" @click="() => toggleModal(subject)">
                            <i class="fas fa-trash"></i>
                        </DangerIconButton>

                    </div>
                </td>
            </tr>

            <tr v-else>
                <td colspan="3" class="text-center p-3">
                    Not Data Found
                </td>
            </tr>
        </template>
    </Table>
    <!-- Modal form outside the table -->
    <DeleteSubjectForm :show="showModal" :subject="selectedSubject" @close="toggleModal" />
    <div class="mt-5">
        <template v-for="(link, index) in subjects.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === subjects.links.length - 1">
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
                <template v-else-if="index === subjects.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>

    </div>
</template>



