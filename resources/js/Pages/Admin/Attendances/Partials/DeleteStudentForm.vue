<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';

const props = defineProps({
    student: Array,
    show: {
        type: Boolean,
        default: false,
    },
});
const emit = defineEmits(['close']);

const close = () => {
    emit('close');
};


const confirmingStudentDeletion = ref(false);
const form = useForm({});

watch(() => {
    confirmingStudentDeletion.value = props.show;
});

const deleteStudent = async () => {
    try {
        // Send a DELETE request to delete the student
        form.delete(route('admin.students.destroy', props.student.student_id), {
            errorBag: 'deleteStudent',
        });

        setTimeout(() => {
            close();
        }, 1000);

    } catch (error) {
        // Handle any errors that occur during the deletion
        console.error('Error deleting student:', error);
    }
};


</script>


<template>
    <!-- Delete Student Confirmation Modal -->
    <ConfirmationModal :show="confirmingStudentDeletion" :max-width="maxWidth" :closeable="closeable" @close="close">

        <template #title>
            Delete Student
        </template>

        <template #content>
            Are you sure you want to delete this student?

            <div class="bg-red-100 w-full mt-2 rounded line-clamp-3 box-content">
                <span class="m-2 line-clamp-3 box-content">
                    <div class="flex flex-col gap-2 sm:flex-row">
                        <div class="flex justify-center items-center flex-col">
                            <div v-if="student.photo != ''"><img :src="'/storage/' + student.photo"
                                    class="d-block h-24 w-20" alt="..."></div>
                            <div v-else class="h-24 w-20 flex justify-center items-center flex-col">
                                <div>No</div>
                                <div>Photo</div>
                                <div>Found</div>
                            </div>
                            <!-- <div>ID: {{ student.student_id }}</div> -->
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="font-semibold text-base">{{ student.student_name_en }}</div>
                            <div class="text-base">{{ student.student_name_bn }}</div>
                            <div v-if="student.roll_no">Roll No: {{ student.roll_no }}</div>
                            <div class="font-semibold">Student ID: {{ student.student_id }}</div>
                        </div>
                    </div>
                </span>
            </div>
        </template>

        <template #footer>
            <div class="flex justify-center items-center">
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-red-600': form.processing }">
                    {{ form.processing ? 'Deleting...' : (form.recentlySuccessful ? 'Deleted!' : 'Failed') }}
                </ActionMessage>

                <SecondaryButton @click="close">
                    Cancel
                </SecondaryButton>

                <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    @click="deleteStudent">
                    Delete
                </DangerButton>
            </div>
        </template>
    </ConfirmationModal>
</template>
