<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import DateInput from '@/Components/DateInput.vue';

const props = defineProps({
    user: Object,
    teacher: Object,
});

const form = useForm({
    _method: 'PUT',
    photo: null,
    name: props.user.name,
    nid: props.teacher.nid,
    date_of_birth: props.teacher.date_of_birth,
    joining_date: props.teacher.joining_date,
    qualification: props.teacher.qualification,
    mobile_no: props.teacher.mobile_no,
    email: props.user.email,
    facebook: props.teacher.facebook,
    instagram: props.teacher.instagram,
    twitter: props.teacher.twitter,
    linkedin: props.teacher.linkedin,
    youtube: props.teacher.youtube,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            
            <!-- Profile Photo -->
            <!-- <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4"> -->
            <div class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input ref="photoInput" type="file" class="hidden" @change="updatePhotoPreview">

                <InputLabel for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div v-show="!photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'" />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                    Select A New Photo
                </SecondaryButton>

                <SecondaryButton v-if="user.profile_photo_path" type="button" class="mt-2" @click.prevent="deletePhoto">
                    Remove Photo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>


            <div class="border rounded p-2 flex flex-col gap-5">
                <div class="text-end p-0">
                    Personal Details
                    <hr class="p-0 m-0">
                </div>

                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="name" value="Name" />
                    <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                        autocomplete="name" />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <!-- Date of Birth -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="date_of_birth" value="Date of Birth" />
                    <DateInput id="date_of_birth" v-model="form.date_of_birth" type="date" class="mt-1 block w-full"
                        required autocomplete="date_of_birth" />
                    <InputError :message="form.errors.date_of_birth" class="mt-2" />
                </div>

                <!-- NID -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="nid" value="National Identification No (NID)" />
                    <TextInput id="nid" v-model="form.nid" type="text" class="mt-1 block w-full" required
                        autocomplete="nid" />
                    <InputError :message="form.errors.nid" class="mt-2" />
                </div>
            </div>

            <div class="border rounded p-2 flex flex-col gap-5">
                <div class="text-end">
                    Career Details
                    <hr class="p-0 m-0">
                </div>
                <!-- Joining Date -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="joining_date" value="Joining Date" />
                    <DateInput id="joining_date" v-model="form.joining_date" type="date" class="mt-1 block w-full" required
                        autocomplete="joining_date" />
                    <InputError :message="form.errors.joining_date" class="mt-2" />
                </div>

                <!-- Qualification -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="qualification" value="Qualification" />
                    <TextArea id="qualification" v-model="form.qualification" type="text" class="mt-1 block w-full" required
                        autocomplete="qualification" />
                    <InputError :message="form.errors.qualification" class="mt-2" />
                </div>
            </div>

            <div class="border rounded p-2 flex flex-col gap-5">
                <div class="text-end">
                    Contact Details
                    <hr class="p-0 m-0">
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
                        autocomplete="username" />
                    <InputError :message="form.errors.email" class="mt-2" />

                    <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                        <p class="text-sm mt-2">
                            Your email address is unverified.

                            <Link :href="route('verification.send')" method="post" as="button"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                @click.prevent="sendEmailVerification">
                            Click here to re-send the verification email.
                            </Link>
                        </p>

                        <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                            A new verification link has been sent to your email address.
                        </div>
                    </div>
                </div>

                <!-- Mobile_no -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="mobile_no" value="Mobile No" />
                    <TextInput id="mobile_no" v-model="form.mobile_no" type="text" class="mt-1 block w-full" required
                        autocomplete="mobile_no" />
                    <InputError :message="form.errors.mobile_no" class="mt-2" />
                </div>
            </div>

            <div class="border rounded p-2 flex flex-col gap-5">
                <div class="text-end">
                    Social Media Links
                    <hr class="p-0 m-0">
                </div>

                <!-- Facebook -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="facebook" value="Facebook Account Link" />
                    <TextInput id="facebook" v-model="form.facebook" type="text" class="mt-1 block w-full" 
                        autocomplete="facebook" />
                    <InputError :message="form.errors.facebook" class="mt-2" />
                </div>

                <!-- Instagram -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="instagram" value="Instagram Account Link" />
                    <TextInput id="instagram" v-model="form.instagram" type="text" class="mt-1 block w-full" 
                        autocomplete="instagram" />
                    <InputError :message="form.errors.instagram" class="mt-2" />
                </div>

                <!-- Twitter -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="twitter" value="Twitter Account Link" />
                    <TextInput id="twitter" v-model="form.twitter" type="text" class="mt-1 block w-full" 
                        autocomplete="twitter" />
                    <InputError :message="form.errors.twitter" class="mt-2" />
                </div>

                <!-- Linkedin -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="linkedin" value="Linkedin Account Link" />
                    <TextInput id="linkedin" v-model="form.linkedin" type="text" class="mt-1 block w-full" 
                        autocomplete="linkedin" />
                    <InputError :message="form.errors.linkedin" class="mt-2" />
                </div>

                <!-- Youtube -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="youtube" value="Youtube Channel Link" />
                    <TextInput id="youtube" v-model="form.youtube" type="text" class="mt-1 block w-full" 
                        autocomplete="youtube" />
                    <InputError :message="form.errors.youtube" class="mt-2" />
                </div>
            </div>

        </template>

        <template #actions>
            <ActionMessage :on="form.processing" class="mr-3"
                :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                {{ form.processing ? 'Saving...' : (form.recentlySuccessful ? 'Saved!' : 'Failed') }}
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
