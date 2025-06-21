<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import Swal from 'sweetalert2'

const props = defineProps({
    project: Object,
    userRole: String,
})

const deleteTask = (taskId: number) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción eliminará permanentemente la tarea.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/projects/${props.project.id}/tasks/${taskId}`, {
                onSuccess: () => {
                    Swal.fire('¡Eliminada!', 'La tarea ha sido eliminada.', 'success')
                }
            })
        }
    })
}

</script>

<template>
    <AppLayout :title="`Proyecto: ${project.name}`">
        <div class="max-w-5xl max-sm:w-full mx-auto mt-10 max-sm:px-4">
            <h1 class="text-3xl font-bold mb-4">Proyecto: {{ project.name }}</h1>
            <p class="mb-2"><strong>Descripción:</strong> {{ project.description }}</p>
            <p><strong>Fechas:</strong> {{ project.start_date }} → {{ project.end_date }}</p>
            <p class="mb-4"><strong>Estado:</strong> {{ project.status }}</p>

            <div class="flex justify-between items-center mb-4 max-sm:flex-col">
                <h2 class="text-xl font-semibold">Tareas</h2>
                <Link v-if="userRole === 'Admin'" :href="`/projects/${project.id}/tasks/create`"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded max-sm:w-full text-center max-sm:my-5">
                + Nueva Tarea
                </Link>
            </div>

            <table class="w-full table-auto bg-white shadow rounded text-black overflow-x-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Título</th>
                        <th class="px-4 py-2">Prioridad</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Asignado a</th>
                        <th class="px-4 py-2 text-right" v-if="userRole === 'Admin'">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="task in project.tasks" :key="task.id" class="border-t text-sm">
                        <td class="px-4 py-2">{{ task.title }}</td>
                        <td class="px-4 py-2">{{ task.priority }}</td>
                        <td class="px-4 py-2">{{ task.status }}</td>
                        <td class="px-4 py-2">{{ task.assigned_user?.name ?? '—' }}</td>
                        <td  class="px-4 py-2 text-right space-x-2 max-sm:flex max-sm:flex-col max-sm:items-start">
                            <Link :href="`/projects/${project.id}/tasks/${task.id}/edit`"
                                class="text-blue-600 hover:underline">
                            Editar
                            </Link>
                            <button v-if="userRole === 'Admin'" @click="deleteTask(task.id)" class="text-red-600 hover:underline">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
