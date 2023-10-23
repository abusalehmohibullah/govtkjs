<script setup>
import { ref, onMounted, computed, watch } from 'vue';

// Define props explicitly
const props = defineProps({
    user: Object,
    roles: Array,
    userRoles: Object,
    userPermissions: Array,
});

const selectedRoles = ref([]);
const selectedPermissions = ref([]);
const emit = defineEmits(['selected-roles-updated', 'selected-permissions-updated']);

// Watch for changes in selectedRoles and selectedPermissions
watch(selectedRoles, (newSelectedRoles) => {
    emit('selected-roles-updated', newSelectedRoles);
});

watch(selectedPermissions, (newSelectedPermissions) => {
    emit('selected-permissions-updated', newSelectedPermissions);
});

const isSelectAllChecked = (roleId) => {
    const rolePermissions = props.roles.find(role => role.id === roleId).permissions.map(permission => permission.id);
    return rolePermissions.every(permissionId => selectedPermissions.value.includes(permissionId));
};


const markAllPermissions = (role) => {
    const rolePermissions = role.permissions.map(permission => permission.id);

    // Select all permissions in this group
    selectedPermissions.value = [...selectedPermissions.value, ...rolePermissions];

};

const toggleAllPermissions = (role) => {
    const rolePermissions = role.permissions.map(permission => permission.id);

    if (isSelectAllChecked(role.id)) {
        // Deselect all permissions in this group
        selectedPermissions.value = selectedPermissions.value.filter(permissionId => !rolePermissions.includes(permissionId));
    } else {
        // Select all permissions in this group that are not already selected
        const newPermissions = rolePermissions.filter(permissionId => !selectedPermissions.value.includes(permissionId));
        selectedPermissions.value = [...selectedPermissions.value, ...newPermissions];
    }
};

const getRoleName = (roleId) => {
    const role = props.roles.find(role => role.id === roleId);
    return role ? role.name.replace(/_/g, ' ') : '';
};

const getPermissionName = (permissionId) => {
    const permission = props.roles.flatMap(role => role.permissions).find(permission => permission.id === permissionId);
    return permission ? permission.name.replace(/_/g, ' ') : '';
};

const restrictedPermissions = computed(() => {
    // Calculate restrictedPermissions based on selectedRoles and selectedPermissions
    return selectedRoles.value
        .flatMap(roleId => {
            const role = props.roles.find(role => role.id === roleId);
            return role ? role.permissions : [];
        })
        .filter(permission => !selectedPermissions.value.includes(permission.id))
        .map(permission => permission.id);
});

const getRestrictionName = (permissionId) => {
    const permission = props.roles.flatMap(role => role.permissions).find(permission => permission.id === permissionId);
    return permission ? permission.name.replace(/_/g, ' ') : '';
};

// Example of handling form submission
// const submitForm = () => {
//     // Handle the selected permissions and roles and submit the form
//     console.log("Selected Roles:", selectedRoles.value);
//     console.log("Selected Permissions:", selectedPermissions.value);
// };

onMounted(() => {
    props.userRoles.forEach((userRole) => {
        selectedRoles.value.push(userRole.id);
    });

    // Pre-select the checkboxes based on userPermissions
    props.userPermissions.forEach((permissionId) => {
        selectedPermissions.value.push(permissionId);
    });

    emit('selected-roles-updated', selectedRoles.value);
    emit('selected-permissions-updated', selectedPermissions.value);
});

</script>

<template>
    <div>
        <div class="border rounded-md p-2 my-2">
            Selected Roles:
            <div class="flex flex-wrap gap-2">
                <div v-if="selectedRoles.length > 0" v-for="selectedRoleId in selectedRoles" :key="selectedRoleId"
                    class="bg-indigo-700 text-white rounded-full px-2 py-1 capitalize flex gap-2">
                    {{ getRoleName(selectedRoleId) }}
                    <label :for="'role-' + selectedRoleId"><i
                            class="bi bi-x-lg hover:font-extrabold cursor-pointer text-gray-300 hover:text-white"></i></label>
                </div>
                <div v-else class="text-center w-full font-bold text-lg"> No role selected</div>
            </div>
        </div>
        <div class="border rounded-md p-2 my-2">
            Selected Permissions:
            <!-- {{ selectedPermissions }} -->
            <div class="h-28 overflow-auto mt-2">
                <div class="flex flex-wrap gap-1">
                    <div v-if="selectedPermissions.length > 0" v-for="selectedPermissionId in selectedPermissions"
                        :key="selectedPermissionId"
                        class="bg-green-700 text-white rounded-full px-2 py-1 capitalize whitespace-nowrap flex gap-2">
                        {{ getPermissionName(selectedPermissionId) }}
                        <label :for="'permission-' + selectedPermissionId"><i
                                class="bi bi-x-lg hover:font-extrabold cursor-pointer text-gray-300 hover:text-white"></i></label>
                    </div>
                    <div v-else class="flex justify-center items-center w-full font-bold text-lg"> No permission selected
                    </div>
                </div>
            </div>
        </div>
        <div class="border rounded-md p-2 my-2">
            Restrictions:
            <div class="h-28 overflow-auto mt-2">
                <div class="flex flex-wrap gap-1">
                    <div v-if="restrictedPermissions.length > 0" v-for="restrictedPermissionId in restrictedPermissions"
                        :key="restrictedPermissionId"
                        class="bg-red-700 text-white rounded-full px-2 py-1 capitalize whitespace-nowrap flex gap-2 h-auto">
                        {{ getRestrictionName(restrictedPermissionId) }}
                        <label :for="'permission-' + restrictedPermissionId"><i
                                class="bi bi-x-lg hover:font-extrabold cursor-pointer text-gray-300 hover:text-white"></i></label>
                    </div>
                    <div v-else class="flex justify-center items-center w-full h-full font-bold text-lg"> No restriction
                        selected</div>
                </div>
            </div>

        </div>
        <div>
            <div class="pt-4">Assign Roles</div>
            <hr class="m-0 p-0">
            <div class="flex gap-5">
                <div v-for="role in roles" :key="role.id" class="py-1">
                    <label class="text-lg capitalize flex items-center gap-1 cursor-pointer">
                        <input type="checkbox" v-model="selectedRoles" :value="role.id" :id="'role-' + role.id"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer">
                        {{ role.name.replace(/_/g, ' ') }}
                    </label>
                    <label class="flex items-center gap-1">
                        <input type="checkbox" :checked="isSelectAllChecked(role.id)" @change="toggleAllPermissions(role)"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            :class="!selectedRoles.includes(role.id) ? 'bg-gray-200 shadow-sm focus:ring-gray-400 checked:bg-gray-400 hover:bg-gray-400 cursor-not-allowed' : 'cursor-pointer'"
                            :disabled="!selectedRoles.includes(role.id)">
                        <span v-if="isSelectAllChecked(role.id)"
                            :class="!selectedRoles.includes(role.id) ? 'text-gray-400 cursor-not-allowed' : 'cursor-pointer'">Restrict
                            all</span>
                        <span v-else
                            :class="!selectedRoles.includes(role.id) ? 'text-gray-400 cursor-not-allowed' : 'cursor-pointer'">All
                            permissions</span>
                    </label>
                </div>
            </div>
        </div>
        <div>
            <div class="pt-4">Restrict from</div>
            <!-- <hr class="m-0 p-0"> -->
            <div v-if="selectedRoles.length !== 0"
                class="flex justify-start flex-wrap gap-3 mt-2 border rounded-md p-2 bg-[#f8d7da]">
                <!-- <dd>{{ selectedRoles }}</dd> -->
                <div v-for="role in roles" :key="role.id" class="permission-container">
                    <div v-if="selectedRoles.includes(role.id)" class="p-1 border rounded-md bg-white">

                        <div class="text-lg capitalize flex items-center justify-start gap-1 font-bold px-2 rounded-md">
                            {{ role.name.replace(/_/g, ' ') }}
                        </div>
                        <hr class="m-0 p-0">
                        <div>
                            <div v-for="permission in role.permissions" :key="permission.id" class="py-1">
                                <label
                                    class="text-lg capitalize flex items-center gap-1 cursor-pointer hover:text-green-700"
                                    :class="selectedPermissions.includes(permission.id) ? 'text-green-700' : 'text-red-700'">
                                    <input type="checkbox" :checked="selectedPermissions.includes(permission.id)"
                                        :value="permission.id" v-model="selectedPermissions"
                                        :id="'permission-' + permission.id"
                                        class="rounded border-gray-300 text-green-700 shadow-sm focus:ring-green-700 cursor-pointer">
                                    {{ permission.name.replace(/_/g, ' ') }}
                                </label>
                            </div>
                        </div>

                    </div>

                    <div v-else class="permission-item"></div>
                </div>
            </div>
            <div v-else class="flex justify-center items-center p-1 border rounded-md text-lg font-semibold">
                Select a role to customize permissions
            </div>
        </div>
        <div>
            <div class="pt-4">Give Extra</div>
            <!-- <hr class="m-0 p-0"> -->
            <div v-if="selectedRoles.length !== roles.length"
                class="flex justify-start flex-wrap gap-3 mt-2 border rounded-md p-2 bg-[#d1e7dd]">
                <!-- <dd>{{ selectedRoles }}</dd> -->
                <div v-for="role in roles" :key="role.id" class="permission-container">
                    <div v-if="!selectedRoles.includes(role.id)" class="p-1 border rounded-md bg-white">

                        <div class="text-lg capitalize flex items-center justify-start gap-1 font-bold px-2 rounded-md">
                            {{ role.name.replace(/_/g, ' ') }}
                        </div>
                        <hr class="m-0 p-0">
                        <div>
                            <label class="text-lg capitalize flex items-center gap-1 cursor-pointer">
                                <input type="checkbox" :checked="isSelectAllChecked(role.id)"
                                    @change="toggleAllPermissions(role)"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer">
                                Select all
                            </label>
                            <div v-for="permission in role.permissions" :key="permission.id" class="py-1">
                                <label
                                    class="text-lg capitalize flex items-center gap-1 cursor-pointer hover:text-green-700"
                                    :class="selectedPermissions.includes(permission.id) ? 'text-green-700' : ''">
                                    <input type="checkbox" :checked="selectedPermissions.includes(permission.id)"
                                        :value="permission.id" v-model="selectedPermissions"
                                        :id="'permission-' + permission.id"
                                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-600 cursor-pointer">
                                    {{ permission.name.replace(/_/g, ' ') }}
                                </label>
                            </div>
                        </div>

                    </div>
                    <div v-else class="permission-item"></div>
                </div>
            </div>
            <div v-else class="flex justify-center items-center p-1 border rounded-md text-lg font-semibold">
                No extra permission available
            </div>
        </div>
    <!-- <button type="submit">sub</button> -->
    </div>
</template>


<style>
.permission-container:has(.permission-item) {
    display: none !important;
}
</style>