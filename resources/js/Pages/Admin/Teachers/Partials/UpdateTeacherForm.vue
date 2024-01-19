  
<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref, reactive, computed, watch } from 'vue';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';

const props = defineProps({
    users: Object,
    classrooms: Object,
    subjects: Object,
    teacher: Object,
});

const form = useForm({
    _method: 'PUT',
    user_id: props.teacher.user_id,
    unique_id: props.teacher.unique_id,
    designation: props.teacher.designation,
    priority: props.teacher.priority,
    subject_id: props.teacher.subject_id,
    classroom_id: props.teacher.classroom_id,
});



const designations = [
    { id: 1, name: 'Principal' },
    { id: 2, name: 'Vice Principal' },
    { id: 3, name: 'Headmaster' },
    { id: 4, name: 'Assistant Headmaster' },
    { id: 5, name: 'Professor' },
    { id: 6, name: 'Associate Professor' },
    { id: 7, name: 'Assistant Professor' },
    { id: 8, name: 'Lecturer' },
    { id: 9, name: 'Assistant Teacher' },
    { id: 10, name: 'Others' }
];


const selectedDesignation = ref({ id: '', name: '' });
const selectedDesignationOption = designations.find(designation => designation.name === form.designation);
    if (selectedDesignationOption) {
        selectedDesignation.value = { id: selectedDesignationOption.id, name: selectedDesignationOption.name };
    } else {
        selectedDesignation.value = { id: '', name: '' };
    }
watch(() => form.designation, (newDesignation, oldDesignation) => {
    const selectedDesignationOption = designations.find(designation => designation.name === newDesignation);
    if (selectedDesignationOption) {
        selectedDesignation.value = { id: selectedDesignationOption.id, name: selectedDesignationOption.name };
    } else {
        selectedDesignation.value = { id: '', name: '' };
    }
});

const handleDesignationSelected = (selectedLabel) => {
    const selectedId = parseInt(selectedLabel); // Convert selected label to integer

    // Find the designation by ID in English
    const selectedDesignationOption = designations.find(designation => designation.id === selectedId);
    if (selectedDesignationOption) {
        form.designation = selectedDesignationOption.name; // Set English designation name
        form.priority = selectedDesignationOption.id; // Set English designation name
    }

    console.log(form.designation);
};

const selectedUser = ref({ id: '', name: '' });
const selectedUserOption = props.users.find(user => user.id === form.user_id);
    if (selectedUserOption) {
        selectedUser.value = { id: selectedUserOption.id, name: selectedUserOption.name };
    } else {
        selectedUser.value = { id: '', name: '' };
    }

watch(() => form.user_id, (newUser, oldUser) => {
    const selectedUserOption = props.users.find(user => user.id === newUser);
    if (selectedUserOption) {
        selectedUser.value = { id: selectedUserOption.id, name: selectedUserOption.name };
    } else {
        selectedUser.value = { id: '', name: '' };
    }
});

const handleUserSelected = (selectedLabel) => {
    form.user_id = selectedLabel;
    // console.log('gg');
};

const selectedSubject = ref({ id: '', name: '' });
const selectedSubjectOption = props.subjects.find(subject => subject.id === form.subject_id);
    if (selectedSubjectOption) {
        selectedSubject.value = { id: selectedSubjectOption.id, name: selectedSubjectOption.name };
    } else {
        selectedSubject.value = { id: '', name: '' };
    }

watch(() => form.subject_id, (newSubject, oldSubject) => {
    const selectedSubjectOption = props.subjects.find(subject => subject.id === newSubject);
    if (selectedSubjectOption) {
        selectedSubject.value = { id: selectedSubjectOption.id, name: selectedSubjectOption.name };
    } else {
        selectedSubject.value = { id: '', name: '' };
    }
});
const handleSubjectSelected = (selectedLabel) => {
    form.subject_id = selectedLabel;
    // console.log('gg');
};

const selectedClassroom = ref({ id: '', name: '' });
const selectedClassroomOption = props.classrooms.find(classroom => classroom.id === form.classroom_id);
    if (selectedClassroomOption) {
        selectedClassroom.value = { id: selectedClassroomOption.id, name: selectedClassroomOption.name };
    } else {
        selectedClassroom.value = { id: '', name: '' };
    }

watch(() => form.classroom_id, (newClassroom, oldClassroom) => {
    const selectedClassroomOption = props.classrooms.find(classroom => classroom.id === newClassroom);
    if (selectedClassroomOption) {
        selectedClassroom.value = { id: selectedClassroomOption.id, name: selectedClassroomOption.name };
    } else {
        selectedClassroom.value = { id: '', name: '' };
    }
});
const handleClassroomSelected = (selectedLabel) => {
    form.classroom_id = selectedLabel;
    // console.log('gg');
};

const updateTeacher = () => {
    form.post(route('admin.teachers.update', props.teacher.id), {
        errorBag: 'updateTeacher',
        preserveScroll: true,
    });
};

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateTeacher">
            <template #title>
                Add Teachers
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <!-- {{ selectedUser }} -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="user" value="User Name">
                        <template #required>*</template>
                    </InputLabel>
                    <SelectInput :options="users" inputName="user_id" :fieldName="'name'" :valueField="'id'"
                        :selectedOption="selectedUser" @option-selected="handleUserSelected" />

                    <InputError :message="form.errors.user_id" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="unique_id" value="Index No/Unique ID">
                        <!-- <template #required>*</template> -->
                    </InputLabel>
                    <TextInput id="unique_id" v-model="form.unique_id" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.unique_id }" type="text"
                        name="unique_id" />
                    <InputError :message="form.errors.unique_id" class="text-red-500" />
                </div>
                <!-- {{ selectedDesignation }} -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="designation" value="Designation">
                        <template #required>*</template>
                    </InputLabel>
                    <SelectInput :options="designations" inputName="designation" :fieldName="'name'" :valueField="'id'"
                        :selectedOption="selectedDesignation" @option-selected="handleDesignationSelected" />

                    <InputError :message="form.errors.designation" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="subject" value="Subject Name">
                        <!-- <template #required>*</template> -->
                    </InputLabel>
                    <SelectInput :options="subjects" inputName="subject_id" :fieldName="'name'" :valueField="'id'"
                        :selectedOption="selectedSubject" @option-selected="handleSubjectSelected" />

                    <InputError :message="form.errors.subject_id" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="classroom" value="Classroom">
                        <!-- <template #required>*</template> -->
                    </InputLabel>
                    <SelectInput :options="classrooms" inputName="classroom_id" :fieldName="'name'" :valueField="'id'"
                        :selectedOption="selectedClassroom" @option-selected="handleClassroomSelected" />

                    <InputError :message="form.errors.classroom_id" class="text-red-500" />
                </div>

            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                    {{ form.processing ? 'Updating...' : (form.recentlySuccessful ? 'Updated!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>