  
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
import DeleteSliderForm from '@/Pages/Admin/Sliders/Partials/DeleteSliderForm.vue';


const props = defineProps({
    sliders: Object,
});

const showModal = ref(false);
const selectedSlider = ref(null);

const toggleModal = (slider) => {
    selectedSlider.value = slider;
    showModal.value = !showModal.value;
};


</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200">Caption</th>
                <th class="py-2 px-4 border-b bg-slate-200">Path</th>
                <th class="py-2 px-4 border-b bg-slate-200">Created/Edited</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>


            <tr v-if="sliders.data.length > 0" v-for="(slider, index) in sliders.data" :key="index"
                class="hover:bg-blue-100" :class="slider.status === 0 ? 'bg-gray-200 opacity-70' : ''">
                <td class="py-2 px-4 border-b">{{ (sliders.current_page - 1) * sliders.per_page + index + 1 }}</td>
                <td class="py-2 px-4 border-b">
                    <div class="font-medium text-slate-500">{{ slider.caption }}</div>
                </td>
                <td class="py-2 px-4 border-b text-center">{{ slider.path }}</td>
                <td class="py-2 px-4 border-b text-center">
                    <CreatedUpdatedBy :createdUpdatedBy="slider" />
                </td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">
                        <ToggleStatus :toggle="slider" :toggleType="`sliders`" />

                        <Link :href="route('admin.sliders.edit', slider.id)">
                        <PrimaryIconButton>
                            <i class="fas fa-pen"></i>
                        </PrimaryIconButton>
                        </Link>

                        <!-- Delete button -->
                        <DangerIconButton class="ml-1" @click="() => toggleModal(slider)">
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
    <DeleteSliderForm :show="showModal" :slider="selectedSlider" @close="toggleModal" />


    <div class="mt-5">
        <template v-for="(link, index) in sliders.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === sliders.links.length - 1">
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
                <template v-else-if="index === sliders.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>
    </div>
</template>



