  
<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref, reactive, computed, watch } from 'vue';

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
import SelectInput from '@/Components/SelectInput.vue';

const { students } = defineProps(['students']);

const form = useForm({
    // classroom_id: classroom.id,
    // grade: classroom.grade.name,
    // session: '',
    // roll_no: '',
    // registration_no: '',
    // unique_id: '',
    // brid: '',
    // date_of_birth: '',
    // student_name_en: '',
    // student_name_bn: '',
    // father_name_en: '',
    // father_name_bn: '',
    // mother_name_en: '',
    // mother_name_bn: '',
    // guardian_name_en: '',
    // guardian_name_bn: '',
    // address_en: '',
    // address_bn: '',
    // gender_en: '',
    // gender_bn: '',
    // religion_en: '',
    // religion_bn: '',
    // disability_status_en: '',
    // disability_status_bn: '',
    // email: '',
    // student_mobile_no: '',
    // father_mobile_no: '',
    // mother_mobile_no: '',
    // guardian_mobile_no: '',
    // photo: null,
});


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
                                                <div class="h-3 w-3 rounded-full"
                                                    :class="{ 'bg-indigo-700': !stepswitherrors.includes(index.toString()), 'bg-red-600 text-white': stepswitherrors.includes(index.toString()) }">
                                                </div>
                                            </div>
                                        </template>

                                        <!-- Checkmark icon for completed steps -->
                                        <template v-else-if="index < currentStep">
                                            <div @click="goToStep(index)"
                                                class="h-6 w-6 rounded-full shadow flex items-center justify-center cursor-pointer"
                                                :class="{ 'bg-indigo-700': !stepswitherrors.includes(index.toString()), 'bg-red-600 text-white': stepswitherrors.includes(index.toString()) }">
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
                                                class="flex justify-center items-center font-medium cursor-pointer rounded-full"
                                                :class="{ 'bg-red-600 text-white': stepswitherrors.includes(index.toString()) }">
                                                {{ index
                                                }}</div>
                                        </template>
                                    </div>
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

                <div v-if="step == 1" class="flex flex-col gap-5 px-1">
                    <h3 class="mb-3">Step 1: Roll and IDs</h3>
                    <!-- Use the Text Input component for each form field -->
                    <div class="w-full flex gap-2">
                        <div class="w-full">
                            <InputLabel for="session" value="Session">
                                <template #required>*</template>
                            </InputLabel>
                            <SelectInput :options="classroom.grade.name < 11 ? singleYearSessions : twoYearSessions"
                                inputName="session" :fieldName="'name'" :valueField="'id'" :selectedOption="selectedSession"
                                @option-selected="handleSessionSelected" class="mt-1 capitalize" />
                        </div>

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
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <TextInput id="registration_no" v-model="form.registration_no" class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.registration_no }" type="text"
                            name="registration_no" />
                        <InputError :message="form.errors.registration_no" class="text-red-500" />
                    </div>
                    <!-- </div> -->

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="unique_id" value="Unique ID">
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <TextInput id="unique_id" v-model="form.unique_id" class="mt-1 block w-full"
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

                <div v-else-if="step == 2" class="flex flex-col gap-5 px-1">
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
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <TextArea id="address_en" v-model="form.address_en" class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.address_en }" type="text"
                            name="address_en" />
                        <InputError :message="form.errors.address_en" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <div>Optional</div>
                        <InputLabel for="guardian_name_en" value="Guardian's Name (English)">
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <TextInput id="guardian_name_en" v-model="form.guardian_name_en" class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.guardian_name_en }" type="text"
                            name="guardian_name_en" />
                        <InputError :message="form.errors.guardian_name_en" class="text-red-500" />
                    </div>

                </div>

                <div v-else-if="step == 3" class="flex flex-col gap-5 px-1">
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
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <TextArea id="address_bn" v-model="form.address_bn" class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.address_bn }" type="text"
                            name="address_bn" />
                        <InputError :message="form.errors.address_bn" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <div>Optional</div>
                        <InputLabel for="guardian_name_bn" value="Guardian's Name (বাংলা)">
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <TextInput id="guardian_name_bn" v-model="form.guardian_name_bn" class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.guardian_name_bn }" type="text"
                            name="guardian_name_bn" />
                        <InputError :message="form.errors.guardian_name_bn" class="text-red-500" />
                    </div>

                </div>

                <div v-else-if="step == 4" class="flex flex-col gap-5 px-1">
                    <h3 class="mb-3">Step 4: Contact and Other Informations</h3>

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
                        <TextInput id="father_mobile_no" v-model="form.father_mobile_no" class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.father_mobile_no }" type="text"
                            pattern="[0-9]{11}" name="father_mobile_no" />
                        <InputError :message="form.errors.father_mobile_no" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="mother_mobile_no" value="Mother's Mobile No">
                        </InputLabel>
                        <TextInput id="mother_mobile_no" v-model="form.mother_mobile_no" class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.mother_mobile_no }" type="text"
                            pattern="[0-9]{11}" name="mother_mobile_no" />
                        <InputError :message="form.errors.mother_mobile_no" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="guardian_mobile_no" value="Guardian's Mobile No">
                        </InputLabel>
                        <TextInput id="guardian_mobile_no" v-model="form.guardian_mobile_no" class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.guardian_mobile_no }" type="text"
                            pattern="[0-9]{11}" name="guardian_mobile_no" />
                        <InputError :message="form.errors.guardian_mobile_no" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="email" value="Email Address">
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <TextInput id="email" v-model="form.email" class="mt-1 block w-full"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.email }" type="email"
                            name="email" />
                        <InputError :message="form.errors.email" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="gender_en" value="Gender">
                            <template #required>*</template>
                        </InputLabel>
                        <!-- {{ selectedGenderEn }} -->
                        <SelectInput :options="gendersEn" inputName="gender_en" :fieldName="'name'" :valueField="'id'"
                            :selectedOption="selectedGenderEn" @option-selected="handleGenderSelected" class="capitalize" />
                        <InputError :message="form.errors.gender_en" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="religion_en" value="Religion">
                            <template #required>*</template>
                        </InputLabel>
                        <SelectInput :options="religionsEn" inputName="religion_en" :fieldName="'name'" :valueField="'id'"
                            :selectedOption="selectedReligionEn" @option-selected="handleReligionSelected"
                            class="capitalize" />
                        <InputError :message="form.errors.religion_en" class="text-red-500" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="disability_status_en" value="Disability Status">
                            <!-- <template #required>*</template> -->
                        </InputLabel>
                        <SelectInput :options="disabilityStatusEn" inputName="disability_status_en" :fieldName="'name'"
                            :selectedOption="selectedDisabilityStatusEn" :valueField="'id'"
                            @option-selected="handleDisabilityStatusSelected" class="capitalize" />
                        <InputError :message="form.errors.disability_status_en" class="text-red-500" />
                    </div>



                </div>

                <div v-else-if="step == 5" class="flex flex-col gap-5 px-1">
                    <h3 class="mb-3">Step 5: Upload Photo</h3>
                    <div class="w-full flex justify-center items-center">
                        <div class="w-[240px] h-[300px] border shadow">
                            <img v-if="photoPreview" :src="photoPreview" alt="Photo Preview"
                                class="object-cover w-[240px] h-[300px]" />
                            <img v-else :src="'/assets/images/profile-preview.jpg'" alt="Photo Preview"
                                class="object-contain w-[240px] h-[300px]" />
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
                <div v-if="step == 1">
                    <PrimaryButton @click="nextStep" :type="'button'">
                        Next</PrimaryButton>
                </div>

                <div v-if="step == 2 || step == 3 || step == 4">
                    <SecondaryButton @click="prevStep" class="mr-2" :type="'button'">
                        Back</SecondaryButton>
                    <PrimaryButton @click="nextStep" :type="'button'">
                        Next</PrimaryButton>
                </div>

                <div v-if="step == 5">
                    <ActionMessage :on="form.processing" class="mr-3"
                        :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                        {{ form.processing ? 'Creating...' : (form.recentlySuccessful ? 'Created!' : 'Failed') }}
                    </ActionMessage>

                    <SecondaryButton @click="prevStep" class="mr-2" :type="'button'">
                        Back</SecondaryButton>

                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create</PrimaryButton>
                </div>
            </template>
        </FormSection>
    </div>
</template>

