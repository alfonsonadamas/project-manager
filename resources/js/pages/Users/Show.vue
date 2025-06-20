<script setup lang="ts">
import { reactive, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    user: Object,
    projects: Array,
    assignedProjects: Array,
});

const form = reactive({
    assignedProjects: [],
    errors: {},
    showProjectList: false,
});

const toggleProjectList = () => {
    console.log('Toggle project list visibility');
    form.showProjectList = !form.showProjectList;
};

const assignedProjectIds = computed(() => props.assignedProjects.map(project => project.id));

const availableProjects = computed(() => {
    return props.projects.filter(project => !assignedProjectIds.value.includes(project.id));
});

const assignProjects = () => {
    
    router.put(`/users/${props.user.id}/assign-projects`, { project_ids: form.assignedProjects }, {
        onSuccess: () => {
            Swal.fire('¡Éxito!', 'Proyectos asignados correctamente.', 'success');
            form.showProjectList = !form.showProjectList;
            form.assignedProjects = [];
        },
        onError: (e) => {
            form.errors = e;
        },
    });
};

const removeProject = (projectId) => {
    router.put(`/users/${props.user.id}/remove-project`, { project_id: projectId }, {
        onSuccess: () => {
            Swal.fire('¡Éxito!', 'Proyecto eliminado correctamente.', 'success');
        },
        onError: (e) => {
            form.errors = e;
        },
    });
};
</script>

<template>
    <AppLayout title="Detalles de Usuario">
        <div class="max-w-6xl mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-4">Detalles del Usuario: {{ user.name }}</h1>

            <div class="bg-white p-6 rounded shadow text-black">
                <p><strong>Email:</strong> {{ props.user.email }}</p>
                <p><strong>Rol:</strong> {{ props.user.role_id }}</p>

                <div>
                    <h3 class="mt-4 font-bold">Proyectos Asignados</h3>


                    <table class="min-w-full table-auto bg-white shadow rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="project in user.projects" :key="project.id" class="border-t text-sm">

                                <td class="px-4 py-2">{{ project.name }}</td>
                                <td>
                                    <button @click="removeProject(project.id)"
                                        class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h2 class="mt-4 font-bold">Asignar Proyectos</h2>
                <button @click="toggleProjectList"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-10 mt-5">
                    {{ form.showProjectList ? 'Cerrar' : 'Seleccionar Proyectos' }}
                </button>





                <div v-if="form.showProjectList" class="mt-4">
                    <table class="min-w-full table-auto bg-white shadow rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2">Seleccionar</th>
                                <th class="px-4 py-2">Nombre del Proyecto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="project in availableProjects" :key="project.id" class="border-t text-sm">
                                <td class="px-4 py-2">

                                    <input type="checkbox" :value="project.id" v-model="form.assignedProjects" />
                                </td>
                                <td class="px-4 py-2">{{ project.name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button @click="assignProjects" v-if="form.assignedProjects.length > 0"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4">
                    Asignar Proyectos
                </button>
            </div>
        </div>
    </AppLayout>
</template>