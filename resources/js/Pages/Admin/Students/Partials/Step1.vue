  
<script setup>
import { ref, watch } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import FileInput from '@/Components/FileInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DateInput from '@/Components/DateInput.vue';

// Define props to receive the value and emit changes
const props = defineProps({
  modelValue: Object, // Use the appropriate object structure based on your data
  classroom: Array, // Use the appropriate object structure based on your data
});

// Create a local copy of the value
const localValue = ref(props.modelValue);

// Emit changes to the parent component
const emitChange = (value) => {
  emit('update:modelValue', value);
};

// Watch for changes in the local copy and emit updates
watch(localValue, (newValue) => {
  emitChange(newValue);
});



</script>

<template>
                 <!-- Use the Text Input component for each form field -->
                 <div class="w-full flex gap-2">
                    <div v-if="classroom.grade" class="w-full">
                        <InputLabel for="grade" value="Class">
                        </InputLabel>
                        <TextInput id="grade" v-model="classroom.grade.name" required class="mt-1 block w-full" type="text"
                            name="grade" disabled />
                    </div>

                    <div v-if="classroom.section" class="w-full">
                        <InputLabel for="section" value="Section">
                        </InputLabel>
                        <TextInput id="section" v-model="classroom.section.name" required class="mt-1 block w-full"
                            type="text" name="section" disabled />
                    </div>

                    <div v-if="classroom.group" class="w-full">
                        <InputLabel for="group" value="Group">
                        </InputLabel>
                        <TextInput id="group" v-model="classroom.group.name" required class="mt-1 block w-full" type="text"
                            name="group" disabled />
                    </div>
                </div>

                <!-- <div class="grid grid-cols-8 gap-2"> -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="roll_no" value="Roll No">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="roll_no" v-model="localValue.roll_no" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.roll_no }" type="text"
                        name="roll_no" />
                    <InputError :message="form.errors.roll_no" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="registration_no" value="Registration No">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="registration_no" v-model="localValue.registration_no" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.registration_no }" type="text"
                        name="registration_no" />
                    <InputError :message="form.errors.registration_no" class="text-red-500" />
                </div>
                <!-- </div> -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="unique_id" value="Unique ID">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="unique_id" v-model="localValue.unique_id" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.unique_id }" type="text"
                        name="unique_id" />
                    <InputError :message="form.errors.unique_id" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="brid" value="Birth Registration No">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="brid" v-model="localValue.brid" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.brid }" type="text" name="brid" />
                    <InputError :message="form.errors.brid" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="date_of_birth" value="Date of Birth">
                        <template #required>*</template>
                    </InputLabel>
                    <DateInput id="date_of_birth" v-model="localValue.date_of_birth" required class="mt-1 block"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.date_of_birth }" type="date"
                        name="date_of_birth" />
                    <InputError :message="form.errors.date_of_birth" class="text-red-500" />
                </div>

                <!-- <template #actions>
                    <PrimaryButton @click="nextStep">
                        Next
                    </PrimaryButton>
                </template> -->

</template>



