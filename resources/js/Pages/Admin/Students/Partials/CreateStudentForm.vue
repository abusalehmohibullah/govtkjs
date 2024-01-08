  
<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import FileInput from '@/Components/FileInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DateInput from '@/Components/DateInput.vue';
const { classroom } = defineProps(['classroom']);

const form = useForm({
    caption: '',
    path: null,
    photo: null, // Add a property for the photo file
});

const photoPreview = ref(null);

const previewPhoto = (event) => {
  const file = event.target.files[0];

  if (file && file.type.startsWith('image/')) {
    const reader = new FileReader();

    reader.onload = (e) => {
      photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(file);

    // Set the file to the form property
    form.photo = file;
  } else {
    // Clear the preview and reset the form property
    photoPreview.value = null;
    form.photo = null;
  }
};

let step = 1; // Initial step
const currentStep = ref(1);
const nextStep = () => {
    // Move to the next step
    step++;
    currentStep.value++;
};

const prevStep = () => {
    // Move to the prev step
    step--;
    currentStep.value--;
};

const goToStep = (index) => {
    // Move to the prev step
    step = index;
    currentStep.value = index;
};


const totalSteps = 5; // Define the total number of steps in your form

// Function to proceed to the next step
// const nextStep = () => {
//   if (currentStep.value < totalSteps) {
//     currentStep.value++;
//   }
// };
// // Function to proceed to the next step
// const nextStep = () => {
//   if (step.value < totalSteps) {
//     step.value++;
//   }
// };

const createStudent = () => {
    form.post(route('admin.students.store'), {
        errorBag: 'createStudent',
        preserveScroll: true,
    });
};

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="createStudent">
            <template #title>
                Add Student
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>







                <!-- component -->

                <div class="w-full my-4">
                    <!-- Dynamic progress bar -->
                    <div class="w-full mx-auto">
                        <div class="bg-gray-200 h-1 flex items-center justify-between relative">
                            <!-- Loop through each step and create a progress step -->
                            <div class="flex justify-between h-1 items-center absolute w-full">
                                <div v-for="index in totalSteps" :key="index"
                                    class="flex justify-between h-1 items-center relative">
                                    <!-- Step indicator -->
                                    <div :class="{ 'bg-white h-6 w-6 rounded-full shadow border': index > currentStep }">

                                        <!-- current step -->
                                        <template v-if="index == currentStep">
                                            <div
                                                class="bg-white h-6 w-6 rounded-full shadow border flex items-center justify-center relative">
                                                <div class="h-3 w-3 bg-indigo-700 rounded-full"></div>
                                            </div>
                                        </template>

                                        <!-- Checkmark icon for completed steps -->
                                        <template v-else-if="index < currentStep">
                                            <div @click="goToStep(index)"
                                                class="bg-indigo-700 h-6 w-6 rounded-full shadow flex items-center justify-center cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-check" width="18" height="18"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                        </template>

                                        <!-- Number for the future steps -->
                                        <template v-else>
                                            <div @click="goToStep(index)"
                                                class="flex justify-center items-center font-medium cursor-pointer">{{ index
                                                }}</div>
                                        </template>
                                    </div>

                                    <!-- Step description and tooltip for the current step -->
                                    <!-- <div class="relative" v-if="index === currentStep">
                                    <div class="absolute right-0 -mr-2">
                                        <div class="relative bg-white shadow-lg px-2 py-1 rounded mt-16 -mr-12">
                                            <svg class="absolute top-0 -mt-1 w-full right-0 left-0" width="16px"
                                                height="8px" viewBox="0 0 16 8" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <g id="Progress-Bars" transform="translate(-322.000000, -198.000000)"
                                                        fill="#FFFFFF">
                                                        <g id="Group-4" transform="translate(310.000000, 198.000000)">
                                                            <polygon id="Triangle" points="20 0 28 8 12 8"></polygon>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                            <p tabindex="0" class="focus:outline-none text-indigo-700 text-xs font-bold">
                                                Step {{ currentStep }}: Analyzing
                                            </p>
                                        </div>
                                    </div>
                                </div> -->
                                </div>
                            </div>
                            <div v-for="index in totalSteps - 1" :key="index"
                                class="w-1/4 flex justify-between h-1 items-center"
                                :class="{ 'bg-indigo-700': currentStep > index }">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dynamic progress bar ends -->

                <div v-if="step === 1" class="flex flex-col gap-5 px-1">
                    <h3 class="mb-3">Step 1: Roll and IDs</h3>
                    <!-- Use the Text Input component for each form field -->
                    <div class="w-full flex gap-2">
                        <div v-if="classroom.grade" class="w-full">
                            <InputLabel for="grade" value="Class">
                            </InputLabel>
                            <TextInput id="grade" v-model="classroom.grade.name" required class="mt-1 block w-full"
                                type="text" name="grade" disabled />
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
                            <TextInput id="group" v-model="classroom.group.name" required class="mt-1 block w-full"
                                type="text" name="group" disabled />
                        </div>
                    </div>


                    <!-- <div class="grid grid-cols-8 gap-2"> -->
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="roll_no" value="Roll No">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="roll_no" v-model="form.roll_no" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.roll_no }" type="text"
                            name="roll_no" />
                        <InputError :message="form.errors.roll_no" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="registration_no" value="Registration No">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="registration_no" v-model="form.registration_no" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.registration_no }" type="text"
                            name="registration_no" />
                        <InputError :message="form.errors.registration_no" class="text-red-500" />
                    </div>
                    <!-- </div> -->

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="unique_id" value="Unique ID">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="unique_id" v-model="form.unique_id" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.unique_id }" type="text"
                            name="unique_id" />
                        <InputError :message="form.errors.unique_id" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="brid" value="Birth Registration No">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="brid" v-model="form.brid" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.brid }" type="text" name="brid" />
                        <InputError :message="form.errors.brid" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="date_of_birth" value="Date of Birth">
                            <template #required>*</template>
                        </InputLabel>
                        <DateInput id="date_of_birth" v-model="form.date_of_birth" required class="mt-1 block"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.date_of_birth }" type="date"
                            name="date_of_birth" />
                        <InputError :message="form.errors.date_of_birth" class="text-red-500" />
                    </div>
                </div>

                <div v-else-if="step === 2" class="flex flex-col gap-5 px-1">
                    <h3 class="mb-3">Step 2: Personal Details (English)</h3>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="student_name_en" value="Student's Name (English)">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="student_name_en" v-model="form.student_name_en" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.student_name_en }" type="text"
                            name="student_name_en" />
                        <InputError :message="form.errors.student_name_en" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="father_name_en" value="Father's Name (English)">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="father_name_en" v-model="form.father_name_en" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.father_name_en }" type="text"
                            name="father_name_en" />
                        <InputError :message="form.errors.father_name_en" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="mother_name_en" value="Mother's Name (English)">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="mother_name_en" v-model="form.mother_name_en" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.mother_name_en }" type="text"
                            name="mother_name_en" />
                        <InputError :message="form.errors.mother_name_en" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="address_en" value="Address (English)">
                            <template #required>*</template>
                        </InputLabel>
                        <TextArea id="address_en" v-model="form.address_en" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.address_en }" type="text"
                            name="address_en" />
                        <InputError :message="form.errors.address_en" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <div>Optional</div>
                        <InputLabel for="guardian_name_en" value="Guardian's Name (English)">
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <TextInput id="guardian_name_en" v-model="form.guardian_name_en" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.guardian_name_en }" type="text"
                            name="guardian_name_en" />
                        <InputError :message="form.errors.guardian_name_en" class="text-red-500" />
                    </div>

                </div>

                <div v-else-if="step === 3" class="flex flex-col gap-5 px-1">
                    <h3 class="mb-3">Step 3: Personal Details (বাংলা)</h3>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="student_name_bn" value="Student's Name (বাংলা)">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="student_name_bn" v-model="form.student_name_bn" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.student_name_bn }" type="text"
                            name="student_name_bn" />
                        <InputError :message="form.errors.student_name_bn" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="father_name_bn" value="Father's Name (বাংলা)">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="father_name_bn" v-model="form.father_name_bn" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.father_name_bn }" type="text"
                            name="father_name_bn" />
                        <InputError :message="form.errors.father_name_bn" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="mother_name_bn" value="Mother's Name (বাংলা)">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="mother_name_bn" v-model="form.mother_name_bn" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.mother_name_bn }" type="text"
                            name="mother_name_bn" />
                        <InputError :message="form.errors.mother_name_bn" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="address_bn" value="Address (বাংলা)">
                            <template #required>*</template>
                        </InputLabel>
                        <TextArea id="address_bn" v-model="form.address_bn" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.address_bn }" type="text"
                            name="address_bn" />
                        <InputError :message="form.errors.address_bn" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <div>Optional</div>
                        <InputLabel for="guardian_name_bn" value="Guardian's Name (বাংলা)">
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <TextInput id="guardian_name_bn" v-model="form.guardian_name_bn" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.guardian_name_bn }" type="text"
                            name="guardian_name_bn" />
                        <InputError :message="form.errors.guardian_name_bn" class="text-red-500" />
                    </div>

                </div>

                <div v-else-if="step === 4" class="flex flex-col gap-5 px-1">
                    <h3 class="mb-3">Step 4: Other Informations</h3>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="gender" value="Roll No4">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="gender" v-model="form.gender" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.gender }" type="text"
                            name="gender" />
                        <InputError :message="form.errors.gender" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="religion" value="Roll No4">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="religion" v-model="form.religion" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.religion }" type="text"
                            name="religion" />
                        <InputError :message="form.errors.religion" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="disability_status" value="Roll No4">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="disability_status" v-model="form.disability_status" required
                            class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.disability_status }" type="text"
                            name="disability_status" />
                        <InputError :message="form.errors.disability_status" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="email" value="Email Address">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="email" v-model="form.email" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.email }" type="email"
                            name="email" />
                        <InputError :message="form.errors.email" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="student_mobile_no" value="Student's Mobile No">
                            <template #required>*</template>
                        </InputLabel>
                        <TextInput id="student_mobile_no" v-model="form.student_mobile_no" required
                            class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.student_mobile_no }" type="text"
                            pattern="[0-9]{11}" name="student_mobile_no" />
                        <InputError :message="form.errors.student_mobile_no" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="father_mobile_no" value="Father's Mobile No">
                        </InputLabel>
                        <TextInput id="father_mobile_no" v-model="form.father_mobile_no" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.father_mobile_no }" type="text"
                            pattern="[0-9]{11}" name="father_mobile_no" />
                        <InputError :message="form.errors.father_mobile_no" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="mother_mobile_no" value="Mother's Mobile No">
                        </InputLabel>
                        <TextInput id="mother_mobile_no" v-model="form.mother_mobile_no" required class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.mother_mobile_no }" type="text"
                            pattern="[0-9]{11}" name="mother_mobile_no" />
                        <InputError :message="form.errors.mother_mobile_no" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="guardian_mobile_no" value="Guardian's Mobile No">
                        </InputLabel>
                        <TextInput id="guardian_mobile_no" v-model="form.guardian_mobile_no" required
                            class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.guardian_mobile_no }" type="text"
                            pattern="[0-9]{11}" name="guardian_mobile_no" />
                        <InputError :message="form.errors.guardian_mobile_no" class="text-red-500" />
                    </div>

                </div>

                <div v-else-if="step === 5" class="flex flex-col gap-5 px-1">
                    <h3 class="mb-3">Step 5: Upload Photo</h3>
                    <div class="w-full flex justify-center items-center">
                        <div class="w-[240px] h-[300px] border">
                            <img v-if="photoPreview" :src="photoPreview" alt="Photo Preview" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-5">
                        <InputLabel for="photo" value="Upload Photo">
                            <template #required>*</template>
                        </InputLabel>
                        <FileInput @input="form.photo = $event.target.files[0]" id="photo" v-model="form.photo"
                            class="form-control mt-1 block"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.photo }" type="file"
                            accept="image/*" @change="previewPhoto" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="absolute h-[2px]">
                            {{ form.progress.percentage }}%
                        </progress>
                        <InputError :message="form.errors.photo" class="text-red-500" />
                    </div>

                    

                </div>

            </template>

            <template #actions>
                <div v-if="step === 1">
                    <PrimaryButton @click="nextStep">
                        Next</PrimaryButton>
                </div>

                <div v-if="step === 2 || step === 3 || step === 4">
                    <SecondaryButton @click="prevStep" class="mr-2">
                        Back</SecondaryButton>
                    <PrimaryButton @click="nextStep">
                        Next</PrimaryButton>
                </div>

                <div v-if="step === 5">
                    <ActionMessage :on="form.processing" class="mr-3"
                        :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                        {{ form.processing ? 'Creating...' : (form.recentlySuccessful ? 'Created!' : 'Failed') }}
                    </ActionMessage>

                    <SecondaryButton @click="prevStep" class="mr-2">
                        Back</SecondaryButton>

                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create</PrimaryButton>
                </div>
            </template>
        </FormSection>
    </div>
</template>

