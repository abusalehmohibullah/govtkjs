  
<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref, reactive, computed, watch, onMounted } from 'vue';

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

const { student, classrooms } = defineProps(['student', 'classrooms']);

const form = useForm({
    _method: 'PUT',
    classroom_id: student.classroom_id,
    session: student.session,
    roll_no: student.roll_no,
    registration_no: student.registration_no,
    unique_id: student.unique_id,
    brid: student.brid,
    date_of_birth: student.date_of_birth,
    student_name_en: student.student_name_en,
    student_name_bn: student.student_name_bn,
    father_name_en: student.father_name_en,
    father_name_bn: student.father_name_bn,
    mother_name_en: student.mother_name_en,
    mother_name_bn: student.mother_name_bn,
    guardian_name_en: student.guardian_name_en,
    guardian_name_bn: student.guardian_name_bn,
    address_en: student.address_en,
    address_bn: student.address_bn,
    gender_en: student.gender_en,
    gender_bn: student.gender_bn,
    religion_en: student.religion_en,
    religion_bn: student.religion_bn,
    disability_status_en: student.disability_status_en,
    disability_status_bn: student.disability_status_bn,
    email: student.email,
    student_mobile_no: student.student_mobile_no,
    father_mobile_no: student.father_mobile_no,
    mother_mobile_no: student.mother_mobile_no,
    guardian_mobile_no: student.guardian_mobile_no,
    photo: '',
});



const selectedClassroom = ref({ id: '', name: '' });
const selectedClass = classrooms.find(classroom => classroom.id === form.classroom_id);
if (selectedClass) {
    selectedClassroom.value = { id: selectedClass.id, name: selectedClass.name };
} else {
    selectedClassroom.value = { id: '', name: '' };
}
watch(() => form.classroom_id, (newClassroom, oldClassroom) => {
    const selectedClass = classrooms.find(classroom => classroom.id === newClassroom);
    if (selectedClass) {
        selectedClassroom.value = { id: selectedClass.id, name: selectedClass.name };
    } else {
        selectedClassroom.value = { id: '', name: '' };
    }
});

const handleClassroomSelected = (selectedLabel) => {
    form.classroom_id = selectedLabel; // Update albumName ref
};


const currentGrade = ref(selectedClassroom.value.name);
const match = currentGrade.value.match(/^\d+/);

const grade = match[0];

const currentYear = new Date().getFullYear();

// Generate sessions with single years
const singleYearSessions = Array.from(
    { length: 5 },
    (_, index) => ({ id: index + 1, name: (currentYear - 2 + index).toString() })
);

// Generate sessions with two-year combinations
const twoYearSessions = Array.from(
    { length: 5 },
    (_, index) => ({
        id: index, // Adjust the starting index based on the previous array length
        name: `${currentYear - 3 + index}-${(currentYear - 2 + index).toString().slice(-2)}`,
    })
);


const selectedSession = ref({ id: '', name: '' });

if (grade < 11) {
    const selectedSessionOption = singleYearSessions.find(session => session.name == student.session);
    if (selectedSessionOption) {
        selectedSession.value = { id: selectedSessionOption.id, name: selectedSessionOption.name };
    } else {
        selectedSession.value = { id: '', name: '' };
    }
} else {
    const selectedSessionOption = twoYearSessions.find(session => session.name == student.session);
    if (selectedSessionOption) {
        selectedSession.value = { id: selectedSessionOption.id, name: selectedSessionOption.name };
    } else {
        selectedSession.value = { id: '', name: '' };
    }

}


watch(() => form.session, (newSession, oldSession) => {
    if (grade < 11) {
        const selectedSessionOption = singleYearSessions.find(session => session.name == newSession);
        if (selectedSessionOption) {
            selectedSession.value = { id: selectedSessionOption.id, name: selectedSessionOption.name };
        } else {
            selectedSession.value = { id: '', name: '' };
        }
    } else {
        const selectedSessionOption = twoYearSessions.find(session => session.name == newSession);
        if (selectedSessionOption) {
            selectedSession.value = { id: selectedSessionOption.id, name: selectedSessionOption.name };
        } else {
            selectedSession.value = { id: '', name: '' };
        }

    }
});

const handleSessionSelected = (selectedLabel) => {
    const selectedId = parseInt(selectedLabel); // Convert selected label to integer

    if (grade < 11) {
        const selectedSessionOption = singleYearSessions.find(session => session.id == selectedId);
        if (selectedSessionOption) {
            form.session = selectedSessionOption.name.toString();
        }
    } else {
        const selectedSessionOption = twoYearSessions.find(session => session.id == selectedId);
        if (selectedSessionOption) {
            form.session = selectedSessionOption.name.toString();
        }
    }

};





const gendersEn = [
    { id: 1, name: 'Male' },
    { id: 2, name: 'Female' },
    { id: 3, name: 'Others' }
];

const selectedGenderEn = ref({ id: '', name: '' });
const selectedGender = gendersEn.find(gender => gender.name === form.gender_en);
if (selectedGender) {
    selectedGenderEn.value = { id: selectedGender.id, name: selectedGender.name };
} else {
    selectedGenderEn.value = { id: '', name: '' };
}
watch(() => form.gender_en, (newGenderEn, oldGenderEn) => {
    const selectedGender = gendersEn.find(gender => gender.name === newGenderEn);
    if (selectedGender) {
        selectedGenderEn.value = { id: selectedGender.id, name: selectedGender.name };
    } else {
        selectedGenderEn.value = { id: '', name: '' };
    }
});



const gendersBn = [
    { id: 1, name: 'বালক' },
    { id: 2, name: 'বালিকা' },
    { id: 3, name: 'অন্যান্য' }
];

const religionsEn = [
    { id: 1, name: 'Islam' },
    { id: 2, name: 'Hinduism' },
    { id: 3, name: 'Buddhism' },
    { id: 4, name: 'Christianity' },
    { id: 5, name: 'Others' }
];


const selectedReligionEn = ref({ id: '', name: '' });
const selectedReligion = religionsEn.find(religion => religion.name === form.religion_en);
if (selectedReligion) {
    selectedReligionEn.value = { id: selectedReligion.id, name: selectedReligion.name };
} else {
    selectedReligionEn.value = { id: '', name: '' };
}
watch(() => form.religion_en, (newReligionEn, oldReligionEn) => {
    const selectedReligion = religionsEn.find(religion => religion.name === newReligionEn);
    if (selectedReligion) {
        selectedReligionEn.value = { id: selectedReligion.id, name: selectedReligion.name };
    } else {
        selectedReligionEn.value = { id: '', name: '' };
    }
});

const religionsBn = [
    { id: 1, name: 'ইসলাম' },
    { id: 2, name: 'হিন্দু' },
    { id: 3, name: 'বৌদ্ধ' },
    { id: 4, name: 'খ্রিষ্টান' },
    { id: 5, name: 'অন্যান্য' }
];

const disabilityStatusEn = [
    { id: 0, name: 'None' },
    { id: 1, name: 'Physical' },
    { id: 2, name: 'Visual' },
    { id: 3, name: 'Hearing' },
    { id: 4, name: 'Verbal' },
    { id: 5, name: 'Intellectual' },
    { id: 6, name: 'Others' }
];


const selectedDisabilityStatusEn = ref({ id: '', name: '' });
const selectedDisabilityStatus = disabilityStatusEn.find(disabilityStatus => disabilityStatus.name === form.disability_status_en);
if (selectedDisabilityStatus) {
    selectedDisabilityStatusEn.value = { id: selectedDisabilityStatus.id, name: selectedDisabilityStatus.name };
} else {
    selectedDisabilityStatusEn.value = { id: '', name: '' };
}
watch(() => form.disability_status_en, (newDisabilityStatusEn, oldDisabilityStatusEn) => {
    const selectedDisabilityStatus = disabilityStatusEn.find(disabilityStatus => disabilityStatus.name === newDisabilityStatusEn);
    if (selectedDisabilityStatus) {
        selectedDisabilityStatusEn.value = { id: selectedDisabilityStatus.id, name: selectedDisabilityStatus.name };
    } else {
        selectedDisabilityStatusEn.value = { id: '', name: '' };
    }
});


const disabilityStatusBn = [
    { id: 0, name: 'প্রযোজ্য নয়' },
    { id: 1, name: 'শারীরিক প্রতিবন্ধী' },
    { id: 2, name: 'দৃষ্টি প্রতিবন্ধী' },
    { id: 3, name: 'শ্রবণ প্রতিবন্ধী' },
    { id: 4, name: 'বাক প্রতিবন্ধী' },
    { id: 5, name: 'বুদ্ধি প্রতিবন্ধী' },
    { id: 6, name: 'অন্যান্য' }
];


const handleGenderSelected = (selectedLabel) => {
    const selectedId = parseInt(selectedLabel); // Convert selected label to integer

    // Find the gender by ID in English
    const selectedEnGender = gendersEn.find(gender => gender.id === selectedId);
    if (selectedEnGender) {
        form.gender_en = selectedEnGender.name; // Set English gender name
    }

    // Find the gender by ID in Bengali
    const selectedBnGender = gendersBn.find(gender => gender.id === selectedId);
    if (selectedBnGender) {
        form.gender_bn = selectedBnGender.name; // Set Bengali gender name
    }

};

const handleReligionSelected = (selectedLabel) => {
    const selectedId = parseInt(selectedLabel); // Convert selected label to integer

    // Find the religion by ID in English
    const selectedEnReligion = religionsEn.find(religion => religion.id === selectedId);
    if (selectedEnReligion) {
        form.religion_en = selectedEnReligion.name; // Set English religion name
    }

    // Find the religion by ID in Bengali
    const selectedBnReligion = religionsBn.find(religion => religion.id === selectedId);
    if (selectedBnReligion) {
        form.religion_bn = selectedBnReligion.name; // Set Bengali religion name
    }

    console.log(form.religion_bn);
    console.log(form.religion_en);
};

const handleDisabilityStatusSelected = (selectedLabel) => {
    const selectedId = parseInt(selectedLabel); // Convert selected label to integer

    // Find the disabilityStatus by ID in English
    const selectedEnDisabilityStatus = disabilityStatusEn.find(disabilityStatus => disabilityStatus.id === selectedId);
    if (selectedEnDisabilityStatus) {
        form.disability_status_en = selectedEnDisabilityStatus.name; // Set English disabilityStatus name
    }

    // Find the disabilityStatus by ID in Bengali
    const selectedBnDisabilityStatus = disabilityStatusBn.find(disabilityStatus => disabilityStatus.id === selectedId);
    if (selectedBnDisabilityStatus) {
        form.disability_status_bn = selectedBnDisabilityStatus.name; // Set Bengali disabilityStatus name
    }

    console.log(form.disability_status_en);
    console.log(form.disability_status_bn);
};



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
const totalSteps = 5;
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


const stepsFields = {
    1: ['roll_no', 'registration_no', 'unique_id', 'brid', 'date_of_birth'],
    2: ['student_name_en', 'father_name_en', 'mother_name_en', 'address_en', 'guardian_name_en'],
    3: ['student_name_bn', 'father_name_bn', 'mother_name_bn', 'address_bn', 'guardian_name_bn'],
    4: ['gender_bn', 'religion_bn', 'disability_status_bn', 'student_mobile_no', 'father_mobile_no', 'mother_mobile_no', 'guardian_mobile_no'],
    5: ['photo'],
    // Define fields for other steps
    // ...
};
const stepswitherrors = ref([]);
watch(() => form.errors, (newErrors, oldErrors) => {
    // console.log('Form errors changed:', newErrors);
    stepswitherrors.value = [];
    // Function to check if a step has errors
    const hasErrorsInStep = (step) => {
        const fieldsInStep = stepsFields[step];
        return fieldsInStep.some(field => newErrors[field]);
    };

    // Iterate through steps and check for errors
    for (const step in stepsFields) {
        if (hasErrorsInStep(step)) {
            stepswitherrors.value.push(step);
            goToStep(stepswitherrors.value[0]);
            console.log(stepswitherrors.value);
            // Do something when a step has errors
        }
    }

});

const updateStudent = () => {
    form.post(route('admin.students.update', student.student_id), {
        errorBag: 'updateStudent',
        preserveScroll: true,
    });
    return console.log('f');

};



</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateStudent">
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
                            <SelectInput :options="grade < 11 ? singleYearSessions : twoYearSessions"
                                inputName="session" :fieldName="'name'" :valueField="'id'" :selectedOption="selectedSession"
                                @option-selected="handleSessionSelected" class="mt-1 capitalize" />
                        </div>

                        <div class="w-full">
                            <InputLabel for="classroom_id" value="Class">
                                <template #required>*</template>
                            </InputLabel>

                            <SelectInput :options="classrooms" inputName="classroom_id" :fieldName="'name'"
                                :valueField="'id'" :selectedOption="selectedClassroom"
                                @option-selected="handleClassroomSelected" class="mt-1 capitalize" />
                            <InputError :message="form.errors.classroom_id" class="text-red-500" />
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
                            <img v-else :src="'/storage/' + student.photo" alt="Photo Preview"
                                class="object-cover w-[240px] h-[300px]" />
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
                        {{ form.processing ? 'Updating...' : (form.recentlySuccessful ? 'Updated!' : 'Failed') }}
                    </ActionMessage>

                    <SecondaryButton @click="prevStep" class="mr-2" :type="'button'">
                        Back</SecondaryButton>

                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update</PrimaryButton>
                </div>
            </template>
        </FormSection>
    </div>
</template>

